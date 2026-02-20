<?php

namespace App\Exports;

use App\Models\Rapat;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AbsensiExport implements WithMultipleSheets
{
    protected Rapat $rapat;

    public function __construct(Rapat $rapat)
    {
        $this->rapat = $rapat;
    }

    public function sheets(): array
    {
        return [
            new InfoRapatSheet($this->rapat),
            new DaftarAbsensiSheet($this->rapat),
        ];
    }
}