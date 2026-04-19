<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class pengeringan extends Model
{
    protected $table = 'pengeringan';

    protected $fillable = [
        'user_id',
        'tanggal',
        'keterangan',
        'dokumentasi',
        'quantity',
        'berita_acara',
        'nominal_pembayaran',
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}
}