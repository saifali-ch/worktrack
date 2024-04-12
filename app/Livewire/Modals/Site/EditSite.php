<?php

namespace App\Livewire\Modals\Site;

use App\Livewire\Modals\BaseModal;
use App\Models\Site;

class EditSite extends BaseModal
{
    public $modalId = 'edit-site';

    public Site $site;

    public $name;

    public function init($id) {
        $this->site = Site::findOrFail($id);
        $this->name = $this->site->name;
    }

    public function update() {
        $this->site->update($this->validate());

        $this->name = '';
        $this->toast('success', 'Site update successfully!');
        $this->dispatch('site-updated');
        $this->hide();
    }

    public function rules() {
        return [
            'name' => 'required|string|unique:sites,name,'.$this->site->id,
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Site name is required!',
            'name.unique' => 'Site already exists!',
        ];
    }

    public function render() {
        return view('livewire.modals.site.edit-site');
    }
}
