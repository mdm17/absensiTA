@extends('layout.app')

@section('content-header','Absensi')

@section('content')
<!-- Button trigger modal -->
<div class="container">
  
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">NIM</th>
      <th scope="col">Nama</th>
      <th scope="col" colspan="2">Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($mahasiswa as $item)
    <tr>
      <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal1" data-nama="{{$item->nim}}" >{{$item->nim}}</button></td>
      <td>{{$item->nama}}</td>
      <td aria-placeholder="test">
      @foreach ($absensi as $key)
      @if ($item->nim == $key->mhs_nim)
      <div title="{{$key->matkul}}" class="d-inline"> &#10004;{{$key->absen_ket}}</div>
      @endif
      @endforeach
    </td>
    </tr>
    @endforeach
  </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Jumlah Akumulasi Kompen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 id="exampleModalLabel"></h4>
        <h5 id="kompen"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Print</button>
      </div>
    </div>
  </div>
</div>
@endsection