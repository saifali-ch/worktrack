<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class WorkersExport implements FromCollection, WithHeadings, WithMapping, Responsable
{

    use Exportable;

    private $fileName;

    public function __construct(protected Collection $workers) {
        $this->fileName = "workers.csv";
    }

    public function headings(): array {
        return [
            'ID',
            'Name',
            'Email',
            'Address',
            'Post Code',
            'Account Name',
            'Short Code',
            'Account Number',
            'Active',
            'Created At'
        ];
    }

    /**
     * @param User $row
     */
    public function map($row): array {
        return [
            $row->id,
            $row->name,
            $row->email,
            $row->address,
            $row->post_code,
            $row->account_name,
            $row->short_code,
            $row->account_number,
            $row->active ? 'Yes' : 'No',
            $row->created_at->format('F d, Y'),
        ];
    }

    public function collection() {
        return $this->workers;
    }
}
