<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    protected $table = 'penerimaan';

    protected $fillable = [
        'user_id',
        'tanggal',
        'keterangan',
        'dokumentasi',
        'berita_acara',
        'nominal_pembayaran',
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}
}