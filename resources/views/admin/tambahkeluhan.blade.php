@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="page-heading">
            <h3>Tambah Keluhan</h3>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="/tambahkeluhan" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama Keluhan</label>
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
    </div>
@endsection
