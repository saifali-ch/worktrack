<?php

namespace App\Livewire\Modals\Worker;

use App\Livewire\Modals\BaseModal;
use App\Models\User;
use Illuminate\Support\Str;

class AddWorker extends BaseModal
{

    public $modalId = 'add-worker';

    public $first_name;
    public $last_name;
    public $email;

    public function store() {
        $data = $this->validate();
        $data['role'] = 'worker';
        $data['password'] = Str::password();

        User::create($data);

        $this->toast('success', 'Worker added successfully!');
        $this->dispatch('worker-added');
        $this->hide();
    }

    public function rules() {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:users,email',
        ];
    }

    public function messages() {
        return [
            'first_name' => 'First name is required',
            'last_name' => 'Last name is required',
            'email.required' => 'Email is required!',
            'email.unique' => 'Email already exists!',
        ];
    }

    public function render() {
        return view('livewire.modals.worker.add-worker');
    }
}
