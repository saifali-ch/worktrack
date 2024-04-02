<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Number;

class InvoiceController extends Controller
{
    public function download(Invoice $invoice) {
        Gate::authorize('download', $invoice);

        $user = auth()->user();
        $shifts = $invoice->shifts()->with('site')->get();
        $grandTotal = Number::currency($shifts->sum('total'), 'GBP');

        $pdf = Pdf::loadView('components.invoice-download', compact('user', 'invoice', 'shifts', 'grandTotal'));
        return $pdf->download("invoice-$invoice->padded_id");
    }
}
