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
                    <div class="card-body d-flex justify-content-center">
                        <form action="/uploadKTP" method="post" class="form" enctype="multipart/form-data">
                            @csrf
                            <h2 class="text-center text-cursive fw-bold pb-2 mt-0">Verifikasi Akun</h2>
                            <!-- Progress bar -->
                            <div class="progressbar">
                                <div class="progress" id="progress"></div>
                                <div class="progress-step progress-step-active fw-bold" data-title="Unggah KTP"
                                    style="z-index: 2"></div>
                                <div class="progress-step" data-title="Data Diri" style="z-index: 2">
                                </div>
                                <div class="progress-step" data-title="Status" style="z-index: 2"></div>
                            </div>

                            <!-- Unggah KTP -->
                            <div id="step1" class="pt-4 form-step form-step-active">
                                @if (session('alert'))
                                    <div class="alert alert-success">{{ session('alert') }}</div>
                                @endif
                                <h6 class="card-title text-success">Unggah KTP</h6>
                                <form class="d-flex flex-column align-items-center" id="ktp">
                                    <div class="d-flex flex-column rounded mt-4 align-items-center" style="height: 350px">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input class="form-control w-100" type="file" name="image"
                                            onchange="preview(event)">
                                        <img class="mb-3 mt-3" id="add-preview"
                                            style="display: block; width: 100%; height: auto;
                                            aspect-ratio: 4/3; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2)"
                                            src="https://www.its.ac.id/tmesin/wp-content/uploads/sites/22/2022/07/no-image.png" />
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-dark mt-3 w-100">Kirim</button>
                                </form>
                                @if (session('alert'))
                                    <div class="row">
                                        <a class="btn btn-dark btn-next">Lanjutkan</a>
                                    </div>
                                @endif
                            </div>

                            <!-- Detail Donasi -->
                            <div class="pt-4 form-step">
                                <div class="row">
                                    <input type="text" name="" class="form-control mb-2"
                                        placeholder="Sembunyikan nama anda">
                                </div>
                                <div class="row">
                                    <a class="btn btn-dark btn-next">Lanjutkan</a>
                                </div>
                            </div>

                            <!-- Pilih Pembayaran -->
                            <div class="pt-4 form-step">
                                <div class="row">
                                    <input type="text" name="" class="form-control mb-2"
                                        placeholder="Pilih Pembayaran">
                                </div>
                                <div class="row">
                                    <a class="btn btn-dark btn-next">Lanjutkan</a>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="pt-4 form-step">
                                <div class="row">
                                    <input type="text" name="" class="form-control mb-2" placeholder="Status">
                                </div>
                                <div class="row">
                                    <button type="submit" name="submit" class="btn btn-dark">Lanjutkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#myForm').submit(function(e) {
                e.preventDefault(); // Prevent form submission

                var formData = new FormData(this);

                $.ajax({
                    url: '/upload',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        function preview(event) {
            if (event.target.files.length > 0) {
                const src = URL.createObjectURL(event.target.files[0]);
                const image = document.getElementById('add-preview');
                image.src = src;
                image.style.display = "block";
            }
        }
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
