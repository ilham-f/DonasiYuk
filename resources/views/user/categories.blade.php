@extends('layouts.main')

@section('container')
    <div class="container">
        <h1 class="text-center m-5">Semua Kategori Obat</h1>
    </div>

    <ul>
        @foreach ($categories as $category)
            <li>
                <a href="/categories/{{ $category->slug }}"><h3>{{ $category->nama }}</h3></a>
            </li>
        @endforeach
    </ul>
@endsection
