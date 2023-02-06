@extends('admin.layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tabel Keluhan</h3>
                    <button type="button" class="btn btn-info mb-3 mt-4 d-flex justify-content-center" data-bs-toggle="modal"
                        data-bs-target="#tambah">
                        <span class="bi bi-plus-square me-2" style="padding-top: 2px;"></span>Tambah Keluhan
                    </button>
                </div>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if (session('isDelete'))
            <div class="alert alert-success">{{ session('isDelete') }}</div>
        @endif
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Keluhan</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keluhans as $keluhan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $keluhan->nama }}</td>
                                    <td class="d-flex justify-content-center align-items-center">

                                        <button style="height: 50%;" class="btn btn-info text-light me-2"
                                            data-bs-toggle="modal" data-bs-target="#ubah-{{ $keluhan->id }}">Ubah</button>
                                        <button style="height: 50%;" class="btn btn-danger text-light"
                                            data-bs-toggle="modal"
                                            data-bs-target="#delete-{{ $keluhan->id }}">Hapus</button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    {{-- Modal Hapus --}}
    @foreach ($keluhans as $keluhan)
        <div id="delete-{{ $keluhan->id }}" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-end">
                            <button type="button" class="btn-close text-end" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="mt-1">
                            <h4>Yakin untuk menghapus?</h4>
                            <p>Apakah benar anda ingin menghapus Keluhan {{ $keluhan->nama }}?</p>
                        </div>
                        <div class="d-flex flex-row-reverse mt-3">
                            <form action="/tabelkeluhan/{{ $keluhan->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" type="submit" name="submit">Hapus</button>
                            </form>
                            <button style="height: 50%;" class="btn btn-secondary me-2"
                                data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Ubah --}}
    @foreach ($keluhans as $keluhan)
        <div class="modal fade" id="ubah-{{ $keluhan->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Ubah Keluhan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form class="row d-flex flex-column" action="/tabelkeluhan/{{ $keluhan->id }}" method="post">
                            @method('put')
                            @csrf
                            <div class="col mb-3">
                                <label for="obat" class="form-label">Nama Keluhan</label>
                                <input type="text" name="nama" class="form-control" value="{{ $keluhan->nama }}" />
                            </div>
                            <button type="submit" class="btn btn-info ms-3 text-light" style="width: 150px">Simpan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Tambah --}}
    <div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/tambahkeluhan" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Keluhan</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug">
                            <div id="slughelp" class="form-text">Ketik nama Obat dengan " - " sebagai pengganti spasi
                            </div>
                        </div>
                        <div class="submit d-flex flex-row-reverse mt-5">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
