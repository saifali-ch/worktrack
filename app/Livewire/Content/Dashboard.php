<?php

namespace App\Livewire\Content;

use App\Models\User;
use Illuminate\Support\Number;
use Livewire\Component;

class Dashboard extends Component
{
    public User $user;

    public $totalInvoices;
    public $latestInvoices;
    public $totalIncome;
    public $currentMonthIncome;
    public $growth;

    public $page = 'invoices';

    public function mount() {
        $this->user = auth()->user();
        $invoices = $this->user->invoices()->with('shifts')
            ->latest()
            ->orderByDesc('id')
            ->get();

        $this->totalInvoices = $invoices->count();

        $this->latestInvoices = $invoices->take(15);

        $this->totalIncome = $invoices->sum(fn($invoice) => $invoice->shifts->sum('total'));

        $this->currentMonthIncome = $invoices
            ->filter(fn($invoice) => $invoice->created_at->isCurrentMonth())
            ->sum(fn($invoice) => $invoice->shifts->sum('total'));

        $lastMonthIncome = $invoices
            ->filter(fn($invoice) => $invoice->created_at->isLastMonth())
            ->sum(fn($invoice) => $invoice->shifts->sum('total'));

        $this->growth = $lastMonthIncome
            ? (($this->currentMonthIncome - $lastMonthIncome) / $lastMonthIncome) * 100
            : 0;

        $this->growth = round($this->growth, 1);
        $this->totalIncome = Number::currency($this->totalIncome, 'USD', true);
        $this->currentMonthIncome = Number::currency($this->currentMonthIncome, 'USD', true);
    }

    public function render() {
        return view('livewire.content.dashboard');
    }
}
