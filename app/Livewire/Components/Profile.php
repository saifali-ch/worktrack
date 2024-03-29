<?php

namespace App\Livewire\Components;

use App\Models\User;
use App\Traits\Toast;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads, Toast;

    public User $user;
    public $uploaded_photo;
    public $first_name;
    public $last_name;
    public $address;
    public $post_code;
    public $account_name;
    public $short_code;
    public $account_number;

    public $actions = false;
    public $isUpdate = false;


    public function mount() {
        $this->user = auth()->user();
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->address = $this->user->address;
        $this->post_code = $this->user->post_code;
        $this->account_name = $this->user->account_name;
        $this->short_code = $this->user->short_code;
        $this->account_number = $this->user->account_number;

    }

    public function updated($propertyName) {
        if ($propertyName === 'uploaded_photo') {
            try {
                $this->validateOnly($propertyName);
            } catch (ValidationException $e) {
                $this->uploaded_photo = null;
                $this->addError('uploaded_photo', $e->getMessage());
            }
        }
    }

    public function removePhoto() {
        $this->uploaded_photo = null;
    }

    #[On('saveProfile')]
    public function save() {
        $data = $this->validate();

        if ($data['uploaded_photo']) {
            $data['photo'] = $this->uploaded_photo->store();
        }
        unset($data['uploaded_photo']);

        auth()->user()->update($data);
        $this->markAsRegularUser();

        $this->toast('success', 'Profile updated successfully');
        return $this->isUpdate ? null : to_route('worker.dashboard');
    }

    public function markAsRegularUser() {
        auth()->user()->update([
            'first_login' => false
        ]);
    }

    public function doItLater() {
        $this->markAsRegularUser();
        return to_route('worker.dashboard');
    }

    public function rules() {
        $rules = [
            'uploaded_photo' => 'nullable|image|max:1024',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ];

        if (auth()->user()->isWorker()) {
            $rules = array_merge($rules, [
                'address' => 'required|string|max:255',
                'post_code' => 'required|string|max:255',
                'account_name' => 'required|string|max:255',
                'short_code' => 'required|string|max:255',
                'account_number' => 'required|string|max:255',
            ]);
        }

        return $rules;
    }

    public function messages() {
        return [
            'uploaded_photo.image' => 'Please select a photo',
            'uploaded_photo.max' => 'Photo size must be less than or equal to 1MB/1024KB',
        ];
    }

    public function render() {
        return view('livewire.components.profile');
    }
}
