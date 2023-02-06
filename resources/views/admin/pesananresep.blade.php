@extends('admin.layouts.main')

@section('content')
@foreach ($pesananresep as $psnrsp )

<div class="card w-75">
    <div class="card-body">
        <h5 class="card-title">ID PESANAN : {{ $psnrsp->id }}</h5>
        <h5 class="card-title">STATUS : {{ $psnrsp->status }}</h5>
    </div>
    <div class="card-footer">
        <a href="pesananresep/{{ $psnrsp->id }}" class="btn btn-primary">Detail</a>
    </div>
</div>

<div>
    {{ $pesananresep->links() }}
</div>

@endforeach

@endsection
