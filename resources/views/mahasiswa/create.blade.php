@extends('layout.app')

@section('content-header','Tambah Data Mahasiswa')

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
      <form method="post" action="/mahasiswa">
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror"
            name="nama" id="nama" placeholder="Example input placeholder">
        </div>
        <div class="form-group">
          <label for="NIM">NIM</label>
          <input type="text" value="{{ old('nim') }}" name="nim" class="form-control @error('nim') is-invalid @enderror"
            id="NIM" placeholder="Another input placeholder">
        </div>
        <div class="form-group">
          <label for="kelas">Kelas</label>
          <select id="kelas" name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror">
            @foreach ($kelas as $kls)
            <option value="{{$kls->id}}">{{$kls->semester.$kls->nama_kelas}}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
      </form>
    </div>
  </div>
</div>
@endsection