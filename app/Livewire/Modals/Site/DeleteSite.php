<?php

namespace App\Livewire\Modals\Site;

use App\Livewire\Modals\BaseModal;
use App\Models\Site;

class DeleteSite extends BaseModal
{
    public $modalId = 'delete-site';

    public Site $site;

    public function init($id) {
        $this->site = Site::findOrFail($id);
    }

    public function destroy() {
        $this->site->delete();

        $this->toast('success', 'Site deleted successfully!');
        $this->dispatch('site-deleted');
        $this->hide();
    }

    public function render() {
        return view('livewire.modals.site.delete-site');
    }
}
