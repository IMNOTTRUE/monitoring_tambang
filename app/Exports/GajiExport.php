<?php

namespace App\Exports;

use App\Models\PembayaranGaji;
use Maatwebsite\Excel\Concerns\FromCollection;

class GajiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PembayaranGaji::all();
    }
}
