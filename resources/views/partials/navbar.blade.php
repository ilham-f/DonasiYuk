<nav class="navbar navbar-expand-lg navbar-light sticky-top w-100 px-3"
    style="padding-bottom: 10px; padding-top: 10px; position:fixed; background-color:rgb(255, 255, 255); box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
    <div class="container">
        <div class="image ms-4 me-2">
            <img src="{{ asset('assets/img/logofix.png') }}" alt="DonasiYuk!" style="display: block; height: 35px;">
        </div>
        <a class="fst-italic text-dark fw-bolder" style="font-size: 18px" href="/">DonasiYuk!</a>
        <button class="navbar-toggler me-4" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse px-4" id="navbarSupportedContent">
            @if (Auth::user())
                <form id="search" class="d-flex" role="search" action='/produk'>
                    <input class="form-control " type="search" name="search" placeholder="Cari Program"
                        aria-label="Search" value="{{ request('search') }}" style="border-radius: 5px 0 0 5px;">
                    <button class="btn btn-dark" type="submit" style="border-radius: 0 5px 5px 0;">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <div class="d-flex">
                    <div class="text-center ms-2" id="galangdana">
                        <a class="btn btn-dark mt-auto" href="/form-program">
                            Galang Dana
                        </a>
                    </div>
                </div>
                {{-- <div class="d-flex">
                    <div class="text-center ms-2" id="bantuan">
                        <a class="btn btn-dark mt-auto" data-bs-toggle="modal" data-bs-target="#bantuan">
                            Bantuan
                            <i class="ms-2 bi bi-question-circle"></i>
                        </a>
                    </div>
                </div> --}}
                <form class="d-flex">
                    <div id="riwayat" class="text-center ms-2">
                        <a class="btn btn-outline-dark mt-auto" href="/keranjang">
                            <i class="bi-clock-history me-1"></i>
                            Riwayat Donasi
                            <span class="badge bg-dark text-white ms-1 rounded-pill"></span>
                        </a>
                    </div>
                </form>
                <div class="vr ms-2" id="vr"></div>
                <div id="namauser" class="btn-group ms-2">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->nama }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/profile">Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <button class="dropdown-item text-danger border-0" data-bs-target="#logoutModal" data-bs-toggle="modal">Logout</button>
                        </li>
                    </ul>
                </div>
            @else
                <form id="search" class="d-flex" role="search" action='/hasilpencarian'>
                    <input class="form-control " type="search" name="search" placeholder="Cari Program"
                        aria-label="Search" value="{{ request('search') }}" style="border-radius: 5px 0 0 5px;">
                    <button class="btn btn-dark" type="submit" style="border-radius: 0 5px 5px 0;">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <div class="d-flex">
                    <div class="text-center ms-2" id="galangdanabtn">
                        <a class="btn btn-dark mt-auto" data-bs-toggle="modal" data-bs-target="#galangdana">
                            Galang Dana
                        </a>
                    </div>
                </div>
                {{-- <div class="d-flex">
                    <div class="text-center ms-2" id="bantuan">
                        <a class="btn btn-dark mt-auto" data-bs-toggle="modal" data-bs-target="#bantuan">
                            Bantuan
                            <i class="ms-2 bi bi-question-circle"></i>
                        </a>
                    </div>
                </div> --}}
                <div class="vr ms-2" id="vr"></div>
                <form class="d-flex">
                    <div class="text-center ms-2" id="masuk1">
                        <a class="btn btn-dark mt-auto" data-bs-toggle="modal" data-bs-target="#login">Masuk</a>
                    </div>
                </form>
                <form class="d-flex">
                    <div class="text-center ms-2" id="daftar1">
                        <a class="btn btn-dark mt-auto" data-bs-toggle="modal" data-bs-target="#daftar">Daftar</a>
                    </div>
                </form>
            @endif
        </div>
    </div>
</nav>

