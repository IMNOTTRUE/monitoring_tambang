<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cctv extends Model
{
    protected $table = 'cctv';

    protected $fillable = [
        'nama',
        'lokasi',
        'url'
    ];
}
