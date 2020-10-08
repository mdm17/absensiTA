<?php

namespace App\Http\Controllers;

class DataMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = \App\Mahasiswa::select('mahasiswa.*', 'kelas.nama_kelas')
            ->join('kelas', 'mahasiswa.kelas_id', '=', 'kelas.id')
            ->get();
        $kelas = \App\Kelas::all();
        $ruang = \App\Ruang::all();
        $dosen = \App\Dosen::all();
        $matkul = \App\Matkul::all();
        return view('data-master.index', ['mahasiswa' => $mahasiswa, 'kelas' => $kelas, 'ruang' => $ruang, 'dosen' => $dosen, 'matkul' => $matkul]);
    }
}
