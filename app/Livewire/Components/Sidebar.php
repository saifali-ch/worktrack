<?php

namespace App\Livewire\Components;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class Sidebar extends Component
{
    public $class;

    #[Modelable]
    public $currentPage;

    public function render() {
        return view('livewire.components.sidebar');
    }
}
