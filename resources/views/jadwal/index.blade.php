@extends('layout.app')

@section('content-header','Jadwal')
@php
$senin = $jadwal->where('hari','SENIN')->count();
$selasa = $jadwal->where('hari','SELASA')->count();
$rabu = $jadwal->where('hari','RABU')->count();
$kamis = $jadwal->where('hari','KAMIS')->count();
$jumat = $jadwal->where('hari','JUMAT')->count();
@endphp
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row row-cols-3">
      <!-- /.col-md-6 -->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <a href="/jadwal/create" class="btn btn-primary float-right">tambah</a>
            <br>
            <hr>
            <table id="example3" class="table table-bordered table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Hari</th>
                  <th>Ruang</th>
                  <th>Jam</th>
                  <th>Kelas</th>
                  <th>Mata Kuliah</th>
                  <th>Dosen</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($jadwal as $jdwl)
                <tr>
                  <th scope="row">{{$loop->iteration}}</th>
                  <td>{{$jdwl->hari}}</td>
                  <td>{{$jdwl->nama_ruang}}</td>
                  <td>{{$jdwl->jam_mulai}}-{{$jdwl->jam_selesai}}</td>
                  <td>{{$jdwl->semester.$jdwl->nama_kelas}}</td>
                  <td>{{$jdwl->nama_matkul}}</td>
                  <td>{{$jdwl->nama}}</td>
                  <td>
                    <a href="" class="badge badge-success">edit</a>
                    <a href="" class="badge badge-danger">hapus</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@endsection