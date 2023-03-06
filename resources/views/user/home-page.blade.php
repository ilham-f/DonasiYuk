@extends('layouts.main')

@section('container')
    <!-- Carousel-->
    <div id="slider" class="container mb-5 mt-5 pt-5 px-4">
        <ul id="autoplay">
            @foreach ($programs as $program)
                <li style="overflow: hidden">
                    <img class="rounded" style="height: 450px; width:100%;" src="{{ asset('assets/img/'.$program->image) }}" alt="{{ $program->image }}">
                </li>
            @endforeach
        </ul>
        <hr>
    </div>

    <!-- Section-->
    <section class="container pt-4 mt-4 px-4">
        <div class="card rounded-3 p-4 border-0 mb-4" style="box-shadow: 1px 2px 20px 2px rgba(162, 162, 162, 0.577);">
            <div class="card rounded-3 border border-success">
                <div class="card-header p-3">
                    <h5 class="mb-0">Penggalangan Dana Mendesak</h5 class="mb-0">
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <button class="btn btn-outline-success me-2 btn-catMendesak">
                                <small value="4">Semua</small>
                            </button>
                            @foreach ($categories as $cat)
                                <button class="btn btn-outline-success me-2 btn-catMendesak">
                                    <small value="{{ $cat->id }}">{{ $cat->nama }}</small>
                                </button>
                            @endforeach
                        </div>
                        <a href="/program" class="d-flex justify-content-center align-items-center border-0"
                            style="text-decoration: none;"><small>Lihat Semua >></small></a>
                    </div>

                    <div id="catMendesak">
                        <ul id="mendesak">
                            @foreach ($programs as $program)
                                <li>
                                    <div class="mendesak{{ $program->category_id }} col-lg mb-2 mt-4">
                                        <div class="card h-100 shadow-sm">
                                            <!-- Product image-->
                                            <img class="card-img-top" style="display: block; height: 150px"
                                                src="{{ asset('assets/img/' . $program->image) }}"
                                                alt="{{ $program->image }}" />
                                            <!-- Product details-->
                                            <div class="card-body p-4 pt-3 pb-0">
                                                <div class="judul"
                                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                                    <!-- Product name-->
                                                    <small class="fw-bolder">{{ $program->judul }}</small>
                                                    <!-- Product price-->
                                                </div>
                                            </div>
                                            <!-- Product Footer-->
                                            <div class="p-4 pt-2">
                                                {{-- Batas Tanggal --}}
                                                @php
                                                    $diff = strtotime($program->batastanggal) - strtotime($program->created_at);

                                                    $time = $diff / 86400;
                                                    // days
                                                    $days = floor($time);
                                                    // hours
                                                    $hours = floor($time);
                                                    // minutes
                                                    $minutes = floor($time);
                                                    // seconds
                                                    $seconds = floor($time);
                                                @endphp
                                                <small>
                                                    @if ($days == 0 && $hours == 0 && $minutes != 0)
                                                        {{ $minutes }} menit lagi
                                                    @elseif ($days == 0 && $hours != 0)
                                                        {{ $hours }} jam lagi
                                                    @elseif ($days != 0)
                                                        {{ $days }} hari lagi
                                                    @endif
                                                </small>
                                                {{-- Terkumpul --}}
                                                <p class="mb-0 text-success">Rp{{ $program->danaterkumpul }}</p>
                                                {{-- Target --}}
                                                <small>Terkumpul dari Rp{{ $program->target }}</small>
                                                <div class="border border-success mt-2 rounded-pill"
                                                    style="overflow: hidden">
                                                    <div id="mendesak{{ $program->id }}" class="rounded-pill"
                                                        style="height:10px; width:0%; background-color:#1db76f"></div>
                                                </div>

                                                <div class="text-center">
                                                    <a class="d-flex justify-content-center btn btn-outline-success mt-3 w-100"
                                                        style="height: 35px" href="">
                                                        <small>Detail</small>
                                                    </a>
                                                </div>
                                                {{-- @if (Auth::user()) --}}
                                                <button style="height: 35px" type="submit"
                                                    class="d-flex justify-content-center btn btn-outline-success mt-2 w-100">
                                                    <small>Donasi Sekarang</small>
                                                </button>
                                                {{-- @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card rounded-3 border border-success mt-4">
                <div class="card-header p-3">
                    <h5 class="mb-0">Belum Terbantu Dengan Baik</h5 class="mb-0">
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            {{-- <span class="mt-1 me-2">Kategori : </span> --}}
                            <button class="btn btn-outline-success me-2 btn-cat">
                                <small value="4">Semua</small>
                            </button>
                            @foreach ($categories as $cat)
                                <button class="btn btn-outline-success me-2 btn-cat">
                                    <small value="{{ $cat->id }}">{{ $cat->nama }}</small>
                                </button>
                            @endforeach
                        </div>
                        <a href="/program" class="d-flex justify-content-center align-items-center border-0"
                            style="text-decoration: none;"><small>Lihat Semua >></small></a>
                    </div>

                    <div id="cat">
                        <ul id="lightSlider">
                            @foreach ($programs as $program)
                                <li>
                                    <div class="{{ $program->category_id }} program col-lg mb-2 mt-4">
                                        <div class="card h-100 shadow-sm">
                                            <!-- Product image-->
                                            <img class="card-img-top" style="display: block; height: 150px"
                                                src="{{ asset('assets/img/' . $program->image) }}"
                                                alt="{{ $program->image }}" />
                                            <!-- Product details-->
                                            <div class="card-body p-4 pt-3 pb-0">
                                                <div class="judul"
                                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                                    <!-- Product name-->
                                                    <small class="fw-bolder">{{ $program->judul }}</small>
                                                    <!-- Product price-->
                                                </div>
                                            </div>
                                            <!-- Product Footer-->
                                            <div class="p-4 pt-2">
                                                {{-- Batas Tanggal --}}
                                                @php
                                                    $diff = strtotime($program->batastanggal) - strtotime($program->created_at);

                                                    $time = $diff / 86400;
                                                    // days
                                                    $days = floor($time);
                                                    // hours
                                                    $hours = floor($time);
                                                    // minutes
                                                    $minutes = floor($time);
                                                    // seconds
                                                    $seconds = floor($time);
                                                @endphp
                                                <small>
                                                    @if ($days == 0 && $hours == 0 && $minutes != 0)
                                                        {{ $minutes }} menit lagi
                                                    @elseif ($days == 0 && $hours != 0)
                                                        {{ $hours }} jam lagi
                                                    @elseif ($days != 0)
                                                        {{ $days }} hari lagi
                                                    @endif
                                                </small>
                                                {{-- Terkumpul --}}
                                                <p class="mb-0 text-success">Rp{{ $program->danaterkumpul }}</p>
                                                {{-- Target --}}
                                                <small>Terkumpul dari Rp{{ $program->target }}</small>
                                                <div class="border border-success mt-2 rounded-pill"
                                                    style="overflow: hidden">
                                                    <div id="{{ $program->id }}" class="rounded-pill"
                                                        style="height:10px; width:0%; background-color:#1db76f"></div>
                                                </div>

                                                <div class="text-center">
                                                    <a class="d-flex justify-content-center btn btn-outline-success mt-3 w-100"
                                                        style="height: 35px" href="">
                                                        <small>Detail</small>
                                                    </a>
                                                </div>
                                                {{-- @if (Auth::user()) --}}
                                                <button style="height: 35px" type="submit"
                                                    class="d-flex justify-content-center btn btn-outline-success mt-2 w-100">
                                                    <small>Donasi Sekarang</small>
                                                </button>
                                                {{-- @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        // Penggalangan mendesak
        $(document).ready(function() {
            $("#mendesak").lightSlider({
                item: 4,
                pager: false,
                slideMove: 2,
                responsive: [{
                        breakpoint: 1200,
                        settings: {
                            item: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            item: 2,
                        }
                    },
                    {
                        breakpoint: 750,
                        settings: {
                            item: 1,
                        }
                    }
                ]
            });
        });


        $(document).ready(function() {
            $("#lightSlider").lightSlider({
                item: 4,
                pager: false,
                slideMove: 2,
                responsive: [{
                        breakpoint: 1200,
                        settings: {
                            item: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            item: 2,
                        }
                    },
                    {
                        breakpoint: 750,
                        settings: {
                            item: 1,
                        }
                    }
                ]
            });
        });

        $(document).ready(function() {
            var autoplaySlider = $('#autoplay').lightSlider({
                item: 1,
                auto: true,
                loop: true,
                pauseOnHover: true,
            });
        });
    </script>

    <script>
        let msg = '{{ Session::get('alert') }}';

        let exist = '{{ Session::has('alert') }}';

        if (exist) {
            alert(msg);
        }
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Penggalangan Mendesak
        $(document).ready(function() {
            $(".btn-catMendesak").on("click", function() {
                var value = $(this).find('small').attr('value');
                // alert(value);
                if (value == 4) {
                    for (let i = 1; i <= 3; i++) {
                        $('.mendesak' + i).show();
                    }
                } else {
                    for (let i = 1; i <= 3; i++) {
                        if (i != value) {
                            $('.mendesak' + i).hide();
                        } else if (i == value) {
                            $('.mendesak' + i).show();
                        }
                    }
                }
            });

            $.get("/getprogram", function(data) {
                $.each(data, function(index, value) {
                    var dana = value.danaterkumpul;
                    var target = value.target;
                    var persen = (dana / target) * 100;

                    if (persen >= 100) {
                        $('#mendesak' + value.id).css('width', persen + '%');
                        $('#mendesak' + value.id).css('background-color', '#198754');
                        // $('#'+value.id).removeClass('bg-success').addClass('bg-info');
                    } else {
                        $('#mendesak' + value.id).css('width', persen + '%');
                    }
                });
            });

        });

        // Belum Terbantu Dengan Baik
        $(document).ready(function() {
            $(".btn-cat").on("click", function() {
                var value = $(this).find('small').attr('value');
                // alert(value);
                if (value == 4) {
                    for (let i = 1; i <= 3; i++) {
                        $('.' + i).show();
                    }
                } else {
                    for (let i = 1; i <= 3; i++) {
                        if (i != value) {
                            $('.' + i).hide();
                        } else if (i == value) {
                            $('.' + i).show();
                        }
                    }
                }

            });

            $.get("/getprogram", function(data) {
                $.each(data, function(index, value) {
                    var dana = value.danaterkumpul;
                    var target = value.target;
                    var persen = (dana / target) * 100;

                    if (persen >= 100) {
                        $('#' + value.id).css('width', persen + '%');
                        $('#' + value.id).css('background-color', '#198754');
                        // $('#'+value.id).removeClass('bg-success').addClass('bg-info');
                    } else {
                        $('#' + value.id).css('width', persen + '%');
                    }
                });
            });

        });
    </script>
@endsection
