@extends('home.app')

@section('title')
Checkout Kelas |
@endsection

<style>
    .btn-anchor-red {
        background: none;
        border: none;
        cursor: pointer;
        text-decoration: underline;
        font-size: 14px;
        color: red;
        margin: 0;
    }

    .btn-anchor-blue {
        background: none;
        border: none;
        color: blue;
        cursor: pointer;
        text-decoration: underline;
        font-size: 14px;
        margin: 0;

    }

</style>
@section('content')
<div style="background-color: #f3f3f3!important">
    <div class="container" style="margin-top: 30px">

        <div class="judul-atas text-center">
            <h5 class="sub-title">Checkout untuk Ujian Ulang</h5>
            <h1 class="judulfix mt-0" style="font-size: 30px">Checkout {{ $item->nama_produk }}, {{ $item->kelas }}</h1>
            <a href="{{ route('home-beranda') }}" class="btn btn-sm btn-light mt-3">Kembali</a>

        </div>
    </div>
    <form action="{{ route('checkout.update', $item->slug) }}" method="POST">
        @method('PUT')
        @csrf
        <div style="padding: 40px 80px 100px 80px">
            <div class="row">
                <div class="col-4 d-flex justify-content-center">
                    <div class="product-card">
                        <div class="product-detail">
                            <img src="{{ asset('/images/produk/katalog.png') }}" alt="cover" width="400" height="400">
                            <div class="text-center">
                                @if ($item->online == 1)
                                <span class="badge badge-online mr-2">Kelas Online</span>
                                @else
                                <span class="badge badge-danger mr-2">Kelas Offline</span>
                                @endif
                            </div>

                            <h5 class="mt-3">Kelas {{ $item->nama_produk }}</h5>

                            <div class="time mt-4">
                                <i class="fa-regular fa-calendar-check"></i>
                                <p class="uppercase">Hari {{ $item->kelas }}
                            </div>
                            <div class="time">
                                <i class="fa-regular fa-calendar-check"></i>
                                <p class="uppercase">{{ tgl_indo2($item->tgl_mulai) }} -
                                    {{ tgl_indo2($item->tgl_selesai) }}</p>
                            </div>
                            <div class="time">
                                <i class="fa-solid fa-clock" style="color: gray"></i>
                                <p>{{date('H:i',strtotime($item->jam_mulai))}} -
                                    {{ date('H:i', strtotime($item->jam_selesai))}}
                                    WIB</p>
                            </div>
                          
                            <div class="col-12 text-center" style="padding: 20px 50px 0 50px">
                                <div class="time text-center">
                                    <p class="me-4 italic fw-bold text-danger">
                                        Rp. {{ convert_to_rupiah($item->harga) ?? 0 }}
                                    </p>
                                    <del class="text-muted small">{{ $item->note ?? 0 }}</del>
    
                                </div>
                                <p class="text-muted small">Lanjut ke pembayaran untuk terdaftar sebagai peserta</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-8">
                    <div class="product-card"
                        style="max-width: 1000px !important; padding-left:60px; padding-right:60px">
                        <div class="product-detail pt-3">
                            <section class="mt-3">
                                <div class="d-flex justify-content-between">
                                    <p class="small fw-semibold">Informasi User, Lengkapi Data Anda</p>
                                    <p class="text-danger small" style="font-size: 12px">(*) Wajib Diisi</p>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="time">
                                            <div class="col-5 col-sm-4">
                                                <p class="fw-semi-bold mb-1">Nama Lengkap</p>
                                            </div>
                                            <div class="col">
                                                <p class="mb-1 italic" id="nama">: {{ $user->name }}</p>
                                                <input name="nama_lengkap" type="text" id="nama_edit"
                                                    style="display: none" class="form-control form-control-sm"
                                                    value="{{ $user->name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="time">
                                            <div class="col-5 col-sm-4">
                                                <p class="fw-semi-bold mb-1">Email
                                                    @if(!$user->email)
                                                    <span class="mr-4 mb-3" style="color: red">*</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col">
                                                @if(!$user->email)
                                                <input name="email" type="text" id="email_edit"
                                                    class="form-control form-control-sm" placeholder="Input Email Anda!"
                                                    value="{{ old('email') }}">
                                                @endif
                                                <p class="mb-1 italic" id="email">: {{ $user->email ?? '-' }}</p>
                                                <input name="email" type="text" id="email_edit" style="display: none"
                                                    class="form-control form-control-sm"
                                                    value="{{ $user->email ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <div class="time">
                                            <div class="col-5 col-sm-4">
                                                <p class="fw-semi-bold mb-1">No Telephone
                                                    @if(!$user->no_hp)
                                                    <span class="mr-4 mb-3" style="color: red">*</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col">
                                                @if(!$user->no_hp)
                                                <input name="no_hp" type="text" id="no_hp_edit"
                                                    class="form-control form-control-sm"
                                                    placeholder="Input No Telephone Anda!" value="{{ old('no_hp') }}"
                                                    required>
                                                @endif
                                                <p class="mb-1 italic" id="no_hp">: {{ $user->no_hp ?? '-' }}</p>
                                                <input name="no_hp" type="text" id="no_hp_edit" style="display: none"
                                                    class="form-control form-control-sm"
                                                    value="{{ $user->no_hp ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="time">
                                            <div class="col-5 col-sm-4">
                                                <p class="fw-semi-bold mb-1">Pekerjaan
                                                    @if(!$user->pekerjaan)
                                                    <span class="mr-4 mb-3" style="color: red">*</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col">
                                                @if(!$user->pekerjaan)
                                                <input name="pekerjaan" type="text" id="pekerjaan_edit"
                                                    class="form-control form-control-sm"
                                                    placeholder="Input Pekerjaan Anda!" value="{{ old('pekerjaan') }}"
                                                    required>
                                                @else
                                                <p class="mb-1 italic" id="pekerjaan">: {{ $user->pekerjaan ?? '-' }}
                                                </p>
                                                <input name="pekerjaan" type="text" id="pekerjaan_edit"
                                                    style="display: none" class="form-control form-control-sm"
                                                    value="{{ $user->pekerjaan ?? '' }}">
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-8">
                                        <div class="time">
                                            <div class="col-3">
                                                <p class="fw-semi-bold mb-1">Asal Instansi
                                                    @if(!$user->kerjasama)
                                                    <span class="mr-4 mb-3" style="color: red">*</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col">
                                                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                                @if(!$user->kerjasama)
                                                <select name="instansi" type="text" id="instansi_edit"
                                                    class="form-control form-select-sm" value="" required>
                                                    <option value="">Pilih Instansi</option>
                                                    @foreach ($instansi as $ins)
                                                    <option value="{{ $ins->id }}">{{ $ins->nama }}</option>
                                                    @endforeach
                                                </select>
                                                @else
                                                <p class="mb-1 italic" id="instansi">:
                                                    {{ $user->kerjasama->nama ?? '-' }}
                                                </p>
                                                <input type="hidden" name="instansi" value="{{ $user->kerjasama->id ?? '' }}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <hr class="mt-4">
                            <section class="mt-4">
                                <div class="d-flex justify-content-between">
                                    <p class="small fw-semibold">Informasi Pembayaran </p>
                                    </p>
                                    <p class="text-danger small" style="font-size: 12px"> (*) Wajib Diisi</p>
                                </div>
                                <div class="time mt-3">
                                    <div class="col-5 col-sm-4">
                                        <p class="fw-semi-bold mb-1">Jenis Pembayaran
                                            <span class="mr-4 mb-3" style="color: red">*</span>
                                        </p>
                                    </div>
                                    <div class="col">
                                        <select name="jenis" type="text" id="jenis_edit"
                                            class="form-control form-control-sm" value="">
                                            <option value="Otomatis">Otomatis</option>
                                            <option value="Manual">Manual</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="time mt-3">
                                    <div class="col-5 col-sm-4">
                                        <p class="fw-semi-bold mb-1">Tenor
                                            <span class="mr-4 mb-3" style="color: red">*</span>
                                        </p>
                                    </div>
                                    <div class="col">
                                        <select name="tenor" type="text" id="tenor_edit"
                                            class="form-control form-control-sm" value="">
                                            <option value="Full">Full Payment</option>
                                            <option value="75">75%</option>
                                            <option value="50">50%</option>
                                            <option value="25">25%</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="time mt-4">
                                    <div class="col-5 col-sm-4">
                                        <p class="fw-semi-bold mb-1">Harga Produk Berdasar Tenor
                                        </p>
                                    </div>
                                    <input type="hidden" name="slug" value="{{ $item->slug }}">
                                    <input type="hidden" name="id_kelas" value="{{ $item->id }}">
                                    <input type="hidden" name="kelas" value="{{ $item->kelas }}">
                                    <input type="hidden" name="diskon_kelas" value="{{ $item->diskon }}">
                                    <input type="hidden" name="nama_produk" value="{{ $item->nama_produk }}">
                                    <div class="col flex">
                                        <h6 class="me-4 italic fw-bold text-danger" id="harga_produk">
                                            : Rp. {{ convert_to_rupiah($item->harga) ?? 0 }}
                                        </h6>
                                        <input type="hidden" name="harga_asli" id="harga_asli" value="{{ $item->harga }}">
                                        <input type="hidden" name="harga_tenor" id="harga_tenor" value="{{ $item->harga }}">

                                    </div>
                                </div>
                                <div class="time mt-4">
                                    <div class="col-5 col-sm-4">
                                        <p class="fw-semi-bold mb-1">Diskon Instansi</p>
                                    </div>
                                    <div class="col">
                                        @if(!$user->kerjasama)
                                        <p class="mb-1 italic" id="diskon_final">: Tidak Ada Diskon</p>
                                        @else
                                        <div class="d-flex justify-content-start">
                                            <p class="me-4 mb-1 italic fw-bold text-danger" id="diskon_final">:
                                                @if($user->kerjasama->status == 'Angka')
                                                (-) Rp. {{ convert_to_rupiah($user->kerjasama->diskon_angka) ?? 0 }}
                                                <input type="hidden" id="diskon_hidden" name="diskon_hidden"
                                                    value="{{ $user->kerjasama->diskon_angka ?? 0 }}">
                                                <input type="hidden" name="type_diskon" id="type_diskon" value="Angka">
                                                @else
                                                (-) {{ $user->kerjasama->diskon_online ?? 0 }} %</p>
                                                <input type="hidden" id="diskon_hidden" name="diskon_hidden"
                                                    value="{{ $user->kerjasama->diskon_online ?? 0 }}">
                                                <input type="hidden" name="type_diskon" id="type_diskon"  value="Persen">
                                            @endif
                                            </p>
                                            <span class="badge badge-sm badge-primary">Voucher</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="time mt-4">
                                    <div class="col-5 col-sm-4">
                                        <p class="fw-semi-bold mb-1">Total Pembayaran
                                        </p>
                                    </div>
                                    <div class="col flex">
                                        <h6 class="me-4 italic fw-bold text-primary" id="harga_final">
                                            : Rp. {{ convert_to_rupiah($harga_final) ?? 0 }}
                                        </h6>
                                        <input type="hidden" id="harga_hidden" name="harga_hidden_final" value="{{ $harga_final }}">
                                        {{-- <input type="hidden" id="harga_sebelum_final" name="harga_sebelum_final" value="{{ $harga_final }}"> --}}

                                    </div>
                                </div>

                            </section>
                        </div>
                        <div class="text-center mt-4 pb-4">
                            <button type="submit" class="btn btn-sm btn-primary text-center">Bayar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@push('js')
