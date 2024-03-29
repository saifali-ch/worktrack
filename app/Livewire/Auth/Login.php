<?php

namespace App\Livewire\Auth;

use App\Mail\MagicLinkMail;
use App\Models\User;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    use WithRateLimiting;

    public $linkSent = false;
    public $email = '';
    public $user = '';

    public function sendMagicLink() {
        try {
            $this->rateLimit(3);
        } catch (TooManyRequestsException $exception) {
            throw ValidationException::withMessages([
                'throttle' => "Slow down! Please wait another $exception->secondsUntilAvailable seconds.",
            ]);
        }

        $this->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $this->user = User::worker()->whereEmail($this->email)->first();

        if (!$this->user) {
            throw ValidationException::withMessages([
                'email' => 'No user found with that email address.'
            ]);
        }

        $expiration = now()->addMinutes((int)config('auth.magiclink_expiration'));
        $params = ['user' => $this->user->id];

        $url = URL::temporarySignedRoute('magiclink.authenticate', $expiration, $params);

        Mail::to($this->email)->send(new MagicLinkMail($url));

        $this->linkSent = true;

    }

    public function back() {
        return to_route('login');
    }

    public function render() {
        return view('livewire.auth.login');
    }
}
