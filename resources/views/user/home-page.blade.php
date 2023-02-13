@extends('layouts.main')

@section('container')
    <!-- Header-->
    <header class="container px-4" style="height: 450px;">
        <div id="carouselExampleIndicators" class="carousel slide mt-5 pt-5" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner rounded-3">
                <div class="carousel-item active">
                    <img style="height: 450px; width: 100%;" src="{{ asset('assets/img/Andi.png') }}"
                        alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="..." alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="..." alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
            </a>
        </div>
    </header>

    <!-- Section-->
    <section class="container mt-5 pt-4 px-4">
        <div class="card rounded-3 p-3 shadow border-0 mb-4">
            <div class="d-flex justify-content-between">
                <div class="category d-flex" id="myBtnContainer">
                    <span class="mt-1 me-2">Kategori : </span>
                    @foreach ($categories as $cat)
                        <button class="btn btn-outline-success me-2" onclick="filterSelection('{{ $cat->id }}')"><small>{{ $cat->nama }}</small></button>
                    @endforeach
                </div>
                <a href="/program" class="d-flex justify-content-center align-items-center border-0"
                    style="text-decoration: none;">Lihat Semua >></a>
            </div>

            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($programs->slice(0, 4) as $program)
                    <div class="filterDiv {{ $program->category_id }} col-lg mb-2 mt-4">
                        <div class="card h-100 shadow-sm">
                            <!-- Product image-->
                            <img class="card-img-top" style="display: block; height: 150px" src="{{ asset('assets/img/'.$program->image) }}" alt="{{ $program->image }}" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h6 class="fw-bolder">{{ $program->judul }}</h6>
                                    <!-- Product price-->
                                    <p style="margin-bottom: 0">Target : Rp. {{ $program->target }}</p>
                                </div>
                            </div>
                            <!-- Product actions-->
                            {{-- <div class="d-flex justify-content-center card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center me-2"><a class="btn btn-outline-success mt-auto" href="/produk/{{ $program->slug }}">Detail</a></div>
                                @if (Auth::user())
                                <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $program->id }}" name="id">
                                    <input type="hidden" value="{{ $program->nama }}" name="name">
                                    <input type="hidden" value="{{ $program->target }}" name="target">
                                    <input type="hidden" value="{{ $program->image }}"  name="image">
                                    <input type="hidden" value="1" name="quantity">
                                    <button type="submit" class="btn btn-outline-success">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </form>
                                @endif
                            </div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        let msg = '{{ Session::get('alert') }}';

        let exist = '{{ Session::has('alert') }}';

        if (exist) {
            alert(msg);
        }
    </script>

    <script>
        filterSelection("all")
        function filterSelection(c) {
            var x, i;
            x = document.getElementsByClassName("filterDiv");
            if (c == "all") c = "";
            // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
            for (i = 0; i < x.length; i++) {
                w3RemoveClass(x[i], "show");
                if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
            }
        }

        // Show filtered elements
        function w3AddClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                if (arr1.indexOf(arr2[i]) == -1) {
                element.className += " " + arr2[i];
                }
            }
        }

        // Hide elements that are not selected
        function w3RemoveClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);
                }
            }
            element.className = arr1.join(" ");
        }

        // // Add active class to the current control button (highlight it)
        // var btnContainer = document.getElementById("myBtnContainer");
        // var btns = btnContainer.getElementsByClassName("btn");
        // for (var i = 0; i < btns.length; i++) {
        //     btns[i].addEventListener("click", function() {
        //         var current = document.getElementsByClassName("active");
        //         current[0].className = current[0].className.replace(" active", "");
        //         this.className += " active";
        //     });
        // }
    </script>
@endsection
