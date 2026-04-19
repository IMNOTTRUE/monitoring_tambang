<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pekerja extends Model
{   protected $table = 'pekerja';
    protected $fillable = [
    'nama',
    'jabatan',
    'no_hp',
    'alamat',
    'lokasi',
    'gaji' // 🔥 tambahin ini
];
public function gaji()
{
    return $this->hasMany(PembayaranGaji::class);
}
}
