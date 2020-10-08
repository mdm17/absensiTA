@extends('layout.app')

@section('content-header','Tambah Data Kelas')

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
            <form method="post" action="/kelas">
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input type="number" value="{{ old('semester') }}"
                        class="form-control @error('semester') is-invalid @enderror" name="semester" id="semester"
                        placeholder="Example input placeholder">
                </div>
                <div class="form-group">
                    <label for="nama">Nama Kelas</label>
                    <input type="text" value="{{ old('nama_kelas') }}"
                        class="form-control @error('nama_kelas') is-invalid @enderror" name="nama_kelas" id="nama"
                        placeholder="Example input placeholder">
                </div>
                <div class="form-group">
                    <label for="diploma">Diploma</label>
                    <input type="text" value="{{ old('diploma') }}" name="diploma"
                        class="form-control @error('diploma') is-invalid @enderror" id="diploma"
                        placeholder="Another input placeholder">
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>
@endsection