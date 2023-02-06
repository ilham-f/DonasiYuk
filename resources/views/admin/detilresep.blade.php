@extends('admin.layouts.main')

@section('content')

<div class="card text-center">
    <div class="card-header">
      ID RESEP : {{ $resep->id }}
    </div>
    <div class="card-body">
      <h5 class="card-title">ID USER : {{  $resep->user_id }}</h5>
      <img src="{{ asset("storage/$resep->image") }}" alt="">
      {{-- <img src="{{ asset("storage/$pesananresep->resep") }}" alt=""> --}}
    </div>
    <div class="card-footer">
      <a href="/resep" class="btn btn-info">Kembali</a>
    </div>
</div>

@endsection
