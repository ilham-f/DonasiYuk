@extends('layouts.main')

@section('container')
    <div class="container-fluid d-flex justify-content-center align-items-center bg-success" style="height: 91.5vh;">
        <div class="card shadow" style="width: 1200px; height: 600px">
            <div class="card-body d-flex justify-content-between py-4">
                <div class="col-md-4 text-center"
                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem; width: 20%">
                    <div class="d-flex flex-column align-items-center">
                        @if (Auth::user()->jk == 1)
                            <img src="{{ asset('assets/img/male.jpg') }}" alt="Avatar" class="img-fluid"
                                style="width: 80px;" />
                        @else
                            <img src="{{ asset('assets/img/female.jpg') }}" alt="Avatar" class="img-fluid"
                                style="width: 80px;" />
                        @endif
                        <small class="fst-italic mt-2 mb-3">{{ Auth::user()->nama }}</small>
                    </div>
                    <button style="width: 60%;" class="btn btn-outline-success mb-2"
                        onclick="location.href='/profile'"><small>Profil Saya</small>
                    </button>
                    <button style="width: 60%;" class="btn btn-outline-success mb-2" data-bs-toggle="modal"
                        data-bs-target="#profil-{{ Auth::user()->id }}"><small>Ubah Profil</small>
                    </button>
                    <button style="width: 60%;" class="btn btn-outline-success mb-2" data-bs-toggle="modal"
                        data-bs-target="#ubahpw"><small>Ubah Password</small>
                    </button>
                    <button style="width: 60%;" class="btn btn-outline-success" onclick="location.href='/rwytpmblian'"
                        type="button">
                        <small>Pesanan Saya</small>
                    </button>
                </div>
                <div class="col-md-7 me-4" style="width: 70%">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-around">
                                <div class="detailBarang me-5 w-50">
                                    <h4 class="card-text mb-4">Detail Barang</h4>
                                    @foreach ($transaksi->obats as $obat)
                                        <div class="d-flex">
                                            <img src="{{ asset("storage/$obat->image") }}" class="img-fluid rounded-start"
                                                alt="{{ $obat->image }}" style="display: block; width: 50%;">
                                            <div class="desc ms-3">
                                                <small class="card-title me-3">{{ $obat->nama }}</small>
                                                <br>
                                                <small class="card-text">Harga : Rp.{{ $obat->harga }},00</small>
                                                <br>
                                                <small class="card-text">Jumlah : {{ $obat->pivot->qty }}</small>
                                                <br>
                                                <h6 class="card-text">Subtotal : {{ $obat->pivot->pricesum }}</h6>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="total mt-5">
                                    <small class="card-text">Jumlah Barang : {{ $transaksi->jumlah_barang }}</small>
                                    <br>
                                    <strong class="card-text">Total Pembelian : Rp.{{ $transaksi->total_harga }},00</strong>
                                </div>
                            </div>
                            @endforeach
                            <h5 class="card-text">Total Pembelian : Rp.{{ $transaksi->total_harga }},00</h5>
                            <h5 class="card-text">Jumlah Barang : {{ $transaksi->jumlah_barang }}</h5>
                          <a href="{{ url()->previous() }}" class="btn btn-success mt-2">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
