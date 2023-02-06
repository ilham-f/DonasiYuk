@extends('admin.layouts.main')

@section('content')

<div class="card text-center">
    <div class="card-header">
      Tanggal : {{ $pesananresep->id }}
    </div>
    <div class="card-body">
      <h5 class="card-title">ID Pesanan : {{  $pesananresep->resep_id }}</h5>
      <p class="card-text">Nama Obat_Obat : {{ $pesananresep->obat_obat }}</p>
      <p class="card-text">Total Harga : {{ $pesananresep->total_harga }}</p>
      <img src="{{ asset("storage/".$pesananresep->resep->image) }}" alt="">
      <p class="card-text">Status : {{ $pesananresep->status }}</p>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</button>
    </div>
    <div class="card-footer">
      <a href="/pesananresep" class="btn btn-info">Kembali</a>
    </div>
</div>

{{-- Modal Update --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('psnrsp.statup') }}" id="formstatus" method="POST">
              @csrf
              <input name="id" type="hidden" value="{{ $pesananresep->id }}">

              <select class="form-select" aria-label="Default select example" name="status">
                  <option selected>Status Transaksi</option>
                  <option value="Diproses">Diproses</option>
                  <option value="Dikirim">Dikirim</option>
                  <option value="Diterima">Diterima</option>
              </select>
          </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary" form="formstatus">Update</button>
        </div>
      </div>
    </div>
  </div>

@endsection
