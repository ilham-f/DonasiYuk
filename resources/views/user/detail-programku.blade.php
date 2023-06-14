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
                                <img id="addPreview" style="height: 450px" src="{{ asset('storage/' . $program->image) }}"
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
                            <a id="pilihFoto" href="" class="btn btn-outline-light my-1"
                                style="font-size: 14px; width: 180px">Ganti Foto</a>
                            <a id="simpanFoto" href="" class="btn btn-light my-1"
                                style="font-size: 14px; width: 180px">Simpan</a>

                            <form id="editFoto" action="/editFotoProgram/{{ $program->id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div id="attachlist"></div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body pt-3 px-0 pb-2">
                        {{-- style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;"> --}}
                        <h5 id="judul" class="text-cursive fw-bolder">{{ $program->judul }}</h5>
                        <form id="editJudul" action="/programku/{{ $program->id }}" method="post">
                            @csrf
                            <input id="inputJudul" name="judul" class="text-cursive fw-bolder form-control mb-2" value="{{ $program->judul }}">
                        </form>
                        <button id="ubahJudul" class="btn btn-dark">Ubah Judul</button>
                        <button id="simpanJudul" class="btn btn-dark">Simpan</button>
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
                                    <p id="deskripsi">{{ $program->deskripsi }}</p>
                                    <form id="editDeskripsi" action="/programku/{{ $program->id }}" method="post">
                                        @csrf
                                        <textarea name="deskripsi" id="inputDeskripsi" class="form-control mb-3">{{ $program->deskripsi }}</textarea>
                                    </form>
                                    <button id="ubahDeskripsi" class="w-100 btn btn-dark">Ubah</button>
                                    <button id="simpanDeskripsi" class="w-100 btn btn-dark">Simpan</button>
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
                                    <div class="d-none" id="jumlahKabar">{{ count($kabars) }}</div>
                                    @if (count($kabars))
                                        @foreach ($kabars as $kabar)
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <span class="d-flex align-items-center me-3">
                                                        <img src="{{ asset('assets/img/avatar.jpg') }}" alt="Avatar"
                                                            class="rounded-circle img-fluid me-2" style="width: 35px;" />
                                                        <small class="bolder">{{ $owner->nama }}</small>
                                                    </span>
                                                    <small>{{ Carbon\Carbon::parse($kabar->updated_at)->diffForHumans() }}</small>
                                                </div>

                                                <form id="editKabar{{ $loop->iteration }}" action="/editkabar/{{ $kabar->id }}" method="post">
                                                    @csrf
                                                    <strong id="judulKabar{{ $loop->iteration }}" class="mb-2">{{ $kabar->judulKabar }}</strong>
                                                    <div id="inputjudulKabar{{ $loop->iteration }}">
                                                        <label>Judul Kabar</label>
                                                        <input class="form-control" type="text" name="judulKabar" value="{{ $kabar->judulKabar }}">
                                                    </div>
                                                    <br>
                                                    <span class="mt-2" id="detailKabar{{ $loop->iteration }}">
                                                        {{ $kabar->detailKabar }}
                                                    </span>
                                                    <div id="inputdetailKabar{{ $loop->iteration }}">
                                                        <label>Detail Kabar</label>
                                                        <textarea name="detailKabar" class="form-control">{{ $kabar->detailKabar }}</textarea>
                                                    </div>
                                                    @if ($kabar->image != '')
                                                        <img style="height: 150px; width: 200px" src="{{ asset('storage/' . $kabar->image) }}"
                                                            class="d-block card-img-top rounded" alt="{{ $kabar->image }}">
                                                    @endif
                                                </form>

                                                <div class="d-flex">
                                                    <button id="ubahKabar{{ $loop->iteration }}" class="btn btn-dark mt-3">Ubah</button>
                                                    <button id="delete{{ $loop->iteration }}" data-bs-toggle="modal" data-bs-target="#delete-{{ $kabar->id }}" class="btn btn-dark mt-3 ms-2">Hapus</button>
                                                </div>
                                                <button id="simpanKabar{{ $loop->iteration }}" class="btn btn-dark mt-3">Simpan</button>
                                                <hr>
                                            </div>
                                        @endforeach
                                    @else
                                        <span>Anda belum memperbarui kabar terbaru</span>
                                    @endif
                                    <button id="tambahKabar" data-bs-toggle="modal" data-bs-target="#tambahkabar" class="btn btn-dark mt-3">Tambah</button>
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
                                        <span>Anda belum pernah melakukan pencairan dana</span>
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
                                            <span>Anda belum pernah menerima donasi</span>
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

    <div class="modal fade" id="tambahkabar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Kabar Terbaru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex flex-column">
                        <form action="/tambahkabar" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" value="{{ $program->id }}" name="program_id"/>
                            <div class="col mb-3">
                                <label for="alamat" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judulKabar"/>
                            </div>
                            <div class="col mb-3">
                                <label for="alamat" class="form-label">Detail Kabar</label>
                                <textarea style="height: 100px" class="form-control" name="detailKabar"></textarea>
                            </div>
                            <div class="pt-2">
                                <div class="d-flex flex-column align-items-center">
                                    <label for="image" class="align-self-start mb-2">Foto Kabar Terbaru
                                        :</label for="image">
                                    {{-- <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> --}}
                                    <input id="image" class="form-control w-100" type="file" name="image"
                                        onchange="previewKabar(event)">
                                    <img class="mb-3 mt-3 rounded" id="add-preview"
                                        style="display: block; width: 40%; height: auto;
                                                        aspect-ratio: 4.5/3; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2)"
                                        src="https://www.its.ac.id/tmesin/wp-content/uploads/sites/22/2022/07/no-image.png" />
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($kabars as $kabar)
        <div class="modal fade" id="delete-{{ $kabar->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h5>Apakah anda yakin menghapus Kabar Terbaru "{{ $kabar->judulKabar }}"?</h5>
                        <div class="mt-4 d-flex justify-content-end">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <form action="/deletekabar" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $kabar->id }}">
                                <button class="ms-2 btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        var isUpdated = '{{ session("isUpdated") }}'
        if (isUpdated) {
            alert(isUpdated)
        }
    </script>

    <script>
        $(document).ready(function () {
            $('#simpanFoto').hide();
            $('#addPreview').hide();

            $('#pilihFoto').click(function(e) {
                e.preventDefault();

                var $UploadInput = $('<input type="file" name="image" style="position: absolute; left: -1000px;">');

                $("#attachlist").append($UploadInput);

                $UploadInput.change(function () {
                    preview(event);
                });

                $UploadInput.click();

            });


            function preview(event) {
                $('#simpanFoto').show();
                $('#pilihFoto').hide();

                if (event.target.files.length > 0) {
                    const src = URL.createObjectURL(event.target.files[0]);
                    const image = $('#addPreview');
                    // console.log(image);
                    image.attr('src', src);
                    image.addClass('d-block');
                }
            }

            $('#simpanFoto').click(function (e) {
                e.preventDefault();
                $('#editFoto').submit();
            });
        });

    </script>

    <script>
        function previewKabar(event) {
            if (event.target.files.length > 0) {
                const src = URL.createObjectURL(event.target.files[0]);
                const image = document.getElementById('add-preview');
                const nextUp = document.getElementById('nextUp');
                image.src = src;
                image.style.display = "block";
                nextUp.style.display = "block";
            }
        }
    </script>

    <script>
        $(document).ready(function () {
            $('#simpanDeskripsi').hide();
            $('#inputDeskripsi').hide();
            $('#simpanJudul').hide();
            $('#inputJudul').hide();

            var jumlahKabar = $('#jumlahKabar').html();
            console.log(jumlahKabar);

            for (let j = 1; j <= jumlahKabar; j++) {
                console.log(j);
                $('#simpanKabar'+ j).hide();
                $('#inputjudulKabar'+ j).hide();
                $('#inputdetailKabar'+ j).hide();
            }

            $('#ubahDeskripsi').click(function (e) {
                e.preventDefault();
                $(this).hide();
                for (let y = 1; y <= jumlahKabar; y++) {
                    $('#ubahKabar'+ y).hide();
                    $('#delete'+ y).hide();
                }

                $('#tambahKabar').hide();
                $('#ubahJudul').hide();
                $('#deskripsi').hide();

                $('#simpanDeskripsi').show();
                $('#inputDeskripsi').show();

            });
            $('#ubahJudul').click(function (e) {
                e.preventDefault();
                $(this).hide();
                for (let n = 1; n <= jumlahKabar; n++) {
                    $('#ubahKabar'+ n).hide();
                    $('#delete'+ n).hide();
                }
                $('#ubahDeskripsi').hide();
                $('#judul').hide();
                $('#tambahKabar').hide();

                $('#simpanJudul').show();
                $('#inputJudul').show();

            });

            for (let i = 1; i <= jumlahKabar; i++) {
                $('#ubahKabar'+ i).click(function (e) {
                    e.preventDefault();
                    $(this).hide();
                    for (let x = 1; x <= jumlahKabar; x++) {
                        if (x != i) {
                            $('#ubahKabar'+ x).hide();
                        }
                    }
                    $('#delete'+ i).hide();
                    $('#ubahJudul').hide();
                    $('#ubahDeskripsi').hide();
                    $('#tambahKabar').hide();

                    $('#judulKabar'+ i).hide();
                    $('#detailKabar'+ i).hide();

                    $('#simpanKabar'+ i).show();
                    $('#inputjudulKabar'+ i).show();
                    $('#inputdetailKabar'+ i).show();
                });
            }

            for (let k = 0; k <= jumlahKabar; k++) {
                $('#simpanKabar'+ k).click(function (e) {
                    $('#editKabar'+ k).submit();
                });
            }

            $('#simpanDeskripsi').click(function (e) {
                $('#editDeskripsi').submit();
            });
            $('#simpanJudul').click(function (e) {
                $('#editJudul').submit();
            });


            $('#inputDeskripsi').on('input', function() {
                this.style.height = 'auto'; // Reset the height to auto
                this.style.height = (this.scrollHeight + 2) +
                'px'; // Set the height based on the scrollHeight
            });
        });
    </script>

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
