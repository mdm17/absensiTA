@extends('layout.app')

@section('content-header','Absensi')

@section('content')
<!-- Button trigger modal -->
<div class="container">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Pilih Kelas
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/absensi/show" method="get">
          <label for="kelas">Kelas</label>
        <select name="kelas" class="custom-select">
          @foreach ($kelas as $kls)
        <option value="{{$kls->id}}">{{$kls->semester.$kls->nama_kelas}}</option>
          @endforeach
        </select>
        <label>Tanggal</label>
        <input type="date" class="form-control" name="date">
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
@endsection