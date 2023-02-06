@extends('admin.layouts.main')

@section('content')

<div class="card text-center">
    <div class="card-header">
      Tanggal : {{ $transaksi->tanggal }}
    </div>
    <div class="card-body">
      <h5 class="card-title">Alamat : {{  $transaksi->alamat }}</h5>
      <p class="card-text">Nama User : {{ $transaksi->user->nama }}</p>
      <p class="card-text">ID User : {{ $transaksi->user_id }}</p>
      <p class="card-text">Pukul {{ $transaksi->jam }} WIB</p>
      <p class="card-text">Jumlah barang : {{ $transaksi->jumlah_barang }}</p>
      <p class="card-text">Total Harga : {{ $transaksi->total_harga }}</p>
      <p class="card-text">Status : {{ $transaksi->status }}</p>
      <p class="card-text">Detail Barang</p>
      @foreach ($transaksi->obats as $obat)
                          <div class="card mt-2">
                              <div class="row g-0">
                                  <div class="col-4">
                                      <img src="{{ asset("storage/$obat->image") }}" class="img-fluid rounded-start" alt="{{ $obat->image }}">
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $obat->nama }}</h5>
                                            <p class="card-text">Rp.{{ $obat->harga }},00</p>
                                            <p class="card-text">Kuantitas : {{ $obat->pivot->qty }}</p>
                                            <p class="card-text">Subtotal : {{ $obat->pivot->pricesum }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
        @endforeach
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</button>
    </div>
    <div class="card-footer">
      <a href="/riwayat" class="btn btn-info">Kembali</a>
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
        <form action="{{ route('transac.statup') }}" id="formstatus" method="POST">
            @csrf
            <input name="id" type="hidden" value="{{ $transaksi->id }}">

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
