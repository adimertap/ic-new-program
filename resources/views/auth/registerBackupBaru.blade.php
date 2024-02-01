<!doctype html>
<html lang="en">

@extends('auth.head')
@section('name')
Register - ICEDUCATION
@endsection

<body style="height: 100vh">
    @include('sweetalert::alert')
    <section class="register-user">
        <div class="left" style="width:40%!important">
            <img src="{{ asset('/images/new/register-law.png') }}" alt="">
            <p class="judul">Jasa Konsultasi Hukum</p>
            <p class="text">Hukum adalah hukum/ peraturan atau adat yang secara resmi
                dianggap mengikat, yang dikukuhkan oleh penguasa atau
                pemerintah.</p>
        </div>
        <div class="right" style="width:60%!important">
            <form action="{{ route('register-auth') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <input id="website" name="website" type="text" value="" /> --}}
                <input type="hidden" name="tgl_mulai">
                <input type="hidden" name="slug" value="{{ request()->segment(2) }}">
                <h1 class="header-third">
                    Pembelian Kelas Pelatihan
                </h1>
                <p class="subheader">
                    Kelas
                    @if($kelas->nama_produk == 'brevet-ab')
                    BREVET A & B
                    @else
                    {{ $kelas->nama_produk }}
                    @endif
                    , Sebelum checkout lengkapi data berikut Ini.
                </p>
                <div class="form-register">
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input name="nama" type="text" class="form-control form-control-sm"
                                value="{{ Auth::user()->name }}" readonly>
                        </div>
                        <div class="col-6">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control form-control-sm"
                                value="{{ Auth::user()->email }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="no_hp" class="form-label">Nomor Handphone</label>
                            <input name="no_hp" type="number" maxlength="14"
                                class="form-control form-control-sm @error('phone') is-invalid @enderror"
                                value="{{ Auth::user()->phone ?? '' }}" id="no_hp"
                                placeholder="Masukan Nomor Telephone Anda .." required>
                            @error('phone')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror
                        </div>
                        <div class="col-6">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input name="pekerjaan" type="pekerjaan"
                                class="form-control form-control-sm @error('pekerjaan') is-invalid @enderror"
                                value="{{ Auth::user()->pekerjaan ?? '' }}" placeholder="Masukan Pekerjaan Anda .. "
                                required>
                            @error('pekerjaan')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="kerjasama" class="form-label">Asal Instansi / Lembaga</label>
                            <select class="form-select @error('kerjasama') is-invalid @enderror" name="kerjasama"
                                id="kerjasama" required>
                                <option value="{{old('kerjasama')}}" holder>Pilih Asal Instansi Anda</option>
                                @foreach ($instansi as $row => $lembaga)
                                <option value="{{ $row }}">
                                    {{ $lembaga->nama }}
                                </option>
                                @endforeach
                            </select>
                            @error('kerjasama')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror
                        </div>
                    </div>
                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-label" for="exampleCheck1">I agree to all The Term and Privacy Policy</label>
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
            </form>
        </div>
        @include('auth.includes.modal_detail_transaksi')

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

</body>

</html>


