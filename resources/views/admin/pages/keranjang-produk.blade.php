@extends('admin.app')

@section('title', 'Master Keranjang Produk')

@push('css')
<link href="{{ asset('/public/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/public/assets/plugins/datatables/datatables.min.css')}}" rel="stylesheet">
<link href="{{ asset('/public/assets/plugins/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
<link href="{{ asset('/public/assets/plugins/dropzone/min/dropzone.min.css')}}" rel="stylesheet">
<link href="{{ asset('/public/assets/plugins/datatables/rowGroup.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="section-description section-description-inline d-flex justify-content-between">

                        <a href="{{ route('admin-keranjang-produk') }}" type="button"
                            class="me-3 btn btn-sm btn-light">Back</a>
                        <h5>Transaksi Manual <b class="text-primary">{{ $instansi->nama }}</b></h5>
                        <div class="d-flex">
                            <button type="button" class="btn btn-sm btn-primary me-3" id="FilterTransaksi">Filter
                                Transaksi</button>
                            <button type="button" class="btn btn-sm btn-danger" id="resetTransaksi"
                                value="{{ $instansi->id }}">Reset</button>
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
                                        <th class="text-center">Slug Produk</th>
                                        <th class="text-center">Harga Kelas</th>
                                        <th class="text-center">Diskon Instansi</th>
                                        <th class="text-center">Diskon Voucher</th>
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
                                        <td>{{ $item->no_invoice }}</td>
                                       
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
                                        <td>{{ $item->slug }}</td>
                                        <td>Rp. {{ convert_to_rupiah($item->harga_kelas) ?? 'product deleted' }}</td>
                                        <td class="text-center">
                                            @if($item->type_diskon == 'Persen')
                                            {{ $item->diskon }} %
                                            @else
                                            Rp. {{ convert_to_rupiah($item->diskon) }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($item->Voucher)
                                                ({{ $item->Voucher->kode }}), - {{ convert_to_rupiah($item->Voucher->nilai) }}                                            
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">Rp. {{ convert_to_rupiah($item->total_price) }}
                                            @if($item->tenor == 25)
                                            (Tenor 25%)
                                            @elseif($item->tenor == 50)
                                            (Tenor 50%)
                                            @elseif ($item->tenor == 75)
                                            (Tenor 75%)
                                            @else
                                            (Lunas)
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

                                              if($item->Voucher){
                                                $angka_diskon = $angka_diskon - $item->Voucher->nilai;
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
                                            @elseif($item->payment_status == 'Pending')
                                                Rp. {{ convert_to_rupiah($item->total_price) }}
                                            @endif
                                        </td>
                                        <td>{{ $item->payment_status == 'Pending' ? 'Menunggu Pembayaran' :
                                            'Dikonfirmasi' }}</td>
                                        <td class="d-flex flex-row">
                                            @if($item->payment_status == 'Pending')
                                                <form action="{{ route('admin-keranjang-produk-confirm', $item->id )}}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')

                                                    <?php 
                                                    if($item->tenor == 25){
                                                        $statusConfirm = 5;
                                                    }else if($item->tenor == 50) {
                                                        $statusConfirm = 3;
                                                    }else if($item->tenor == 75){
                                                        $statusConfirm = 4;
                                                    }else {
                                                        $statusConfirm = 2;
                                                    }
                                                  ?>
                                                    <input type="hidden" name="tenor" value="{{ $item->tenor }}">
                                                    <input type="hidden" name="confirm" value="{{ $statusConfirm }}">
                                                    <button type="submit" class="btn btn-sm btn-success m-r-sm"
                                                        id="confirm-transaksi">
                                                        Confirm
                                                    </button>
                                                </form>
                                            @else
                                                @if($item->status == 3 && $item->payment_status == 'Cicilan')
                                                    <form action="{{ route('admin-keranjang-produk-confirm', $item->id )}}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="tenor" value="75">
                                                        <input type="hidden" name="confirm" value="4">
                                                        <button type="submit" class="btn btn-sm btn-primary m-r-sm"
                                                            id="confirm-transaksi">
                                                            25%
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin-keranjang-produk-confirm', $item->id )}}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="tenor" value="Full">
                                                        <input type="hidden" name="confirm" value="2">
                                                        <button type="submit" class="btn btn-sm btn-success m-r-sm"
                                                            id="confirm-transaksi">
                                                            Lunas
                                                        </button>
                                                    </form>
                                                @elseif ($item->status == 5 && $item->payment_status == 'Cicilan')
                                                <form action="{{ route('admin-keranjang-produk-confirm', $item->id )}}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="tenor" value="50">
                                                    <input type="hidden" name="confirm" value="3">
                                                    <button type="submit" class="btn btn-sm btn-primary m-r-sm"
                                                        id="confirm-transaksi">
                                                        25%
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin-keranjang-produk-confirm', $item->id )}}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="tenor" value="75">
                                                    <input type="hidden" name="confirm" value="4">
                                                    <button type="submit" class="btn btn-sm btn-primary m-r-sm"
                                                        id="confirm-transaksi">
                                                        50%
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin-keranjang-produk-confirm', $item->id )}}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="tenor" value="Full">
                                                    <input type="hidden" name="confirm" value="2">
                                                    <button type="submit" class="btn btn-sm btn-success m-r-sm"
                                                        id="confirm-transaksi">
                                                        Lunas
                                                    </button>
                                                </form>
                                                @elseif ($item->status == 4 && $item->payment_status == 'Cicilan')
                                                <form action="{{ route('admin-keranjang-produk-confirm', $item->id )}}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="tenor" value="Full">
                                                    <input type="hidden" name="confirm" value="2">
                                                    <button type="submit" class="btn btn-sm btn-success m-r-sm"
                                                        id="confirm-transaksi">
                                                        Lunas
                                                    </button>
                                                </form>
                                                @endif
                                            @endif
                                            <button type="submit" id="delete-transaksi"
                                                class="btn btn-sm btn-danger m-r-sm" data-id="{{ $item->id }}">
                                                Cancel
                                            </button>
                                            <button type="submit" id="edit-transaksi" data-id="{{ $item->id }}"
                                                class="btn btn-sm btn-warning m-r-sm">
                                                Edit Transaksi
                                            </button>
                                            @if($item->payment_status != 'Pending')
                                            <a href="{{ route('admin-keranjang-produk-invoice', $item->id) }}"
                                                class="btn btn-sm btn-primary m-r-sm">Invoice</a>
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

<div class="modal fade" id="modalFilter" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4 bg-blend-lighten" id="addInstansiLabel">Filter Keranjang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin-keranjang-produk-detail', $instansi->id)}}">
                <div class="modal-body small">
                    @csrf
                    <div class="form mb-3">
                        <label class="mb-1">Filter Sesuai Status Pembayaran</label>
                        <select class="form-select mb-3" name="filterStatus">
                            <option value="" holder>Pilih Status Pembayaran</option>
                            <option value="Full">Lunas</option>
                            <option value="25">Pembayaran 25%</option>
                            <option value="50">Pembayaran 50%</option>
                            <option value="75">Pembayaran 75%</option>
                            <option value="Pending">Menunggu Pembayaran</option>
                        </select>
                    </div>
                    <div class="form">
                        <label class="mb-1">Filter Sesuai Produk</label>
                        <select class="form-select" name="filterKelas">
                            <option value="" holder>Pilih Produk</option>
                            @foreach ($active as $item)
                            <option value="{{ $item->slug }}">{{ $item->nama_produk." || ".$item->kelas." ||
                                ".$item->tgl_mulai." ||
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
                        <option value="{{ $item->slug }}">{{ $item->nama_produk." || ".$item->kelas." ||
                            ".$item->tgl_mulai." ||
                            ".($item->online == '1' ? "Online" : "") }}</option>
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

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true">
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
<script src="{{ asset('/public/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('/public/assets/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{ asset('/public/assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/public/assets/js/pages/datatables.js')}}"></script>
<script src="{{ asset('/public/assets/plugins/flatpickr/flatpickr.js')}}"></script>
<script src="{{ asset('/public/assets/js/pages/datepickers.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#FilterTransaksi').on('click', function () {
            $('#modalFilter').modal('show')
        })
        $('#resetTransaksi').on('click', function () {
            var id = $(this).val()
            console.log(id)
            window.location.href = '/keranjang-produk/detail/' + id
        })
    })

    $('body').on('click', '#delete-transaksi', function (event) {
        const id = $(this).data('id')
        $('#confirmDeleteModal').modal('show')
        $('#deleted_produk_id').val(id)
    })

    $('body').on('click', '#edit-transaksi', function (event) {
        const id = $(this).data('id')
        $('#editTransaksi').modal('show')
        $('#produk_id').val(id)
    })

</script>
@endpush