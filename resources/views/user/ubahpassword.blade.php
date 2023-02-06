@extends('layouts.main')

@section('container')

<div class="row container-fluid">
        @include('partials.sidebaruser')
            <div class="col py-3">
                <h2 class="text-success">Saudara User - example@email.com</h2>
                <p class="text text-danger">Semua Kolom harus diisi!</p>
                <input type="text" class="form-control w-50 my-2" id="notelp" placeholder="Password Lama">
                <input type="text" class="form-control w-50 my-2" id="notelp" placeholder="Password baru">
                <input type="text" class="form-control w-50 my-2" id="notelp" placeholder="Ulangi Password baru">

                <button class="btn btn-success">Simpan</button>
            </div>
</div>

@endsection
