@extends('layouts.main')

@section('container')
    <section class="vh-100">
        <div class="container py-5 h-100 bg-transparent">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-6">
                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card p-3"
                        style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; border-radius: 15px;">
                        <div class="card-body text-center">
                            <div class="mb-4">
                                <img src="{{ asset('assets/img/logofix.png') }}" class="rounded-circle img-fluid"
                                    style="width: 100px;" />
                            </div>
                            <h3 class="mb-3 text-cursive fw-bold">Selamat Datang di DonasiYuk!</h3>
                            <p class="text-muted mb-5">Segera verifikasi akun anda dengan cara klik "Verify Email Address"
                                di email yang telah kami kirimkan ke {{ substr(Auth::user()->email, 0, 2) . str_repeat('*', strpos(Auth::user()->email,"@") - 4) . substr(Auth::user()->email, (strpos(Auth::user()->email,"@")-2)) }}
                            </p>
                            <button type="button" class="btn btn-dark btn-rounded btn-lg mb-5" onclick="window.location.href='/email/verification-notification'">
                                Kirim Ulang
                            </button>
                            <br>
                            <small class="text-muted">*Jika email belum terkirim tekan tombol "Kirim Ulang" untuk mengirim ulang email verifikasi</small>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
