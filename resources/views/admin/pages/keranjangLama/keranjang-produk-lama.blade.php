@extends('admin.app')

@section('title', 'Master Keranjang Produk')

@push('css')
<link href="{{ asset('/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/datatables/datatables.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/dropzone/min/dropzone.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugians/datatables/rowGroup.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="section-description section-description-inline d-flex justify-content-center">

                 
                        <h5>Transaksi Data Lama</h5>
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
                                        <th class="text-center">Status</th>

                                        <th class="text-center">Slug Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_invoice ?? '' }}</td>
                                        <td>{{ $item->user->name ?? '' }}</td>
                                        <td>{{ $item->user->email ?? '' }}</td>
                                        <td>{{ $item->user->no_hp ?? '' }}</td>
                                        <td>{{ $item->user->pekerjaan ?? '' }}</td>
                                        <td>{{ $item->produk->nama_produk ?? 'product deleted' }}</td>
                                        <td>{{ $item->produk->kelas ?? 'product deleted' }}</td>
                                        <td>Rp. {{ convert_to_rupiah($item->harga_kelas) ?? 'product deleted' }}</td>
                                        <td>
                                            @if($item->status == 2)
                                                Lunas
                                            @elseif($item->status == 1)
                                                Menunggu Pembayaran
                                            @elseif($item->status !== 1 && $item->status !== 2)
                                                Cicilan
                                            @endif
                                        </td>
                                        <td>{{ $item->slug }}</td>
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


@endsection

@push('js')
<script src="{{ asset('/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('/assets/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{ asset('/assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/assets/js/pages/datatables.js')}}"></script>
<script src="{{ asset('/assets/plugins/flatpickr/flatpickr.js')}}"></script>
<script src="{{ asset('/assets/js/pages/datepickers.js')}}"></script>
<script>
   
</script>
@endpush