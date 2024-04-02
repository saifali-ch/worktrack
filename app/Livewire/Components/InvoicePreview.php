<?php

namespace App\Livewire\Components;

use App\Models\Invoice;
use App\Models\Site;
use Illuminate\Support\Number;
use Livewire\Component;

class InvoicePreview extends Component
{
    public $sites;
    public $user;
    public $invoice;
    public $shifts;
    public $total;

    protected $listeners = [
        'showInvoicePreview' => 'show'
    ];

    public function mount() {
        $this->sites = Site::all();
        $this->user = auth()->user();
    }

    public function show(Invoice $invoice) {
        if ($invoice->user_id !== $this->user->id) {
            abort(403);
        }
        $this->invoice = $invoice;
        $this->shifts = $invoice->shifts()->with('site')->get();
        $this->total = $this->shifts->sum('total');
        $this->total = Number::currency($this->total, 'GBP');
        $this->dispatch('show:invoice-preview');
    }

    public function render() {
        return view('livewire.components.invoice-preview');
    }
}
