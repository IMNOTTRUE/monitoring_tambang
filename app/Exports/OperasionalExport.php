<?php

namespace App\Exports;

use App\Models\PembayaranOperasional;
use Maatwebsite\Excel\Concerns\FromCollection;

class OperasionalExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PembayaranOperasional::all();
    }
}
