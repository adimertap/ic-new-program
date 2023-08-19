@extends('user.layouts.user-app')

@push('css')
<link href="{{ asset('assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
@endpush

@section('content')
<main class="col-md-12 ms-sm-auto px-md-4" style="margin-bottom: 80px">
    <div class="d-flex justify-content-between">
        <div class="mt-2">
            <nav style="--falcon-breadcrumb-divider: '»';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user-dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List Transaksi</li>
                </ol>
            </nav>
        </div>
        <p class="mt-4" style="margin-right: 50px">Selamat datang, <b>{{ Auth::user()->name }}</b> </p>
    </div>
    @if(session()->has('success'))
    <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif
    <div class="mt-3">
        <h4 class="text-primary italic m-0">Transaksi Saya</h4>
        <p class="m-0">Pilih transaksi manual atau otomatis untuk melihat transaksi</p>
    </div>
    <div class="card mt-4">
        <div class="card-header p-3">
            <div class="d-flex justify-content-between">
                <nav class="">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">Transaksi Manual</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Transaksi
                            Otomatis</button>
                    </div>
                </nav>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                    tabindex="0">
                    <div id="tableJenis"
                        data-list='{"valueNames":["no","nama","modul","materi","kuis","jenis"],"page":20,"pagination":true}'>
                        <div class="table-responsive scrollbar">
                            <table class="small table table-bordered table-striped fs--1 mb-0" id="tableManual">
                                <thead>
                                    <tr>
                                        <th class="col-1 text-center">No</th>
                                        <th class="sort text-center" style="width: 50px">No. Invoice</th>
                                        <th class="sort text-center" style="width: 100px">Produk</th>
                                        <th class="sort text-center" style="width: 50px">Kelas</th>
                                        <th class="sort text-center" style="width: 50px">Tanggal</th>
                                        <th class="sort text-center" style="width: 90px">Harga Produk</th>
                                        <th class="sort text-center" style="width: 70px">Diskon</th>
                                        <th class="sort text-center" style="width: 100px">Pembayaran</th>
                                        <th class="sort text-center" style="width: 100px">Kurang Bayar</th>
                                        <th class="sort text-center" style="width: 100px">Status</th>
                                        <th class="sort text-center" style="width: 100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($manual as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_invoice }}</td>
                                        <td>{{ $item->produk->nama_produk }}</td>
                                        <td>{{ $item->produk->kelas }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>Rp. {{ convert_to_rupiah($item->harga_kelas) ?? 'product deleted' }}</td>
                                        <td class="text-center">
                                            @if($item->type_diskon == 'Persen')
                                            {{ $item->diskon }} %
                                            @else
                                            Rp. {{ convert_to_rupiah($item->diskon) }}
                                            @endif
                                        </td>

                                        @if($item->status == 3 && $item->payment_status == 'Cicilan')
                                        <td class="text-center text-primary">Rp.
                                            {{ convert_to_rupiah($item->total_price) }}
                                            (Tenor 50%)
                                        </td>
                                        @elseif($item->status == 4 && $item->payment_status == 'Cicilan')
                                        <td class="text-center text-primary">Rp.
                                            {{ convert_to_rupiah($item->total_price) }}
                                            (Tenor 75%)
                                        </td>
                                        @elseif($item->status == 5 && $item->payment_status == 'Cicilan')
                                        <td class="text-center text-primary">Rp.
                                            {{ convert_to_rupiah($item->total_price) }}
                                            (Tenor 25%)
                                        </td>
                                        @elseif($item->status == 2 && $item->payment_status == 'Paid')
                                        <td class="text-center text-success">Rp.
                                            {{ convert_to_rupiah($item->total_price) }}
                                            (Lunas)
                                        </td>
                                        @elseif($item->payment_status == 'Pending')
                                        <td class="text-center text-danger">Rp.
                                            {{ convert_to_rupiah($item->total_price) }}
                                            (Pending)
                                        </td>
                                        @endif

                                        <td class="text-center">
                                            <?php 
                                            if($item->type_diskon == 'Persen'){
                                                $disc = ($item->harga_kelas/100) * $item->diskon;
                                                $angka_diskon = $item->harga_kelas - $disc;
                                            }else {
                                                $angka_diskon = $item->harga_kelas - $item->diskon;
                                            }
                                            ?>
                                            @if($item->status == 3 && $item->payment_status == 'Cicilan')
                                            Rp. {{ convert_to_rupiah($angka_diskon - $item->total_price) }} (-50%)
                                            @elseif($item->status == 4 && $item->payment_status == 'Cicilan')
                                            Rp. {{ convert_to_rupiah($angka_diskon - $item->total_price) }} (-25%)
                                            @elseif($item->status == 5 && $item->payment_status == 'Cicilan')
                                            Rp. {{ convert_to_rupiah($angka_diskon - $item->total_price) }} (-75%)
                                            @elseif($item->status == 2 && $item->payment_status == 'Paid' ||
                                            $item->payment_status == 'Cicilan')
                                            Lunas
                                            @elseif($item->payment_status == 'Pending')
                                            Pending
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($item->status == 3 && $item->payment_status == 'Cicilan')
                                            Terbayar 50%
                                            @elseif($item->status == 4 && $item->payment_status == 'Cicilan')
                                            Terbayar 75%
                                            @elseif($item->status == 5 && $item->payment_status == 'Cicilan')
                                            Terbayar 25%
                                            @elseif($item->status == 2 && $item->payment_status == 'Paid' ||
                                            $item->payment_status == 'Cicilan')
                                            Dikonfirmasi dan Lunas
                                            @elseif($item->payment_status == 'Pending')
                                            Menunggu Pembayaran
                                            @endif
                                        </td>
                                        <td class="d-flex">
                                            @if($item->payment_status =='Paid' || $item->payment_status == 'Cicilan')
                                            <a href="{{ route('transaksi-invoice', $item->id) }}"
                                                class="btn btn-sm btn-primary"
                                                style="font-size: 12px; margin-right:15px">Invoice</a>
                                            @endif
                                            <a href="https://wa.me/628111474251" class="btn btn-sm btn-secondary"
                                                style="font-size: 12px">Chat</a>
                                        </td>
                                        {{-- @if ($item->status == '2')
                                        <td>Dikonfirmasi</td>
                                        @elseif ($item->status == '3')
                                        <td>30%</td>
                                        @elseif ($item->status == '4')
                                        <td>60%</td>
                                        @else
                                        <td>Menunggu Pembayaran</td>
                                        @endif --}}
                                    </tr>
                                    @empty
                                
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                    tabindex="0">
                    <table class="small table table-bordered table-striped fs--1 mb-0" id="tableOtomatis">
                        <thead>
                            <tr>
                                <th class="col-1 text-center">No</th>
                                <th class="sort text-center">No. Invoice</th>
                                <th class="sort text-center">Produk</th>
                                <th class="sort text-center">Kelas</th>
                                <th class="sort text-center">Tanggal</th>
                                <th class="sort text-center">Harga Produk</th>
                                <th class="sort text-center">Diskon</th>
                                <th class="sort text-center">Pembayaran</th>
                                <th class="sort text-center">Sisa</th>
                                <th class="sort text-center">Status</th>
                                <th class="sort text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($otomatis as $item)
                            <tr role="row" class="odd">
                                <td>{{ $loop->iteration }}</td>
                                <td><span id="{{ $item->id }}"></span>{{ $item->no_invoice }}</td>
                                <td>{{ $item->produk->nama_produk }}</td>
                                <td>{{ $item->produk->kelas }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>Rp. {{ convert_to_rupiah($item->harga_kelas) ?? 'product deleted' }}</td>
                                <td class="text-center">
                                    @if($item->type_diskon == 'Persen')
                                    {{ $item->diskon }} %
                                    @else
                                    Rp. {{ convert_to_rupiah($item->diskon) }}
                                    @endif
                                </td>
                                <td class="text-center text-primary">

                                    @if($item->status == 3 && $item->payment_status == 'Cicilan')

                                    <span id="{{ $item->total_price }}">
                                        Rp. {{ convert_to_rupiah($item->total_price) }}(50%)
                                    </span>

                                    @elseif($item->status == 5 && $item->payment_status == 'Cicilan')

                                    <span id="{{ $item->total_price }}">
                                        Rp. {{ convert_to_rupiah($item->total_price) }}
                                        (25%)
                                    </span>

                                    @elseif($item->status == 4 && $item->payment_status == 'Cicilan')

                                    <span id="{{ $item->total_price }}"> Rp.
                                        {{ convert_to_rupiah($item->total_price) }}(75%)
                                    </span>

                                    @elseif($item->status == 2 && $item->payment_status == 'Paid')

                                    <span id="{{ $item->total_price }}">Rp.
                                        {{ convert_to_rupiah($item->total_price) }}
                                        (Lunas)
                                    </span>

                                    @elseif($item->payment_status == 'Pending')

                                    <span id="{{ $item->total_price }}">
                                        Rp. {{ convert_to_rupiah($item->total_price) }}
                                        (Pending)
                                    </span>

                                    @elseif($item->payment_status == 'Failed')

                                    <span id="{{ $item->total_price }}">
                                        Rp. {{ convert_to_rupiah($item->total_price) }}
                                        (Gagal)
                                    </span>

                                    @endif
                                </td>
                                <td class="text-center">
                                    <?php 
                                      if($item->type_diskon == 'Persen'){
                                        $disc = ($item->harga_kelas/100) * $item->diskon;
                                        $angka_diskon = $item->harga_kelas - $disc;
                                      }else {
                                          $angka_diskon = $item->harga_kelas - $item->diskon;
                                      }
                                    ?>
                                    @if($item->tenor == 50 && $item->payment_status == 'Cicilan')
                                    Rp. {{ convert_to_rupiah($angka_diskon - $item->total_price) }} (-50%)
                                    @elseif($item->tenor == 25 && $item->payment_status == 'Cicilan')
                                    Rp. {{ convert_to_rupiah($angka_diskon - $item->total_price) }} (-75%)
                                    @elseif($item->tenor == 75 && $item->payment_status == 'Cicilan')
                                    Rp. {{ convert_to_rupiah($angka_diskon - $item->total_price) }} (-25%)
                                    @elseif($item->tenor == 'Full' && $item->payment_status == 'Paid' ||
                                    $item->payment_status == 'Cicilan')
                                    Lunas
                                    @elseif($item->payment_status == 'Pending')
                                    {{-- Rp. {{ convert_to_rupiah($item->total_price) }} (Pending) --}}
                                    Pending
                                    @elseif($item->payment_status == 'Failed')
                                    Gagal
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->status == 3 && $item->payment_status == 'Cicilan')
                                        Terbayar 50%
                                    @elseif($item->status == 5 && $item->payment_status == 'Cicilan')
                                        Terbayar 25%
                                    @elseif($item->status == 4 && $item->payment_status == 'Cicilan')
                                        Terbayar 75%
                                    @elseif($item->status == 2 && $item->payment_status == 'Paid' ||
                                    $item->payment_status == 'Cicilan')
                                        Lunas
                                    @elseif($item->payment_status == 'Pending')
                                    Menunggu Pembayaran
                                    @elseif($item->payment_status == 'Failed')
                                    Gagal, Hubungi Admin
                                    @endif
                                </td>
                                <td class="d-flex">
                                    @if($item->status != 2 && $item->payment_status != 'Paid' && $item->payment_status != 'Failed')
                                        <button type="button" class="btn btn-sm btn-success payment" value="{{ $item->id }}"
                                        style="font-size: 12px; margin-right:10px">Bayar</button>
                                    
                                    @endif
                                    
                                    @if($item->payment_status == 'Paid' || $item->payment_status == 'Cicilan')
                                    <a href="{{ route('transaksi-invoice', $item->id) }}" class="btn btn-sm btn-primary"
                                        style="font-size: 12px; margin-right:15px">Invoice
                                    </a>
                                    @endif

                                    <a href="https://wa.me/628111474251" class="btn btn-sm btn-secondary"
                                        style="font-size: 12px">Chat
                                    </a>
                                </td>
                            </tr>
                            @empty
                          
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBayar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title h4 bg-blend-lighten" id="addInstansiLabel">Pembayaran</h5>
                </div>
                <form action="{{ route('bayar', '1') }}" method="POST" id="formGenerate">
                    @csrf
                    <div class="modal-body small">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="transaksi_id" name="transaksi_id" value="">
                        <input type="hidden" id="sisaBayarHidden" name="sisaBayarHidden" value="">
                        <label class="mb-1">Sisa Pembayaran</label>
                        <div class="input-group m-b-sm">
                            <div class="input-group-text">Rp.</div>
                            <input type="text" class="form-control" id="sisaPembayaran" placeholder="" name="sisaBayar"
                                readonly>
                        </div>
                        <div class="form mb-3 mt-3">
                            <label class="mb-1">Pembayaran</label><span style="color: red">*</span>
                            <select class="form-control form-control-sm mb-3" name="cicilan">
                                <option value="">Pilih Tenor Cicilan Pembayaran</option>
                                <option value="75" id="sisa75">Bayar 75%</option>
                                <option value="50" id="sisa50">Bayar 50%</option>
                                <option value="25" id="sisa25">Bayar 25%</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-end">
                        <button type="button" class="btn btn-info" style="margin-right: 12px" id="btnCancel"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ms-3">Bayar Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   
</main>
<script>
    $(document).ready(function () {
        var tes = $('#tableManual').DataTable();
        var table = $('#tableOtomatis').DataTable();
        table.on('click', '.payment', function () {
            var id = $(this).val();
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('clid')) {
                $tr = $tr.prev('.parent')
            }

            var data = table.row($tr).data();
            var id_temp = data[1]
            var id_transaksi = $(id_temp).attr('id')
            var sisaBayar = data[8]
            if (sisaBayar == 'Pending') {
                var formattedPrice = data[7]
                var price = $(formattedPrice).attr('id')
            } else {
                var formattedPrice = data[8]
                var percentage = parseFloat(formattedPrice.match(
                    /\((-?\d+(?:\.\d+)?)%\)/)[1]);
                if (percentage == "-25") {
                    var startIndex = sisaBayar.indexOf("Rp.") +
                        4; // Add 4 to skip "Rp. "
                    var endIndex = sisaBayar.indexOf("(-25%)");
                    var formattedPrice = sisaBayar.substring(startIndex,
                        endIndex).trim();
                    $('#sisa75').hide()
                    $('#sisa50').hide()
                    $('#sisa25').show()
                } else if (percentage == "-50") {
                    var startIndex = sisaBayar.indexOf("Rp.") +
                        4; // Add 4 to skip "Rp. "
                    var endIndex = sisaBayar.indexOf("(-50%)");
                    var formattedPrice = sisaBayar.substring(startIndex,
                        endIndex).trim();
                    $('#sisa50').show()
                    $('#sisa75').hide()
                    $('#sisa25').show()
                } else if (percentage == "-75") {
                    var startIndex = sisaBayar.indexOf("Rp.") +
                        4; // Add 4 to skip "Rp. "
                    var endIndex = sisaBayar.indexOf("(-75%)");
                    var formattedPrice = sisaBayar.substring(startIndex,
                        endIndex).trim();
                    $('#sisa25').show()
                    $('#sisa75').show()
                    $('#sisa50').show()
                }
                var price = formattedPrice.replace('.', '').replace('.', '')
            }
            $.ajax({
                url: '/transaksi/cek/' + id,
                type: "GET",
                success: function (respon) {
                    if (respon == "Data not Found") {
                        $('#id_transaksi').val(id)
                        $('#modalBayar').modal('show')

                        $('#sisaPembayaran').val(price)
                        $('#transaksi_id').val(id_transaksi)
                        $('#sisaBayarHidden').val(price)
                    } else {

                        window.location.href = respon
                    }
                },
                error: function (response) {
                    console.log(response)
                }
            });
        })

        $('#btnCancel').on('click', function () {
            $('#modalBayar').modal('hide')
        })
    });

</script>
@endsection


@push('addon-style')
<link rel="stylesheet" href="{{ url('user_dashboard/frontend/styles/menu-html.css')}}" />
@endpush