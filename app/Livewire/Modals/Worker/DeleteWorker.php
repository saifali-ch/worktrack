<?php

namespace App\Livewire\Modals\Worker;

use App\Livewire\Modals\BaseModal;
use App\Models\User;

class DeleteWorker extends BaseModal
{
    public $modalId = 'delete-worker';

    public User $worker;

    public function init($id) {
        $this->worker = User::worker()->findOrFail($id);
    }

    public function destroy() {
        $this->worker->delete();

        $this->toast('success', 'Worker deleted successfully!');
        $this->dispatch('worker-deleted');
        $this->hide();
    }

    public function render() {
        return view('livewire.modals.worker.delete-worker');
    }
}
