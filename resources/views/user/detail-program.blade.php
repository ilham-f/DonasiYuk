@extends('layouts.main')

@section('container')
    <div class="container px-4" style="margin-top: 80px">
        <div class="card rounded-3 border-0 mb-4"
            style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
            <div class="card-body p-5 pt-2 pb-4">
                <div class="card-body pt-4 px-0">
                    <!-- Program image-->
                    <div id="carouselExampleCaptions" class="carousel slide">
                        {{-- <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                        </div> --}}

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img style="height: 450px" src="{{ asset('storage/' . $program->image) }}"
                                    class="d-block w-100 card-img-top rounded" alt="{{ $program->image }}">
                            </div>
                        </div>

                        <div class="carousel-caption rounded d-inline-block mx-auto" style="max-width: 30%;">
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
                            <h6 class="fw-bolder text-light">
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
                            </h6>
                            <a href="/form-donasi/{{ $program->id }}" class="btn btn-outline-light my-1"
                                style="font-size: 14px; width: 180px">Donasi Sekarang</a>
                        </div>

                        {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button> --}}
                    </div>
                    {{-- <div class="image-conatiner" style="position:relative; display:inline-block; width:100%">
                        <img class="card-img-top rounded" style="display: block; height: 450px; max-width: 100%"
                            src="{{ asset('assets/img/' . $program->image) }}" alt="{{ $program->image }}" />
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <button style="height: 35px; width: 150px;" type="submit"
                                class="btn btn-outline-dark d-flex justify-content-center align-items-center">
                                <small>Donasi Sekarang</small>
                            </button>
                        </div>
                    </div> --}}
                    <!-- Program details-->
                    <div class="card-body pt-3 px-0 pb-2">
                        {{-- style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;"> --}}
                        <h5 class="text-cursive fw-bolder">{{ $program->judul }}</h5>
                    </div>
                    <div id="detail" idprogram="{{ $program->id }}" catprogram="{{ $program->category_id }}">
                        {{-- Terkumpul --}}
                        <p class="mb-0 fw-bolder">Rp{{ $program->danaterkumpul }}</p>
                        <p id="dana" class="mb-0 fw-bolder d-none">{{ $program->danaterkumpul }}</p>
                        {{-- Target --}}
                        <small>Terkumpul dari Rp{{ $program->target }}</small>
                        <small id="target" class="d-none">{{ $program->target }}</small>

                        @if ($program->category_id == 1)
                            <div class="border border-success mt-2 rounded-pill" style="overflow: hidden">
                                <div id="{{ $program->id }}" class="rounded-pill bg-success"
                                    style="height:10px; width:0%;">
                                </div>
                            </div>
                        @elseif ($program->category_id == 2)
                            <div class="border border-warning mt-2 rounded-pill" style="overflow: hidden">
                                <div id="{{ $program->id }}" class="rounded-pill bg-warning"
                                    style="height:10px; width:0%;">
                                </div>
                            </div>
                        @elseif ($program->category_id == 3)
                            <div class="border border-info mt-2 rounded-pill" style="overflow: hidden">
                                <div id="{{ $program->id }}" class="rounded-pill bg-info" style="height:10px; width:0%;">
                                </div>
                            </div>
                        @endif
                        {{-- @if (Auth::user()) --}}
                        {{-- <button style="height: 35px" type="submit"
                            class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                            <small>Donasi Sekarang</small>
                        </button> --}}
                    </div>
                    <div class="accordion mt-3" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    Deskripsi
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    {{ $program->deskripsi }}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    Kabar Terbaru
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="d-flex align-items-center me-3">
                                                <img src="{{ asset('assets/img/male.jpg') }}" alt="Avatar"
                                                    class="img-fluid me-2" style="width: 35px;" />
                                                <h5 class="pt-2 fw-bolder">@$owner->nama</h6>
                                            </span>
                                            <small>1 jam lalu</small>
                                        </div>
                                        <strong class="mb-1">Operasi Jantung</strong>
                                        <span>
                                            It is hidden by default, until the collapse plugin adds the appropriate classes
                                            that we use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify any of
                                            this with custom CSS or overriding our default variables. It's also worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>, though
                                            the transition does limit overflow.
                                        </span>
                                        <hr>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="d-flex align-items-center me-3">
                                                <img src="{{ asset('assets/img/male.jpg') }}" alt="Avatar"
                                                    class="img-fluid me-2" style="width: 35px;" />
                                                <h5 class="pt-2 fw-bolder">{{ @$owner->nama }}</h6>
                                            </span>
                                            <small>1 jam lalu</small>
                                        </div>
                                        <strong class="mb-1">Operasi Lambung</strong>
                                        <span>
                                            It is hidden by default, until the collapse plugin adds the appropriate classes
                                            that we use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify any of
                                            this with custom CSS or overriding our default variables. It's also worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>, though
                                            the transition does limit overflow.
                                        </span>
                                        <hr>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="d-flex align-items-center me-3">
                                                <img src="{{ asset('assets/img/male.jpg') }}" alt="Avatar"
                                                    class="img-fluid me-2" style="width: 35px;" />
                                                <h5 class="pt-2 fw-bolder">{{ @$owner->nama }}</h6>
                                            </span>
                                            <small>1 jam lalu</small>
                                        </div>
                                        <strong class="mb-1">Operasi Usus</strong>
                                        <span>
                                            It is hidden by default, until the collapse plugin adds the appropriate classes
                                            that we use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify any of
                                            this with custom CSS or overriding our default variables. It's also worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>, though
                                            the transition does limit overflow.
                                        </span>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    Pancairan Dana
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="d-flex align-items-center me-3">
                                                <img src="{{ asset('assets/img/male.jpg') }}" alt="Avatar"
                                                    class="img-fluid me-2" style="width: 35px;" />
                                                <h5 class="pt-2 fw-bolder">{{ @$owner->nama }}</h6>
                                            </span>
                                            <small>1 jam lalu</small>
                                        </div>
                                        <strong class="mb-1">Pencairan Dana 10.000</strong>
                                        <span>
                                            It is hidden by default, until the collapse plugin adds the appropriate classes
                                            that we use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify any of
                                            this with custom CSS or overriding our default variables. It's also worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>, though
                                            the transition does limit overflow.
                                        </span>
                                        <hr>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="d-flex align-items-center me-3">
                                                <img src="{{ asset('assets/img/male.jpg') }}" alt="Avatar"
                                                    class="img-fluid me-2" style="width: 35px;" />
                                                <h5 class="pt-2 fw-bolder">{{ @$owner->nama }}</h6>
                                            </span>
                                            <small>1 jam lalu</small>
                                        </div>
                                        <strong class="mb-1">Pencairan Dana 10.000</strong>
                                        <span>
                                            It is hidden by default, until the collapse plugin adds the appropriate classes
                                            that we use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify any of
                                            this with custom CSS or overriding our default variables. It's also worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>, though
                                            the transition does limit overflow.
                                        </span>
                                        <hr>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="d-flex align-items-center me-3">
                                                <img src="{{ asset('assets/img/male.jpg') }}" alt="Avatar"
                                                    class="img-fluid me-2" style="width: 35px;" />
                                                <h5 class="pt-2 fw-bolder">{{ @$owner->nama }}</h6>
                                            </span>
                                            <small>1 jam lalu</small>
                                        </div>
                                        <strong class="mb-1">Pencairan Dana 10.000</strong>
                                        <span>
                                            It is hidden by default, until the collapse plugin adds the appropriate classes
                                            that we use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify any of
                                            this with custom CSS or overriding our default variables. It's also worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>, though
                                            the transition does limit overflow.
                                        </span>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseFour">
                                    Donasi
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until
                                    the collapse plugin adds the appropriate classes that we use to style each element.
                                    These classes control the overall appearance, as well as the showing and hiding via CSS
                                    transitions. You can modify any of this with custom CSS or overriding our default
                                    variables. It's also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseFive">
                                    Doa
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until
                                    the collapse plugin adds the appropriate classes that we use to style each element.
                                    These classes control the overall appearance, as well as the showing and hiding via CSS
                                    transitions. You can modify any of this with custom CSS or overriding our default
                                    variables. It's also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Presentase Dana Terkumpul
            var id = $('#detail').attr('idprogram');
            var catid = $('#detail').attr('catprogram');
            // alert(id);
            var dana = $('#dana').html();
            // alert(dana);
            var target = $('#target').html();
            // alert(target);
            var persen = (dana / target) * 100;
            // alert(persen);

            if (persen >= 100 && catid == 1) {
                $('#' + id).css('width', persen + '%');
                $('#' + id).css('background-color', '#157347');
            } else if (persen >= 100 && catid == 2) {
                $('#' + id).css('width', persen + '%');
                $('#' + id).css('background-color', '#e6b626');
            } else if (persen >= 100 && catid == 3) {
                $('#' + id).css('width', persen + '%');
                $('#' + id).css('background-color', '#2fbdd9');
            } else {
                $('#' + id).css('width', persen + '%');
            }
        });
    </script>
@endsection
