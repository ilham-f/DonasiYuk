@extends('layouts.main')

@section('container')
    <div class="container px-4" style="margin-top: 80px">
        <div class="card rounded-3 border-0 mb-4"
            style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
            <div class="px-5 pt-4 d-flex justify-content-between align-items-center" id="header">
                {{-- <h5 class="mb-0 text-cursive fw-bolder">{{ $title }}</h5> --}}
                {{-- Dropdown Kategori --}}
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle border-0" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span style="font-size: 22px" class="mb-0 text-cursive fw-bolder">{{ $title }}</span>
                        </a>
                        <ul class="dropdown-menu" style="padding: 0; border-radius: 5px;">
                            <li class="btn-urut">
                                {{-- @dd($title) --}}
                                @if ($title == 'Kesehatan')
                                    @if (substr($_SERVER['REQUEST_URI'], 1, 15) == 'categoriesdesak' ||
                                            substr($_SERVER['REQUEST_URI'], 1, 12) == 'urutmendesak')
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesdesak/2') }}'">Pendidikan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesdesak/3') }}'">Bencana Alam
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('/urutmendesak') }}'">Semua Program
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'], 1, 14) == 'categoriesbaru' ||
                                            substr($_SERVER['REQUEST_URI'], 1, 11) == 'urutterbaru')
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesbaru/2') }}'">Pendidikan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesbaru/3') }}'">Bencana Alam
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('/urutterbaru') }}'">Semua Program
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'], 1, 10) == 'categories' || substr($_SERVER['REQUEST_URI'], 1, 12) == 'semuaprogram')
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categories/2') }}'">Pendidikan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categories/3') }}'">Bencana Alam
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('/semuaprogram') }}'">Semua Program
                                        </small>
                                    @endif
                                @elseif ($title == 'Pendidikan')
                                    @if (substr($_SERVER['REQUEST_URI'], 1, 15) == 'categoriesdesak' ||
                                            substr($_SERVER['REQUEST_URI'], 1, 12) == 'urutmendesak')
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesdesak/1') }}'">Kesehatan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesdesak/3') }}'">Bencana Alam
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('/urutmendesak') }}'">Semua Program
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'], 1, 14) == 'categoriesbaru' ||
                                            substr($_SERVER['REQUEST_URI'], 1, 11) == 'urutterbaru')
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesbaru/1') }}'">Kesehatan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesbaru/3') }}'">Bencana Alam
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('/urutterbaru') }}'">Semua Program
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'], 1, 10) == 'categories' || substr($_SERVER['REQUEST_URI'], 1, 12) == 'semuaprogram')
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categories/1') }}'">Kesehatan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categories/3') }}'">Bencana Alam
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('/semuaprogram') }}'">Semua Program
                                        </small>
                                    @endif
                                @elseif ($title == 'Bencana Alam')
                                    @if (substr($_SERVER['REQUEST_URI'], 1, 15) == 'categoriesdesak' ||
                                            substr($_SERVER['REQUEST_URI'], 1, 12) == 'urutmendesak')
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesdesak/1') }}'">Kesehatan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesdesak/2') }}'">Pendidikan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('/urutmendesak') }}'">Semua Program
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'], 1, 14) == 'categoriesbaru' ||
                                            substr($_SERVER['REQUEST_URI'], 1, 11) == 'urutterbaru')
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesbaru/1') }}'">Kesehatan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesbaru/2') }}'">Pendidikan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('/urutterbaru') }}'">Semua Program
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'], 1, 10) == 'categories' || substr($_SERVER['REQUEST_URI'], 1, 12) == 'semuaprogram')
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categories/1') }}'">Kesehatan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categories/2') }}'">Pendidikan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('/semuaprogram') }}'">Semua Program
                                        </small>
                                    @endif
                                @elseif ($title == 'Semua Program')
                                    @if (substr($_SERVER['REQUEST_URI'], 1, 15) == 'categoriesdesak' ||
                                            substr($_SERVER['REQUEST_URI'], 1, 12) == 'urutmendesak')
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesdesak/1') }}'">Kesehatan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesdesak/2') }}'">Pendidikan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesdesak/3') }}'">Bencana Alam
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'], 1, 14) == 'categoriesbaru' ||
                                            substr($_SERVER['REQUEST_URI'], 1, 11) == 'urutterbaru')
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesbaru/1') }}'">Kesehatan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesbaru/2') }}'">Pendidikan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categoriesbaru/3') }}'">Bencana Alam
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'], 1, 10) == 'categories' || substr($_SERVER['REQUEST_URI'], 1, 12) == 'semuaprogram')
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categories/1') }}'">Kesehatan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categories/2') }}'">Pendidikan
                                        </small>
                                        <small class="dropdown-item border-0 fw-bolder"
                                            onclick="window.location.href='{{ url('categories/3') }}'">Bencana Alam
                                        </small>
                                    @endif
                                @endif
                            </li>
                        </ul>
                    </li>
                </ul>

                {{-- Dropdown Urutkan --}}
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle border-0" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @php
                                // echo substr($_SERVER['REQUEST_URI'],1,14);
                                if (substr($_SERVER['REQUEST_URI'], 1, 15) == 'categoriesdesak' || substr($_SERVER['REQUEST_URI'], 1, 12) == 'urutmendesak') {
                                    echo 'Mendesak';
                                } elseif (substr($_SERVER['REQUEST_URI'], 1, 14) == 'categoriesbaru' || substr($_SERVER['REQUEST_URI'], 1, 11) == 'urutterbaru') {
                                    echo 'Terbaru';
                                } elseif (substr($_SERVER['REQUEST_URI'], 1, 10) == 'categories' || substr($_SERVER['REQUEST_URI'], 1, 12) == 'semuaprogram') {
                                    echo 'Terlama';
                                }
                            @endphp
                        </a>
                        <ul class="dropdown-menu" style="padding: 0; border-radius: 5px;">
                            <li class="btn-urut">
                                @if ($title == 'Kesehatan')
                                    @if (substr($_SERVER['REQUEST_URI'], 1, 15) == 'categoriesdesak' ||
                                            substr($_SERVER['REQUEST_URI'], 1, 12) == 'urutmendesak')
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categoriesbaru/1') }}'">Terbaru
                                        </small>
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categories/1') }}'">Terlama
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'], 1, 14) == 'categoriesbaru' ||
                                            substr($_SERVER['REQUEST_URI'], 1, 11) == 'urutterbaru')
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categoriesdesak/1') }}'">Mendesak
                                        </small>
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categories/1') }}'">Terlama
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'], 1, 10) == 'categories' || substr($_SERVER['REQUEST_URI'], 1, 12) == 'semuaprogram')
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categoriesdesak/1') }}'">Mendesak
                                        </small>
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categoriesbaru/1') }}'">Terbaru
                                        </small>
                                    @endif
                                @elseif ($title == 'Pendidikan')
                                    @if (substr($_SERVER['REQUEST_URI'], 1, 15) == 'categoriesdesak' || substr($_SERVER['REQUEST_URI'], 1, 12) == 'urutmendesak')
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categoriesbaru/2') }}'">Terbaru
                                        </small>
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categories/2') }}'">Terlama
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'], 1, 14) == 'categoriesbaru' || substr($_SERVER['REQUEST_URI'], 1, 11) == 'urutterbaru')
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categoriesdesak/2') }}'">Mendesak
                                        </small>
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categories/2') }}'">Terlama
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'], 1, 10) == 'categories' || substr($_SERVER['REQUEST_URI'], 1, 12) == 'semuaprogram')
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categoriesdesak/2') }}'">Mendesak
                                        </small>
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categoriesbaru/2') }}'">Terbaru
                                        </small>
                                    @endif
                                @elseif ($title == 'Bencana Alam')
                                    @if (substr($_SERVER['REQUEST_URI'],1,15) == 'categoriesdesak' || substr($_SERVER['REQUEST_URI'],1,12) == 'urutmendesak')
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categoriesbaru/3') }}'">Terbaru
                                        </small>
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categories/3') }}'">Terlama
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'],1,14) == 'categoriesbaru' || substr($_SERVER['REQUEST_URI'],1,11) == 'urutterbaru')
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categoriesdesak/3') }}'">Mendesak
                                        </small>
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categories/3') }}'">Terlama
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'],1,10) == 'categories' || substr($_SERVER['REQUEST_URI'],1,12) == 'semuaprogram')
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categoriesdesak/3') }}'">Mendesak
                                        </small>
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('categoriesbaru/3') }}'">Terbaru
                                        </small>
                                    @endif
                                @elseif ($title == 'Semua Program')
                                    {{-- @dd(substr($_SERVER['REQUEST_URI'],1,12)) --}}
                                    @if (substr($_SERVER['REQUEST_URI'],1,15) == 'categoriesdesak' || substr($_SERVER['REQUEST_URI'],1,12) == 'urutmendesak')
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('/urutterbaru') }}'">Terbaru
                                        </small>
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('/semuaprogram') }}'">Terlama
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'],1,14) == 'categoriesbaru' || substr($_SERVER['REQUEST_URI'],1,11) == 'urutterbaru')
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('/urutmendesak') }}'">Mendesak
                                        </small>
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('/semuaprogram') }}'">Terlama
                                        </small>
                                    @elseif (substr($_SERVER['REQUEST_URI'],1,10) == 'categories' || substr($_SERVER['REQUEST_URI'],1,12) == 'semuaprogram')
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('/urutmendesak') }}'">Mendesak
                                        </small>
                                        <small class="dropdown-item border-0"
                                            onclick="window.location.href='{{ url('/urutterbaru') }}'">Terbaru
                                        </small>
                                    @endif
                                @endif
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="card-body p-5 pt-2 pb-4">
                <div class="card-body pt-4 px-0">
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
                        id="foreach">
                        @if ($programs->count())
                            @foreach ($programs as $program)
                                <div class="col mb-5">
                                    <div class="card h-100 shadow-sm">
                                        <!-- Program image-->
                                        <img class="card-img-top" style="display: block; height: 150px"
                                            src="{{ asset('storage/' . $program->image) }}"
                                            alt="{{ $program->image }}" />
                                        <!-- Program details-->
                                        <div class="card-body p-4 pt-3 pb-0">
                                            <div class="judul"
                                                style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                                <!-- Program judul-->
                                                <small class="fw-bolder">{{ $program->judul }}</small>
                                            </div>
                                        </div>
                                        <div class="p-4 pt-2">
                                            {{-- Batas Tanggal --}}
                                            @php
                                                // var_dump($program->batastanggal);
                                                // var_dump($program->tglmulai);
                                                $diff = strtotime($program->batastanggal) - time();
                                                // var_dump($diff);
                                                $day = $diff / 86400;
                                                // var_dump($day);
                                                // days
                                                $days = floor($day);
                                                // var_dump($days);
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
                                                    <div id="{{ $program->id }}" class="rounded-pill bg-success"
                                                        style="height:10px; width:0%;">
                                                    </div>
                                                </div>
                                            @elseif ($program->category_id == 2)
                                                <div class="border border-warning mt-2 rounded-pill"
                                                    style="overflow: hidden">
                                                    <div id="{{ $program->id }}" class="rounded-pill bg-warning"
                                                        style="height:10px; width:0%;">
                                                    </div>
                                                </div>
                                            @elseif ($program->category_id == 3)
                                                <div class="border border-info mt-2 rounded-pill"
                                                    style="overflow: hidden">
                                                    <div id="{{ $program->id }}" class="rounded-pill bg-info"
                                                        style="height:10px; width:0%;">
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="text-center">
                                                <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                                    style="height: 35px"
                                                    href="{{ url('programs/' . $program->id) }}">
                                                    <small>Detail</small>
                                                </a>
                                            </div>
                                            {{-- @if (Auth::user()) --}}
                                            <button style="height: 35px" type="submit"
                                                class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                                <small>Donasi Sekarang</small>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">Belum ada program galang dana</p>
                        @endif
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $programs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Presentase Dana Terkumpul
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

@endsection
