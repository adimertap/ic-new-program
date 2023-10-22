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

    .custom-list {
        list-style: none;
        padding: 0;
        padding-left: 15px !important;
        list-style-type: decimal;
    }

    .custom-list li {
        padding-left: 15px !important;
        margin-bottom: 5px;
        text-align: justify;
    }
</style>
@section('content')
<div style="background-color: #f3f3f3!important">
    <div class="container" style="margin-top: 30px">

        <div class="judul-atas text-center">
            <h5 class="sub-title">Checkout Kelas</h5>
            <h1 class="judulfix mt-0" style="font-size: 30px">Checkout {{ $item->nama_produk }}, {{ $item->kelas }}</h1>
            <a href="{{ route('home-beranda') }}" class="btn btn-sm btn-light mt-3">Kembali</a>
            {{-- <button type="button" id="btnSyarat"></button> --}}

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
                            <img src="{{ asset('images/produk/katalog.png') }}" alt="cover" width="400" height="400">
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
                                    <p class="small fw-semibold">Informasi</p>
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
                                                </p>
                                            </div>
                                            <div class="col">
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
                                                </p>
                                            </div>
                                            <div class="col">
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
                                                <p class="fw-semi-bold mb-1">Asal Instansi
                                                </p>
                                            </div>
                                            <div class="col">
                                                <p class="mb-1 italic" id="instansi">:
                                                    {{ $user->kerjasama->nama ?? '-' }}
                                                </p>
                                                <input type="hidden" name="instansi"
                                                    value="{{ $user->kerjasama->id ?? '' }}">
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
                                    <div class="col-3 col-sm-3">
                                        <p class="fw-semi-bold mb-1">Jenis Pembayaran
                                            <span class="mr-4 mb-3" style="color: red">*</span>
                                        </p>
                                    </div>
                                    <div class="col">
                                        <select name="jenis" type="text" id="jenis_edit"
                                            class="form-control form-control-sm" value="">
                                            <option value="Manual">Manual Confirm</option>
                                            <option value="Otomatis">Otomatis Midtrans</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="time mt-3">
                                    <div class="col-3 col-sm-3">
                                        <p class="fw-semi-bold mb-1">Tenor
                                            <span class="mr-4 mb-3" style="color: red">*</span>
                                        </p>
                                    </div>
                                    <div class="col">
                                        <select name="tenor" type="text" id="tenor_edit"
                                            class="form-control form-control-sm" value="">
                                            <option value="Full">Lunas (Full Payment)</option>
                                            <option value="75">Tenor 75%</option>
                                            <option value="50">Tenor 50%</option>
                                            <option value="25">Tenor 25%</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="time mt-4">
                                    <div class="col-3 col-sm-3">
                                        <p class="fw-semi-bold mb-1">Harga Berdasar Tenor
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
                                        <input type="hidden" name="harga_asli" id="harga_asli"
                                            value="{{ $item->harga }}">
                                        <input type="hidden" name="harga_tenor" id="harga_tenor"
                                            value="{{ $item->harga }}">

                                    </div>
                                </div>
                                <div class="time mt-4">
                                    <div class="col-3 col-sm-3">
                                        <p class="fw-semi-bold mb-1">Diskon Instansi</p>
                                    </div>
                                    <div class="col">
                                        @if(!$user->kerjasama)
                                        <p class="mb-1 italic" id="diskon_final">: Tidak Ada Diskon</p>
                                        @else
                                        <div class="d-flex justify-content-start">
                                            <p class="me-4 mb-1 italic fw-bold text-danger" id="diskon_final">:
                                                @if($user->kerjasama->status == 'Angka')
                                                - Rp. {{ convert_to_rupiah($user->kerjasama->diskon_angka) ?? 0 }}
                                                <input type="hidden" id="diskon_hidden" name="diskon_hidden"
                                                    value="{{ $user->kerjasama->diskon_angka ?? 0 }}">
                                                <input type="hidden" name="type_diskon" id="type_diskon" value="Angka">
                                                @else
                                                - {{ $user->kerjasama->diskon_online ?? 0 }} %
                                            </p>
                                            <input type="hidden" id="diskon_hidden" name="diskon_hidden"
                                                value="{{ $user->kerjasama->diskon_online ?? 0 }}">
                                            <input type="hidden" name="type_diskon" id="type_diskon" value="Persen">
                                            @endif
                                            </p>
                                            {{-- <span class="badge badge-sm badge-secondary"
                                                style="font-size:10px">Voucher Instansi</span> --}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="time mt-4">
                                    <div class="col-3 col-sm-3">
                                        <p class="fw-semi-bold mb-1">Voucher Code</p>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h6 class="mt-1 italic fw-bold text-danger small"
                                                            id="jumlahVoucherDiskon">
                                                            : - Rp. 0
                                                        </h6>
                                                        <input type="hidden" id="hidden_voucher">
                                                    </div>
                                                    <div class="col-6">
                                                        <input name="voucher_code" id="voucher_code" type="text"
                                                            class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4" style="margin-top: 5px">
                                                <div class="row">
                                                    <div class="col-3" id="tempBtnApply">
                                                        <button class="btn btn-sm btn-voucher" type="button"
                                                            id="btnApplyVoucher">Apply</button>
                                                    </div>
                                                    <div class="col-3">
                                                        <button class="btn btn-sm btn-reset" type="button"
                                                            id="btnReset">Reset</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="time mt-4">
                                    <div class="col-3 col-sm-3">
                                        <p class="fw-semi-bold mb-1">Total Pembayaran
                                        </p>
                                    </div>
                                    <div class="col flex">
                                        <h6 class="me-4 italic fw-bold text-primary" id="harga_final">
                                            : Rp. {{ convert_to_rupiah($harga_final) ?? 0 }}
                                        </h6>
                                        <input type="hidden" id="harga_hidden" name="harga_hidden_final"
                                            value="{{ $harga_final }}">
                                        <input type="hidden" name="harga_kelas_after_disc" id="harga_kelas_after_disc"
                                            value="{{ $harga_final }}">
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
    <div class="modal fade" id="modalSyarat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Syarat dan Ketentuan</h5>
                    
                </div>
                <div class="modal-body">
                    <p class="small text-muted">Mohon dibaca dan scroll bawah untuk centang persetujuan syarat dan ketentuan </p>
                    <hr>
                    <div class="small text-justify">
                        Hallo Sahabat Taxes <br> <br>
                        Terimakasih telah mengunjungi dan belanja di website kami <i
                            class="text-primary">www.iceducation.co.id</i>, dalam
                        website kami tertulis Syarat dan Ketentuan Belanja produk kami online maupun offline. Di bawah
                        ini akan di jelaskan peraturan dan persyaratan pembelian produk, dan diharapkan peserta dapat
                        membaca secara teliti sebelum melakukan belanja. Jika ada yang belum jelas, silahkan
                        menghubungi CS kami di nomor telepon <i>021-225-309-53/021-225-309-54</i> atau melalui
                        WhatsApp kami di <i> 0811-1474-251.</i>
                        <br><br>
                        Dengan mengakses atau menggunakan situs <i class="text-primary"> www.iceducation.co.id</i>, maka
                        setiap Pengguna
                        dianggap telah menerima, memahami, menyetujui, serta sepakat untuk mematuhi semua isi dalam
                        Syarat & Ketentuan Layanan.
                        <br><br>
                        <b>Syarat dan Ketentuan Belanja:</b>
                        <br><br>
                        <ul class="custom-list">
                            <li><b>Website kami</b> adalah www.iceducation.co.id.</li>
                            <li><b>Permintaan Invoice</b> dilakukan secara request manual.</li>
                            <li><b>Penjual</b> adalah PT Indonesia Consultindo Global & Lembaga Kursus Pelatihan IC
                                Education
                                yang terdapat penjelasan didalam website www.iceducation.co.id, . Informasi lainnya bisa
                                melalui Instagram kami @iceducation_id, @ic.consultant.</li>
                            <li><b>Kelas</b> tersedia 4 produk dengan Harga dan manfaat yang berbeda. peserta memilih
                                pembelian
                                sesuai yang di inginkan. Sudah termasuk fasilitas sebagaimana disebutkan pada laman
                                penjelasan produk masing-masing.</li>
                            <li><b>Harga</b> yang tercantum dapat kami pastikan benar, Harga Online dan Offline berbeda,
                                namun
                                jika ada kesalahan nominal harga pada produk yang peserta order/beli, akan kami beritahukan
                                secepatnya kepada Anda, dan kami berikan pilihan apakah tetap order atau batal</li>
                            <li><b>Angsuran Pembayaran bisa di lakukan 2 kali</b>
                                <ul>
                                    <li>- Angsuran pertama 50% sebelum Kelas dimulai.</li>
                                    <li>- Angsuran Kedua 50% sebelum Ujian pertama dimulai (pertemuan ke 6).</li>
                                </ul>
                                <i>Bagi peserta yang belum melakukan angsuran sesuai aturan di atas tidak diperbolehkan
                                    ujian.</i>
                            </li>
                            <li><b>Salah Order kelas</b> atau ingin pindah ke kelas lain masih diperbolehkan selama mendapat
                                persetujuan oleh manajemen.</li>
                            <li><b>Pengembalian pembayaran</b> hanya dapat dilakukan jika kelas dinyatakan "batal" oleh
                                manajemen IC Education berdasarkan email yang dikirim keseluruh calon peserta.
                                Pengembalian akan dilakukan 14 hari kerja terhitung sejak diterimanya dengan lengkap data
                                rekening bank calon peserta yang kelasnya dinyatakan "batal" tersebut melalui email.</li>
                            <li><b>Pindah kelas</b> di saat kelas sedang berlangsung hanya diperkenankan dari kelas tatap
                                muka ke
                                kelas online, dan tidak diperkenankan pindah kelas sebaliknya,</li>
                            <li><b>Pembayaran</b> hanya dengan transfer bank
                                <ul>
                                    <li>- Jika dalam 1x24 jam setelah Anda melakukan order tidak melakukan pembayaran atas
                                        order tersebut, maka order Anda akan dibatalkan secara otomatis, dan jika tetap
                                        menginginkan kelas yang sama, mohon untuk melakukan order kembali dengan syarat dan
                                        ketentuan yang sama,</li>
                                    <li>
                                        - Setelah melakukan pembayaran diharuskan untuk mengirimkan bukti pembayaran melalui
                                        admin kami untuk mempermudah proses verifikasi pembayaran,
                                    </li>
                                    <li>
                                        - Jangan melakukan pembayaran sebelum Anda mendapatkan invoice dan email berupa
                                        tagihan sesuai KODE VIRTUAL ACOOUNT BANK yang harus ditransfer,
                                    </li>
                                </ul>
                            </li>
                            <li><b>Modul Peserta</b> bagi yang order BREVET PAJAK AB akan dikirim ke alamat masing-masing
                                dan ongkos kirim dibayarkan oleh peserta. Setelah Peserta melakukan pembayaran dan sudah
                                mendapatkan approval/verifikasi pembayaran dari Admin kami.</li>
                            <li><b>Kelas di Mulai,</b> Peserta akan mendapatkan pemberitahuan kelas yang akan berjalan 1-2 hari
                                menjelang hari pelaksanaan perihal kelengkapan dan jadwal serta lainnya,</li>
                            <li> Peserta mengikuti <b>Pelaksanaan Ujian</b> jika sudah menjalankan aturan pembayaran yang di
                                informasikan.
                                <ul>
                                    <li><b>Ujian susulan</b> dan <b>perbaikan dikenakan</b> biaya tambahan sebesar Rp. 50.000,-/ materi.
                                    </li>
                                </ul>
                            </li>
                            <li><b>Sertifikat </b>hilang baik atas kesengajaan maupun ketidaksengajaan Anda dapat diberikan
                                sertifikat pengganti dengan syarat peserta masih memiliki softcopy sertifikat.</li>
                        </ul>
                        <br><br>
                        Dengan demikian Anda telah setuju untuk mematuhi aturan sesuai syarat-syarat dan ketentuan
                        sebagaimana penjelasan diatas.
                        <br><br>
                        Hormat Kami
                        <br><br>
                        <br><br>
                        ADMIN IC EDUCATION
                        <br><br>
                    </div>
                    <hr>
                    <div class="pb-3 pt-3 text-center small">
                        <input type="checkbox" id="checkSetuju" name="item1" value="Setuju">
                        Saya Setuju dengan Syarat dan Ketentuan
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>



@endsection
@push('js')

<script>
    $(document).ready(function () {
        $('#checkSetuju').on('change', function() {
    if (this.checked) {
        $('#modalSyarat').modal('hide');
    }
});

        $('#modalSyarat').modal('show');
        $('#btnReset').on('click', function(){
            window.location.reload()
        })

        $('#btnApplyVoucher').on('click', function (){
            var voucher = $('#voucher_code').val()
            console.log(voucher)
            var token = $('#_token').val()
            if(voucher){
                var data = {
                    voucher: voucher,
                    _token: token
                }

                $.ajax({
                    method: 'get',
                    url: '/checkout/voucher/code',
                    data: data,
                    success: function (response) {
                        if(response == 'Data Not Found'){
                            swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                html: 'Voucher Code Not Found',
                                timer: 2000,
                                timerProgressBar: true,
                            });
                        }else{
                            var final = $('#harga_hidden').val()
                            var nilai = response.nilai
                            var afterVoucher = final - nilai

                            var formatted_nilai = nilai.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            });
                            formatted_nilai = formatted_nilai.replace(/\,00$/, '');

                            Swal.fire({
                                title: 'Voucher Found',
                                text: `Apakah Anda Ingin Menambahkan Voucher Potongan Seharga ${formatted_nilai}`,
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, Pakai!'
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    if(afterVoucher < 0){
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Voucher tidak dapat digunakan!',
                                        })
                                        $('#tempBtnApply').show()
                                    }else{
                                        $('#jumlahVoucherDiskon').html(`: - ${formatted_nilai}`)
                                        $('#tempBtnApply').hide()
                                        var formatted_harga_final = afterVoucher.toLocaleString('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR'
                                        });
                                        Swal.fire({
                                            title: 'Good job!',
                                            text: `Anda Mendapatkan Potongan ${formatted_nilai}, Lanjutkan Pembayaran`,
                                            icon: 'success',
                                            timer: 2000,
                                            timerProgressBar: true
                                        });

                                        $('#tempBtnApply').hide()
                                        $('#harga_hidden').val(afterVoucher)
                                        $('#hidden_voucher').val(nilai)
                                        $('#harga_final').html(": " + formatted_harga_final)
                                    }

                                   
                                }
                            })
                          

                            
                        }
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

            }
        });

    
        $('#tenor_edit').on('change', function () {
            var selected = $(this).val()
            var harga = $('#harga_asli').val()
            var diskon = $('#diskon_hidden').val()
            var type = $('#type_diskon').val()

            if (selected == '25') {
                var harga_semi = (harga / 100) * 25
                var tenor = ' (Tenor 25%)'
            } else if (selected == '50') {
                var harga_semi = (harga / 100) * 50
                var tenor = ' (Tenor 50%)'
            } else if (selected == '75') {
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
            $('#harga_kelas_after_disc').val(harga_final)

          

            var formated_harga_semi = harga_semi.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
            formated_harga_semi = formated_harga_semi.replace(/\,00$/, '');
            
            // VOUCHER VALIDATION
            var _voucher = $('#hidden_voucher').val()
            var _finalVoucher = 0
            if(_voucher != 0){
                var _tes = harga_final - _voucher
                _finalVoucher = _finalVoucher + _tes
            }else{
                _finalVoucher = _finalVoucher + harga_final
            }

            var formatted_harga_final = _finalVoucher.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
            formatted_harga_final = formatted_harga_final.replace(/\,00$/, '');

            // FINAL < 0
            if(_finalVoucher < 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Voucher dan tenor tidak dapat digunakan!',
                }).then(() => {
                    // Add a delay of 3 seconds (3000 milliseconds) before reloading the window
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                });
            }else{
                $('#harga_produk').html(": " + formated_harga_semi + tenor)
                $('#harga_sebelum_final').html(harga_semi)
                $('#harga_tenor').val(harga_semi)
                $('#harga_hidden').val(_finalVoucher)
                $('#harga_final').html(": " + formatted_harga_final)
            }
        })

    })

</script>
@endpush