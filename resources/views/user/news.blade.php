@extends('layouts.main')

@section('container')
    <div class="container px-4" style="margin-top: 80px">
        <div class="card rounded-3 border-0 mb-4"
            style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
            <div class="card-body p-5 pt-2 pb-4">
                <div class="card-body pt-4 px-0">
                    <!-- Program image-->
                    <div id="carouselExampleCaptions" class="carousel slide">

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img style="height: 450px" src="{{ asset('storage/' . $news->image) }}"
                                    class="d-block w-100 card-img-top rounded" alt="{{ $news->image }}">
                            </div>
                        </div>

                    </div>

                    <div class="card-body pt-3 px-0 pb-2">
                        {{-- style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;"> --}}
                        <div class="d-flex justify-content-between">
                            <h5 class="text-cursive fw-bolder">{{ $news->judul }}</h5>
                            <small>{{ $news->updated_at->diffForHumans() }}</small>
                        </div>
                        <p class="mt-4">{{ $news->konten }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
