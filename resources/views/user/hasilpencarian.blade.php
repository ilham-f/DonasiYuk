@extends('layouts.main')

@section('container')
    <div class="container px-4" style="margin-top: 80px">
        <div class="card rounded-3 border-0"
            style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
            <div class="ps-5 pt-4">
                <h5 class="mb-0 text-cursive fw-bolder">Hasil Pencarian</h5>
            </div>
            <div class="card-body p-5 pt-4 mt-2 pb-2">
                <div class="card-body pt-4 px-0">
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        @if ($programs->count())
                            @foreach ($programs as $program)
                                <div class="{{ $program->category_id }} program col mb-5">
                                    <div class="card h-100 shadow-sm">
                                        <!-- Product image-->
                                        <img class="card-img-top" style="display: block; height: 150px"
                                            src="{{ asset('assets/img/' . $program->namafile) }}"
                                            alt="{{ $program->namafile }}" />
                                        <!-- Product details-->
                                        <div class="card-body p-4 pt-3 pb-0">
                                            <div class="judul"
                                                style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                                <!-- Product name-->
                                                <small class="fw-bolder">{{ $program->judul }}</small>
                                                {{-- @dd() --}}
                                                <!-- Product price-->
                                            </div>
                                        </div>
                                        <!-- Product Footer-->
                                        <div class="p-4 pt-2">
                                            {{-- Batas Tanggal --}}
                                            @php
                                                $diff = strtotime($program->batastanggal) - strtotime($program->tglmulai);

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
                                                    <div id="{{ $program->program_id }}" class="rounded-pill bg-success"
                                                        style="height:10px; width:0%;">
                                                    </div>
                                                </div>
                                            @elseif ($program->category_id == 2)
                                                <div class="border border-warning mt-2 rounded-pill"
                                                    style="overflow: hidden">
                                                    <div id="{{ $program->program_id }}" class="rounded-pill bg-warning"
                                                        style="height:10px; width:0%;">
                                                    </div>
                                                </div>
                                            @elseif ($program->category_id == 3)
                                                <div class="border border-info mt-2 rounded-pill"
                                                    style="overflow: hidden">
                                                    <div id="{{ $program->program_id }}" class="rounded-pill bg-info"
                                                        style="height:10px; width:0%;">
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="text-center">
                                                <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                                    style="height: 35px" href="programs/{{ $program->program_id }}">
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
                            <p class="text-center">Tidak Ditemukan</p>
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
        $(document).ready(function () {
            // Presentase Dana Terkumpul
            $.get("/getprogram", function(data) {
                $.each(data, function(index, value) {
                    var dana = value.danaterkumpul;
                    var target = value.target;
                    var persen = (dana / target) * 100;

                    if (persen >= 100 && value.category_id == 1) {
                        $('#' + value.id).css('width', persen + '%');
                        $('#' + value.id).css('background-color', '#157347');
                    } else if (persen >= 100 && value.category_id == 2) {
                        $('#' + value.id).css('width', persen + '%');
                        $('#' + value.id).css('background-color', '#e6b626');
                    } else if (persen >= 100 && value.category_id == 3) {
                        $('#' + value.id).css('width', persen + '%');
                        $('#' + value.id).css('background-color', '#2fbdd9');
                    } else {
                        $('#' + value.id).css('width', persen + '%');
                    }
                });
            });

            $(".btn-cat").on("click", function() {
                var val = $(this).find('small').attr('value');
                if (val == 4) {
                    for (let i = 1; i <= 3; i++) {
                        $('.' + i).show();
                    }
                } else {
                    for (let i = 1; i <= 3; i++) {
                        if (i != val) {
                            $('.' + i).hide();
                        } else if (i == val) {
                            $('.' + i).show();
                        }
                    }
                }
            });
        });
    </script>
@endsection
