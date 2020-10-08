<?php

namespace App\Http\Controllers;

use App\Akumulasi;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = \App\Kelas::all();
        return view('absensi.index', ['kelas' => $kelas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        Date::setLocale('id');
        $date = new Date($request->input('date'));
        $jadwal = \App\Jadwal::select('jadwal.*', 'kelas.*', 'ruang.*', 'matkul.*', 'dosen.*')
            ->where('hari', strtoupper($date->format('l')))
            ->where('kelas_id', $request->input('kelas'))
            ->join('kelas', 'jadwal.kelas_id', '=', 'kelas.id')
            ->join('ruang', 'jadwal.ruang_id', '=', 'ruang.id')
            ->join('matkul', 'jadwal.matkul_id', '=', 'matkul.id')
            ->join('dosen', 'jadwal.dosen_id', '=', 'dosen.id')
            ->get();
        $mahasiswa = \App\Mahasiswa::select()->where('kelas_id', $request->input('kelas'))->get();
        $absensi = \App\Absensi::select()
            ->where('kelas', $request->input('kelas'))
            ->whereDate('created_at', $request->input('date'))->get();
        return view('absensi.monitoring', ['mahasiswa' => $mahasiswa, 'absensi' => $absensi, 'jadwal' => $jadwal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function akumulasi($id)
    {
        $success['mahasiswa'] = \App\Mahasiswa::select('*')
            // ->join('akumulasi', 'mahasiswa.nim', '=', 'akumulasi.mhs_nim')
            ->where('nim', $id)->get();
        // $success['mahasiswa'] = \App\Mahasiswa::where('nim', $id);
        $akumulasi = DB::table('akumulasi')
            ->where('mhs_nim', $id)
            ->sum('jumlah');
        $success['kompen'] = gmdate("H:i:s", $akumulasi);
        return response()->json(['success' => [$success]], 200);
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
