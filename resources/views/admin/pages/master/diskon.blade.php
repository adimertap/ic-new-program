@extends('admin.app')

@section('title')
Instansi
@endsection

@push('css')
<link href="{{ asset('/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css')}}"
    rel="stylesheet">
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<link href="{{ asset('/assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="section-description section-description-inline">
                        <h1>Diskon</h1>
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
                    <div class="card">
                        <div class="card-body small">
                            <button type="button" class="btn btn-primary m-b-sm" data-bs-toggle="modal"
                                data-bs-target="#addInstansi">Add Diskon</button>
                            <div id="tableExample"
                                data-list='{"valueNames":["no","kode","nilai","is_active","tanggal_mulai","tanggal_selesai"],"page":20,"pagination":true}'>
                                <div class="table-responsive scrollbar">
                                    <table id="example" class="table table-striped" style="width:100%">
                                        <thead class="bg-200 text-900">
                                            <tr class="">
                                                <th class="sort text-center" data-sort="no">No.</th>
                                                <th class="sort text-center" data-sort="kode">Kode</th>
                                                <th class="sort text-center" data-sort="nilai">Nilai</th>
                                                <th class="sort text-center" data-sort="is_active">Is Aktif</th>
                                                <th class="sort text-center" data-sort="tanggal_mulai">Tanggal Mulai
                                                </th>
                                                <th class="sort text-center" data-sort="tanggal_selesai">Tanggal Selesai
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach ($diskon as $disc)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $disc->kode }}</td>
                                                <td>Rp {{ convert_to_rupiah($disc->nilai) }}</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input data-id="{{ $disc->id }}"
                                                            class="form-check-input is_active" type="checkbox"
                                                            data-toggle="toggle" data-on="1" data-off="0"
                                                            name="is_active" {{ $disc->is_active ? "checked": ""}}>
                                                    </div>
                                                </td>
                                                <td>{{ $disc->tgl_mulai }}</td>
                                                <td>{{ $disc->tgl_selesai }}</td>
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
    </div>
</div>

<div class="modal fade" id="addInstansi" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="addInstansiLabel">Add New Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="myForm" name="myForm" class="form-horizontal" action="{{ route('admin-create-diskon')}}"
                    method="POST">
                    @csrf
                    <div class="form-group m-b-sm">
                        <div class="col-12">
                            <label class="kode">Kode Voucher</label>
                            <input type="text" class="form-control" name="kode" id="kode" autocomplete="off"
                                autocorrect="off" spellcheck="false" required>
                        </div>
                    </div>
                    {{-- <div class="form-group m-b-sm">
            <div class="col-12">
              <label class="kerjasama">Instansi <i>(skip bila voucher berlaku umum)</i></label>
              <select class="form-select" name="kerjasama" id="kerjasama">
                <option selected>Pilih instansi untuk voucher</option>
                @foreach ($instansi as $row => $lembaga)
                <option value="{{ $row }}">{{ $lembaga->nama }}</option>
                    @endforeach
                    </select>
            </div>
        </div> --}}
        <div class="form-group m-b-sm">
            <div class="col-12">
                <label class="price">Nilai Voucher</label>
                <input type="number" class="form-control" name="price" id="price" autocomplete="off" autocorrect="off"
                    spellcheck="false" required>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group m-b-sm">
                    <div class="col-12">
                        <label class="tgl_mulai">Tanggal Mulai</label>
                        <input class="form-control flatpickr1" type="text" name="tgl_mulai" id="tgl_mulai">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group m-b-sm">
                    <div class="col-12">
                        <label class="tgl_selesai">Tanggal Selesai</label>
                        <input class="form-control flatpickr1" type="text" name="tgl_selesai" id="tgl_selesai">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group m-b-sm" id="formKodeSoal"></div>
        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
<script src="{{ asset('/assets/plugins/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/assets/js/pages/datepickers.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        var table = $('#example').DataTable();
    })
    $(".flatpickr1").flatpickr();

    $(function () {
        $(".is_active").change(function () {
            var status = $(this).prop('checked') == true ? 1 : 0
            var voucherId = $(this).data('id')
            console.log(status)

            $.ajax({
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin-toggle-active') }}",
                data: {
                    'voucherId': voucherId,
                    'status': status
                },
                success: function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Status voucher berhasil dirubah',
                        showConfirmButton: false,
                        timer: 1300
                    })
                }
            })
        });
    })

</script>
@endpush
