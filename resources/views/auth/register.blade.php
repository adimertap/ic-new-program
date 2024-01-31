<!doctype html>
<html lang="en">

@extends('auth.head')
@section('name')
{{ $meta->title ?? '' }}
@endsection

<body style="height: 100vh">
    @include('sweetalert::alert')
    <section class="register-user">
        <div class="left">
            <img src="{{ asset('/public/images/new/register-law.png') }}" alt="">
            <p class="judul">Jasa Konsultasi Hukum</p>
            <p class="text">Hukum adalah hukum/ peraturan atau adat yang secara resmi
                dianggap mengikat, yang dikukuhkan oleh penguasa atau
                pemerintah.</p>
        </div>
        <div class="right">
            <form action="{{ route('register-auth') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <input id="website" name="website" type="text" value="" /> --}}
                <input type="hidden" name="tgl_mulai">
                <input type="hidden" name="slug" value="{{ request()->segment(2) }}">
                <h1 class="header-third">
                    Register
                </h1>
                <p class="subheader">
                    Fill the form Below and Registration to continue to Dashboard
                </p>
                <div class="form-register">
                    <div class="grids">
                        <div class="nama">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input name="nama" type="text"
                                class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                value="{{ old('nama') }}" id="nama" placeholder="Masukan Nama Lengkap Anda .." required>
                            @error('nama')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror
                        </div>
                        <div class="email">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email"
                                class="form-control form-control-sm @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="Masukan Email Anda .. " required>
                            @error('email')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror
                        </div>
                    </div>
                
                    <div class="grids">
                       
                        <div class="pass">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password"
                                class="form-control form-control-sm @error('password') is-invalid @enderror"
                                value="{{ old('password') }}" id="password" placeholder="Masukan Password Anda .."
                                required>
                            @error('password')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror
                        </div>
                        <div class="conpass">
                            <label for="password" class="form-label">Confirm Password</label>
                            <input name="confirm_password" type="password"
                                class="form-control form-control-sm @error('confirm_password') is-invalid @enderror"
                                value="" id="confirm_password" placeholder="Confirmation Password" required>
                            @error('confirm_password')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror
                        </div>

                    </div>
                    
                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-label" for="exampleCheck1">Data yang diinputkan sudah benar</label>
                    </div>

                </div>
                <p>
                    <button class="btn btn-register btn-margin-top" type="submit">Register
                    </button>
                </p>

                <p class="footer-account">
                    Sudah Punya Akun ? <a href="{{ route('login') }}">
                        Login disini
                    </a>
                </p>
                {{-- <p class="footer-account-2 mt-5">
                    Powered By <a href="{{ route('register') }}">
                        Tempo Data System
                    </a>
                </p> --}}
            </form>
        </div>
        @include('auth.includes.modal_detail_transaksi')

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

</body>

</html>