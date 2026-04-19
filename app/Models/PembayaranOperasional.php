<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranOperasional extends Model
{
protected $fillable = [
    'lokasi',
    'nominal',
    'keterangan',
    'tanggal'
];
}
