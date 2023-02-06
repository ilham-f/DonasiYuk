@extends('layouts.main')

@section('container')

    <div class="container-fluid py-3 px-5 bg-success">
        <div class="row p-4">
            <div class="col card m-2">
                <h4 class="text-success my-3">Obat</h4>
                <div class="row">
                    <div class="col mx-3">
                        @if (Cart::session(auth()->user()->id)->isEmpty())
                            <p class="text-center">Keranjang Kosong</p>
                        @else
                            {{-- Mulai Obat --}}
                            @foreach ($obats as $obat)
                                {{-- {{ dd($obat) }} --}}

                                <div class="row mb-3">
                                    <div class="card">
                                        <div class="row g-0 mt-4">
                                            <div class="">
                                            </div>

                                            <div class="col-4">
                                                <img src="{{ asset('storage/' . $obat->attributes->image) }}"
                                                    class="img-fluid rounded-start" alt="{{ $obat->slug }}">
                                            </div>

                                            <div class="col-7">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $obat->name }}</h5>
                                                    <p class="card-text">Rp{{ $obat->price }},00 / Unit</p>
                                                    <p class="card-text">Subtotal : {{ $obat->getPriceSum() }}</p>
                                                    <div class="d-flex">
                                                        <form action="{{ route('cart.update') }}" method="POST"
                                                            class="w-60">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $obat->id }}">
                                                            <input type="number" min="1" name="quantity"
                                                                value="{{ $obat->quantity }}"
                                                                class="btn btn-outline-success text-center"
                                                                style="width: 20%" />
                                                            <button type="submit" class="btn btn-info">Simpan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $obat->id }}"
                                                        name="id">
                                                    <button class="btn btn-danger">x</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button class="btn btn-danger mb-3">Hapus Semua</button>
                            </form>
                            {{-- Akhir Obat --}}
                        @endif
                    </div>
                </div>
            </div>
            {{-- Ringkasan Belanja --}}
            <div class="col-4 card m-2" style="height: 320px">
                <h4 class="text-success mt-3">Ringkasan Belanja</h4>
                <div class="card mt-2 p-3">
                    <p>Jumlah Barang : {{ Cart::session(auth()->user()->id)->getTotalQuantity() }}</p>
                    <p>Total Harga : </p>
                    <hr>
                    <p>Rp {{ Cart::session(auth()->user()->id)->getTotal() }},00 </p>
                </div>
                <button type="button" class="mt-2 btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Beli
                </button>
                @if (!Cart::session(auth()->user()->id)->isEmpty())
                    <button type="button" class="mt-2 btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Beli
                    </button>
                @endif

            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Pembelian</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (Cart::session(auth()->user()->id)->isEmpty())
                        <p>Keranjang Masih Kosong</p>
                    @else
                        <p>Apakah Anda Yakin menyelesaikan pembelian?</p>
                        <form action="{{ route('transaksi.store') }}" method="POST" id="form1">
                            @csrf
                            <label for="Alamat" class="">
                                <h6>Alamat Pengiriman</h6>
                            </label>
                            <input type="text" class="form-control w-75" placeholder="Alamat" id="alamat"
                                name="alamat" value="{{ Auth::user()->alamat }}" required>
                        </form>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    @if (!Cart::session(auth()->user()->id)->isEmpty())
                        <button form="form1" class="btn btn-success mt-3 mb-3">Beli</button>
                    @endif
                </div>
            </div>
            {{-- Akhir Ringkasan --}}
        </div>
    </div>
@endsection
