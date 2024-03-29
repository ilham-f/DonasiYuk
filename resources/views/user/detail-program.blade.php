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
                        @if ($program->danaterkumpul)
                            <p class="mb-0 fw-bolder">Rp{{ $program->danaterkumpul }}</p>
                        @else
                            <p class="mb-0 fw-bolder">Rp0</p>
                        @endif
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
                                    @if (count($kabars))
                                        @foreach ($kabars as $kabar)
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <span class="d-flex align-items-center me-3">
                                                        <img src="{{ asset('assets/img/avatar.jpg') }}" alt="Avatar"
                                                            class="rounded-circle img-fluid me-2" style="width: 35px;" />
                                                        <small class="bolder">{{ $owner->nama }}</small>
                                                    </span>
                                                    <small>{{ Carbon\Carbon::parse($kabar->updated_at)->diffForHumans() }}</small>
                                                </div>
                                                <strong class="mb-1">{{ $kabar->judulKabar }}</strong>
                                                <span>
                                                    {{ $kabar->detailKabar }}
                                                </span>
                                                <hr>
                                            </div>
                                        @endforeach
                                    @else
                                        <span>Pemilik program belum memperbarui kabar terbaru</span>
                                    @endif
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
                                    @if (count($pencairans))
                                        @foreach ($pencairans as $pencairan)
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <span class="d-flex align-items-center me-3">
                                                        <img src="{{ asset('assets/img/avatar.jpg') }}" alt="Avatar"
                                                            class="rounded-circle img-fluid me-2" style="width: 35px;" />
                                                        <small class="bolder">{{ $owner->nama }}</small>
                                                    </span>
                                                    <small>{{ Carbon\Carbon::parse($pencairan->updated_at)->diffForHumans() }}</small>
                                                </div>
                                                <strong class="mb-2">Pencairan Dana {{ $pencairan->jumlah }}</strong>
                                                <span class="mb-2">
                                                    {{ $pencairan->tujuan }}
                                                </span>
                                                @if ($pencairan->bukti != '')
                                                    <img style="height: 150px; width: 200px" src="{{ asset('storage/' . $pencairan->bukti) }}"
                                                        class="d-block card-img-top rounded" alt="{{ $pencairan->bukti }}">
                                                @endif
                                                <hr>
                                            </div>
                                        @endforeach
                                    @else
                                        <span>Pemilik program belum pernah melakukan pencairan dana</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseFour">
                                    Donasi & Doa
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div id="content">
                                        {{-- @dd($donasis) --}}
                                        @if (count($donasis))
                                            @foreach ($donasis as $donasi)
                                                <div class="d-flex flex-column">
                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                        <span class="d-flex align-items-center me-3">
                                                            <img src="{{ asset('assets/img/avatar.jpg') }}" alt="Avatar"
                                                                class="rounded-circle img-fluid me-2" style="width: 35px;" />
                                                            <small class="bolder">
                                                                @if ($donasi->anonim != '' && $donasi->anonim != 0)
                                                                    #OrangBaik
                                                                @else
                                                                    {{ $donasi->nama }}
                                                                @endif
                                                            </small>
                                                        </span>
                                                        <small>{{ Carbon\Carbon::parse($donasi->updated_at)->diffForHumans() }}</small>
                                                    </div>
                                                    <strong class="mb-2">{{ $donasi->jml_donasi }}</strong>
                                                    <span class="mb-2">
                                                        {{ $donasi->doa }}
                                                    </span>
                                                    <hr>
                                                </div>
                                            @endforeach
                                        @else
                                            <span>Program ini belum menerima donasi</span>
                                        @endif
                                    </div>
                                    @if ($donasis != '')
                                        <div class="d-none" id="programid">{{ $donasi->program_id }}</div>
                                    @endif
                                    @if (count($donasis) >= 3)
                                        <button id="show-more" class="btn btn-dark w-100 py-2 border-0">
                                            <small>----&nbsp;&nbsp; Tampilkan lebih banyak &nbsp;&nbsp;----</small>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        moment.locale('id');
        // Function to load more items via AJAX
        function loadMoreItems() {
            // Define a variable to keep track of the number of items shown
            let itemsShown = 3;
            var programid = $('#programid').html();
            // Make an AJAX request to retrieve more items from the server
            // Adjust the URL and data based on your server-side implementation
            $.ajax({
                url: '/showMore',
                type: 'GET',
                data: { start: itemsShown,
                        program_id: programid },
                success: function(response) {
                    console.log(response);
                    console.log(response[1]);
                    console.log(response[0]);
                    donasiLength = response[0];
                    donasis = response[1];
                    //Check if there are more items
                    if (donasiLength > 0) {
                        $.each(donasis, function (index, value) {
                            var html = '<div class="d-flex flex-column doa">'+
                                            '<div class="d-flex align-items-center justify-content-between mb-2">'+
                                                '<span class="d-flex align-items-center me-3">'+
                                                    '<img src="{{ asset('assets/img/avatar.jpg') }}" alt="Avatar"'+
                                                        'class="rounded-circle img-fluid me-2" style="width: 35px;" />'+
                                                    '<small class="bolder">'+ value.nama +'</small>'+
                                                '</span>'+
                                                '<small>'+ moment(value.created_at).fromNow() +'</small>'+
                                            '</div>'+
                                            '<strong class="mb-2">'+ value.jml_donasi +'</strong>'+
                                            '<span class="mb-2">'+ value.doa +'</span>'+
                                            '<hr>'+
                                        '</div>';
                            $('#content').append(html);
                        });
                        // Increment the counter
                        itemsShown += donasiLength;
                    }
                    if (donasiLength <= 3) {
                        $('#show-more').hide();
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
        // Event listener for the load more button
        $('#show-more').click(function() {
            console.log('tes');
            loadMoreItems();
        });
    </script>

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
