<?php

namespace App\Livewire\Content;

use App\Exports\InvoicesExport;
use Livewire\Component;

class Invoices extends Component
{
    public $latestInvoices;

    public $activeFilter = '';

    public $fromDate;
    public $toDate;

    public $orderBy = '';

    public function loadInvoices() {
        $this->latestInvoices = auth()->user()->invoices()->with('shifts')
            ->withSum('shifts', 'total')
            ->when($this->fromDate, fn($query) => $query->whereDate('created_at', '>=', $this->fromDate))
            ->when($this->toDate, fn($query) => $query->whereDate('created_at', '<=', $this->toDate))
            ->when($this->activeFilter === 'thisMonth', function ($query) {
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            })
            ->when($this->activeFilter === 'previousMonth', function ($query) {
                $query->whereMonth('created_at', now()->subMonthNoOverflow()->month)
                    ->whereYear('created_at', now()->subMonthNoOverflow()->year);
            })
            ->when($this->activeFilter === 'thisYear', fn($query) => $query->whereYear('created_at', now()->year))
            ->when($this->orderBy, fn($query) => $query->orderBy($this->orderBy, 'desc'))
            ->get();
    }

    public function thisMonth() {
        $this->activeFilter = $this->activeFilter === 'thisMonth' ? '' : 'thisMonth';
    }

    public function previousMonth() {
        $this->activeFilter = $this->activeFilter === 'previousMonth' ? '' : 'previousMonth';
    }

    public function thisYear() {
        $this->activeFilter = $this->activeFilter === 'thisYear' ? '' : 'thisYear';
    }

    public function clearDateRange() {
        $this->fromDate = null;
        $this->toDate = null;
    }

    public function exportCSV() {
        return new InvoicesExport($this->latestInvoices);
    }

    public function render() {
        $this->dispatch('js:render', [
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
        ]);
        $this->loadInvoices();
        return view('livewire.content.invoices');
    }
}
