@extends('admin.layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 order-md-1 order-last mb-2 text-center">
                    <h3>Data Artikel</h3>
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
                                <th scope="col" class="text-center">Cover</th>
                                <th scope="col">Judul</th>
                                <th scope="col" class="text-center">Tanggal</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        {{-- @dd($news) --}}
                        <tbody>
                            @foreach ($news as $n)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <img style="display: block; height: 81px; width: 150px"
                                            src="{{ asset('assets/img/'.$n->image) }}" alt="{{ $n->image }}" />
                                    </td>
                                    <td class="text-capitalize">{{ $n->judul }}</td>
                                    <td class="text-center">
                                        @php
                                            $date = Carbon\Carbon::parse($n->created_at);
                                            $formattedDate = $date->translatedFormat('l, d F Y');
                                        @endphp
                                        {{ $formattedDate }}
                                    </td>
                                    <td class="text-center">
                                        <button style="height: 50%;" class="btn btn-info text-light" data-bs-toggle="modal"
                                            data-bs-target="#info-{{ $n->id }}">Info</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    
    {{-- @dd($news) --}}
    <!-- Modal Info-->
    @foreach ($news as $detail)
        <div class="modal fade" id="info-{{ $detail->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Detail Artikel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row d-flex flex-column">
                            <div class="col mb-3">
                                <label for="detail" class="form-label">Penulis</label>
                                <input type="text" class="form-control"
                                    value="{{ $detail->penulis ?? 'Penulis tidak diketahui' }}" readonly />
                            </div>
                            <div class="col mb-3">
                                <label for="detail" class="form-label">Kategori</label>
                                <input type="text" class="form-control"
                                    value="{{ $detail->kategori ?? 'Kategori tidak diketahui' }}" readonly />
                            </div>
                            <div class="col mb-3">
                                <label for="alamat" class="form-label">Konten</label>
                                <textarea style="height: 100px" class="form-control" name="alamat" readonly>{{ $detail->konten ?? 'Konten belum dilengkapi' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
