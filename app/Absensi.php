<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $fillable = [
        'ruang', 'kelas', 'hari', 'pertemuan', 'mhs_nim', 'mhs_nama', 'matkul', 'bahasan', 'nip_dosen', 'absen_ket'
    ];
}
