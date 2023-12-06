<!DOCTYPE html>
<html lang="en">

@extends('auth.head')
@section('name')
Change Password - ICEDUCATION
@endsection
<body>
    @include('sweetalert::alert')
    <section class="login-user">
        <div class="left">
            <img src="{{ asset('images/new/login-img2.png') }}" alt="">
            <p class="judul">IC-Education</p>
            <p class="text">Lembaga Pelatihan dan Pendidikan Non Formal dalam bidang keuangan dan bisnis.</p>
        </div>
        <div class="right">
            <form action="{{ route('forgot-password-change')}}" method="post">
                @csrf
                <h1 class="header-third">
                    <img src="{{ asset('images/ic-edu-logo.png')}}" alt="" />
                </h1>
                <p class="subheader mt-5">
                    Please input your <b> New Password</b>
                </p>
                <div class="form-login">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div class="mb-2">
                        <label for="new_password" class="form-label">Password</label>
                        <input name="new_password" type="password" class="form-control" value="{{ old('new_password') }}" id="new_password"
                            placeholder="Masukan Password Anda .." required>
                    </div>
                    <div class="mb-2">
                        <label for="new_password_confirmation" class="form-label">Confirm Password</label>
                        <input name="new_password_confirmation" type="password" class="form-control" value="{{ old('new_password_confirmation') }}" id="new_password_confirmation"
                            placeholder="Confirm Password" required>
                    </div>
                </div>
                <p class="mt-0">
                    <button type="submit" class="btn btn-login btn-margin-top">Change Password
                    </button>
                </p>
            </form>
            <p class="footer-account">
                Belum Punya Akun ? <a  href="{{ route('register') }}">
                    Register disini
                </a><br>
                atau Kembali ke  <a  href="{{ route('login') }}">Login</a>
            </p>
            {{-- <p class="footer-account-2 mt-5">
                Powered By <a style="color: white" href="#">
                    IC Consultant
                </a>
            </p> --}}
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

</body>

</html>
