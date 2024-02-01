@extends('admin.app')

@section('title', 'Master Keranjang Produk')

@push('css')
<link href="{{ asset('/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/datatables/datatables.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/dropzone/min/dropzone.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/datatables/rowGroup.dataTables.min.css')}}" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .btn-anchor {
        background: none;
        border: none;
        padding: 0;
        font: inherit;
        color: blue;
        text-decoration: underline;
        cursor: pointer;
    }

</style>
@endpush

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="section-description section-description-inline d-flex justify-content-between">

                        <a href="{{ route('admin-keranjang-produk') }}" type="button" class="me-3 btn btn-sm btn-light">Back</a>
                        <h5>Transaksi Midtrans <b class="text-primary">{{ $instansi->nama }}</b></h5>
                        <div class="d-flex">
                            <button type="button" class="btn btn-sm btn-primary me-3" id="FilterTransaksi">Filter
                                Transaksi</button>
                            <button type="button" class="btn btn-sm btn-danger" id="resetTransaksi" value="{{ $instansi->id }}">Reset</button>
                        </div>
                    </div>

                    @if (session()->has('success'))
                    <div class="alert alert-success alert-style-light" role="alert">
                        {{ session('success')}}
                    </div>
                    @elseif (session()->has('error'))
                    <div class="alert alert-danger alert-style-light" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger alert-style-light" role="alert">
                        <ul>
                            @foreach ($errors->all() as $item)
                            <li>
                                {{ $item }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-body small">
                            <table id="datatable1" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Order ID</th>
                                        <th class="text-center">Nama Lengkap</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">No Hp</th>
                                        <th class="text-center">Pekerjaan</th>
                                        <th class="text-center">Produk</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Harga Kelas</th>
                                        <th class="text-center">Diskon Instansi</th>
                                        <th class="text-center">Slug Produk</th>
                                        <th class="text-center">Pembayaran (Setelah Diskon)</th>
                                        <th class="text-center">Belum Terbayar</th>
                                        <th class="text-center">Status Pembayaran</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><span id="{{ $item->id }}">{{ $item->no_invoice }}</span></td>
                                        @if($item->user)
                                        <td>{{ $item->user->name ?? 'user not found' }}</td>
                                        <td>{{ $item->user->email ?? '' }}</td>
                                        <td>{{ $item->user->no_hp ?? '' }}</td>
                                        <td>{{ $item->user->pekerjaan ?? '' }}</td>
                                        @else
                                            <td>user not found</td>
                                            <td>user not found</td>
                                            <td>user not found</td>
                                            <td>user not found</td>

                                        @endif
                                        <td>{{ $item->produk->nama_produk ?? 'product deleted' }}</td>
                                        <td>{{ $item->produk->kelas ?? 'product deleted' }}</td>
                                        <td>Rp. {{ convert_to_rupiah($item->harga_kelas) ?? 'product deleted' }}</td>
                                        <td class="text-center">
                                            @if($item->type_diskon == 'Persen')
                                            {{ $item->diskon }} %
                                            @else
                                            Rp. {{ convert_to_rupiah($item->diskon)  }}
                                            @endif
                                        </td>
                                        <td>{{ $item->slug }}</td>
                                        <td class="text-center">Rp. {{ convert_to_rupiah($item->total_price) }}
                                            @if($item->status == 3 && $item->payment_status == 'Cicilan')
                                            (Tenor 50%)
                                            @elseif($item->status == 4 && $item->payment_status == 'Cicilan')
                                            (Tenor 75%)
                                            @elseif($item->status == 5 && $item->payment_status == 'Cicilan')
                                            (Tenor 25%)
                                            @elseif($item->status == 2 && $item->payment_status == 'Paid')
                                            (Lunas)
                                            @elseif($item->payment_status == 'Failed')
                                            Failed
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

                                            @if($item->status == 3 && $item->payment_status == 'Cicilan')
                                            Rp. {{ convert_to_rupiah($angka_diskon - $item->total_price) }} (-50%)
                                            @elseif($item->status == 4 && $item->payment_status == 'Cicilan')
                                            Rp. {{ convert_to_rupiah($angka_diskon - $item->total_price) }} (-25%)
                                            @elseif($item->status == 5 && $item->payment_status == 'Cicilan')
                                            Rp. {{ convert_to_rupiah($angka_diskon - $item->total_price) }} (-75%)
                                            @elseif($item->status == 2 && $item->payment_status == 'Paid')
                                            (Lunas)
                                            @elseif($item->status == 1 && $item->payment_status == 'Pending')
                                            Rp. {{ convert_to_rupiah($item->total_price) }}
                                            @elseif($item->payment_status == 'Failed')
                                            Failed
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($item->payment_status == 'Pending')
                                                Menunggu Pembayaran
                                            @elseif($item->payment_status == 'Paid')
                                                Transaksi Success
                                            @elseif($item->payment_status == 'Failed')
                                                Transaksi Gagal
                                            @elseif($item->payment_status == 'Cicilan')
                                                @if($item->status == 3 )
                                                    Terbayar 50%
                                                @elseif($item->status == 4)
                                                    Terbayar 75%
                                                @elseif($item->status == 5)
                                                    Terbayar 25%
                                                @endif
                                            @endif
                                        </td>
                                        <td class="d-flex flex-row">
                                            @if($item->payment_status !== 'Paid')
                                                @if($item->payment_status == 'Pending')
                                                <button type="submit" class="pendingLink btn btn-sm btn-primary m-r-sm" value="{{ $item->id }}">
                                                    Link Bayar
                                                </button>
                                                @else
                                                <button type="submit" class="generateLink btn btn-sm btn-primary m-r-sm" value="{{ $item->id }}">
                                                    Link Bayar
                                                </button>
                                                @endif
                                                
                                                <button type="submit" id="delete-transaksi" class="btn btn-sm btn-danger m-r-sm" data-id="{{ $item->id }}">
                                                    Cancel
                                                </button>
                                                <button type="submit" id="edit-transaksi" data-id="{{ $item->id }}" class="btn btn-sm btn-warning m-r-sm">
                                                    Edit Transaksi
                                                </button>
                                                <form action="{{ route('admin-midtrans-manual', $item->id )}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-light m-r-sm">
                                                        Manual
                                                    </button>
                                                </form>
                                            @else

                                                <button type="button" class="btn btn-sm btn-success m-r-sm" disabled>
                                                    Transaksi Success dan Lunas
                                                </button>
                                                @if($item->payment_status != 'Pending')
                                                <a href="{{ route('admin-keranjang-produk-invoice', $item->id) }}" class="btn btn-sm btn-primary m-r-sm">Invoice</a>
                                                @endif

                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalFilter" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4 bg-blend-lighten" id="addInstansiLabel">Filter Keranjang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin-keranjang-otomatis.show', $instansi->id)}}">
                <div class="modal-body small">
                    @csrf
                    <div class="form mb-3">
                        <label class="mb-1">Filter Sesuai Status Pembayaran</label>
                        <select class="form-select mb-3" name="filterStatus">
                            <option value="" holder>Pilih Status Pembayaran</option>
                            <option value="Pending">Menunggu Pembayaran</option>
                            <option value="Paid">Lunas</option>
                            <option value="Cicilan">Cicilan</option>
                            <option value="Failed">Gagal</option>

                        </select>
                    </div>
                    <div class="form">
                        <label class="mb-1">Filter Sesuai Produk</label>
                        <select class="form-select" name="filterKelas">
                            <option value="" holder>Pilih Produk</option>
                            @foreach ($active as $item)
                            <option value="{{ $item->slug }}">{{ $item->nama_produk." || ".$item->kelas." || ".$item->tgl_mulai." ||
                          ".($item->online == '1' ? "Online" : "") }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="card-footer bg-light d-flex justify-content-end">
                    <button type="button" class="btn btn-info" id="btnCancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary ms-3">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPendingLink" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4 bg-blend-lighten" id="addInstansiLabel">Generate Link Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="formPending">
                <div class="modal-body small">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="transaksi_id_pending" name="transaksi_id" value="">
                    <div class="d-flex justify-content-between">
                        <label class="mb-1 mt-3">Tanggal Transaksi: <span id="waktuTransaksi" class="text-primary"></span></label>
                        <p class="text-primary" id="sisaWaktu"></p>
                    </div>
                    <div class="form mt-3">
                        <div class="input-group m-b-sm">
                            <div class="input-group-text">Link Payment</div>
                            <input type="text" class="form-control form-control-sm" id="linkPaymentPending" placeholder="Otomatis Terisi Setelah Klik Generate" name="linkPayment" readonly>
                        </div>
                        <p class="text-muted">Anda dapat mengirim link pembayaran ini ke User,Link tersebut akan langsung mengarahkan user ke halaman pembayaran Midtrans</p>
                    </div>
                </div>
                <div class="card-footer bg-light d-flex justify-content-end">
                    <button type="button" class="btn btn-info" id="btnCancel" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalGenerate" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4 bg-blend-lighten" id="addInstansiLabel">Generate Link Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="formGenerate">
                <div class="modal-body small">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="transaksi_id" name="transaksi_id" value="">
                    <input type="hidden" id="sisaBayarHidden" name="sisaBayarHidden" value="">
                    <div class="row">
                        <div class="col-6">
                            <label class="mb-1">Terbayar</label>
                            <div class="input-group m-b-sm">
                                <div class="input-group-text">Rp.</div>
                                <input style="background-color: green; color:white" type="text" class="form-control" id="terbayar" placeholder="" name="terbayar" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="mb-1">Sisa Pembayaran</label>
                            <div class="input-group m-b-sm">
                                <div class="input-group-text">Sisa Bayar</div>
                                <input style="background-color: red; color:white" type="text" class="form-control" id="sisaPembayaran" placeholder="" name="sisaBayar" readonly>
                            </div>
                        </div>
                    </div>
                  
                    <div class="form mb-1">
                        <label class="mb-1">Pembayaran</label><span style="color: red">*</span>
                        <select class="form-select mb-3" name="cicilan" id="selectBayar">
                            <option value="">Pilih Tenor Cicilan Pembayaran</option>
                            <option value="25" id="sisa25">Bayar Sisa 25%</option>
                            <option value="50" id="sisa50">Bayar Sisa 50%</option>
                            <option value="75" id="sisa75">Bayar Sisa 75%</option>
                        </select>
                    </div>
                        <input type="hidden" id="sisaJumlah" value="">
                    <label class="mb-1 mt-3">Kirim Link ke User?</label>
                    <div class="d-flex mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radioEmail" value="tidakEmail" id="radioEmail" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Hanya Generate Link Pembayaran
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radioEmail" value="Email" id="radioEmail">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Kirim Link Pembayaran Via Email
                            </label>
                        </div>
                    </div>
                    <div class="form mt-3">
                        <div class="d-flex justify-content-between">
                            <label class="mb-1">Link Payment</label>
                        </div>
                        <div class="input-group m-b-sm">
                            <div class="input-group-text">Link Payment</div>
                            <input type="text" class="form-control form-control-sm" id="linkPayment" placeholder="Otomatis Terisi Setelah Klik Generate" name="linkPayment" readonly>
                        </div>
                        <p class="text-muted text-center">Link berlaku selama: <span id="countdown" class="text-danger text-center"></span></p>
                        <p class="text-muted">Anda dapat mengirim link pembayaran ini ke User,Link tersebut akan langsung mengarahkan user ke halaman pembayaran Midtrans</p>
                    </div>
                </div>
                <div class="card-footer bg-light d-flex justify-content-end">
                    <button type="button" class="btn btn-info" id="btnCancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary ms-3" onclick="GenerateFunction(event)" id="GenerateButton">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin-edit-transactions')}}" method="post">
                    @csrf
                    @method('put')
                    <select class="form-select" name="slug">
                        @foreach ($active as $item)
                        <option value="{{ $item->slug }}">{{ $item->nama_produk." || ".$item->kelas." || ".$item->tgl_mulai." ||".($item->online == '1' ? "Online" : "") }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="id" id="produk_id">
                    <div class="mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Delete Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin-keranjang-produk-destroy')}}" method="post" id="formDeleteTransaksi">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" id="deleted_produk_id">
                    <label for="inputNote" class="form-label">Note</label>
                    <input type="text" class="form-control m-b-sm" id="inputNote" name="noteDelete" value="Batal">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('/assets/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{ asset('/assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/assets/js/pages/datatables.js')}}"></script>
<script src="{{ asset('/assets/plugins/flatpickr/flatpickr.js')}}"></script>
<script src="{{ asset('/assets/js/pages/datepickers.js')}}"></script>
<script>
    $(document).ready(function() {

        $('#selectBayar').on('change',function(){
            var tes = $(this).val()
        })


        $('#FilterTransaksi').on('click', function() {
            $('#modalFilter').modal('show')
        })
        $('#resetTransaksi').on('click', function() {
            var id = $(this).val()
            window.location.href = '/keranjang-otomatis/' + id
        })

        var table = $('#datatable1').DataTable();
        table.on('click', '.pendingLink', function(){
          
            var id = $(this).val();
            $('#transaksi_id_pending').val(id)
            $.ajax({
                url: '/keranjang-otomatis/get/link/pending/' + id,
                type: "GET",
                success: function(response) {
                    console.log(response)
                    if(response.midtrans_url){
                       
                        if(response.created_at){
                            var dateObj = new Date(response.created_at);

                            // Format the date in "dd-mm-yy" format
                            var day = ("0" + dateObj.getDate()).slice(-2);
                            var month = ("0" + (dateObj.getMonth() + 1)).slice(-2);
                            var year = dateObj.getFullYear().toString().substr(-2);

                            // Format the time in "H:i:s" format
                            var hours = ("0" + dateObj.getHours()).slice(-2);
                            var minutes = ("0" + dateObj.getMinutes()).slice(-2);
                            var seconds = ("0" + dateObj.getSeconds()).slice(-2);

                            // Combine date and time
                            var formattedTime = day + "-" + month + "-" + year + " " + hours + ":" + minutes + ":" + seconds;
                            $('#waktuTransaksi').html(formattedTime)
                            var currentDate = new Date();
                            currentDate.setDate(currentDate.getDate() + 1); // Add one day to the current date

                            if (dateObj.getTime() > currentDate.getTime()) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Gagal, Link Telah Kedaluarsa',
                                    html: 'Sebaiknya User mengulangi proses checkout! Waktu Link: 24 Jam',
                                });
                            }else{
                                $('#linkPaymentPending').val(response.midtrans_url)
                                $('#modalPendingLink').modal('show')
                            }

                        }

                    }else{
                        swal.fire({
                            icon: 'error',
                            title: 'Gagal, Link Tidak Tergenerate',
                            html: 'Sebaiknya User mengulangi proses checkout!',
                        });
                    }
                }
                , error: function(response) {
                    console.log(response)
                }
            });

        })


        table.on('click', '.generateLink', function() {
            $("#countdown").text(" ");
            $('#linkPayment').val(" ")
            $('#copyButton').hide()

            $('#modalGenerate').modal('show');
            var id = $(this).val();
            $('#id_transaksi').val(id)

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('clid')) {
                $tr = $tr.prev('.parent')
            }

            var data = table.row($tr).data();
            var id_temp = data[1]
            var id_transaksi = $(id_temp).attr('id')
            var sisaBayar = data[12]
            var percentage = parseFloat(sisaBayar.match(/\((-?\d+(?:\.\d+)?)%\)/)[1]);
            var terbayar_temp = data[11]
            var terbayar = terbayar_temp.replace(/\s/g, '');
            $('#terbayar').val(terbayar)
            var numericValue = terbayar.match(/\d+(\.\d+)*(?=\s*\(-\d+%\))/);

            $('#sisaJumlah').val(numericValue)

            if (percentage == "-75") {
                var startIndex = sisaBayar.indexOf("Rp.") + 4; // Add 4 to skip "Rp. "
                var endIndex = sisaBayar.indexOf("(-75%)");
                var number = sisaBayar.substring(startIndex, endIndex).trim();
                $('#sisa25').show()
                $('#sisa50').show()
                $('#sisa75').show()
            } else if (percentage == "-50") {
                var startIndex = sisaBayar.indexOf("Rp.") + 4; // Add 4 to skip "Rp. "
                var endIndex = sisaBayar.indexOf("(-50%)");
                var number = sisaBayar.substring(startIndex, endIndex).trim();
                $('#sisa25').show()
                $('#sisa50').show()
                $('#sisa75').hide()
            }else if (percentage == "-25") {
                var startIndex = sisaBayar.indexOf("Rp.") + 4; // Add 4 to skip "Rp. "
                var endIndex = sisaBayar.indexOf("(-25%)");
                var number = sisaBayar.substring(startIndex, endIndex).trim();
                $('#sisa25').show()
                $('#sisa50').hide()
                $('#sisa75').hide()
            }

            $('#sisaPembayaran').val(sisaBayar)
            $('#transaksi_id').val(id_transaksi)
            $('#sisaBayarHidden').val(number)
        })
    })

    function GenerateFunction(event) {
        event.preventDefault()
        var form = $('#formGenerate')
        var _token = form.find('input[name="_token"]').val()
        var cicilan = parseInt(form.find('select[name="cicilan"]').val())
        var radio = $('input[name="radioEmail"]:checked').val();
        var id_transaksi = form.find('input[name="transaksi_id"]').val()
        var sisa_pembayaran = form.find('input[name="sisaBayarHidden"]').val()
        var sisa = sisa_pembayaran.replace(/\./g, '');
        if (cicilan == "" || cicilan == undefined) {
            Swal.fire({
                icon: 'error'
                , title: 'Oops...'
                , text: 'Pilih Tenor Pembayaran Terlebih Dahulu'
            , })
        } else {
            var data = {
                _token: _token
                , cicilan: cicilan
                , radio: radio
                , id_transaksi: id_transaksi
                , sisa_pembayaran: sisa
            }

            $.ajax({
                url: '/keranjang-otomatis/generate/link/' + id_transaksi
                , type: "POST"
                , data: data
                , success: function(response) {
                    console.log(response)
                    $('#linkPayment').val(response)
                    $('#copyButton').show()
                    var countdownDate = new Date();
                    countdownDate.setHours(countdownDate.getHours() + 24); // Add 24 hours to current time

                    var timer = setInterval(function() {
                        var now = new Date().getTime();
                        var distance = countdownDate - now;

                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        var countdown = hours + "h " + minutes + "m " + seconds + "s";

                        $("#countdown").text(countdown);

                        if (distance < 0) {
                            clearInterval(timer);
                            $("#countdown").text("Link Expired");
                            $('#linkPayment').val(" ")
                        }
                    }, 1000);
                }
                , error: function(response) {
                    console.log(response)
                }
            });

        }


    }



    $('body').on('click', '#delete-transaksi', function(event) {
        const id = $(this).data('id')
        $('#confirmDeleteModal').modal('show')
        $('#deleted_produk_id').val(id)
    })

    $('body').on('click', '#edit-transaksi', function(event) {
        const id = $(this).data('id')
        $('#editTransaksi').modal('show')
        $('#produk_id').val(id)
    })

</script>
@endpush
