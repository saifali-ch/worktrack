<?php

namespace App\Livewire\Worker;

use Livewire\Attributes\On;
use Livewire\Component;

class Home extends Component
{
    public $currentPage = 'dashboard';

    #[On('changePage')]
    public function setCurrentPage($page) {
        $this->currentPage = $page;
    }

    public function render() {
        return view('livewire.worker.home');
    }
}
