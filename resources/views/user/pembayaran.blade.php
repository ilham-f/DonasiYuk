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
                        <form action="/donasi/{{ $program->id }}" method="POST" class="form">
                            @csrf
                            <div class="text-center">
                                <h2 class="text-cursive fw-bold pb-2 mt-0">Donasi Sekarang</h2>
                            </div>
                            <!-- Progress bar -->
                            <!-- Pilih Pembayaran -->
                            <div class="pt-4">
                                <div class="row">
                                    <a id="pay-button" class="btn btn-dark">Pilih Pembayaran</a>
                                </div>
                            </div>
                            {{-- @dd($snapToken) --}}
                            <div class="d-none" id="snapToken">{{ $snapToken }}</div>
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

        $(document).ready(function() {
            var payButton = document.getElementById('pay-button');
            var snapToken = $('#snapToken').html();
            console.log(snapToken);
            payButton.addEventListener('click', function() {
                window.snap.pay(snapToken, {
                    onSuccess: function(result){
                        /* You may add your own implementation here */
                        alert("Pembayaran berhasil");
                        var id_bayar = result.order_id;
                        var dana = result.gross_amount;
                        var bank = result.va_numbers[0].bank;
                        var va = result.va_numbers[0].va_number;

                        $.ajax({
                            type: "post",
                            url: "/updateDana",
                            data: {
                                'bank': bank,
                                'va': va,
                                'dana': dana,
                                'id_bayar': id_bayar,
                            },
                            success: function (response) {
                                console.log(response);
                                window.location.href = "{{ url('rwytdonasi') }}";
                            }
                        });
                        // checkout(result,result.transaction_status);
                    },
                    onPending: function(result){
                        /* You may add your own implementation here */
                        alert("Menunggu pembayaran anda!");
                        console.log(result.transaction_status);
                    },
                    onError: function(result){
                        /* You may add your own implementation here */
                        alert("Pembayaran anda gagal");
                    },
                    onClose: function(){
                        /* You may add your own implementation here */
                        alert('Apakah anda yakin untuk menutup halaman pembayaran?');
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
                if (formStepsNum <= 0) {
                    $('#prev').hide();
                }
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
