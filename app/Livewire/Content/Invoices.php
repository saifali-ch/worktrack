<?php

namespace App\Livewire\Content;

use Livewire\Component;

class Invoices extends Component
{
    public function render() {
        sleep(1);
        return view('livewire.content.invoices');
    }
}
