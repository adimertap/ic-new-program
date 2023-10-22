<!doctype html>
<html lang="en">

@extends('auth.head')
@section('name')
Register - ICEDUCATION
@endsection

<body style="height: 100vh">
    @include('sweetalert::alert')
    <section class="register-user">
        <div class="left" style="width:35%!important;">

            <img src="{{ asset('images/produk/Crop.png') }}"
                style="margin-top:250px!important; margin-right:50px!important" alt="cover" width="20" height="20">
            <div class="text-center mt-4">
                @if ($item->online == 1)
                <span class="badge badge-online mr-2">Kelas Online</span>
                @else
                <span class="badge badge-danger mr-2">Kelas Offline</span>
                @endif
            </div>
            <p class="judul">KELAS {{ $item->nama_produk }}, <br> Hari {{ $item->kelas }}</p>
            <div class="small mt-2" style="color: white">
                <p class="uppercase mb-0">{{ tgl_indo2($item->tgl_mulai) }} -
                    {{ tgl_indo2($item->tgl_selesai) }}</p>
                <p class="mt-0">{{date('H:i',strtotime($item->jam_mulai))}} -
                    {{ date('H:i', strtotime($item->jam_selesai))}}
                    WIB</p>
            </div>



        </div>
        <div class="right" style="width:60%!important">
            <form action="{{ route('register-data-update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <input id="website" name="website" type="text" value="" /> --}}
                <input type="hidden" name="tgl_mulai">
                <input type="hidden" name="slug" value="{{ request()->segment(2) }}">
                <h1 class="header-third">
                    Kelengkapan Data User
                </h1>
                <p class="subheader">
                    Kelas
                    @if($item->nama_produk == 'brevet-ab')
                    BREVET A & B
                    @else
                    {{ $item->nama_produk }}
                    @endif
                    , Sebelum checkout lengkapi data berikut Ini.
                </p>
                <div class="form-register">
                    <input type="hidden" value="{{ $item->slug }}" name="id_kelas">
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
                            <label for="no_hp" class="form-label">Nomor Handphone
                                @if(!Auth::user()->no_hp)
                                <span class="mr-4 mb-3" style="color: red">*</span>
                                @endif
                            </label>
                            <input type="number" maxlength="14"
                                class="form-control form-control-sm @error('phone') is-invalid @enderror"
                                value="{{ Auth::user()->no_hp ?? '' }}" id="no_hp" name="phone"
                                placeholder="Masukan Nomor Telephone Anda .." required>
                            @error('phone')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror
                        </div>
                        <div class="col-6">
                            <label for="pekerjaan" class="form-label">Pekerjaan
                                @if(!Auth::user()->pekerjaan)
                                <span class="mr-4 mb-3" style="color: red">*</span>
                                @endif
                            </label>
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
                            <label for="kerjasama" class="form-label">Asal Instansi / Lembaga
                                @if(!Auth::user()->kerjasama)
                                <span class="mr-4 mb-3" style="color: red">*</span>
                                @endif
                            </label>
                            <select class="form-select @error('kerjasama') is-invalid @enderror" name="id_instansi"
                                id="kerjasama" required>
                                @if(!Auth::user()->kerjasama)
                                <option value="{{old('kerjasama')}}" holder>Pilih Asal Instansi Anda</option>
                                @else
                                <option value="{{ Auth::user()->kerjasama->id }}" holder>{{
                                    Auth::user()->kerjasama->nama }}</option>
                                @endif
                                @foreach ($instansi as $row => $lembaga)
                                <option value="{{ $lembaga->id }}">
                                    {{ $lembaga->nama }}
                                </option>
                                @endforeach
                                <option value="Lainnya">LAINNYA</option>
                            </select>
                            @error('kerjasama')<div class="text-danger error-valid mb-1">{{ $message }}
                            </div> @enderror
                        </div>
                    </div>
                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-label" for="exampleCheck1">Data yang saya inputkan benar apa adanya</label>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-5">
                    <a href="{{ route('home-beranda') }}" class="btn btn-register btn-margin-top"
                        style="width: 120px!important;background-color:dimgrey!important" type="button">Back
                    </a>
                    <button class="btn btn-register btn-margin-top" style="width: 250px!important" type="submit">Lanjut
                        Payment
                    </button>
                </div>
            </form>
        </div>
        @include('auth.includes.modal_detail_transaksi')
    </section>

    <div class="modal fade" id="addNewInstansi" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="addNewProductLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h5 small" id="addNewProductLabel">Tambah Data Asal Instansi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="myForm" name="myForm" class="form-horizontal" action="{{ route('register-data-instansi')}}"
                        method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="kerjasama" class="form-label small">Jenis <span class="mr-4 mb-3" style="color: red">*</span></label>
                            <select class="form-select form-select-sm" id="id_jenis" name="id_jenis" required>
                                <option value="{{old('kerjasama')}}" holder>Pilih Jenis</option>
                                @foreach ($jenis as $row => $jns)
                                <option value="{{ $jns->id_jenis }}">
                                    {{ $jns->jenis }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="nama" class="form-label small">Nama Instansi <span class="mr-4 mb-3" style="color: red">*</span></label>
                            <input name="nama" type="text" class="form-control form-control-sm"
                                value="{{ Auth::user()->phone ?? '' }}" id="nama"
                                placeholder="Masukan Nama Instansi .." required>
                            <hr class="mt-3">
                            <div class="mt-4">
                                <button type="submit" class="btn btn-register small"
                                    style="background-color: #407BFF;color:white; padding-top:10px!important; padding-bottom:10px!important"
                                    id="saveBtn" value="create">Save</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
</body>

<script>
    $(document).ready(function () {
        $('#kerjasama').on('change', function () {
            var id = $(this).val()
            if(id == 'Lainnya'){
                $('#addNewInstansi').modal('show')
            }
        });
    })
</script>

</html>