<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InvoicesExport implements FromCollection, WithHeadings, WithMapping, Responsable
{

    use Exportable;

    private $fileName;

    public function __construct(protected Collection $invoices) {
        $time = time();
        $this->fileName = "invoices-$time.csv";
    }

    public function headings(): array {
        return [
            'ID',
            'Date',
            'Amount',
            'Status',
        ];
    }

    /**
     * @param Invoice $row
     */
    public function map($row): array {
        return [
            $row->id,
            $row->created_at->format('F d, Y'),
            $row->amount,
            $row->status
        ];
    }

    public function collection() {
        return $this->invoices;
    }
}