<script>
    $(document).ready(function () {
        $('#instansi_edit').on('change', function () {
            var selected = $(this).val()
            var html = $(this).html()
            var token = $('#_token').val()

            var data = {
                kerjasama_id: selected,
                _token: token
            }

            $.ajax({
                method: 'post',
                url: '/checkout/profile',
                data: data,
                success: function (response) {
                    window.location.reload();
                },
                error: function (response) {
                    console.log(response)
                    swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: response
                    });
                }
            });
        });

        $('#tenor_edit').on('change', function () {
            var selected = $(this).val()
            var harga = $('#harga_asli').val()
            var diskon = $('#diskon_hidden').val()
            var type = $('#type_diskon').val()

            if (selected == '50') {
                var harga_semi = (harga / 100) * 50
                var tenor = ' (Tenor 50%)'
            } else if (selected == '25') {
                var harga_semi = (harga / 100) * 25
                var tenor = ' (Tenor 25%)'
            } else if(selected == '75'){
                var harga_semi = (harga / 100) * 75
                var tenor = ' (Tenor 75%)'
            }else {
                var harga_semi = parseFloat(harga)
                var tenor = ""
            }

            if(type == 'Angka'){
                var harga_final = harga_semi - diskon;
            }else{
                var harga_final = harga_semi - (harga_semi /100) * diskon;
            }

            var formatted_harga_final = harga_final.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
            formatted_harga_final = formatted_harga_final.replace(/\,00$/, '');

            var formated_harga_semi = harga_semi.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
            formated_harga_semi = formated_harga_semi.replace(/\,00$/, '');
            
            $('#harga_produk').html(": " + formated_harga_semi + tenor)
            $('#harga_sebelum_final').html(harga_semi)
            $('#harga_tenor').val(harga_semi)
            $('#harga_hidden').val(harga_final)
            $('#harga_final').html(": " + formatted_harga_final)



        })

    })

</script>
@endpush
