@extends('partials.profil')

@section('body')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <h4>Akun Saya</h4>
    <hr class="mt-0 mb-3">
    <div class="row pt-1">
        <div class="col-6 mb-3">
            <h6>Email</h6>
            <p class="text-muted">{{ Auth::user()->email }}</p>
        </div>
        <div class="col-6 mb-3">
            <h6>No. Telepon</h6>
            <p class="text-muted">{{ Auth::user()->notelp }}</p>
        </div>
        <div class="col-10 mb-3">
            <h6>Alamat</h6>
            <p class="text-muted">{{ Auth::user()->alamat }}</p>
        </div>
    </div>
@endsection
