<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MagicLinkController extends Controller
{
    public function authenticate(Request $request) {
        $user = User::worker()->findOrFail($request->user);

        if (!url()->hasValidSignature($request)) {
            return to_route('login')->withErrors(['url' => 'Invalid or expired URL.']);
        }

        auth()->login($user);

        return $user->first_login
            ? to_route('worker.profile')
            : to_route('worker.dashboard');
    }

    public function logout() {
        $isAdmin = auth()->user()->isAdmin();
        auth()->logout();

        return $isAdmin
            ? to_route('admin.login')
            : to_route('login');
    }
}
