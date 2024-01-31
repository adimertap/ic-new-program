<!DOCTYPE html>
<html lang="en">

@extends('auth.head')
@section('name')
{{ $meta->title ?? '' }}
@endsection
<body>
    @include('sweetalert::alert')
    <section class="login-user">
        <div class="left">
            <img src="{{ asset('/public/images/new/login-img2.png') }}" alt="">
            <p class="judul">IC-Education</p>
            <p class="text">Lembaga Pelatihan dan Pendidikan Non Formal dalam bidang keuangan dan bisnis.</p>
        </div>
        <div class="right">
            <form action="{{ route('login-auth')}}" method="post">
                @csrf
                <h1 class="header-third">
                    <img src="{{ asset('/public/images/ic-edu-logo.png')}}" alt="" />
                </h1>
                <p class="subheader">
                    Please sign-in to your account and continue to the dashboard.
                </p>
                <div class="form-login">
                    <div class="mb-4">
                        <label for="name" class="form-label">Email</label>
                        <input name="username" type="text" class="form-control" placeholder="Masukan Email Anda .."
                            value="" required>
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" value="" id="password"
                            placeholder="Masukan Password Anda .." required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-label" for="exampleCheck1">Remember Me</label>
                        </div>
                        <a href="{{ route('forgot-password') }}" class="small forgot" style="color: grey">
                            Forgot Password?
                        </a>
                    </div>
                </div>
                <p>
                    <button type="submit" class="btn btn-login btn-margin-top">Login
                    </button>
                </p>
            </form>
            <p class="footer-account">
                Belum Punya Akun ? <a  href="{{ route('register') }}">
                    Register disini
                </a>
            </p>
            <p class="footer-account-2 mt-5">
                Powered By <a style="color: white" href="#">
                    IC Consultant
                </a>
            </p>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

</body>

</html>
