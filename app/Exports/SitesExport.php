<?php

namespace App\Exports;

use App\Models\Site;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SitesExport implements FromCollection, WithHeadings, WithMapping, Responsable
{

    use Exportable;

    private $fileName;

    public function __construct(protected Collection $sites) {
        $this->fileName = "sites.csv";
    }

    public function headings(): array {
        return [
            'ID',
            'Name',
            'Creation Date',
        ];
    }

    /**
     * @param Site $row
     */
    public function map($row): array {
        return [
            $row->id,
            $row->name,
            $row->created_at->format('F d, Y'),
        ];
    }

    public function collection() {
        return $this->sites;
    }
}
