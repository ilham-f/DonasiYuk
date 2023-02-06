<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>DonasiYuk</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    @include('partials.navbar')

    @yield('container')

    {{-- Modal Login --}}
    <div class="modal fade" id="login" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="modalCenterTitle">Masuk di Apotech</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- login input-->
                    <div class="loginInput">
                        <form class="px-3 pt-2" action="/login" method="post">
                            @csrf
                            <div class="row g-3">
                                <input type="text" name="email" class="form-control mb-2" id="email"
                                    placeholder="Email">
                            </div>
                            <div class="row g-3">
                                <input type="password" name="password" class="form-control mb-2" id="password"
                                    placeholder="Password">
                            </div>
                            <div class="row g-3">
                                <button type="submit" class="btn btn-success" style="width: 100%">Masuk</button>
                            </div>
                        </form>

                        <div class="row g-3">
                            <button type="submit" class="btn btn-light" style="width: 100%" onclick="window.location.href='{{ '/auth/redirect' }}'">Masuk dengan Google</button>
                        </div>

                        <div class="row">
                            <p class="mt-4" style="font-size: 13px; text-align: center;">Belum punya akun?
                                <a data-bs-toggle="modal" data-bs-target="#daftar" class="text-success" style="font-size: 13px; font-weight: 600;">Daftar >></a>
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
                    <h5 class="modal-title text-success" id="modalCenterTitle">Daftar di Apotech</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- login input-->
                    <div class="loginInput">
                        <form class="px-3 pt-2" action="/regis" method="post">
                            @csrf
                            <div class="row g-3">
                                <input type="text" name="nama" class="form-control mb-2" id="nama" placeholder="Nama Lengkap">
                            </div>
                            <div class="row g-3">
                                <input type="text" name="email" class="form-control mb-2" id="email" placeholder="Email">
                            </div>
                            <div class="row g-3">
                                <input type="text" name="alamat" class="form-control mb-2" id="alamat" placeholder="Alamat Domisili">
                            </div>
                            <div class="row g-3">
                                <input type="password" name="password" class="form-control mb-2" id="password1" placeholder="Password">
                            </div>
                            <div class="row g-3">
                                <input type="password" name="password_confirmation" class="form-control mb-2" id="password2" placeholder="Konfirmasi Password">
                            </div>
                            <div class="row g-3">
                                <button type="submit" class="btn btn-success" style="width: 100%;">Daftar</button>
                            </div>
                            <div class="row">
                                <p class="mt-4" style="font-size: 13px; text-align: center;">Sudah punya akun?
                                    <a data-bs-toggle="modal" data-bs-target="#login" class="text-success" style="font-size: 13px; font-weight: 600;">Masuk >></a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