<script>
    $(document).ready(function() {
        var $window = $(window);
        var $masuk = $('#masuk1');
        var $daftar = $('#daftar1');
        var $search = $('#search');
        var $namauser = $('#namauser');
        var $riwayat = $('#riwayat');
        var $galangdana = $('#galangdanabtn');
        var $bantuan = $('#bantuan');
        var $vr = $('#vr');
        var $hr = $('#hr');

        // MASUK & DAFTAR
        // REMOVE CLASS MS-2
        $window.resize(function resize() {
            if ($window.width() < 992) {
                return $masuk.removeClass('ms-2');
            }
            $masuk.addClass('ms-2');
        }).trigger('resize');
        $window.resize(function resize() {
            if ($window.width() < 992) {
                return $daftar.removeClass('ms-2');
            }
            $daftar.addClass('ms-2');
        }).trigger('resize');

        // ADD CLASS MT-2
        $window.resize(function resize() {
            if ($window.width() < 992) {
                return $masuk.addClass('mt-2');
            }
            $masuk.removeClass('mt-2');
        }).trigger('resize');
        $window.resize(function resize() {
            if ($window.width() < 992) {
                return $daftar.addClass('mt-2');
            }
            $daftar.removeClass('mt-2');
        }).trigger('resize');

        // SEARCH
        // ADD CLASS MT-2
        $window.resize(function resize() {
            if ($window.width() < 992) {
                return $search.addClass('mt-2');
            }
            $search.removeClass('mt-2');
        }).trigger('resize');

        // NAMA USER
        // ADD DROPEND
        $window.resize(function resize() {
            if ($window.width() < 992) {
                return $namauser.addClass('dropend');
            }
            $namauser.removeClass('dropend');
        }).trigger('resize');
        // ADD CLASS MT-2
        $window.resize(function resize() {
            if ($window.width() < 992) {
                return $namauser.addClass('mt-2');
            }
            $namauser.removeClass('mt-2');
        }).trigger('resize');
        // REMOVE CLASS MS-2
        $window.resize(function resize() {
            if ($window.width() < 992) {
                return $namauser.removeClass('ms-2');
            }
            $namauser.addClass('ms-2');
        }).trigger('resize');

        // RIWAYAT
        // ADD CLASS MT-2
        $window.resize(function resize() {
            if ($window.width() < 992) {
                return $riwayat.addClass('mt-2');
            }
            $riwayat.removeClass('mt-2');
        }).trigger('resize');
        // REMOVE CLASS MS-2
        $window.resize(function resize() {
            if ($window.width() < 992) {
                return $riwayat.removeClass('ms-2');
            }
            $riwayat.addClass('ms-2');
        }).trigger('resize');

        // GALANG DANA
        // ADD CLASS MT-2
        $window.resize(function resize() {
            if ($window.width() < 992) {
                return $galangdana.addClass('mt-2');
            }
            $galangdana.removeClass('mt-2');
        }).trigger('resize');
        // REMOVE CLASS MS-2
        $window.resize(function resize() {
            if ($window.width() < 992) {
                return $galangdana.removeClass('ms-2');
            }
            $galangdana.addClass('ms-2');
        }).trigger('resize');

        // BANTUAN
        // ADD CLASS MT-2
        // $window.resize(function resize() {
        //     if ($window.width() < 992) {
        //         return $bantuan.addClass('mt-2');
        //     }
        //     $bantuan.removeClass('mt-2');
        // }).trigger('resize');
        // // REMOVE CLASS MS-2
        // $window.resize(function resize() {
        //     if ($window.width() < 992) {
        //         return $bantuan.removeClass('ms-2');
        //     }
        //     $bantuan.addClass('ms-2');
        // }).trigger('resize');

        // VR
        // HIDE VR
        $window.resize(function resize() {
            if ($window.width() < 992) {
                return $vr.hide();
            }
            $vr.show();
        }).trigger('resize');

        // HR
        // HIDE HR
        $window.resize(function resize() {
            if ($window.width() < 992) {
                return $hr.show();
            }
            $hr.hide();
        }).trigger('resize');

        $masuk.click(function () {

        });
    });
</script>
