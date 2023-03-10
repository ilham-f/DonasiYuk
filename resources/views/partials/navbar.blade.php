<nav class="navbar navbar-expand-lg navbar-light sticky-top w-100 shadow-sm" style="background-color: rgb(218, 255, 222); position:fixed">
    <div class="container">
        <div class="image ms-2">
            <img src="{{ asset('assets/img/logo.png') }}" alt="DonasiYuk!" style="display: block; height: 50px;">
        </div>
        <a class="fst-italic" style="color: #235323; font-weight: 500" href="/">DonasiYuk!</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse me-4" id="navbarSupportedContent">
            @if (Auth::user())
                <form class="d-flex" role="search" action='/produk'>
                    <input class="form-control " type="search" name="search" placeholder="Cari Program" aria-label="Search" value="{{ request('search') }}" style="border-radius: 5px 0 0 5px;">
                    <button class="btn btn-success" type="submit" style="border-radius: 0 5px 5px 0;">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <form class="d-flex">
                    <div class="text-center ms-2">
                        <a class="btn btn-outline-success mt-auto" href="/keranjang">
                            <i class="bi-cart-fill me-1"></i>
                            Riwayat
                            <span class="badge bg-success text-white ms-1 rounded-pill"></span>
                        </a>
                    </div>
                </form>

                <form class="d-flex">
                    <div class="text-center ms-2">
                        <a class="btn btn-outline-success mt-auto" href="/kirimresep">
                            <i class="bi-card-text me-1"></i>
                            Kirim Resep
                        </a>
                    </div>
                </form>
                <div class="btn-group ms-2">
                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      {{ Auth::user()->nama }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item" href="/profile">Profil</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button class="dropdown-item text-danger border-0">Logout</button>
                        </form>
                      </li>
                    </ul>
                </div>
            @else
                <form class="d-flex" role="search" action='/produk'>
                    <input class="form-control " type="search" name="search" placeholder="Cari Program" aria-label="Search" value="{{ request('search') }}" style="border-radius: 5px 0 0 5px;">
                    <button class="btn btn-success" type="submit" style="border-radius: 0 5px 5px 0;">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <form class="d-flex">
                    <div class="text-center ms-2">
                        <a class="btn btn-outline-success mt-auto" data-bs-toggle="modal" data-bs-target="#login">Masuk</a>
                    </div>
                </form>
                <form class="d-flex">
                    <div class="text-center ms-2">
                        <a class="btn btn-outline-success mt-auto" data-bs-toggle="modal" data-bs-target="#daftar">Daftar</a>
                    </div>
                </form>
            @endif
        </div>
    </div>
</nav>
