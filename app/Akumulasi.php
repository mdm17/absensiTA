<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akumulasi extends Model
{
    protected $table = 'akumulasi';
    protected $fillable = [
        'mhs_nim', 'jumlah'
    ];
}
