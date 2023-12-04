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
    <section class="container px-4" style="margin-top: 75px;">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div id="col6" class="col-6 mt-2">
                <div class="card p-4"
                    style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; border-radius: 15px;">
                    <i id="prevArrow" class="bi bi-arrow-left h2 ms-3 btn-prev"
                        style="cursor: pointer; margin-bottom: -40px; z-index: 2"></i>
                    <h2 class="text-center text-cursive fw-bold pb-2 mt-0" style="z-index: 1">Ajukan Program Galang Dana</h2>
                    <div class="card-body d-flex justify-content-center">
                        <form action="/upProgram" method="POST" class="form" enctype="multipart/form-data">
                            @csrf
                            <!-- Progress bar -->
                            <div class="progressbar">
                                <div class="progress" id="progress"></div>

                                <div class="progress-step progress-step-active fw-bold" data-title="Kategori"
                                    style="z-index: 2"></div>
                                <div class="progress-step" data-title="Foto Program" style="z-index: 2">
                                </div>
                                <div class="progress-step" data-title="Detail Program" style="z-index: 2">
                                </div>
                                <div class="progress-step" data-title="Status" style="z-index: 2"></div>
                            </div>

                            <!-- Pilih Kategori -->
                            <div id="step1" class="pt-4 form-step form-step-active">
                                <span class="me-0 fw-bold" style="margin-left: -10px">Pilih Kategori :</span>
                                <div class="mb-4 row">
                                    <a class="btn btn-outline-success btn-cat col g-1 me-2">Kesehatan</a>
                                    <a class="btn btn-outline-warning btn-cat col g-1 me-2">Pendidikan</a>
                                    <a class="btn btn-outline-info btn-cat col g-1 me-2">Bencana Alam</a>
                                </div>
                                <div class="row mb-2">
                                    {{-- <div class="cat-bg form-control d-flex justify-content-between" style="height: 40px; ">
                                        <span>Kategori yang dipilih :</span>
                                        <span id="kategori"></span>
                                    </div> --}}
                                    <input type="hidden" id="catId" name="category_id">
                                </div>
                                <div class="row">
                                    <a id="nextCat" class="btn btn-dark btn-next">Lanjutkan</a>
                                </div>
                            </div>

                            <!-- Foto Program -->
                            <div class="pt-4 form-step">
                                <div class="d-flex flex-column align-items-center">
                                    <label for="image" class="fw-bold align-self-start mb-2">Foto Program
                                        :</label for="image">
                                    {{-- <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> --}}
                                    <input id="image" class="form-control w-100" type="file" name="image"
                                        onchange="preview(event)">
                                    <img class="mb-3 mt-3 rounded" id="add-preview"
                                        style="display: block; width: 40%; height: auto;
                                            aspect-ratio: 4.5/3; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2)"
                                        src="https://www.its.ac.id/tmesin/wp-content/uploads/sites/22/2022/07/no-image.png" />
                                </div>

                                <div class="row">
                                    <a id="nextUp" class="mt-3 btn btn-dark btn-next">Lanjutkan</a>
                                </div>
                            </div>

                            <!-- Detail Program -->
                            <div class="pt-4 form-step">
                                <div class="row">
                                    <input id="judul" type="text" name="judul" class="form-control mb-2"
                                        placeholder="Judul Program" required>
                                </div>
                                <div class="row">
                                    <textarea id="deskripsi" name="deskripsi" class="mb-3" placeholder="Deskripsi Program" required></textarea>
                                </div>
                                <div class="row">
                                    <input type="number" name="target" class="form-control mb-3"
                                        placeholder="Target Dana" required>
                                </div>
                                <div class="row">
                                    <div class="p-0 mb-2 d-flex flex-column">
                                        <label for="batastanggal" class="ms-1">Batas Tanggal</label>
                                        <input type="date" name="batastanggal" class="form-control mb-2"
                                            placeholder="Batas Tanggal" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <button type="submit" name="submit" class="mt-3 btn btn-dark">Submit</button>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="pt-4 form-step">
                                {{-- <div class="row">
                                    <input type="text" name="" class="form-control mb-2" placeholder="Status">
                                </div>
                                <div class="row">
                                    <button class="btn btn-dark">Submit</button>
                                </div> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Get the input element
        var inputDate = document.getElementsByName('batastanggal')[0];
        // Get the current date
        var currentDate = new Date();
        // Calculate the next five days
        var nextFourDays = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate() + 5);
        // Get the current date
        var startDate = nextFourDays.toISOString().split('T')[0];
        // Set the min attribute of the input element to the current date
        inputDate.min = startDate;
    </script>

    <script>
        $(document).ready(function() {
            $('#prev').hide();
            var button = $('.btn-cat');
            // var kategori = $('#kategori');
            var category_id = $('#catId');
            var nextCat = $('#nextCat');
            var nextUp = $('#nextUp');
            nextCat.hide();
            nextUp.hide();

            button.click(function() {
                $(this).addClass('active').siblings().removeClass('active');

                var value = $(this).html();
                // kategori.html(value);

                if (value == 'Kesehatan') {
                    category_id.val(1);
                    nextCat.show();
                    nextCat.removeClass('btn-warning');
                    nextCat.removeClass('btn-info');
                    nextCat.removeClass('btn-dark');
                    nextCat.addClass('btn-success');
                } else if (value == 'Pendidikan') {
                    category_id.val(2);
                    nextCat.show();
                    nextCat.removeClass('btn-success');
                    nextCat.removeClass('btn-info');
                    nextCat.removeClass('btn-dark');
                    nextCat.addClass('btn-warning');
                } else if (value == 'Bencana Alam') {
                    category_id.val(3);
                    nextCat.show();
                    nextCat.removeClass('btn-success');
                    nextCat.removeClass('btn-warning');
                    nextCat.removeClass('btn-dark');
                    nextCat.addClass('btn-info');
                }
            });

            var $window = $(window);
            var $col6 = $('#col6');

            // console.log(col6.html());
            // COL-6
            // REMOVE CLASS col-6
            $window.resize(function resize() {
                if ($window.width() < 992) {
                    return $col6.removeClass('col-6');
                }
                $col6.addClass('col-6');
            }).trigger('resize');

            // ADD CLASS MT-2
            $window.resize(function resize() {
                if ($window.width() < 992) {
                    return $col6.addClass('col-9');
                }
                $col6.removeClass('col-9');
            }).trigger('resize');

            $('#deskripsi').on('input', function() {
                this.style.height = 'auto'; // Reset the height to auto
                this.style.height = (this.scrollHeight + 2) +
                'px'; // Set the height based on the scrollHeight
            });
        });
    </script>

    <script>
        const prevBtns = document.querySelectorAll(".btn-prev");
        const nextBtns = document.querySelectorAll(".btn-next");
        const progress = document.getElementById("progress");
        const formSteps = document.querySelectorAll(".form-step");
        const progressSteps = document.querySelectorAll(".progress-step");
        const prevArrow = document.getElementById("prevArrow");

        let formStepsNum = 0;

        if (formStepsNum == 0) {
            prevArrow.style.display = "none";
        }

        nextBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                formStepsNum++;
                updateFormSteps();
                updateProgressbar();
                if (formStepsNum == 0) {
                    prevArrow.style.display = "none";
                } else {
                    prevArrow.style.display = "block";
                }
            });
        });

        prevBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                formStepsNum--;
                updateFormSteps();
                updateProgressbar();
                if (formStepsNum == 0) {
                    prevArrow.style.display = "none";
                } else {
                    prevArrow.style.display = "block";
                }
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

    <script>
        function preview(event) {
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
@endsection
