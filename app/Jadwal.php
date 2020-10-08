<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = [
        'hari', 'jam_mulai', 'jam_selesai', 'kelas_id', 'matkul_id', 'ruang_id', 'dosen_id'
    ];
}
