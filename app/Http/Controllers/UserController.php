<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu harus login dulu');
        } else {
            return view('/');
        }
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {

        if (Auth::attempt(['user' => $request->user, 'password' => $request->password, 'status' => 'MAHASISWA'])) {
            Session::put('nip', $request->user);
            Session::put('login', TRUE);
            $user = User::all()->count();
            $jadwal = \App\Jadwal::all()->count();
            $kelas = \App\Kelas::all()->count();
            $absen = \App\Absensi::whereDate('created_at', \Carbon\Carbon::today())->count();
            return view('index', ['user' => $user, 'jadwal' => $jadwal, 'kelas' => $kelas, 'absen' => $absen]);
        } else {
            return redirect('login')->with('alert', 'Password atau Email, Salah !');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('login')->with('alert', 'Kamu sudah logout');
    }
}
