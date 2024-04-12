<?php

namespace App\Livewire\Content\Admin;

use App\Exports\WorkersExport;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Workers extends Component
{
    public $workers;

    public $orderBy = '';
    public $active = true;


    #[On('worker-added')]
    #[On('worker-updated')]
    #[On('worker-deleted')]
    public function loadWorkers() {
        $this->workers = User::worker()
            ->when($this->active === true, fn($query) => $query->whereActive(true))
            ->when($this->active === false, fn($query) => $query->whereActive(false))
            ->when($this->orderBy, fn($query) => $query->orderBy($this->orderBy, 'desc'))
            ->get();
    }

    public function activated() {
        $this->active = true;
    }

    public function deactivated() {
        $this->active = false;
    }

    public function exportCSV() {
        return new WorkersExport($this->workers);
    }

    public function render() {
        $this->dispatch('js:render');
        $this->loadWorkers();
        return view('livewire.content.admin.workers');
    }
}
