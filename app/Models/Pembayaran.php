<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

protected $fillable = [
    'serah_terima_id',
    'user_id',
    'nominal',
    'status',
    'tanggal_bayar',
    'bukti_pembayaran', // 🔥 tambah ini
];
    public function user()
{
    return $this->belongsTo(User::class);
}
public function serahTerima()
{
    return $this->belongsTo(\App\Models\SerahTerima::class);
}
}