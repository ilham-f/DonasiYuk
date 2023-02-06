@extends('admin.layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tabel Kategori</h3>
                    <button type="button" class="btn btn-info mb-3 mt-4 d-flex justify-content-center" data-bs-toggle="modal"
                        data-bs-target="#tambah">
                        <span class="bi bi-plus-square me-2" style="padding-top: 2px;"></span>Tambah Kategori
                    </button>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/tabelkategori">Tabel Kategori</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tabel Kategori</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="/tambahkategori" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="obat" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug">
                            <div id="slughelp" class="form-text">Ketik nama Obat dengan " - " sebagai pengganti spasi</div>
                        </div>
                        <div class="submit d-flex flex-row-reverse mt-5">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
