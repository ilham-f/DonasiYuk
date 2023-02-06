@extends('layouts.main')

@section('container')

    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @if ($obats->count())
                @foreach ($obats as $obat)
                    <div class="col mb-5">
                        <div class="card h-100 shadow">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ asset("storage/$obat->image") }}" alt="{{ $obat->slug }}" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $obat->nama }}</h5>
                                    <!-- Product price-->
                                    <p>Rp. {{ $obat->harga }}</p>
                                    <p>Keluhan :
                                        @foreach ($obat->keluhans as $keluhan)
                                            {{ $keluhan->nama . ' ' }}
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="d-flex justify-content-center card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center me-2"><a class="btn btn-outline-success mt-auto" href="/produk/{{ $obat->slug }}">Detail</a></div>
                                @if (Auth::user())
                                <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $obat->id }}" name="id">
                                    <input type="hidden" value="{{ $obat->nama }}" name="name">
                                    <input type="hidden" value="{{ $obat->harga }}" name="price">
                                    <input type="hidden" value="{{ $obat->image }}"  name="image">
                                    <input type="hidden" value="1" name="quantity">
                                    <button type="submit" class="btn btn-outline-success">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">Tidak Ada</p>
            @endif
        </div>
        <div class="d-flex justify-content-center">
            {{ $obats->links() }}
        </div>
    </div>
@endsection
