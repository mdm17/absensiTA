@extends('layout.app')

@section('content-header','Tambah Data Ruang')

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
            <form method="post" action="/ruang">
                <div class="form-group">
                    <label for="nama_ruang">Nama Ruang</label>
                    <input type="text" value="{{ old('nama_ruang') }}"
                        class="form-control @error('nama_ruang') is-invalid @enderror" name="nama_ruang" id="nama_ruang"
                        placeholder="Example input placeholder">
                </div>
                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" value="{{ old('lokasi') }}"
                        class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi"
                        placeholder="Example input placeholder">
                </div>
                <div class="form-group">
                    <label for="lat">Latitude</label>
                    <input type="text" value="{{ old('lat') }}" name="lat"
                        class="form-control @error('lat') is-invalid @enderror" id="lat"
                        placeholder="Another input placeholder">
                </div>
                <div class="form-group">
                    <label for="long">Longitude</label>
                    <input type="text" value="{{ old('long') }}" name="long"
                        class="form-control @error('long') is-invalid @enderror" id="long"
                        placeholder="Another input placeholder">
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>
@endsection