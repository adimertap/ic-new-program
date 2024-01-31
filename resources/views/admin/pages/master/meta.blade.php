@extends('admin.app')

@section('title')
Meta Description
@endsection

@push('css')
<link href="{{ asset('/public/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/public/assets/plugins/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css')}}"
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
                        <h1>Meta Title Description</h1>
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
                                data-bs-target="#modalTambah">Add Title</button>
                            <hr class="m-0 mb-4">
                            <div id="tableExample"
                                data-list='{"valueNames":["no","jenis","nama","diskon_online","diskon_angka"],"page":20,"pagination":true}'>
                                <div class="table-responsive scrollbar">
                                    <table id="example" class="table table-striped" style="width:100%">
                                        <thead class="bg-200 text-900">
                                            <tr class="">
                                                <th class="sort text-center" data-sort="no">No.</th>
                                                <th class="sort text-center" data-sort="pages">Pages</th>
                                                <th class="sort text-center" data-sort="title">Title</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach ($meta as $item)
                                            <tr role="row" class="odd ">
                                                <th scope="row" class="no">{{ $loop->iteration  }}</th>
                                                <td class="text-center pages">{{ $item->pages }}</td>
                                                <td class="title">{{ $item->title }}</td>
                                                <td class="text-center">
                                                    <button href="" class="btn btn-sm btn-light text-center editBtn"
                                                        style="padding-right:5px" value="{{ $item->id }}"
                                                        type="button"><i class="fa-solid fa-pen-to-square fa-xs"
                                                            style="font-size:16px"></i>
                                                    </button>
                                                    <button href="" class="btn btn-sm btn-danger text-center deleteBtn"
                                                        style="padding-right:2px" value="{{ $item->id }}"
                                                        type="button" onclick="myFunction({{ $item->id }})">
                                                        <i class="fa-solid fa-trash fa-xs" style="font-size:16px"></i>
                                                    </button>
                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('admin-meta.destroy', $item->id) }}"
                                                        method="post" style="display: none">
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

<div class="modal fade" id="modalTambah" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4 bg-blend-lighten" id="addInstansiLabel">Add New Meta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCreate" name="myForm" class="form-horizontal" action="{{ route('admin-meta.store')}}"
                method="POST">
                <div class="modal-body small">
                    @csrf
                    <div class="form-group m-b-sm">
                        <div class="form-group">
                            <label for="jenis">Pages</label><span class="mr-4 mb-3" style="color: red">*</span>
                            <select class="form-select form-select-sm" id="pages" name="pages">
                                <option value="">Pilih Pages</option>
                                <option value="Beranda">Beranda</option>
                                <option value="Brevet">Brevet</option>
                                <option value="Seminar">Seminar</option>
                                <option value="InHouse">InHouse</option>
                                <option value="USKP">USKP</option>
                                <option value="Gallery">Gallery</option>
                                <option value="Teams">Teams</option>
                                <option value="Register">Register</option>
                                <option value="Login">Login</option>
                                <option value="LengkapiData">LengkapiData</option>
                                <option value="Checkout">Checkout</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label class="control-label">Title</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input type="text" class="form-control form-control-sm" name="title" autocomplete="off"
                                autocorrect="off" spellcheck="false" placeholder="Masukan Title" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light d-flex justify-content-end">
                    <button type="button" class="btn btn-info" id="btnCancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary ms-3" id="saveBtn" value="create">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4 bg-blend-lighten" id="addInstansiLabel">Edit Meta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEdit" class="form-horizontal" action="{{ route('admin-meta.update', 1)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_meta">
                    <div class="modal-body small">
                    <div class="form-group m-b-sm">
                        <div class="row">
                            <p>Pages: <b id="pagesEdit"></b></p>
                            <div class="col-12">
                                <label class="control-label">Title</label><span class="mr-4 mb-3"
                                    style="color: red">*</span>
                                <input type="text" class="form-control form-control-sm" id="titleEdit" name="title" autocomplete="off"
                                    autocorrect="off" spellcheck="false" placeholder="Masukan Nama Instansi" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light d-flex justify-content-end">
                    <button type="button" class="btn btn-info" id="btnCancelEdit" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary ms-3" id="saveBtn" value="create">Update</button>
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
        

        $('#create_diskon_angka').on('input', function () {
            var value = $(this).val()
            var hasil_calc = new Intl.NumberFormat('id', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(value);

            $('#detail_angka').html(hasil_calc)
        });

        $('#edit_diskon_angka').on('input', function () {
            var value = $(this).val()
            var hasil_calc = new Intl.NumberFormat('id', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(value);

            $('#detail_angka_edit').html(hasil_calc)
        });


        var table = $('#example').DataTable();
        table.on('click', '.editBtn', function () {
            $('#modalEdit').modal('show');
            var id = $(this).val();

            $.ajax({
                method: 'get',
                url: '/master/meta/' + id + '/edit',
                success: function (response) {
                    console.log(response)
                    var form = $('#formEdit')
                    $('#pagesEdit').html(response.pages)
                    form.find('input[name="title"]').val(response.title)
                    form.find('input[name="id_meta"]').val(response.id)
                },
                error: function (response) {
                    console.log(response)
                },
            })
        })
    })

    $('#btnCancel').click(function () {
        $('#modalTambah').modal('hide')
    });
    $('#btnCancelEdit').click(function () {
        $('#modalEdit').modal('hide')
    });

</script>
<script src="{{ asset('/public/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('/public/assets/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{ asset('/public/assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/public/assets/js/pages/datatables.js')}}"></script>
@endpush
