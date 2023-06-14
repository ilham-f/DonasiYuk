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
                    <button class="btn btn-info" data-bs-toggle="modal"
                        data-bs-target="#tambah">
                        <i class="bi bi-plus-square"></i>
                        <span class="ms-2">Tambah Artikel</span>
                    </button>
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
                                            src="{{ asset('storage/' . $n->image) }}" alt="{{ $n->image }}" />
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
                                        <div class="d-flex">
                                            <button style="height: 50%;" class="btn btn-info text-light" data-bs-toggle="modal"
                                                data-bs-target="#info-{{ $n->id }}"><i class="bi bi-info-square"></i></button>
                                            <button style="height: 50%;" class="btn btn-warning text-light ms-2" data-bs-toggle="modal"
                                                data-bs-target="#ubah-{{ $n->id }}"><i class="bi bi-pencil-square"></i></button>
                                            <button style="height: 50%;" class="btn btn-danger text-light ms-2" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $n->id }}"><i class="bi bi-trash"></i></button>
                                        </div>
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

    @foreach ($news as $detail)
        <div class="modal fade" id="ubah-{{ $detail->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Detail Artikel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row d-flex flex-column">
                            <form action="/updatenews" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" value="{{ Auth::user()->id }}" name="user_id"/>
                                <div class="col mb-3">
                                    <label>Kategori</label>
                                    <select class="form-select w-50 border-1 rounded" name="category_id">
                                        @foreach ($categories as $cat)
                                            @if ($detail->category_id == $cat->id)
                                                <option selected value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                            @endif
                                            <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col mb-3">
                                    <label for="alamat" class="form-label">Judul</label>
                                    <input type="text" value="{{ $detail->judul }}" class="form-control" name="judul"/>
                                </div>
                                <div class="col mb-3">
                                    <label for="alamat" class="form-label">Konten</label>
                                    <textarea style="height: 100px" class="form-control" name="konten">{{ $detail->konten }}</textarea>
                                </div>
                                <div class="pt-2">
                                    <div class="d-flex flex-column align-items-center">
                                        <label for="image" class="align-self-start mb-2">Foto Artikel
                                            :</label for="image">
                                        {{-- <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> --}}
                                        <input id="image" class="form-control w-100" type="file" name="image"
                                            onchange="preview(event)">
                                        <img class="mb-3 mt-3 rounded" id="add-preview"
                                            style="display: block; width: 40%; height: auto;
                                                            aspect-ratio: 4.5/3; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2)"
                                            src="{{ asset('storage/'. $detail->image) }}" />
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{ $detail->id }}">

                                <button type="submit" class="btn btn-info">Ubah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($news as $detail)
        <div class="modal fade" id="delete-{{ $detail->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h5>Apakah anda yakin menghapus Artikel {{ $detail->judul }}?</h5>
                        <div class="mt-4 d-flex justify-content-end">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <form action="/deletenews" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $detail->id }}">
                                <button class="ms-2 btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex flex-column">
                        <form action="/tambahnews" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" value="{{ Auth::user()->id }}" name="user_id"/>
                            <div class="col mb-3">
                                <label>Kategori</label>
                                <select class="form-select w-50 border-1 rounded" name="category_id">
                                    <option>-- Pilih Kategori --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label for="alamat" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul"/>
                            </div>
                            <div class="col mb-3">
                                <label for="alamat" class="form-label">Konten</label>
                                <textarea style="height: 100px" class="form-control" name="konten"></textarea>
                            </div>
                            <div class="pt-2">
                                <div class="d-flex flex-column align-items-center">
                                    <label for="image" class="align-self-start mb-2">Foto Artikel
                                        :</label for="image">
                                    {{-- <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> --}}
                                    <input id="image" class="form-control w-100" type="file" name="image"
                                        onchange="preview(event)">
                                    <img class="mb-3 mt-3 rounded" id="add-preview"
                                        style="display: block; width: 40%; height: auto;
                                                        aspect-ratio: 4.5/3; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2)"
                                        src="https://www.its.ac.id/tmesin/wp-content/uploads/sites/22/2022/07/no-image.png" />
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function preview(event) {
            if (event.target.files.length > 0) {
                const src = URL.createObjectURL(event.target.files[0]);
                const image = document.getElementById('add-preview');
                const nextUp = document.getElementById('nextUp');
                image.src = src;
                image.style.display = "block";
                nextUp.style.display = "block";
            }
        }
    </script>
@endsection
