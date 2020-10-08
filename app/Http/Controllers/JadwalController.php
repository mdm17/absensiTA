<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = \App\Jadwal::select('jadwal.*', 'kelas.*', 'ruang.nama_ruang', 'matkul.nama_matkul', 'dosen.nama')
            ->join('kelas', 'jadwal.kelas_id', '=', 'kelas.id')
            ->join('ruang', 'jadwal.ruang_id', '=', 'ruang.id')
            ->join('matkul', 'jadwal.matkul_id', '=', 'matkul.id')
            ->join('dosen', 'jadwal.dosen_id', '=', 'dosen.id')
            ->get();
        return view('jadwal.index', ['jadwal' => $jadwal]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ruang = \App\Ruang::all();
        $matkul = \App\Matkul::all();
        $dosen = \App\Dosen::all();
        $kelas = \App\Kelas::all();
        return view('jadwal.create', ['kelas' => $kelas, 'ruang' => $ruang, 'matkul' => $matkul, 'dosen' => $dosen]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'kelas_id' => 'required',
            'matkul_id' => 'required',
            'ruang_id' => 'required',
            'dosen_id' => 'required'
        ]);
        \App\Jadwal::create($request->all());
        return redirect('/jadwal')->with('status', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
