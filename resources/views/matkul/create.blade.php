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
            <form method="post" action="/matkul">
                <div class="form-group">
                    <label for="diploma">Diploma</label>
                    <input type="text" value="{{ old('diploma') }}"
                        class="form-control @error('diploma') is-invalid @enderror" name="diploma" id="diploma"
                        placeholder="Example input placeholder">
                </div>
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input type="text" value="{{ old('semester') }}"
                        class="form-control @error('semester') is-invalid @enderror" name="semester" id="semester"
                        placeholder="Example input placeholder">
                </div>
                <div class="form-group">
                    <label for="kode">Kode</label>
                    <input type="text" value="{{ old('kode') }}" name="kode"
                        class="form-control @error('kode') is-invalid @enderror" id="kode"
                        placeholder="Another input placeholder">
                </div>
                <div class="form-group">
                    <label for="nama_matkul">Nama Mata Kuliah</label>
                    <input type="text" value="{{ old('nama_matkul') }}" name="nama_matkul"
                        class="form-control @error('nama_matkul') is-invalid @enderror" id="nama_matkul"
                        placeholder="Another input placeholder">
                </div>
                <div class="form-group">
                    <label for="sks">SKS</label>
                    <input type="text" value="{{ old('sks') }}" name="sks"
                        class="form-control @error('sks') is-invalid @enderror" id="sks"
                        placeholder="Another input placeholder">
                </div>
                <div class="form-group">
                    <label for="jml_jam">Jumlah Jam</label>
                    <input type="text" value="{{ old('jml_jam') }}" name="jml_jam"
                        class="form-control @error('jml_jam') is-invalid @enderror" id="jml_jam"
                        placeholder="Another input placeholder">
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>
@endsection