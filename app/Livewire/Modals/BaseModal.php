<?php

namespace App\Livewire\Modals;

use App\Traits\Toast;
use Livewire\Attributes\On;
use Livewire\Component;

class BaseModal extends Component
{
    use Toast;

    public $modalId;
    public $visible = false;

    #[On('showModal')]
    public function show($modalId, $id = null) {
        if ($this->modalId === $modalId) {
            $this->visible = true;
            $this->init($id);
        }
    }

    public function init($id) {
    }

    #[On('hideModal')]
    public function hide() {
        $this->visible = false;
        $this->clearValidation();
        $this->reset();
    }
}
