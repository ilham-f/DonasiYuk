@extends('admin.layouts.main')

@section('content')

@foreach ($resep as $res )

<div class="card w-75">
    <div class="card-body">
        <h5 class="card-title">ID RESEP : {{ $res->id }}</h5>
        <h5 class="card-title">ID USER : {{ $res->user_id }}</h5>
    </div>
    <div class="card-footer">
        <a href="/resep/{{ $res->id }}" class="btn btn-primary">Detail</a>
    </div>
</div>

<div>
    {{ $resep->links() }}
</div>

@endforeach

@endsection
