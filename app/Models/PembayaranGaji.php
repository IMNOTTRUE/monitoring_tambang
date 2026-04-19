<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranGaji extends Model
{
    
protected $fillable = [
    'pekerja_id',
    'lokasi',
    'nama_karyawan',
    'nominal',
    'bulan',
    'tahun',
    'status',
    'tanggal'
];
public function pekerja()
{
    return $this->belongsTo(Pekerja::class);
}
}
