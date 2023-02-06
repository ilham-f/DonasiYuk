@extends('layouts.main')

@section('container')
    <div class="container-fluid d-flex justify-content-center align-items-center bg-success" style="height: 91.5vh;">
        <div class="card shadow" style="width: 1200px; height: 600px">
            <div class="card-body d-flex justify-content-between py-4">
                <div class="col-md-4 text-center"
                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem; width: 20%">
                    <div class="d-flex flex-column align-items-center">
                        @if (Auth::user()->jk == 1)
                            <img src="assets/img/male.jpg" alt="Avatar" class="img-fluid" style="width: 80px;" />
                        @else
                            <img src="assets/img/female.jpg" alt="Avatar" class="img-fluid" style="width: 80px;" />
                        @endif
                        <small class="fst-italic mt-2 mb-3">{{ Auth::user()->nama }}</small>
                    </div>
                    <button style="width: 60%;" class="btn btn-outline-success mb-2"
                        onclick="location.href='/profile'"><small>Profil Saya</small>
                    </button>
                    <button style="width: 60%;" class="btn btn-outline-success mb-2" data-bs-toggle="modal"
                        data-bs-target="#profil-{{ Auth::user()->id }}"><small>Ubah Profil</small>
                    </button>
                    <button style="width: 60%;" class="btn btn-outline-success mb-2" data-bs-toggle="modal"
                        data-bs-target="#ubahpw"><small>Ubah Password</small>
                    </button>
                    <button style="width: 60%;" class="btn btn-outline-success" onclick="location.href='/rwytpmblian'"
                        type="button">
                        <small>Pesanan Saya</small>
                    </button>
                </div>
                <div class="col-md-7 me-4" style="width: 70%">
                    <div class="card-body p-3">
                        <div class="col">
                            @if (!$transaksi->count())
                                <p>Belum ada Riwayat Pembelian</p>
                            @else
                                @foreach ($transaksi as $tra)
                                    {{-- Cards Pembelian --}}
                                    <div class="card mt-3">
                                        <div class="row g-0">
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">Tanggal : {{ $tra->tanggal }}</h5>
                                                    <p class="card-text">Pukul : {{ $tra->jam }} WIB</p>
                                                    <p class="card-text">Total : Rp.{{ $tra->total_harga }},00</p>
                                                    <p class="card-text">Status : {{ $tra->status }}</p>
                                                    <a href="/pembelian/{{ $tra->id }}" class="btn btn-success">Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $transaksi->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah-->
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
                                    <option selected>Jenis Kelamin</option>
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
