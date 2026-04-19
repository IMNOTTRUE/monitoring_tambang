<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasKeuangan extends Model
{
    protected $table = 'kas_keuangan';

protected $fillable = [
    'lokasi',
    'jenis',
    'nominal',
    'keterangan',
    'tanggal',
];
}
