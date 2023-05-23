@extends('layouts.main')

@section('container')
    <style>
        .progressbar::before,
        .progress {
            content: "";
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            height: 4px;
            width: 100%;
            background-color: #dcdcdc;
            z-index: 1;
        }

        .progress {
            background-color: #000;
            width: 0%;
            transition: 0.3s;
        }
    </style>
    <!-- MultiStep Form -->
    <section style="height: 84.5vh">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="col-6">
                <div class="card p-4"
                    style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; border-radius: 15px;">
                    <i id="prev" class="bi bi-arrow-left h2 ms-3 mb-0 btn-prev" style="cursor: pointer"></i>
                    @if (session('donasi'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('donasi') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body d-flex justify-content-center">
                        <form action="/donasi/{{ $id }}" method="POST" class="form">
                            @csrf
                            <div class="text-center">
                                <h2 class="text-cursive fw-bold pb-2 mt-0">Donasi Sekarang</h2>
                                {{-- <small class="fst-italic">"{{ $program->judul }}"</small> --}}
                            </div>
                            <!-- Progress bar -->
                            {{-- <div class="progressbar">
                                <div class="progress" id="progress"></div>

                                <div class="progress-step progress-step-active fw-bold" data-title="Nominal"
                                    style="z-index: 2"></div>
                                <div class="progress-step" data-title="Detail Donasi" style="z-index: 2">
                                </div>
                                <div class="progress-step" data-title="Pilih Pembayaran" style="z-index: 2">
                                </div>
                                <div class="progress-step" data-title="Status" style="z-index: 2"></div>
                            </div> --}}

                            <!-- Nominal -->
                            <div id="step1" class="pt-4 form-step form-step-active">
                                <span class="me-0 fw-bold" style="margin-left: -10px">Pilih Otomatis :</span>
                                <div class="mb-4 row">
                                    <a class="btn btn-outline-dark col g-1 me-2">Rp10.000</a>
                                    <a class="btn btn-outline-dark col g-1 me-2">Rp25.000</a>
                                    <a class="btn btn-outline-dark col g-1 me-2">Rp50.000</a>
                                    <a class="btn btn-outline-dark col g-1">Rp100.000</a>
                                </div>
                                <div class="row mb-2">
                                    <label for="nominal" class="bg-transparent fw-bold"
                                        style="position: absolute; bottom: 26.3%; width: 50px">Rp</label for="nominal">
                                    <input id="nominal" type="number" name="jml_donasi"
                                        class="form-control text-end nominal" placeholder="Jumlah Donasi">
                                </div>
                                <div class="row">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="program_id" value="{{ $program->id }}">
                                    <a id="donasiBtn" class="btn btn-dark btn-next">Donasi</a>
                                </div>
                            </div>


                            <!-- Detail Donasi -->
                            {{-- <div class="pt-4 form-step">
                                <div class="row">
                                    <input type="text" name="" class="form-control mb-2"
                                        placeholder="Sembunyikan nama anda">
                                </div>
                                <div class="row">
                                    <a class="btn btn-dark btn-next">Lanjutkan</a>
                                </div>
                            </div> --}}

                            <!-- Pilih Pembayaran -->
                            <div class="pt-4 form-step">
                                <div class="row">
                                    <input type="text" name="" class="form-control mb-2"
                                        placeholder="Pilih Pembayaran">
                                </div>
                                <div class="row">
                                    <a id="pay-button" class="btn btn-dark">Pilih Pembayaran</a>
                                </div>
                            </div>

                            <!-- Status -->
                            {{-- <div class="pt-4 form-step">
                                <div class="row">
                                    <input type="text" name="" class="form-control mb-2"
                                        placeholder="Status">
                                </div>
                                <div class="row">
                                    <button type="submit" name="submit" class="btn btn-dark">Lanjutkan</button>
                                </div>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#donasiBtn').click(function (e) {
                e.preventDefault();
                var data = [];
                var jml_donasi = $('#nominal').val();
                var user_id = $('input[name="user_id"]').val();
                // console.log(user_id);
                var program_id = $('input[name="program_id"]').val();

                data.push(jml_donasi);
                data.push(user_id);
                data.push(program_id);
                // console.log(data);

                $.ajax({
                    type: "POST",
                    url: "/newToken",
                    data: JSON.stringify(data),
                    success: function (response) {
                        console.log("RESPON : " + response);
                        var payButton = document.getElementById('pay-button');
                        payButton.addEventListener('click', function () {
                        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                        //   console.log('{{ $snaptoken }}');
                        window.snap.pay(response);
                        // customer will be redirected after completing payment pop-up
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('#prev').hide();
            var button = $('.btn-outline-dark');
            var nominal = $('#nominal');

            button.click(function() {
                $(this).addClass('active').siblings().removeClass('active');

                var tempvalue = $(this).html();
                var value = tempvalue.replace('.', '').replace('Rp', '');
                nominal.val(value);
            });

            nominal.click(function() {
                button.removeClass('active');
            });

            // if (!$('#step1').hasClass('form-step-active')) {
            //     $('#prev').show();
            // }
        });
    </script>

    <script>
        const prevBtns = document.querySelectorAll(".btn-prev");
        const nextBtns = document.querySelectorAll(".btn-next");
        const progress = document.getElementById("progress");
        const formSteps = document.querySelectorAll(".form-step");
        const progressSteps = document.querySelectorAll(".progress-step");

        let formStepsNum = 0;

        nextBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                formStepsNum++;
                updateFormSteps();
                updateProgressbar();
                $('#prev').show();
            });
        });

        prevBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                formStepsNum--;
                updateFormSteps();
                updateProgressbar();
            });
        });

        function updateFormSteps() {
            formSteps.forEach((formStep) => {
                formStep.classList.contains("form-step-active") &&
                    formStep.classList.remove("form-step-active");
            });

            formSteps[formStepsNum].classList.add("form-step-active");
        }

        function updateProgressbar() {
            progressSteps.forEach((progressStep, idx) => {
                if (idx < formStepsNum + 1) {
                    progressStep.classList.add("progress-step-active");
                    progressStep.classList.add("fw-bold");
                } else {
                    progressStep.classList.remove("progress-step-active");
                    progressStep.classList.remove("fw-bold");
                }
            });

            const progressActive = document.querySelectorAll(".progress-step-active");

            progress.style.width = ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
        }
    </script>
@endsection
