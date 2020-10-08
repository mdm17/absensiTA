@extends('layout.app')

@section('content-header','Tambah Data Mata Kuliah')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="post" action="/jadwal">
                <div class="form-group">
                    <label for="hari">hari</label>
                    <select id="hari" name="hari" class="form-control @error('hari') is-invalid @enderror">
                        <option>Pilih Hari</option>
                        <option value="SENIN">SENIN</option>
                        <option value="SELASA">SELASA</option>
                        <option value="RABU">RABU</option>
                        <option value="KAMIS">KAMIS</option>
                        <option value="JUMAT">JUMAT</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jam_mulai">Jam Mulai</label>
                    <input type="time" value="{{ old('jam_mulai') }}"
                        class="form-control without_ampm @error('jam_mulai') is-invalid @enderror" name="jam_mulai"
                        id="jam_mulai" placeholder="Example input placeholder">
                </div>
                <div class="form-group">
                    <label for="jam_selesai">Jam selesai</label>
                    <input type="time" value="{{ old('jam_selesai') }}"
                        class="form-control without_ampm @error('jam_selesai') is-invalid @enderror" name="jam_selesai"
                        id="jam_selesai" placeholder="Example input placeholder">
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select id="kelas" name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror">
                        @foreach ($kelas as $kls)
                        <option value="{{$kls->id}}">{{$kls->semester.$kls->nama_kelas}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="matkul">matkul</label>
                    <select id="matkul" name="matkul_id" class="form-control @error('matkul_id') is-invalid @enderror">
                        @foreach ($matkul as $mtkl)
                        <option value="{{$mtkl->id}}">{{"(".$mtkl->diploma.")"." ".$mtkl->kode." ".$mtkl->nama_matkul}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="ruang">ruang</label>
                    <select id="ruang" name="ruang_id" class="form-control @error('ruang_id') is-invalid @enderror">
                        @foreach ($ruang as $rng)
                        <option value="{{$rng->id}}">{{$rng->nama_ruang}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="dosen">dosen</label>
                    <select id="dosen" name="dosen_id" class="form-control @error('dosen_id') is-invalid @enderror">
                        @foreach ($dosen as $dsn)
                        <option value="{{$dsn->id}}">{{$dsn->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>
@endsection