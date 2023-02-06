@extends('layouts.main')

@section('container')
    <div class="container-fluid d-flex justify-content-center align-items-center bg-success" style="height: 91.5vh;">
        <div class="card shadow" style="width: 800px">
            <div class="card-body d-flex flex-column align-items-center">
                @if (session('alert'))
                    <div class="alert alert-success">{{ session('alert') }}</div>
                @endif
                <h3 class="card-title text-success">Unggah Resep</h3>
                <form class="d-flex flex-column align-items-center" action="/kirimresep" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column rounded mt-4 align-items-center" style="height: 350px">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input class="form-control w-100" type="file" name="image" onchange="preview(event)">
                        <img class="mb-3 mt-3" id="add-preview"
                            style="display: block; width: 400px; height: 300px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2)"
                            src="https://www.its.ac.id/tmesin/wp-content/uploads/sites/22/2022/07/no-image.png" />
                    </div>
                    <button type="submit" name="submit" class="btn btn-success mt-3 w-100">Kirim</button>
                </form>
            </div>
        </div>
    </div>
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
@endsection

