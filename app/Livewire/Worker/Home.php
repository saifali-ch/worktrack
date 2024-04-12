<?php

namespace App\Livewire\Worker;

use Livewire\Attributes\On;
use Livewire\Component;

class Home extends Component
{
    public $currentPage;

    public function mount() {
        $this->currentPage = auth()->user()->isAdmin() ? 'sites' : 'dashboard';
    }

    #[On('changePage')]
    public function setCurrentPage($page) {
        $this->currentPage = $page;
    }

    public function render() {
        return auth()->user()->isAdmin()
            ? view('livewire.admin.home')
            : view('livewire.worker.home');
    }
}
