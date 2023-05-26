@extends('admin.layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 order-md-1 order-last mb-2 text-center">
                    <h3>Data Transaksi</h3>
                </div>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Donasi Ke-</th>
                                <th scope="col" class="text-center">Jumlah</th>
                                <th scope="col" class="text-center">Tanggal</th>
                                {{-- <th scope="col" class="text-center">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksis as $transaksi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-capitalize">{{ $transaksi->nama }}</td>
                                    <td>{{ $transaksi->judul }}</td>
                                    <td class="text-center">{{ $transaksi->jml_donasi }}</td>
                                    <td class="text-center">
                                        @php
                                            $date = Carbon\Carbon::parse($transaksi->created_at);
                                            $formattedDate = $date->translatedFormat('l, d F Y');
                                        @endphp
                                        {{ $formattedDate }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
