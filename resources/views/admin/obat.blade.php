@extends('admin.layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tabel Obat</h3>
                    <button type="button" class="btn btn-info mb-3 mt-4 d-flex justify-content-center" data-bs-toggle="modal"
                    data-bs-target="#tambah">
                    <span class="bi bi-plus-square me-2" style="padding-top: 2px;"></span>Tambah Obat
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
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Stok</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($obats as $obat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $obat->nama }}</td>
                                    <td>{{ $obat->stok }}</td>
                                    <td class="d-flex justify-content-center align-items-center">

                                        <button style="height: 50%;" class="btn btn-info text-light me-2"
                                            data-bs-toggle="modal" data-bs-target="#ubah-{{ $obat->id }}">Ubah</button>
                                        <button style="height: 50%;" class="btn btn-danger text-light" data-bs-toggle="modal"
                                            data-bs-target="#delete-{{ $obat->id }}">Hapus</button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Delete-->
    @foreach ($obats as $obat)
        <div id="delete-{{ $obat->id }}" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                            <p>Apakah benar anda ingin menghapus {{ $obat->nama }}?</p>
                        </div>
                        <div class="d-flex flex-row-reverse mt-3">
                            <form action="/tabelobat/{{ $obat->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" type="submit" name="submit">Hapus</button>
                            </form>
                            <button style="height: 50%;" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Ubah-->
    @foreach ($obats as $obat)
        <div class="modal fade" id="ubah-{{ $obat->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Ubah Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form class="row d-flex flex-column" action="/tabelobat/{{ $obat->id }}" method="post">
                            @method('put')
                            @csrf
                            <div class="col mb-3">
                                <label for="obat" class="form-label">Nama Obat</label>
                                <input type="text" name="nama" class="form-control" value="{{ $obat->nama }}" />
                            </div>
                            <div class="col mb-3">
                                <label for="obat" class="form-label">Stok</label>
                                <input type="text" name="stok" class="form-control" value="{{ $obat->stok }}" />
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

                    <form action="/tambahobat" method="POST" enctype="multipart/form-data">
                        @method('post')
                        @csrf
                        <div class="mb-3">
                            <label for="obat" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" id="obat" name="nama">
                        </div>

                        <label for="category_id">Kategori</label>
                        <br>
                        <select class="form-select w-50 border-1 rounded" name="category_id">
                            <option selected>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama }}</option>
                            @endforeach
                        </select>

                        <div class="mb-3 mt-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug">
                            <div id="slughelp" class="form-text">Ketik nama Obat dengan " - " sebagai pengganti spasi
                            </div>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="formkeluh" class="form-label">Keluhan</label>
                            @foreach ($keluhan as $keluh)
                            <div class="form-check" id="formkeluh">
                                <input class="form-check-input" type="checkbox" value="{{ $keluh->id }}" id="{{ $keluh->nama }}" name="keluhans[]">
                                <label class="form-check-label" for="{{ $keluh->nama }}">
                                    {{ $keluh->nama }}
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="image" name="image"
                                onchange="preview(event)">
                            <img class="mb-3 mt-3" id="add-preview"
                                style="display: block; width: 210px; height: 140px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2)"
                                src="https://www.its.ac.id/tmesin/wp-content/uploads/sites/22/2022/07/no-image.png" />
                        </div>

                        <label for="tambahstok">Stok</label>
                        <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups"
                            id="tambahstok">
                            <div class="btn-group me-2" role="group" aria-label="First group">
                                <button id="kurang" type="button" min="0" class="btn btn-outline-secondary"
                                    onclick="counter(this.id)">-</button>
                                <div class="input-group" style="width: 45px">
                                    <input id="value" type="text" name="stok"
                                        class="form-control rounded-0 text-center" value="1">
                                </div>
                                <button id="tambah" type="button" min="0" class="btn btn-outline-secondary"
                                    onclick="counter(this.id)">+</button>
                            </div>
                        </div>
                        <div class="submit d-flex flex-row-reverse mt-5">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function counter(clicked_id) {
        var counter = document.getElementById('value').value;

        var parsed = parseInt(counter);

        let result = clicked_id == "kurang" ? parsed - 1 : parsed + 1;

        if (result <= 0) {
            result = 1;
        }
        document.getElementById('value').value = result;
    }
</script>

<script>
    function preview(event) {
        if (event.target.files.length > 0) {
            const src = URL.createObjectURL(event.target.files[0]);
            const image = document.getElementById('add-preview');
            image.src = src;
            image.style.display = "block";
        }
    }
</script>
