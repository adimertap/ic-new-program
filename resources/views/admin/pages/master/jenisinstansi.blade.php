@extends('admin.app')

@section('title')
Tenaga Pendidik
@endsection

@push('css')
<link href="{{ asset('assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('assets/plugins/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css')}}"
    rel="stylesheet">
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
@endpush

@section('content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="section-description section-description-inline">
                        <h1>Jenis Instansi</h1>
                    </div>
                    <div class="card">
                        <div class="card-body small">
                            <button type="button" class="btn btn-primary m-b-sm" data-bs-toggle="modal"
                                data-bs-target="#modalTambah">Tambah Jenis</button>
                            <hr class="mt-0">
                            <div id="tableExample"
                                data-list='{"valueNames":["no","jenis"],"page":20,"pagination":true}'>
                                <div class="table-responsive scrollbar">
                                    <table id="example" class="table table-striped" style="width:100%">
                                        <thead class="bg-200 text-900">
                                            <tr class="">
                                                <th class="sort text-center" data-sort="no">No.</th>
                                                <th class="sort text-center" data-sort="jenis">Nama Jenis</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach ($jenis as $item)
                                            <tr role="row" class="odd ">
                                                <th scope="row" class="no">{{ $loop->iteration  }}</th>
                                                <td class="text-center jenis">{{ $item->jenis }}</td>
                                                <td class="text-center">
                                                    <button href="" class="btn btn-sm btn-light text-center editBtn" style="padding-right:5px" value="{{ $item->id_jenis }}" type="button"><i class="fa-solid fa-pen-to-square fa-xs" style="font-size:16px"></i>
                                                    </button>
                                                    <button href="" class="btn btn-sm btn-danger text-center deleteBtn" style="padding-right:2px" value="{{ $item->id_jenis }}" type="button" onclick="myFunction({{ $item->id_jenis }})">
                                                        <i class="fa-solid fa-trash fa-xs" style="font-size:16px"></i>
                                                    </button>
                                                    <form id="delete-form-{{ $item->id_jenis }}" action="{{ route('admin-master-jenis-instansi.destroy', $item->id_jenis) }}" method="post" style="display: none">
                                                        @method('DELETE')
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    </form>
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
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4" id="addInstansiLabel">Edit Data Jenis Instansi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEdit" class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin-master-jenis-instansi.update','1') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_jenis_instansi" />
                    <div class="form-group m-b-sm">
                        <div class="col-12">
                            <label class="control-label">Nama Jenis Instansi</label> <span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input type="text" value="{{ old('jenis') }}" class="form-control form-control-sm"
                                name="jenis" autocomplete="off" autocorrect="off" spellcheck="false" required>
                        </div>
                        <p class="text-danger small mt-3">(*) Wajib diisi</p>
                    </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-info" id="dismis-modal-edit"
                    data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4" id="addInstansiLabel">Tambah Data Jenis Instansi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data"
                    action="{{ route('admin-master-jenis-instansi.store')}}" method="POST">
                    @csrf
                    <div class="form-group m-b-sm">
                        <div class="col-12">
                            <label class="control-label">Nama Jenis Instansi</label> <span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input type="text" value="{{ old('jenis') }}" class="form-control form-control-sm"
                                name="jenis" autocomplete="off" autocorrect="off" spellcheck="false" required>
                        </div>
                        <p class="text-danger small mt-3">(*) Wajib diisi</p>
                    </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-info" id="dismis-modal-create">Back</button>
                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>


@endsection

@push('js')
<script>
   function myFunction(itemId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault()
                document.getElementById(`delete-form-${itemId}`).submit()
            }
        })
    }

    $(document).ready(function () {
        var table = $('#example').DataTable();
        table.on('click', '.editBtn', function () {
                $('#modalEdit').modal('show');
                var id = $(this).val();
                $.ajax({
                    method: 'get',
                    url: '/master/master-jenis-instansi/' + id,
                    success: function (response) {
                        var form = $('#formEdit')
                        form.find('input[name="id_jenis_instansi"]').val(response.id_jenis)
                        form.find('input[name="jenis"]').val(response.jenis)
                    },
                    error: function (response) {
                        console.log(response)
                    },
                })
        })
    })

    $('#dismis-modal-create').click(function () {
        $('#modalTambah').modal('hide')
    });

</script>


<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('assets/plugins/highlight/highlight.pack.js')}}"></script>
{{-- <script src="{{ asset('assets/plugins/datatables/datatables.min.js')}}"></script> --}}
<script src="{{ asset('assets/js/pages/datatables.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
@endpush
