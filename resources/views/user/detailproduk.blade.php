@extends('layouts.main')

@section('container')
<div class="container vh-100 d-flex justify-content-evenly mt-5">
    <div class="">
        <img src="{{ asset("storage/$obat->image") }}" alt="{{ $obat->slug }}" />
    </div>

    <div class="container">
        <h1>Nama Obat : {{ $obat->nama }}</h1>
        <h2>Jenis Obat : <a href="/categories/{{ $obat->category->slug }}">{{ $obat->category->nama }}</a></h2>
        <p>Harga : Rp{{ $obat->harga }},00</p>
        <p>Stok : {{ $obat->stok }}</p>
        <p>Keluhan :
            @foreach ($obat->keluhans as $keluhan )
                @if ($keluhan == $obat->keluhans->last())
                    <small>{{ $keluhan->nama}}</small>
                @else
                    <small>
                        {{ $keluhan->nama . ", " }}
                    </small>
                @endif
            @endforeach
        </p>
        <div class="d-flex">
            <a class="me-2" href="{{ url()->previous() }}"><button class="btn btn-outline-success">Kembali</button></a>
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
@endsection
