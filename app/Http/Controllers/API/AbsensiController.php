<?php

namespace App\Http\Controllers\API;

use App\Absensi;
use App\Http\Controllers\Controller;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Phpml\Classification\KNearestNeighbors;

class AbsensiController extends Controller
{
    public $successStatus = 200;
    public function store(Request $request)
    {
        $ruang = $request->input('ruang');
        $dosen = $request->input('dosen');
        $matkul = $request->input('matkul');
        $mhs_nim = $request->input('mhs_nim');
        $mhs_nama = $request->input('mhs_nama');
        $kelas = $request->input('kelas');
        $hari = $request->input('hari');
        $awal = strtotime($request->input('jam_mulai'));
        // $akhir = strtotime('07:10:00');
        $akhir = time(date("h:i:s"));
        $diff = $akhir - $awal;

        $data = new \App\Absensi();
        $data->ruang = $ruang;
        $data->nip_dosen = $dosen;
        $data->matkul = $matkul;
        $data->hari = $hari;
        $data->mhs_nim = $mhs_nim;
        $data->mhs_nama = $mhs_nama;
        $data->kelas = $kelas;

        $total = new \App\Akumulasi();
        $total->mhs_nim = $mhs_nim;
        if ($diff >= 5000) {
            $diff = 5000;
        }
        $total->jumlah = $diff;


        $absen = \App\Absensi::select('mhs_nim', 'ruang', 'created_at')->where('matkul', '=', $matkul)->where('mhs_nim', '=', $mhs_nim)
            ->whereDate('created_at', date('Y-m-d'))
            ->get();
        if ($absen == '[]') {
            $data->save();
            if ($diff > 900) {
                $total->save();
            }

            $res['success'] = 1;
            $res['value'] = $data;
            return response()->json($res, $this->successStatus);
        } else {
            $res['success'] = 0;
            return response()->json($res, 200);
        }
    }
    public function jadwal(Request $request)
    {
        Date::setLocale('id');
        if ($request->input('status') == "MAHASISWA") {
            $mahasiswa = \App\Mahasiswa::select('*')->where('nim', $request->input('nim'))->get();
            $success = \App\Jadwal::select('jadwal.*', 'kelas.*', 'ruang.*', 'matkul.*', 'dosen.*')
                ->where('hari', 'SENIN')
                ->where('kelas_id', $mahasiswa[0]{
                    'kelas_id'})
                ->join('kelas', 'jadwal.kelas_id', '=', 'kelas.id')
                ->join('ruang', 'jadwal.ruang_id', '=', 'ruang.id')
                ->join('matkul', 'jadwal.matkul_id', '=', 'matkul.id')
                ->join('dosen', 'jadwal.dosen_id', '=', 'dosen.id')
                ->get();
            return response()->json(['results' => $success], $this->successStatus);
        } elseif ($request->input('status') == "DOSEN") {
            $dosen = \App\Dosen::select('*')->where('nip', $request->input('nim'))->get();
            $success = \App\Jadwal::select('jadwal.*', 'kelas.*', 'ruang.*', 'matkul.*', 'dosen.*')
                ->where('hari', 'SENIN')
                ->where('dosen_id', $dosen[0]{
                    'id'})
                ->join('kelas', 'jadwal.kelas_id', '=', 'kelas.id')
                ->join('ruang', 'jadwal.ruang_id', '=', 'ruang.id')
                ->join('matkul', 'jadwal.matkul_id', '=', 'matkul.id')
                ->join('dosen', 'jadwal.dosen_id', '=', 'dosen.id')
                ->get();
            return response()->json(['results' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    public function verification(Request $request)
    {
        $ruang = \App\Ruang::all();

        if (\App\Ruang::where('id', '=', $request->input('id'))->exists()) {
            foreach ($ruang as $data) {
                // $jarak = [floatval($data->lat), floatval($data->long)];
                $samples[] = [floatval($data->lat), floatval($data->long)];
                $label[] = $data->lokasi;
            }
            $classifier = new KNearestNeighbors();
            $classifier->train($samples, $label);
            $hasil = $classifier->predict([floatval($request->input('lat')), floatval($request->input('long'))]);
            $id = \App\Ruang::select('*')->where('id', '=', $request->input('id'))->get();
            if ($id[0]{
                'lokasi'} == $hasil) {
                $longitude1 = $request->input('long');
                $longitude2 = $id[0]{
                    'long'};
                $latitude1 = $request->input('lat');
                $latitude2 = $id[0]{
                    'lat'};
                $theta = $longitude1 - $longitude2;
                $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)))  + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
                $distance = acos($distance);
                $distance = rad2deg($distance);
                $distance = $distance * 60 * 1.1515;
                $distance = $distance * 1.609344;
                $distance = $distance * 1000;
                if (round($distance) < 500) {
                    return response()->json(['results' => 'success'], $this->successStatus);
                }
                return response()->json(['results' => 'lokasi terlalu jauh'], $this->successStatus);
            }
            return response()->json(['results' => 'lokasi salah'], $this->successStatus);
        } else {
            return response()->json(['results' => 'id tidak di temukan'], 401);
        }
    }
    public function validated(Request $request)
    {
        $absen = \App\Absensi::select('mhs_nim', 'mhs_nama', 'id')
            ->where('absen_ket', '=', null)
            ->where('kelas', '=', $request->input('kelas'))
            ->where('nip_dosen', '=', $request->input('dosen'))
            ->whereDate('created_at', date('Y-m-d'))
            ->get();
        return response()->json(['results' => $absen], $this->successStatus);
    }
    public function editValidated(Request $request, Absensi $absensi)
    {
        if ($request->input('confirm') == 0) {
            Absensi::where('id', $absensi->id)
                ->update(['absen_ket' => 'ALPHA']);
            return response()->json(['results' => 'alpha'], $this->successStatus);
        } elseif (request('confirm') == 1) {
            Absensi::where('id', $absensi->id)
                ->update(['absen_ket' => 'HADIR']);
            return response()->json(['results' => 'hadir'], $this->successStatus);
        } else {
            return response()->json(['results' => 0], $this->successStatus);
        }
    }
    public function getMahasiswa(Request $request)
    {
        $absen = \App\Absensi::select('mhs_nim')
            ->whereIn('absen_ket',  [null, 'IZIN', 'ALPHA', 'SAKIT', 'DITUGASKAN'])
            ->where('kelas', '=', $request->input('kelas'))
            ->where('nip_dosen', '=', $request->input('dosen'))
            ->whereDate('created_at', date('Y-m-d'))
            ->get()->toArray();
        $mahasiswa = \App\Mahasiswa::select('*')
            // ->leftJoin('absensi', 'absensi.mhs_nim', '=', 'mahasiswa.nim')
            // ->where('mhs_nim', NULL)
            // ->where('absen_ket', null)
            // ->whereDate('absensi.created_at', date('Y-m-d'))
            ->where('kelas_id', '=', $request->input('kelas'))
            ->whereNotIn('nim', $absen)
            ->get();
        return response()->json(['results' => $mahasiswa], $this->successStatus);
    }
    public function inputMahasiswa(Request $request)
    {
        $ruang = $request->input('ruang');
        $dosen = $request->input('dosen');
        $matkul = $request->input('matkul');
        $mhs_nim = $request->input('mhs_nim');
        $mhs_nama = $request->input('mhs_nama');
        $kelas = $request->input('kelas');
        $hari = $request->input('hari');


        $data = new \App\Absensi();
        $data->ruang = $ruang;
        $data->nip_dosen = $dosen;
        $data->matkul = $matkul;
        $data->hari = $hari;
        $data->mhs_nim = $mhs_nim;
        $data->mhs_nama = $mhs_nama;
        $data->kelas = $kelas;

        $total = new \App\Akumulasi();
        $total->mhs_nim = $mhs_nim;
        $total->jumlah = 5000;


        if ($request->input('ket') == 1) {
            $data->absen_ket = "IZIN";
            $data->save();
            $res['success'] = 1;
            return response()->json($res, $this->successStatus);
        } elseif ($request->input('ket') == 2) {
            $data->absen_ket = "SAKIT";
            $data->save();
            $res['success'] = 1;
            return response()->json($res, $this->successStatus);
        } elseif ($request->input('ket') == 3) {
            $data->absen_ket = "ALPHA";
            $data->save();
            $total->save();
            $res['success'] = 1;
            return response()->json($res, $this->successStatus);
        } elseif ($request->input('ket') == 4) {
            $data->absen_ket = "DITUGASKAN";
            $data->save();
            $res['success'] = 1;
            return response()->json($res, $this->successStatus);
        } else {
            $res['success'] = 0;
            return response()->json($res, $this->successStatus);
        }
    }
}
