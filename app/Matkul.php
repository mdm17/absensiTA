<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkul';
    protected $fillable = [
        'diploma', 'semester', 'kode', 'nama_matkul', 'sks', 'jml_jam'
    ];
}
