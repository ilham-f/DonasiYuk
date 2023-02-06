@extends('admin.layouts.main')

@section('content')

    <div class="container-fluid">
        @foreach ($transaksi as $tra)

        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title">{{ $tra->tanggal }}</h5>
                        <p class="card-text">{{ $tra->jam }}</p>
                        <p class="card-text">{{ $tra->alamat }}</p>
                        <p class="card-text">{{ $tra->total_harga }}</p>
                        <p class="card-text">{{ $tra->status }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="riwayat/{{ $tra->id }}" class="btn btn-success">Detail</a>
                    </div>
                </div>
            </div>
        </div>


          @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $transaksi->links() }}
    </div>

@endsection
