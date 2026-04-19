<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerahTerima extends Model
{ protected $table = 'serah_terima';
    protected $fillable = [
    'user_id',
    'tanggal',
    'keterangan',
    'dokumentasi',
    'berita_acara',
    'clear',
    'ada_kurang',
    'nominal_pembayaran'
];    public function user()
{
    return $this->belongsTo(User::class);
}
public function pembayaran()
{
    return $this->hasOne(Pembayaran::class);
}

}

