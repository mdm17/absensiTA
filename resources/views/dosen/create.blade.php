@extends('layout.app')

@section('content-header','Tambah Data Dosen')

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
    <form method="post" action="/dosen">
      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Example input placeholder">
      </div>
      <div class="form-group">
        <label for="NIP">NIP</label>
        <input type="text" value="{{ old('nip') }}" name="nip" class="form-control @error('nip') is-invalid @enderror" id="NIP" placeholder="Another input placeholder">
      </div>
      <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
    </div>
  </div>
</div>
@endsection