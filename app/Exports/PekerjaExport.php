<?php

namespace App\Exports;

use App\Models\Pekerja;
use Maatwebsite\Excel\Concerns\FromCollection;

class PekerjaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pekerja::all();
    }
}
