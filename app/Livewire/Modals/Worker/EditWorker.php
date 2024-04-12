<?php

namespace App\Livewire\Modals\Worker;

use App\Livewire\Modals\BaseModal;
use App\Models\User;

class EditWorker extends BaseModal
{
    public $modalId = 'edit-worker';

    public User $worker;

    public $first_name;
    public $last_name;
    public $email;
    public $address;
    public $post_code;
    public $account_name;
    public $short_code;
    public $account_number;

    public function init($id) {
        $this->worker = User::worker()->findOrFail($id);
        $this->first_name = $this->worker->first_name;
        $this->last_name = $this->worker->last_name;
        $this->email = $this->worker->email;
        $this->address = $this->worker->address;
        $this->post_code = $this->worker->post_code;
        $this->account_name = $this->worker->account_name;
        $this->short_code = $this->worker->short_code;
        $this->account_number = $this->worker->account_number;
    }

    public function update() {
        $this->worker->update($this->validate());

        $this->toast('success', 'Worker update successfully!');
        $this->dispatch('worker-updated');
        $this->hide();
    }

    public function activate() {
        $this->worker->update(['active' => 1]);

        $this->toast('success', 'Worker activated successfully!');
        $this->dispatch('worker-updated');
        $this->hide();
    }

    public function deactivate() {
        $this->worker->update(['active' => 0]);

        $this->toast('success', 'Worker deactivated successfully!');
        $this->dispatch('worker-updated');
        $this->hide();
    }

    public function rules() {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:users,email,'.$this->worker->id,
            'address' => 'nullable|string',
            'post_code' => 'nullable|string',
            'account_name' => 'nullable|string',
            'short_code' => 'nullable|string',
            'account_number' => 'nullable|string'
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
        return view('livewire.modals.worker.edit-worker');
    }
}
