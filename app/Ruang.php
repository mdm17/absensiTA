<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $table = 'ruang';
    protected $fillable = [
        'nama_ruang', 'lokasi', 'lat', 'long'
    ];
}
