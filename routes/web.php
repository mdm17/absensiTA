<?php

use App\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/', function () {
        $user = User::all()->count();
        $jadwal = \App\Jadwal::all()->count();
        $kelas = \App\Kelas::all()->count();
        $absen = \App\Absensi::whereDate('created_at', \Carbon\Carbon::today())->count();
        return view('index', ['user' => $user, 'jadwal' => $jadwal, 'kelas' => $kelas, 'absen' => $absen]);
    });

    // Route::get('/data-master', function () {
    //     return view('data-master.index');
    // });
    Route::get('/data-master', 'DataMasterController@index');
    Route::get('/jadwal', 'JadwalController@index');
    Route::get('/absensi', 'AbsensiController@index');
    Route::get('/mahasiswa/create', 'MahasiswaController@create');
    Route::get('/dosen/create', 'DosenController@create');
    Route::get('/kelas/create', 'KelasController@create');
    Route::get('/ruang/create', 'RuangController@create');
    Route::get('/matkul/create', 'MatkulController@create');
    Route::get('/jadwal/create', 'JadwalController@create');
    Route::get('/ruang/{ruang}', 'RuangController@show');
    Route::get('/absensi/show', 'AbsensiController@show');
    Route::get('/akumulasi/{akumulasi}', 'AbsensiController@akumulasi');
    Route::post('/mahasiswa', 'MahasiswaController@store');
    Route::post('/dosen', 'DosenController@store');
    Route::post('/kelas', 'KelasController@store');
    Route::post('/ruang', 'RuangController@store');
    Route::post('/matkul', 'MatkulController@store');
    Route::post('/jadwal', 'JadwalController@store');
});
Route::get('/login', 'UserController@login')->name('login');
Route::post('/loginPost', 'UserController@loginPost');
Route::get('/logout', 'UserController@logout');
