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
            <h5>Transaksi <b class="text-primary">Midtrans</b> Berdasarkan Instansi</h5>
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
                <table id="example" class="table table-striped" style="width:100%">
                    <thead class="bg-200 text-900">
                        <tr class="">
                          <th class="sort text-center" data-sort="no">No.</th>
                          <th class="sort text-center" data-sort="jenis">Jenis</th>
                          <th class="sort text-center" data-sort="nama">Nama Instansi</th>
                          <th class="sort text-center" data-sort="nama">Jumlah Keranjang</th>
                          <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($instansi as $item)
                        <tr role="row" class="odd ">
                          <th scope="row" class="no">{{ $loop->iteration  }}</th>
                            <td class="text-center jenis">{{ $item->jenis }}</td>
                            <td class="nama text-center">{{ $item->nama }}</td>
                            <td class="nama text-center">{{ $item->jumlah_keranjang }} Invoice</td>
                            <td class="text-center">
                                <a href="{{ route('admin-keranjang-otomatis.show', $item->id) }}" class="btn btn-sm btn-primary text-center editBtn"
                                    style="padding-right:5px" value="{{ $item->id }}"
                                    type="button">Lihat Keranjang
                                </a>
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
        $('#example').DataTable();
    })

  $('body').on('click', '#delete-transaksi', function(event){
        const id = $(this).data('id')
        $('#confirmDeleteModal').modal('show')
        $('#deleted_produk_id').val(id)
    })

    $('body').on('click', '#edit-transaksi', function(event){
        const id = $(this).data('id')
        $('#editTransaksi').modal('show')
        $('#produk_id').val(id)
    })
</script>
@endpush