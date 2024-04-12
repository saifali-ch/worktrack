<?php

namespace App\Livewire\Modals\Site;

use App\Livewire\Modals\BaseModal;
use App\Models\Site;

class AddSite extends BaseModal
{
    public $modalId = 'add-site';

    public $name;

    public function store() {
        Site::create($this->validate());

        $this->toast('success', 'Site added successfully!');
        $this->dispatch('site-added');
        $this->hide();
    }

    public function rules() {
        return [
            'name' => 'required|string|unique:sites,name',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Site name is required!',
            'name.unique' => 'Site already exists!',
        ];
    }

    public function render() {
        return view('livewire.modals.site.add-site');
    }
}
