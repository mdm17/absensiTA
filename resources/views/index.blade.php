@extends('layout.app')

@section('content-header','Dashboard')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h5 class="m-0">Jumlah User</h5>
          </div>
          <div class="card-body">
          <h3><span>{{$user}}</span></h3><br>
            <a href="#" class="btn btn-primary">Data Master</a>
          </div>
        </div>

        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0">Absensi</h5>
          </div>
          <div class="card-body">
            <h3><span>{{$absen}}</span></h3><br>
            <a href="#" class="btn btn-primary">Absensi</a>
          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
      <div class="col-lg-6">
        <div class="card">
                    <div class="card-header">
                      <h5 class="m-0">Kelas</h5>
                    </div>
                    <div class="card-body">
                      <h3><span>{{$kelas}}</span></h3><br>
                      <a href="#" class="btn btn-primary">Kelas</a>
                    </div>
        </div>

        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0">Jadwal</h5>
          </div>
          <div class="card-body">
            <h3><span>{{$jadwal}}</span></h3><br>
            <a href="#" class="btn btn-primary">Jadwal</a>
          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@endsection