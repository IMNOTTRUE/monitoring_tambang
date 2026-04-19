<?php

namespace App\Exports;

use App\Models\KasKeuangan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; // 🔥 ini ditaruh di atas

class KasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return KasKeuangan::select(
            'tanggal',
            'lokasi',
            'keterangan',
            'jenis',
            'nominal'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Lokasi',
            'Keterangan',
            'Jenis',
            'Nominal'
        ];
    }
}