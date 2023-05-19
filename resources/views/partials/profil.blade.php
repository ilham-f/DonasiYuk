@extends('layouts.main')

@section('container')
    <div class="mt-5 pt-5 d-flex justify-content-center align-items-center">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; width: 1200px; height: 600px">
            <div class="card-body d-flex justify-content-evenly py-4 overflow-hidden">
                <div id="profilBtn" class="col-md-4 text-center mt-3"
                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem; width: 20%">
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{ asset('assets/img/avatar.jpg') }}" alt="Avatar" class="img-fluid rounded-circle" style="width: 80px;" />
                        <small class="fst-italic mt-2 mb-3">{{ Auth::user()->nama }}</small>
                    </div>
                    <button class="btn btn-outline-dark mb-2"
                        onclick="location.href='/profile'"><small>Profil Saya</small>
                    </button>
                    <button class="ubahProfil btn btn-outline-dark mb-2" data-bs-toggle="modal"
                        data-bs-target="#profil-{{ Auth::user()->id }}"><small>Ubah Profil</small>
                    </button>
                    <button class="ubahPw btn btn-outline-dark mb-2" data-bs-toggle="modal"
                        data-bs-target="#ubahpw"><small>Ubah Password</small>
                    </button>
                    <button class="programKu btn btn-outline-dark mb-2" onclick="location.href='/programku'"
                        type="button">
                        <small>Program Saya</small>
                    </button>
                    <button class="donasiKu btn btn-outline-dark mb-2" onclick="location.href='/rwytdonasi'"
                        type="button">
                        <small>Riwayat Donasi</small>
                    </button>

                    <button class="donasiKu btn btn-outline-dark mb-2" data-bs-toggle="modal" data-bs-target="#ajukan"
                        type="button">
                        <small>Buat Program!</small>
                    </button>
                </div>
                <div class="col-md-7 me-4" style="width: 70%">
                    <div class="card-body p-3" id="cardBody">
                        @yield('body')
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal buat program --}}
    <div class="modal fade" id="ajukan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Ajukan Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form class="row d-flex flex-column" action="/programbaru" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="col mb-3">
                            <label for="program" class="form-label">Kategori</label>
                            <br>
                            <select class="form-select border-1 rounded" name="category_id">
                                <option selected>Pilih Kategori</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label for="program" class="form-label">Judul</label>
                            <input type="text" name="judul" class="form-control" />
                        </div>
                        <div class="col mb-3">
                            <label for="program" class="form-label">Deskripsi</label>
                            <textarea style="overflow:hidden;" type="text" name="deskripsi" class="form-control"
                            oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                        </div>
                        <div class="col mb-3">
                            <label for="program" class="form-label">Target</label>
                            <input type="number" name="target" class="form-control" />
                        </div>
                        <div class="col mb-3">
                            <label for="program" class="form-label">Batas Tanggal</label>
                            <input type="date" name="batastanggal" class="form-control" />
                        </div>
                        <div class="col mb-3">
                            <label for="program" class="form-label">Gambar</label>
                            <input type="file" name="image" class="form-control" />
                        </div>
                        <div class="col mb-3">
                            <label for="program" class="form-label">Hubungan dengan Penerima Manfaat</label>
                            <br>
                            <select class="form-select border-1 rounded" name="category_id">
                                <option selected>Pilih Hubungan</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label for="program" class="form-label">Bukti Hubungan dengan Penerima Manfaat</label>
                            <input type="file" name="bukti" class="form-control" />
                        </div>
                        <button type="submit" class="btn btn-info ms-3 text-light" style="width: 150px">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Profil-->
    @foreach ($users as $user)
        <div class="modal fade" id="profil-{{ $user->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form class="row d-flex flex-column" action="/profil/{{ $user->id }}" method="post">
                            @method('put')
                            @csrf
                            <div class="col mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" />
                            </div>
                            <div class="col mb-3">
                                <label for="jk">Jenis Kelamin</label>
                                <br>
                                <select class="form-select border-1 rounded mt-2" name="jk">
                                    @if (!$user->jk)
                                        <option value="1">Laki-laki</option>
                                        <option value="0">Perempuan</option>
                                    @elseif ($user->jk == 1)
                                        <option selected value="{{ $user->jk }}">Laki-laki</option>
                                        <option value="0">Perempuan</option>
                                    @elseif ($user->jk == 0)
                                        <option selected value="{{ $user->jk }}">Perempuan</option>
                                        <option value="1">Laki-laki</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $user->email }}" />
                            </div>
                            <div class="col mb-3">
                                <label for="notelp" class="form-label">No. Telepon</label>
                                <input type="text" name="notelp" class="form-control" value="{{ $user->notelp }}" />
                            </div>
                            <div class="col mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ $user->alamat }}" />
                            </div>
                            <button type="submit" class="btn btn-info ms-3 text-light" style="width: 150px">Simpan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Ubah Pw --}}
    <div class="modal fade" id="ubahpw" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form class="row d-flex flex-column" action="/ubahpw" method="post">
                        @method('put')
                        @csrf
                        <div class="col mb-3">
                            <label for="password_lama" class="form-label">Password Lama</label>
                            <input type="password" name="password_lama" class="form-control" />
                        </div>
                        <div class="col mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control" />
                        </div>
                        <div class="col mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control" />
                        </div>
                        <button type="submit" class="btn btn-info ms-3 text-light" style="width: 150px">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="">Logout</a>
                </div>
            </div>
        </div>
    </div>
@endsection
