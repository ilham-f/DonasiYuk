<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DonasiYuk</title>
    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logofix.png') }}" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/lightslider.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/swipper.css') }}" />

    <script src="{{ asset('js/jquery.js') }}"></script>
    {{-- <script src="{{ asset('js/lightslider.js') }}"></script> --}}

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key='{{ env('MIDTRANS_CLIENT_KEY') }}'></script>

    <style>
        .text-cursive {
            font-family: 'Poppins', sans-serif;
            font-style: italic;
        }
    </style>

</head>

<body style="background-color: #f5f5f5;">
    <!-- Navigation-->
    @include('partials.navbar')

    @yield('container')

    {{-- <!-- Footer-->
    <footer class="footer py-4 mt-5" style="background-color: #fff;">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <div class="text-dark">Copyright &copy; DonasiYuk! 2023</div>
            </div>
        </div>
    </footer> --}}

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h5>Apakah anda yakin untuk keluar?</h5>
                    <div class="mt-4 d-flex justify-content-end">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <form action="/logout" method="post">
                            @csrf
                            <button class="ms-2 btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Galang Dana --}}
    <div class="modal fade" id="galangdana" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="modalCenterTitle">Ingin Mengajukan Program Galang Dana?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-evenly flex-column">
                        <p class="fw bold text-center">Silahkan Masuk ke Akun anda terlebih dahulu</p>
                        <div class="text-center ms-2" id="masuk1">
                            <a class="btn btn-dark mt-auto" data-bs-toggle="modal" data-bs-target="#login">Masuk</a>
                        </div>
                        <div class="row">
                            <p class="mt-4" style="font-size: 13px; text-align: center;">Belum punya akun?
                                <a data-bs-toggle="modal" data-bs-target="#daftar" class="text-dark"
                                    style="font-size: 13px; font-weight: 600; cursor: pointer;">Daftar >></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Lupa Password --}}
    <div class="modal fade" id="lupa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="modalCenterTitle">Lupa Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form input-->
                    <div class="loginInput">
                        <form class="px-3 pt-2" action="/forgot-password" method="post">
                            @csrf
                            <div class="row g-3">
                                <small class="mb-2" style="margin-left: -8px">Isi dengan email yang telah terdaftar di akun anda!</small>
                            </div>
                            <div class="row g-3">
                                <input type="text" name="email" class="form-control mb-2"
                                    placeholder="Email">
                            </div>
                            <div class="row g-3">
                                <button type="submit" class="btn btn-dark mb-2" style="width: 100%">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Login --}}
    <div class="modal fade" id="login" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="modalCenterTitle">Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form input-->
                    <div class="loginInput">
                        <form class="px-3 pt-2" action="/login" method="post">
                            @csrf
                            <div class="row g-3">
                                <input type="text" name="email" class="form-control mb-2"
                                    placeholder="Email">
                            </div>
                            <div class="row g-3">
                                <input type="password" name="password" class="form-control mb-2"
                                    placeholder="Password">
                            </div>
                            <div class="row g-3">
                                <button type="submit" class="btn btn-dark mb-2" style="width: 100%">Masuk</button>
                            </div>

                        </form>
                        <div class="d-flex justify-content-center px-2">
                            <button class="d-flex justify-content-center btn btn-light border border-dark"
                                style="width: 100%;" onclick="window.location.href='{{ '/auth/redirect' }}'">
                                <img style="display: block; height: 20px; padding-top: 4px;" class="me-2"
                                    src="{{ asset('assets/img/google.png') }}" alt="google">
                                Masuk dengan Google
                            </button>
                        </div>
                        <div class="d-flex justify-content-between px-2">
                            <p class="mt-3" style="font-size: 13px; text-align: center;">
                                <a data-bs-toggle="modal" data-bs-target="#lupa" class="text-dark" style="font-size: 13px; font-weight: 600; cursor: pointer;">Lupa Password</a>
                            </p>
                            <p class="mt-3" style="font-size: 13px; text-align: center;">Belum punya akun?
                                <a data-bs-toggle="modal" data-bs-target="#daftar" class="text-dark"
                                    style="font-size: 13px; font-weight: 600; cursor: pointer;">Daftar</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Login 2--}}
    <div class="modal fade" id="login2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="modalCenterTitle">Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (session('logindulu'))
                        <div class="alert alert-warning alert-dismissible fade show">
                            {{ session('logindulu') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <!-- Form input-->
                    <div class="loginInput">
                        <form class="px-3 pt-2" action="/login" method="post">
                            @csrf
                            <div class="row g-3">
                                <input type="text" name="email" class="form-control mb-2"
                                    placeholder="Email">
                            </div>
                            <div class="row g-3">
                                <input type="password" name="password" class="form-control mb-2"
                                    placeholder="Password">
                            </div>
                            <div class="row g-3">
                                <button type="submit" class="btn btn-dark mb-2" style="width: 100%">Masuk</button>
                            </div>

                        </form>
                        <div class="d-flex justify-content-center px-2">
                            <button class="d-flex justify-content-center btn btn-light border border-dark"
                                style="width: 100%;" onclick="window.location.href='{{ '/auth/redirect' }}'">
                                <img style="display: block; height: 20px; padding-top: 4px;" class="me-2"
                                    src="{{ asset('assets/img/google.png') }}" alt="google">
                                Masuk dengan Google
                            </button>
                        </div>
                        <div class="d-flex justify-content-between px-2">
                            <p class="mt-3" style="font-size: 13px; text-align: center;">
                                <a data-bs-toggle="modal" data-bs-target="#lupa" class="text-dark" style="font-size: 13px; font-weight: 600; cursor: pointer;">Lupa Password</a>
                            </p>
                            <p class="mt-3" style="font-size: 13px; text-align: center;">Belum punya akun?
                                <a data-bs-toggle="modal" data-bs-target="#daftar" class="text-dark"
                                    style="font-size: 13px; font-weight: 600; cursor: pointer;">Daftar</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Daftar --}}
    <div class="modal fade" id="daftar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="modalCenterTitle">Daftar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form input-->
                    <div class="loginInput">
                        <form class="px-3 pt-2" action="/regis" method="post">
                            @csrf
                            <div class="row g-3">
                                <input type="text" name="nama" class="form-control mb-2" id="nama"
                                    placeholder="Nama Lengkap (sesuai KTP)">
                            </div>
                            <div class="row g-3">
                                <input type="text" name="email" class="form-control mb-2"
                                    placeholder="Email">
                            </div>
                            <div class="row g-3">
                                <input type="password" name="password" class="form-control mb-2" id="password1"
                                    placeholder="Password">
                            </div>
                            <div class="row g-3">
                                <input type="password" name="password_confirmation" class="form-control mb-2"
                                    id="password2" placeholder="Konfirmasi Password">
                            </div>
                            <div class="row g-3 mb-2">
                                <button type="submit" class="btn btn-dark" style="width: 100%;">Daftar</button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center px-2">
                            <button class="d-flex justify-content-center btn btn-light border border-dark"
                                style="width: 100%;" onclick="window.location.href='{{ '/auth/redirect' }}'">
                                <img style="display: block; height: 20px; padding-top: 4px;" class="me-2"
                                    src="{{ asset('assets/img/google.png') }}" alt="google">
                                Masuk dengan Google
                            </button>
                        </div>
                        <div class="row">
                            <p class="mt-4" style="font-size: 13px; text-align: center;">Sudah punya akun?
                                <a data-bs-toggle="modal" data-bs-target="#login" class="text-dark"
                                    style="font-size: 13px; font-weight: 600; cursor: pointer;">Masuk >></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/swipper.js') }}"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let exist = '{{ Session::has('errors') }}';
        let msg = '{{ Session::get('errors') }}';
        msg = msg.replace(/&quot;/g, '\"');

        if (exist) {
            let json = JSON.parse(msg);
            let emailErr = ((typeof(json["email"]) !== 'undefined') ? json["email"] : '');
            let passErr = ((typeof(json["password_confirmation"]) !== 'undefined') ? json["password_confirmation"] : '');
            let alertText = emailErr + "\n" + passErr;
            alert(alertText);
        }
    </script>
</body>
</html>
