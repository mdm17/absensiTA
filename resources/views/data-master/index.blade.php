@extends('layout.app')

@section('content-header','Data Master')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row row-cols-3">
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Kelas</h5>
            <a href="/kelas/create" class="btn btn-primary float-right">tambah</a>
          </div>
          <div class="card-body">
            <ul class="list-group">
              @foreach ($kelas as $kls)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{$kls->semester.$kls->nama_kelas}}
                <a href="/students/{{$kls->id}}" class="badge badge-info">detail</a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Ruang</h5>
            <a href="/ruang/create" class="btn btn-primary float-right">tambah</a>
          </div>
          <div class="card-body">
            <ul class="list-group">
              @foreach ($ruang as $rng)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{$rng->nama_ruang}}
                <button type="button" class="btn btn-sm btn-primary" data-nama="{{$rng->id}}" data-toggle="modal"
                  data-target="#exampleModal{{$rng->id}}">Details</button>
              </li>
              @endforeach
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Mata Kuliah</h5>
            <a href="/matkul/create" class="btn btn-primary float-right">tambah</a>
          </div>
          <div class="card-body">
            <table id="example2" class="table  table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Nama Matkul</th>
                  <th>SKS</th>
                  <th>Kode(s)</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($matkul as $mtk)
                <tr>
                  <th scope="row">{{$loop->iteration}}</th>
                  <td>{{$mtk->nama_matkul}}</td>
                  <td>{{$mtk->sks}}</td>
                  <td>{{$mtk->kode}}</td>
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
      <div class="col-lg-12">
        <div class="card">
          @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
          @endif
          <div class="card-header">
            <h5 class="card-title">Mahasiswa </h5>
            <a href="/mahasiswa/create" class="btn btn-primary float-right">tambah</a>
          </div>
          <div class="card-body">
            <table id="example3" class="table table-bordered table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Kelas</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($mahasiswa as $mhs)
                <tr>
                  <th scope="row">{{$loop->iteration}}</th>
                  <td>{{$mhs->nama}}</td>
                  <td>{{$mhs->nim}}</td>
                  <td>{{$kls->semester.$mhs->nama_kelas}}</td>
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

        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Dosen</h5>
            <a href="/dosen/create" class="btn btn-primary float-right">tambah</a>
          </div>
          <div class="card-body">
            <table id="example4" class="table table-bordered table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>NIP(s)</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($dosen as $dsn)
                <tr>
                  <th scope="row">{{$loop->iteration}}</th>
                  <td>{{$dsn->nama}}</td>
                  <td>{{$dsn->nip}}</td>
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
@foreach ($ruang as $rng)
<div class="modal fade" id="exampleModal{{$rng->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$rng->nama_ruang}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-auto">
        <div id="qrcode">
          {!!QrCode::size(250)->format('png')->generate(base64_encode($rng->id),'qrcodes/'.$rng->nama_ruang.'.png',
          'image/png')!!}
          {!!QrCode::size(250)->format('svg')->generate(base64_encode($rng->id))!!}
        </div>
        <a class="btn btn-sm btn-primary" href="qrcodes/{{$rng->nama_ruang}}.png" download="">download</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection