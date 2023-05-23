@extends('layouts.main')

@section('container')
    <section class="vh-100">
        <div class="container py-5 h-100 bg-transparent">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-6">
                    <!-- Form input-->
                    <div class="loginInput">
                        <form class="px-3 pt-2" action="/reset-password" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="row g-3">
                                <input type="text" name="email" class="form-control mb-2" placeholder="Email">
                            </div>
                            <div class="row g-3">
                                <input type="password" name="password" class="form-control mb-2" id="password1"
                                    placeholder="Password">
                            </div>
                            <div class="row g-3">
                                <input type="password" name="password_confirmation" class="form-control mb-2" id="password2"
                                    placeholder="Konfirmasi Password">
                            </div>
                            <div class="row g-3 mb-2">
                                <button type="submit" class="btn btn-dark" style="width: 100%;">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var emailAlert = '{{ Session::get('email') }}';

        var isEmail = '{{ Session::has('email') }}';

        if (isEmail) {
            alert(emailAlert);
        }
    </script>
@endsection
