@extends('layouts.main')

@section('container')
    <div class="mt-5 d-flex justify-content-center align-items-center">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; height: 93.7vh; width: 100%">
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

                    <button class="donasiKu btn btn-outline-dark mb-2" onclick="location.href='/form-program'"
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

@endsection
