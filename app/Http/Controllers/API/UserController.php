<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Jenssegers\Date\Date;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login()
    {
        Date::setLocale('id');
        if (Auth::attempt(['user' => request('user'), 'password' => request('password'), 'status' => 'MAHASISWA'])) {

            $user = Auth::user();

            $success['token'] =  $user->createToken('nApp')->accessToken;
            $mahasiswa = \App\Mahasiswa::select('*')->where('nim', request('user'))->get();
            $success['jadwal'] = \App\Jadwal::select('jadwal.*', 'kelas.nama_kelas', 'ruang.nama_ruang', 'matkul.nama_matkul', 'dosen.nama')
                ->where('hari', strtoupper(Date::now()->format('l')))
                ->where('kelas_id', $mahasiswa[0]{
                    'kelas_id'})
                ->join('kelas', 'jadwal.kelas_id', '=', 'kelas.id')
                ->join('ruang', 'jadwal.ruang_id', '=', 'ruang.id')
                ->join('matkul', 'jadwal.matkul_id', '=', 'matkul.id')
                ->join('dosen', 'jadwal.dosen_id', '=', 'dosen.id')
                ->get();
            $success['nama'] = $mahasiswa[0]{
                'nama'};
            $success['nim'] = $mahasiswa[0]{
                'nim'};
            $success['status'] = 'MAHASISWA';
            return response()->json(['success' => [$success]], $this->successStatus);
        } elseif (Auth::attempt(['user' => request('user'), 'password' => request('password'), 'status' => 'DOSEN'])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('nApp')->accessToken;
            $dosen = \App\Dosen::select('*')->where('nip', request('user'))->get();
            $success['jadwal'] = \App\Jadwal::select('jadwal.*', 'kelas.nama_kelas', 'ruang.nama_ruang', 'matkul.nama_matkul')
                ->where('hari', strtoupper(Date::now()->format('l')))
                ->where('dosen_id', $dosen[0]{
                    'id'})
                ->join('kelas', 'jadwal.kelas_id', '=', 'kelas.id')
                ->join('ruang', 'jadwal.ruang_id', '=', 'ruang.id')
                ->join('matkul', 'jadwal.matkul_id', '=', 'matkul.id')
                ->get();
            $success['nama'] = $dosen[0]{
                'nama'};
            $success['nim'] = $dosen[0]{
                'nip'};
            $success['status'] = 'DOSEN';
            return response()->json(['success' => [$success]], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
