<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\UserController@login');

Route::group(['middleware' => 'auth:api'], function () {
  Route::get('details', 'API\UserController@details');
  // Route::get('absensi/jadwal', 'API\AbsensiController@jadwal');
  // Route::post('absensi/store', 'API\AbsensiController@store');
});
// Route::get('details', 'API\UserController@details');
Route::get('absensi/verification', 'API\AbsensiController@verification');
Route::get('absensi/jadwal', 'API\AbsensiController@jadwal');
Route::get('absensi/validasi', 'API\AbsensiController@validated');
Route::get('absensi/get', 'API\AbsensiController@getMahasiswa');
Route::put('absensi/validasi/{absensi}', 'API\AbsensiController@editValidated');
Route::post('absensi/store', 'API\AbsensiController@store');
Route::post('absensi/input', 'API\AbsensiController@inputMahasiswa');
