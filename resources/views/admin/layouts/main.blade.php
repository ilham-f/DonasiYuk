<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <img src="{{ asset('assets/img/logofix.png') }}" alt="logo" style="width: 50px; height: 50px;">
                            <h3 class="pt-2"><a href="/admin" class="text-primary ms-2">DonasiYuk!</a><h3>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle text-primary"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu" id="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item {{ ($title === 'Dashboard') ? 'active' : '' }}">
                            <a href="" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span class="pt-1">Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ ($title === 'Program') ? 'active' : '' }}">
                            <a href="/tblprogram" class='sidebar-link'>
                                <i class="bi bi-capsule"></i>
                                <span class="pt-1">Program</span>
                            </a>
                        </li>

                        {{-- <li class="sidebar-item {{ ($title === 'Kategori') ? 'active' : '' }}">
                            <a href="" class='sidebar-link'>
                                <i class="bi bi-tags-fill"></i>
                                <span class="pt-1">Kategori</span>
                            </a>
                        </li> --}}

                        {{-- <li class="sidebar-item has-sub">
                            <a href="" class='sidebar-link'>
                                <i class="bi bi-graph-up"></i>
                                <span class="pt-1">Laporan Keuangan</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="">...</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="">...</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="">...</a>
                                </li>
                            </ul>
                        </li> --}}
                        <hr>
                        <li class="sidebar-item">
                            <a data-bs-target="#logoutModal" data-bs-toggle="modal" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right text-danger"></i>
                                <span class="text-danger pt-1">Keluar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            @yield('content')
        </div>

    </div>

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

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>
