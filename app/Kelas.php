<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = [
        'semester', 'nama_kelas', 'diploma'
    ];
}
