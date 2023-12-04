@extends('partials.profil')

@section('body')
    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 23px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .3s;
            transition: .3s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .3s;
            transition: .3s;
        }

        input:checked+.slider {
            background-color: #000;
        }

        /* input:focus + .slider {
                box-shadow: 0 0 1px #000;
                } */

        input:checked+.slider:before {
            -webkit-transform: translateX(17px);
            -ms-transform: translateX(17px);
            transform: translateX(17px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <h4>Akun Saya</h4>
    <hr class="mt-0 mb-3">
    <div class="row pt-1">
        <div class="col-6 mb-3">
            <h6>Nama</h6>
            <input id="namaUser" class="form-control text-muted" value="{{ Auth::user()->nama }}" readonly />
        </div>
        <div class="col-6 mb-3">
            <h6>Jenis Kelamin</h6>
            <select id="jkUser" style="color: #7d7a87" class="form-select border-1 rounded" name="jk" disabled>
                @if (!Auth::user()->jk)
                    <option selected>Jenis Kelamin</option>
                    <option value="1">Laki-laki</option>
                    <option value="0">Perempuan</option>
                @elseif (Auth::user()->jk == 1)
                    <option selected value="1">Laki-laki</option>
                    <option value="0">Perempuan</option>
                @elseif (Auth::user()->jk == 0)
                    <option selected value="0">Perempuan</option>
                    <option value="1">Laki-laki</option>
                @endif
            </select>
            {{-- <h6>Jenis Kelamin</h6>
            <input id="jkUser" class="form-control text-muted" value="{{ Auth::user()->jk ?? 'pilih'}}" readonly/> --}}
        </div>
        <div class="col-6 mb-3">
            <h6>Email</h6>
            <input id="emailUser" class="form-control text-muted" value="{{ Auth::user()->email }}" readonly />
        </div>
        <div class="col-6 mb-3">
            <h6>No. Telepon</h6>
            <input id="notelpUser" class="form-control text-muted" value="{{ Auth::user()->notelp ?? 'No. Telepon' }}"
                readonly />
        </div>
        <div class="col-12 mb-3">
            <h6>Alamat</h6>
            <input id="alamatUser" class="form-control text-muted" readonly
                value="{{ Auth::user()->alamat ?? 'Alamat' }}" />
        </div>
        {{-- <div class="text-end mt-2">
            <button id="ubahProfil" class="btn btn-dark">Ubah Profil</button>
        </div> --}}
    </div>
    <hr class="my-3">
    <div class="d-flex justify-content-between align-items-center">
        <label for="anonim">Sembunyikan nama anda ketika berdonasi :</label>
        <div class="d-flex align-items-center">
            <small id="namaAnonim" class="text-muted">{{ Auth::user()->nama }}</small>
            <label class="switch ms-2">
                @if (Auth::user()->anonim == 1)
                    <input id="anonim" name="anonim" type="checkbox" value="1" checked>
                @else
                    <input id="anonim" name="anonim" type="checkbox" value="0">
                @endif
                {{-- <input id="anonim" type="checkbox" value="0"> --}}
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    <div class="text-center mt-4 p-3 border border-secondary rounded" style="background-color: #e9ecef">
        <h5 class="text-uppercase">Total Donasi Saya</h5>
        <div class="d-flex justify-content-center mt-3" style="font-size: 30px">
            <span class="fw-bold text-muted">Rp</span>
            <span id="number-display" class="fw-bold text-muted">{{ $donasi->totalDonasi ?? '0' }}
            </span>
        </div>
    </div>

    <!-- Modal Ubah Profil-->
    <div class="modal fade" id="profil-{{ $user->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form class="row d-flex flex-column" action="/profil/{{ $user->id }}" method="post">
                        @method('put')
                        @csrf
                        <div class="col mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" />
                        </div>
                        <div class="col mb-3">
                            <label for="jk">Jenis Kelamin</label>
                            <br>
                            <select class="form-select border-1 rounded mt-2" name="jk">
                                @if (!$user->jk)
                                    <option selected>-- Pilih --</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="0">Perempuan</option>
                                @elseif ($user->jk == 1)
                                    <option selected value="1">Laki-laki</option>
                                    <option value="0">Perempuan</option>
                                @elseif ($user->jk == 0)
                                    <option selected value="0">Perempuan</option>
                                    <option value="1">Laki-laki</option>
                                @endif
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label for="notelp" class="form-label">No. Telepon</label>
                            <input type="text" name="notelp" class="form-control" value="{{ $user->notelp }}"
                                placeholder="No. Telepon" />
                        </div>
                        <div class="col mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ $user->alamat }}"
                                placeholder="Alamat" />
                        </div>
                        <button type="submit" class="btn btn-info ms-3 text-light" style="width: 150px">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            var namaAnonim = $('#namaAnonim');
            var userNama = $('#namaAnonim').html();
            var isAnonim = $('#anonim');
            if (isAnonim.val() == 1) {
                    namaAnonim.html('#OrangBaik');
            } else {
                    namaAnonim.html(userNama);
            }

            isAnonim.change(function() {
                if (isAnonim.val() == 0) {
                    isAnonim.val(1);
                    // console.log(isAnonim.val());
                    namaAnonim.html('#OrangBaik');
                } else {
                    isAnonim.val(0)
                    // console.log(isAnonim.val());
                    namaAnonim.html(userNama);
                }

                var data = isAnonim.val();
                // console.log(data);
                $.ajax({
                    type: "post",
                    url: "/ubahAnonim",
                    data: {
                        isAnonim: data
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                    }
                });
            });

            var ubah = $('#ubahProfil');
            var nama = $('#namaUser');
            var jk = $('#jkUser');
            var email = $('#emailUser');
            var notelp = $('#notelpUser');
            var alamat = $('#alamatUser');
            jk.css({
                'background-size': '0px 0px'
            });
            // simpan.hide();
            ubah.click(function() {
                if (ubah.html() == 'Ubah Profil') {
                    ubah.html('Simpan');
                    nama.removeAttr('readonly');
                    email.removeAttr('readonly');
                    notelp.removeAttr('readonly');
                    alamat.removeAttr('readonly');
                    jk.removeAttr('readonly');
                    jk.css({
                        'background-size': '16px 12px'
                    });
                } else if (ubah.html() == 'Simpan') {
                    ubah.html('Ubah Profil');
                    nama.attr('readonly');
                    email.attr('readonly');
                    notelp.attr('readonly');
                    alamat.attr('readonly');
                    jk.attr('readonly');
                    jk.css('background-size', '0');

                    // $.ajax({
                    //     type: "post",
                    //     url: "url",
                    //     data: "data",
                    //     dataType: "dataType",
                    //     success: function(response) {

                    //     }
                    // });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to perform the number animation
            function animateNumber(totalDonasi, duration) {
                var startNumber = parseInt($('#number-display').text());

                // Calculate the number of steps
                var steps = Math.ceil(duration / 50);

                // Calculate the increment for each step
                var increment = Math.ceil((totalDonasi - startNumber) / steps);

                // Define the interval for each step
                var interval = duration / steps;

                // Start the animation
                var currentNumber = startNumber;
                var counter = setInterval(function() {
                    currentNumber += increment;

                    // Check if the animation has reached or exceeded the target number
                    if (currentNumber >= totalDonasi) {
                        clearInterval(counter);
                        currentNumber = totalDonasi;
                    }

                    // Update the displayed number
                    $('#number-display').text(currentNumber);
                }, interval);
            }

            // Function to fetch the updated data from the API
            function fetchData() {
                $.ajax({
                    url: '/totalDonasi',
                    method: 'GET',
                    success: function(response) {
                        var totalDonasi = parseInt(
                            response); // Extract the updated number from the API response
                        console.log(totalDonasi);
                        animateNumber(totalDonasi, 3000); // Animate to the updated number in 3 seconds
                    },
                    error: function() {
                        console.log('Failed to fetch data from the API.');
                    }
                });
            }

            // Call the fetchData function every 5 seconds to get the updated data
            setInterval(fetchData, 5000);
        });
    </script>
@endsection
