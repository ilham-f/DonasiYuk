@extends('layouts.main')

@section('container')
    <!-- Section-->
    <section class="container px-4" style="margin-top: 75px;">
        {{-- NEWS --}}
        <div class="card rounded-3 pb-0 border-0 mb-3"
            style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
            {{-- <div class="p-3">
                <h5 style="letter-spacing: 1.5px;" class="mb-0 text-cursive fw-bolder">NEWS</h5>
            </div> --}}
            {{-- <div class="card-body p-0">
                <div id="carouselExampleCaptions" class="carousel slide">
                    <div class="carousel-indicators">
                        @foreach ($news as $key => $n)
                            <button type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide-to="{{ $key }}" class="active" aria-current="true"
                                aria-label="Slide {{ $loop->iteration }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach ($news as $key => $n)
                            @if ($key == 0)
                                <div class="carousel-item active">
                                    <img style="height: 450px" src="{{ asset('assets/img/' . $n->image) }}"
                                        class="d-block w-100 card-img-top rounded" alt="{{ $n->image }}">
                                    <div class="carousel-caption rounded d-inline-block" style="max-width: 100%;">
                                        <h5 class="fw-bolder">{{ $n->judul }}</h5>
                                        <p class="text-truncate">{{ $n->deskripsi }}</p>
                                        <a href="programs/{{ $n->program_id }}" class="btn btn-outline-light my-1"
                                            style="font-size: 14px">Selengkapnya >></a>
                                    </div>
                                </div>
                            @else
                                <div class="carousel-item">
                                    <img style="height: 450px" src="{{ asset('assets/img/' . $n->image) }}"
                                        class="d-block w-100 card-img-top rounded" alt="{{ $n->image }}">
                                    <div class="carousel-caption rounded d-inline-block" style="max-width: 100%;">
                                        <h5 class="fw-bolder">{{ $n->judul }}</h5>
                                        <p class="text-truncate">{{ $n->deskripsi }}</p>
                                        <a href="programs/{{ $n->program_id }}" class="btn btn-outline-light my-1"
                                            style="font-size: 14px">Selengkapnya >></a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div> --}}
        </div>

        {{-- Menu Kategori --}}
        <div class="card rounded-3 p-2 py-3 border-0 mt-3"
            style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
            <div class="card-body d-flex justify-content-evenly">
                @foreach ($categories as $cat)
                    <button style="width: 150px" onclick="window.location.href='categories/{{ $cat->id }}'"
                        class="catbtn d-flex flex-column align-items-center border-0 rounded bg-transparent">
                        @if ($cat->id == 1)
                            <img class="catimg" src="assets/img/health.png" alt="" style="height: 100px">
                            <h5 class="fw-bolder text-success cattext">{{ $cat->nama }}</h5>
                        @elseif ($cat->id == 2)
                            <img class="catimg" src="assets/img/edu3.png" alt="" style="height: 100px">
                            <h5 class="fw-bolder text-warning cattext">{{ $cat->nama }}</h5>
                        @elseif ($cat->id == 3)
                            <img class="catimg" src="assets/img/bencana1.png" alt="" style="height: 100px">
                            <h5 class="fw-bolder text-info cattext">{{ $cat->nama }}</h5>
                        @endif
                    </button>
                @endforeach
                <button style="width: 150px" onclick="window.location.href='/semuaprogram'"
                    class="catbtn d-flex flex-column align-items-center border-0 rounded bg-transparent">
                    <img class="catimg" src="assets/img/all.png" alt="Semua Program" style="height: 100px">
                    <h5 class="fw-bolder cattext">Semua</h5>
                </button>
            </div>
        </div>

        <hr class="mt-3 mb-3">

        {{-- Mendesak --}}
        <div class="card rounded-3 border-0"
            style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
            <div class="ps-5 ms-2 pt-4">
                <h5 class="mb-0 text-cursive fw-bolder">Penggalangan Dana Mendesak</h5>
            </div>
            <div class="card-body p-5 pt-4 mt-2 pb-4">
                <div class="d-flex justify-content-between px-2">
                    <div class="d-flex " id="btnDesak">
                        <button style="white-space: nowrap" class="btn btn-dark me-2 btn-catMendesak">
                            <small value="4">Semua</small>
                        </button>
                        @foreach ($categories as $cat)
                            @if ($cat->id == 1)
                                <button style="white-space: nowrap" class="btn btn-success me-2 btn-catMendesak">
                                    <small value="{{ $cat->id }}">{{ $cat->nama }}</small>
                                </button>
                            @elseif ($cat->id == 2)
                                <button style="white-space: nowrap" class="btn btn-warning me-2 btn-catMendesak">
                                    <small value="{{ $cat->id }}">{{ $cat->nama }}</small>
                                </button>
                            @elseif ($cat->id == 3)
                                <button style="white-space: nowrap" class="btn btn-info me-2 btn-catMendesak">
                                    <small value="{{ $cat->id }}">{{ $cat->nama }}</small>
                                </button>
                            @endif
                        @endforeach
                    </div>

                    {{-- IF WIDTH < 768 --}}
                    <ul class="navbar-nav d-none" id="dropDesak">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle border-0" id="navbarDropdown" href="#"
                                role="button" data-bs-toggle="dropdown"
                                aria-expanded="false"><small>Kategori</small></a>
                            <ul class="dropdown-menu" style="padding: 0; border-radius: 5px;">
                                <li class="btn-catMendesak">
                                    <small class="dropdown-item border-0"
                                        value="4">Semua
                                    </small>
                                </li>
                                @foreach ($categories as $cat)
                                    <li class="btn-catMendesak">
                                        <small class="dropdown-item border-0"
                                            value="{{ $cat->id }}">{{ $cat->nama }}
                                        </small>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>

                    <a href="/program" class="d-flex justify-content-center align-items-center border-0"
                        style="text-decoration: none;"><small style="white-space: nowrap">Lihat Semua >></small>
                    </a>
                </div>

                <div id="catMendesak">
                    <div class="swiper-container" style="overflow: hidden">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper" id="desak">
                            <!-- Slides -->
                            @foreach ($programs as $program)
                                <div class="swiper-slide mendesak{{ $program->category_id }} program col-lg mb-2 mt-4">
                                    <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                                        <!-- Gambar Program -->
                                        <img class="card-img-top" style="display: block; height: 150px"
                                            src="{{ asset('assets/img/' . $program->namafile) }}"
                                            alt="{{ $program->namafile }}" />
                                        <!-- Detail Program -->
                                        <div class="card-body p-4 pt-3 pb-0">
                                            <div class="judul"
                                                style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                                <!-- Nama Program -->
                                                <small class="fw-bolder">{{ $program->judul }}</small>
                                            </div>
                                        </div>
                                        <!-- Program Footer-->
                                        <div class="p-4 pt-2">
                                            {{-- Batas Tanggal --}}
                                            @php
                                                $diff = strtotime($program->batastanggal) - time();

                                                $day = $diff / 86400;
                                                // var_dump($day);
                                                // days
                                                $days = floor($day);
                                                // hours
                                                $hours = floor($day * 24);
                                                // minutes
                                                $minutes = floor($day * 1440);
                                                // var_dump($minutes);
                                                // seconds
                                                $seconds = floor($diff);
                                            @endphp
                                            <small>
                                                {{-- {{Carbon\Carbon::parse($program->batastanggal)->diffForHumans()}} --}}
                                                @if ($days <= 0 && $hours <= 0 && $minutes != 0)
                                                    {{ $minutes }} menit lagi
                                                @elseif ($days <= 0 && $hours != 0)
                                                    {{ $hours }} jam lagi
                                                @elseif ($days != 0)
                                                    {{ $days }} hari lagi
                                                    {{-- @elseif ($days >= 31 && $days != 0)
                                                            {{ floor($days/30) }} bulan {{ $days%30 }} hari lagi --}}
                                                @endif
                                            </small>
                                            {{-- Terkumpul --}}
                                            <p class="mb-0 fw-bolder">Rp{{ $program->danaterkumpul }}</p>
                                            {{-- Target --}}
                                            <small>Terkumpul dari Rp{{ $program->target }}</small>

                                            @if ($program->category_id == 1)
                                                <div class="border border-success mt-2 rounded-pill"
                                                    style="overflow: hidden">
                                                    <div id="mendesak{{ $program->program_id }}"
                                                        class="rounded-pill bg-success" style="height:10px; width:0%;">
                                                    </div>
                                                </div>
                                            @elseif ($program->category_id == 2)
                                                <div class="border border-warning mt-2 rounded-pill"
                                                    style="overflow: hidden">
                                                    <div id="mendesak{{ $program->program_id }}"
                                                        class="rounded-pill bg-warning" style="height:10px; width:0%;">
                                                    </div>
                                                </div>
                                            @elseif ($program->category_id == 3)
                                                <div class="border border-info mt-2 rounded-pill"
                                                    style="overflow: hidden">
                                                    <div id="mendesak{{ $program->program_id }}"
                                                        class="rounded-pill bg-info" style="height:10px; width:0%;">
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="text-center">
                                                <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                                    style="height: 35px" href="programs/{{ $program->program_id }}">
                                                    <small>Detail</small>
                                                </a>
                                            </div>
                                            @if (Auth::user())
                                                <a href="/form-donasi/{{ $program->program_id }}/{{ Auth::id() }}" style="height: 35px" type="submit"
                                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                                    <small>Donasi Sekarang</small>
                                                </a>
                                            @else
                                                <a style="height: 35px" data-bs-toggle="modal" data-bs-target="#login"
                                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                                    <small>Donasi Sekarang</small>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-3 mb-3">

        {{-- Terbaru --}}
        <div class="card rounded-3 border-0 mb-4"
            style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
            <div class="ps-5 ms-2 pt-4">
                <h5 class="mb-0 text-cursive fw-bolder">Penggalangan Dana Terbaru</h5>
            </div>
            <div class="card-body p-5 pt-4 mt-2 pb-4">
                <div class="d-flex justify-content-between px-2">
                    <div class="d-flex" id="btnBaru">
                        <button style="white-space: nowrap" class="btn btn-dark me-2 btn-cat">
                            <small value="4">Semua</small>
                        </button>
                        @foreach ($categories as $cat)
                            @if ($cat->id == 1)
                                <button style="white-space: nowrap" class="btn btn-success me-2 btn-cat">
                                    <small value="{{ $cat->id }}">{{ $cat->nama }}</small>
                                </button>
                            @elseif ($cat->id == 2)
                                <button style="white-space: nowrap" class="btn btn-warning me-2 btn-cat">
                                    <small value="{{ $cat->id }}">{{ $cat->nama }}</small>
                                </button>
                            @elseif ($cat->id == 3)
                                <button style="white-space: nowrap" class="btn btn-info me-2 btn-cat">
                                    <small value="{{ $cat->id }}">{{ $cat->nama }}</small>
                                </button>
                            @endif
                        @endforeach
                    </div>

                    {{-- IF WIDTH < 768 --}}
                    <ul class="navbar-nav d-none" id="dropBaru">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle border-0" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><small>Kategori</small></a>
                            <ul class="dropdown-menu" style="padding: 0; border-radius: 5px;">
                                <li class="btn-cat">
                                    <small class="dropdown-item border-0"
                                        value="4">Semua
                                    </small>
                                </li>
                                @foreach ($categories as $cat)
                                    <li class="btn-cat">
                                        <small class="dropdown-item border-0"
                                            value="{{ $cat->id }}">{{ $cat->nama }}
                                        </small>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>

                    <a href="/program" class="d-flex justify-content-center align-items-center border-0"
                        style="text-decoration: none;"><small style="white-space: nowrap">Lihat Semua >></small></a>
                </div>

                <div id="catTerbaru">
                    <div class="swiper-container" style="overflow: hidden">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper" id="baru">
                            <!-- Slides -->
                            @foreach ($newest as $program)
                                <div class="swiper-slide baru{{ $program->category_id }} program col-lg mb-2 mt-4">
                                    <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                                        <!-- Gambar Program -->
                                        <img class="card-img-top" style="display: block; height: 150px"
                                            src="{{ asset('assets/img/' . $program->namafile) }}"
                                            alt="{{ $program->namafile }}" />
                                        <!-- Detail Program -->
                                        <div class="card-body p-4 pt-3 pb-0">
                                            <div class="judul"
                                                style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                                <!-- Nama Program -->
                                                <small class="fw-bolder">{{ $program->judul }}</small>
                                            </div>
                                        </div>
                                        <!-- Program Footer-->
                                        <div class="p-4 pt-2">
                                            {{-- Batas Tanggal --}}
                                            @php
                                                $diff = strtotime($program->batastanggal) - time();

                                                $day = $diff / 86400;
                                                // var_dump($day);
                                                // days
                                                $days = floor($day);
                                                // hours
                                                $hours = floor($day * 24);
                                                // minutes
                                                $minutes = floor($day * 1440);
                                                // var_dump($minutes);
                                                // seconds
                                                $seconds = floor($diff);
                                            @endphp
                                            <small>
                                                {{-- {{Carbon\Carbon::parse($program->batastanggal)->diffForHumans()}} --}}
                                                @if ($days <= 0 && $hours <= 0 && $minutes != 0)
                                                    {{ $minutes }} menit lagi
                                                @elseif ($days <= 0 && $hours != 0)
                                                    {{ $hours }} jam lagi
                                                @elseif ($days != 0)
                                                    {{ $days }} hari lagi
                                                    {{-- @elseif ($days >= 31 && $days != 0)
                                                            {{ floor($days/30) }} bulan {{ $days%30 }} hari lagi --}}
                                                @endif
                                            </small>
                                            {{-- Terkumpul --}}
                                            <p class="mb-0 fw-bolder">Rp{{ $program->danaterkumpul }}</p>
                                            {{-- Target --}}
                                            <small>Terkumpul dari Rp{{ $program->target }}</small>

                                            @if ($program->category_id == 1)
                                                <div class="border border-success mt-2 rounded-pill"
                                                    style="overflow: hidden">
                                                    <div id="{{ $program->program_id }}"
                                                        class="rounded-pill bg-success" style="height:10px; width:0%;">
                                                    </div>
                                                </div>
                                            @elseif ($program->category_id == 2)
                                                <div class="border border-warning mt-2 rounded-pill"
                                                    style="overflow: hidden">
                                                    <div id="{{ $program->program_id }}"
                                                        class="rounded-pill bg-warning" style="height:10px; width:0%;">
                                                    </div>
                                                </div>
                                            @elseif ($program->category_id == 3)
                                                <div class="border border-info mt-2 rounded-pill"
                                                    style="overflow: hidden">
                                                    <div id="{{ $program->program_id }}"
                                                        class="rounded-pill bg-info" style="height:10px; width:0%;">
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="text-center">
                                                <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                                    style="height: 35px" href="programs/{{ $program->program_id }}">
                                                    <small>Detail</small>
                                                </a>
                                            </div>
                                            @if (Auth::user())
                                                <a href="/form-donasi/{{ $program->program_id }}/{{ Auth::id() }}" style="height: 35px" type="submit"
                                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                                    <small>Donasi Sekarang</small>
                                                </a>
                                            @else
                                                <button style="height: 35px" data-bs-toggle="modal" data-bs-target="#login"
                                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                                    <small>Donasi Sekarang</small>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Script Program --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Filter Penggalangan Mendesak
        $(document).ready(function() {
            var desak = $('#desak');

            $(".btn-catMendesak").on("click", function() {
                var desakVal = $(this).find('small').attr('value');
                // console.log(desakVal);
                if (desakVal == 4) {
                    $.ajax({
                        url: "/getDesakSemua",
                        type: "GET",
                        success: function(result) {
                            // console.log(result);
                            var html = result.join('');
                            desak.html(html);
                        }
                    });
                } else if (desakVal == 3) {
                    $.ajax({
                        url: "/getDesakBencana",
                        type: "GET",
                        success: function(result) {
                            // console.log(result);
                            var html = result.join('');
                            desak.html(html);
                        }
                    });

                } else if (desakVal == 2) {
                    $.ajax({
                        url: "/getDesakPendidikan",
                        type: "GET",
                        success: function(result) {
                            // console.log(result);
                            var html = result.join('');
                            desak.html(html);
                        }
                    });
                } else if (desakVal == 1) {
                    $.ajax({
                        url: "/getDesakSehat",
                        type: "GET",
                        success: function(result) {
                            // console.log(result);
                            var html = result.join('');
                            desak.html(html);
                        }
                    });
                }

            });
        });

        // Filter Penggalangan Terbaru
        $(document).ready(function() {
            var baru = $('#baru');

            $(".btn-cat").on("click", function() {
                var baruVal = $(this).find('small').attr('value');
                if (baruVal == 4) {
                    $.ajax({
                        url: "/getBaruSemua",
                        type: "GET",
                        success: function(result) {
                            var html = result.join('');
                            baru.html(html);
                        }
                    });
                } else if (baruVal == 3) {
                    $.ajax({
                        url: "/getBaruBencana",
                        type: "GET",
                        success: function(result) {
                            var html = result.join('');
                            baru.html(html);
                        }
                    });
                } else if (baruVal == 2) {
                    $.ajax({
                        url: "/getBaruPendidikan",
                        type: "GET",
                        success: function(result) {
                            var html = result.join('');
                            baru.html(html);
                        }
                    });
                } else if (baruVal == 1) {
                    $.ajax({
                        url: "/getBaruSehat",
                        type: "GET",
                        success: function(result) {
                            var html = result.join('');
                            baru.html(html);
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Slider Swipper.js
            const swiper = new Swiper('.swiper-container', {
                // Optional parameters
                direction: 'horizontal',
                loop: false,
                speed: 500,
                spaceBetween: 40,
                slidesPerView: 4,
                slidesPerGroup: 4,

                // Responsive breakpoints
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                    },
                    640: {
                        slidesPerView: 2,
                    },
                    992: {
                        slidesPerView: 3,
                    },
                    1200: {
                        slidesPerView: 4,
                    },
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

            });

            // Presentase Dana Terkumpul Penggalangan Mendesak
            $.get("/getprogram", function(data) {
                $.each(data, function(index, value) {
                    var dana = value.danaterkumpul;
                    var target = value.target;
                    var persen = (dana / target) * 100;

                    $('#mendesak' + value.id).css('width', persen + '%');
                });
            });

            // Presentase Dana Terkumpul Penggalangan Terbaru
            $.get("/getprogram", function(data) {
                $.each(data, function(index, value) {
                    var dana = value.danaterkumpul;
                    var target = value.target;
                    var persen = (dana / target) * 100;

                    $('#' + value.id).css('width', persen + '%');
                });
            });
        });
    </script>

    {{-- Responsive News Image --}}
    <script>
        $(document).ready(function() {
            var $window = $(window),
                $newsImage = $('.newsImage');

            // Change CSS
            $window.resize(function resize() {
                if ($window.width() <= 478) {
                    return $newsImage.css({
                        "height": "200px",
                        "width": "100%"
                    });
                }
                $newsImage.css({
                    "height": "250px",
                    "width": "100%"
                });
            }).trigger('resize');

            // Change CSS
            $window.resize(function resize() {
                if ($window.width() <= 492) {
                    return $newsImage.css({
                        "height": "230px",
                        "width": "100%"
                    });
                }
                $newsImage.css({
                    "height": "250px",
                    "width": "100%"
                });
            }).trigger('resize');

            // Change CSS
            $window.resize(function resize() {
                if ($window.width() <= 768) {
                    return $newsImage.css({
                        "height": "250px",
                        "width": "100%"
                    });
                }
                $newsImage.css({
                    "height": "270px",
                    "width": "100%"
                });
            }).trigger('resize');

            // Change CSS
            $window.resize(function resize() {
                if ($window.width() <= 1200) {
                    return $newsImage.css({
                        "height": "270px",
                        "width": "100%"
                    });
                }
                $newsImage.css({
                    "height": "500px",
                    "width": "100%"
                });
            }).trigger('resize');
        });
    </script>

    {{-- Responsive Filter Kategori Penggalangan Mendesak --}}
    <script>
        $(document).ready(function() {
            var $window = $(window),
                $dropDesak = $('#dropDesak');
            $btnDesak = $('#btnDesak');

            // Remove-Add Class
            $window.resize(function resize() {
                if ($window.width() <= 768) {
                    return $dropDesak.removeClass('d-none');
                }
                $dropDesak.addClass('d-none');
            }).trigger('resize');

            $window.resize(function resize() {
                if ($window.width() <= 768) {
                    return $btnDesak.addClass('d-none');
                }
                $btnDesak.removeClass('d-none');
            }).trigger('resize');
        });
    </script>

    {{-- Responsive Filter Kategori Penggalangan Terbaru --}}
    <script>
        $(document).ready(function() {
            var $window = $(window),
                $dropBaru = $('#dropBaru');
            $btnBaru = $('#btnBaru');

            // Remove-Add Class
            $window.resize(function resize() {
                if ($window.width() <= 768) {
                    return $dropBaru.removeClass('d-none');
                }
                $dropBaru.addClass('d-none');
            }).trigger('resize');

            $window.resize(function resize() {
                if ($window.width() <= 768) {
                    return $btnBaru.addClass('d-none');
                }
                $btnBaru.removeClass('d-none');
            }).trigger('resize');
        });
    </script>

    {{-- Kategori Menu --}}
    <script>
        $(document).ready(function() {
            $(".catbtn").hover(function() {
                $(this).removeClass('bg-transparent');
            }, function() {
                $(this).addClass('bg-transparent');
            });

            var $window = $(window),
                $catimg = $('.catimg'),
                $h5 = $('.cattext');

            // Change CSS
            $window.resize(function resize() {
                if ($window.width() <= 768) {
                    return $catimg.css({
                        "height": "50px",
                    });
                }
                $catimg.css({
                    "height": "100px",
                });
            }).trigger('resize');

            // Change CSS
            $window.resize(function resize() {
                if ($window.width() <= 768) {
                    return $h5.css({
                        "font-size": "12px",
                    });
                }
                $h5.css({
                    "font-size": "16px",
                });
            }).trigger('resize');
        });
    </script>

    {{-- Card Header --}}
    <script>
        var $window = $(window),
            $h5 = $('.card-header').find('h5');

        // Change CSS
        $window.resize(function resize() {
            if ($window.width() <= 768) {
                return $h5.css({
                    "font-size": "14px",
                });
            }
            $h5.css({
                "font-size": "20px",
            });
        }).trigger('resize');
    </script>

    <script>
        let msg = '{{ Session::get('alert') }}';

        let exist = '{{ Session::has('alert') }}';

        if (exist) {
            alert(msg);
        }
    </script>
@endsection
