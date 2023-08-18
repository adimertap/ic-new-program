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
          <img src="{{ asset('images/new/register-law.png') }}" alt="">
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
                    Register
                </h1>
                <p class="subheader">
                  Fill the form Below and Registration to continue to Dashboard
                </p>
                <div class="form-register">
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input name="nama" type="text"
                                class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                value="{{ old('nama') }}" id="nama"
                                placeholder="Masukan Nama Lengkap Anda .." required>
                            @error('nama')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror
                        </div>
                        <div class="col-6">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="Masukan Email Anda .. " required>
                                @error('email')<div class="text-danger error-valid mb-1">{{ $message }}
                                </div> @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-6">
                          <label for="no_hp" class="form-label">Nomor Handphone</label>
                          <input name="no_hp" type="number" maxlength="14"
                              class="form-control form-control-sm @error('no_hp') is-invalid @enderror"
                              value="{{ old('no_hp') }}" id="no_hp"
                              placeholder="Masukan Nomor Telephone Anda .." required>
                          @error('no_hp')<div class="text-danger error-valid mb-1">{{ $message }}
                          </div> @enderror
                      </div>
                      <div class="col-6">
                          <label for="pekerjaan" class="form-label">Pekerjaan</label>
                          <input name="pekerjaan" type="pekerjaan" class="form-control form-control-sm @error('pekerjaan') is-invalid @enderror"
                              value="{{ old('pekerjaan') }}" placeholder="Masukan Pekerjaan Anda .. " required>
                              @error('pekerjaan')<div class="text-danger error-valid mb-1">{{ $message }}
                              </div> @enderror
                      </div>
                  </div>
                    <div class="row mb-3">
                      <div class="col-6">
                        <label for="kerjasama" class="form-label">Asal Instansi / Lembaga</label>
                        <select class="form-select @error('kerjasama') is-invalid @enderror" name="kerjasama" id="kerjasama" required>
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
                        <div class="col-6">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror"
                                value="{{ old('password') }}" id="password" placeholder="Masukan Password Anda .."
                                required>
                                @error('password')<div class="text-danger error-valid mb-1">{{ $message }}
                                </div> @enderror
                        </div>
                      
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input name="confirm_password" type="password" class="form-control form-control-sm @error('confirm_password') is-invalid @enderror" value=""
                            id="confirm_password" placeholder="Confirmation Password" required>
                            @error('confirm_password')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror
                    </div>
                    </div>
                    
                    {{-- <div class="row mb-3">
                        <div class="col-6">
                            <label for="id_company" class="form-label">Company</label>
                            <select class="form-select @error('id_company') is-invalid @enderror" name="id_company" id="id_company" required>
                                <option value="{{old('id_company')}}" holder>Pilih Company Anda</option>
                                @foreach ($company as $companys)
                                <option value="{{ $companys->id_company }}">
                                    {{ $companys->company }}
                                </option>
                                @endforeach
                            </select>
                            @error('id_company')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror

                        </div>
                        <div class="col-6">
                            <label for="id_cabang" class="form-label">Cabang</label>
                            <select class="form-select @error('id_cabang') is-invalid @enderror" name="id_cabang" id="id_cabang" required>
                                <option value="{{old('id_cabang')}}" holder>Pilih Cabang Anda</option>
                                @foreach ($cabang as $cabangs)
                                <option value="{{ $cabangs->id_cabang }}">
                                    {{ $cabangs->cabang }}
                                </option>
                                @endforeach
                            </select>
                            @error('id_cabang')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="id_departemen" class="form-label">Departemen</label>
                            <select class="form-select @error('id_departemen') is-invalid @enderror" name="id_departemen" id="id_departemen" required>
                                <option value="{{old('id_departemen')}}" holder>Pilih Departemen Anda</option>
                                @foreach ($departemen as $departemens)
                                <option value="{{ $departemens->id_departemen }}">
                                    {{ $departemens->departemen }}
                                </option>
                                @endforeach
                            </select>
                            @error('id_departemen')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror
                        </div>
                        <div class="col-6">
                            <label for="id_jabatan" class="form-label">Jabatan</label>
                            <select class="form-select @error('id_jabatan') is-invalid @enderror" name="id_jabatan" id="id_jabatan" required>
                                <option value="{{old('id_jabatan')}}" holder>Pilih Jabatan Anda</option>
                                @foreach ($jabatan as $jabatans)
                                <option value="{{ $jabatans->id_jabatan }}">
                                    {{ $jabatans->nama_jabatan }}
                                </option>
                                @endforeach
                            </select>
                            @error('id_jabatan')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror
                        </div>
                    </div> --}}
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
