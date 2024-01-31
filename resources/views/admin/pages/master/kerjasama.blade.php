@extends('admin.app')

@section('title')
Instansi
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
                        <h1>Instansi</h1>
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
                                data-bs-target="#modalTambah">Add Instansi</button>
                            <hr class="m-0 mb-4">
                            <div id="tableExample"
                                data-list='{"valueNames":["no","jenis","nama","diskon_online","diskon_angka"],"page":20,"pagination":true}'>
                                <div class="table-responsive scrollbar">
                                    <table id="example" class="table table-striped" style="width:100%">
                                        <thead class="bg-200 text-900">
                                            <tr class="">
                                                <th class="sort text-center" data-sort="no">No.</th>
                                                <th class="sort text-center" data-sort="jenis">Jenis</th>
                                                <th class="sort text-center" data-sort="nama">Nama Instansi</th>
                                                <th class="sort text-center" data-sort="status">Status Diskon</th>
                                                <th class="sort text-center" data-sort="diskon_online">Diskon Pers
                                                </th>
                                                <th class="sort text-center" data-sort="diskon_angka">Diskon Angka</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach ($instansi as $item)
                                            <tr role="row" class="odd ">
                                                <th scope="row" class="no">{{ $loop->iteration  }}</th>
                                                <td class="text-center jenis">{{ $item->Jenis->jenis }}</td>
                                                <td class="nama">{{ $item->nama }}</td>
                                                <td class="text-center status">
                                                    @if($item->status == "Persen")
                                                    <div class="badge badge-primary">Diskon Persen</div>
                                                    @elseif($item->status == 'Angka')
                                                    <div class="badge badge-primary">Diskon Angka</div>
                                                    @else
                                                    <div class="badge badge-danger">Tidak Ada Diskon</div>
                                                    @endif
                                                </td>
                                                <td class="text-center diskon_online">
                                                    @if(!$item->diskon_online)
                                                    -
                                                    @else
                                                    {{ $item->diskon_online }} %
                                                    @endif
                                                </td>
                                                <td class="text-center diskon_angka">
                                                    @if(!$item->diskon_angka)
                                                    -
                                                    @else
                                                    Rp. {{ number_format($item->diskon_angka, 0) }}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <button href="" class="btn btn-sm btn-light text-center editBtn"
                                                        style="padding-right:5px" value="{{ $item->id }}"
                                                        type="button"><i class="fa-solid fa-pen-to-square fa-xs"
                                                            style="font-size:16px"></i>
                                                    </button>
                                                    <button href="" class="btn btn-sm btn-danger text-center deleteBtn" style="padding-right:2px" value="{{ $item->id_jenis }}" type="button" onclick="myFunction({{ $item->id_jenis }})">
                                                        <i class="fa-solid fa-trash fa-xs" style="font-size:16px"></i>
                                                    </button>
                                                    <form id="delete-form-{{ $item->id_jenis }}" action="{{ route('admin-instansi-delete', $item->id) }}" method="post" style="display: none">
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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4 bg-blend-lighten" id="addInstansiLabel">Add New Instansi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCreate" name="myForm" class="form-horizontal" action="{{ route('admin-instansi-create')}}"
                method="POST">
                <div class="modal-body small">
                    @csrf
                    <div class="form-group m-b-sm">
                        <div class="row">
                            <div class="col-4">
                                <label for="jenis">Jenis Instansi</label><span class="mr-4 mb-3"
                                    style="color: red">*</span>
                                <select class="form-select form-select-sm" id="id_jenis" name="id_jenis">
                                    <option value="">Pilih Jenis Instansi</option>
                                    @foreach ($jenis as $item)
                                    <option value="{{ $item->id_jenis }}">{{ $item->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-8">
                                <label class="control-label">Nama Instansi</label><span class="mr-4 mb-3"
                                    style="color: red">*</span>
                                <input type="text" class="form-control form-control-sm" name="nama" autocomplete="off"
                                    autocorrect="off" spellcheck="false" placeholder="Masukan Nama Instansi" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <label for="status">Status Diskon</label><span class="mr-4 mb-3"
                                    style="color: red">*</span>
                                <select class="form-select form-select-sm" id="status" name="status">
                                    <option value="Tidak Ada">Tidak Ada Diskon</option>
                                    <option value="Persen">Diskon Persen (1-100%)</option>
                                    <option value="Angka">Diskon Angka</option>

                                </select>
                            </div>
                            <div class="col-8">
                                <div class="d-flex justfiy-content-between">
                                    <label class="control-label">Diskon</label>
                                    <p class="m-0 text-primary ms-2" id="detail_angka"></p>
                                </div>
                                <div class="input-group" id="diskon_persen">
                                    <input type="number" class="form-control form-control-sm" id="create_diskon_persen"
                                        name="diskon_online" autocomplete="off" autocorrect="off" spellcheck="false"
                                        placeholder="Masukan Diskon dalam Persen (1-100%)" max="100" min="1" disabled>
                                    <span class="input-group-text">%</span>
                                </div>
                                <div id="diskon_angka" style="display: none">
                                    <div class="input-group mb-1">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="number" class="form-control form-control-sm"
                                            id="create_diskon_angka" name="diskon_angka" autocomplete="off"
                                            autocorrect="off" spellcheck="false"
                                            placeholder="Masukan Diskon dalam Angka Ribuan">
                                    </div>
                                </div>
                            </div>
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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4 bg-blend-lighten" id="addInstansiLabel">Edit Instansi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEdit" class="form-horizontal" action="{{ route('admin-instansi-update')}}" method="POST">
                <input type="hidden" name="id_instansi">
                <div class="modal-body small">
                    @csrf
                    <div class="form-group m-b-sm">
                        <div class="row">
                            <div class="col-4">
                                <label for="jenis">Jenis Instansi</label><span class="mr-4 mb-3"
                                    style="color: red">*</span>
                                <select class="form-select form-select-sm" id="id_jenis_edit" name="id_jenis">
                                    <option value="">Pilih Jenis Instansi</option>
                                    @foreach ($jenis as $item)
                                    <option value="{{ $item->id_jenis }}">{{ $item->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-8">
                                <label class="control-label">Nama Instansi</label><span class="mr-4 mb-3"
                                    style="color: red">*</span>
                                <input type="text" class="form-control form-control-sm" name="nama" autocomplete="off"
                                    autocorrect="off" spellcheck="false" placeholder="Masukan Nama Instansi" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <label for="status">Status Diskon</label><span class="mr-4 mb-3"
                                    style="color: red">*</span>
                                <select class="form-select form-select-sm" id="status_edit" name="status">
                                    <option value="Tidak Ada">Tidak Ada Diskon</option>
                                    <option value="Persen">Diskon Persen (1-100%)</option>
                                    <option value="Angka">Diskon Angka</option>

                                </select>
                            </div>
                            <div class="col-8">
                                <div class="d-flex justfiy-content-between">
                                    <label class="control-label">Diskon</label>
                                    <p class="m-0 text-primary ms-2" id="detail_angka_edit"></p>
                                </div>
                                <div class="input-group" id="layout_diskon_persen">
                                    <input type="number" class="form-control form-control-sm" id="edit_diskon_persen"
                                        name="diskon_online" autocomplete="off" autocorrect="off" spellcheck="false"
                                        placeholder="Masukan Diskon dalam Persen (1-100%)" max="100" min="1" disabled>
                                    <span class="input-group-text">%</span>
                                </div>
                                <div id="layout_diskon_angka" style="display: none">
                                    <div class="input-group mb-1">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="number" class="form-control form-control-sm" id="edit_diskon_angka"
                                            name="diskon_angka" autocomplete="off" autocorrect="off" spellcheck="false"
                                            placeholder="Masukan Diskon dalam Angka Ribuan">
                                    </div>
                                </div>
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
        $('#status').on('change', function () {
            var status = this.value
            if (status == 'Angka') {
                $('#diskon_angka').show()
                $('#diskon_persen').hide()
                $('#create_diskon_angka').prop('required', true)
                $('#create_diskon_persen').val('')
            } else if (status == 'Persen') {
                $('#diskon_angka').hide()
                $('#diskon_persen').show()
                $('#create_diskon_persen').prop('disabled', false)
                $('#create_diskon_persen').prop('required', true)
                $('#create_diskon_angka').val('')
                $('#detail_angka').html("")
            } else if (status == 'Tidak Ada') {
                $('#diskon_angka').hide()
                $('#diskon_persen').show()
                $('#create_diskon_persen').prop('disabled', true)
                $('#detail_angka').html("")
            }
        });

        $('#status_edit').on('change', function () {
            var status = this.value
            if (status == 'Angka') {
                $('#layout_diskon_angka').show()
                $('#layout_diskon_persen').hide()
                $('#edit_diskon_angka').prop('required', true)
                $('#edit_diskon_persen').val('')
            } else if (status == 'Persen') {
                $('#layout_diskon_angka').hide()
                $('#layout_diskon_persen').show()
                $('#edit_diskon_persen').prop('disabled', false)
                $('#edit_diskon_persen').prop('required', true)
                $('#detail_angka_edit').html("")
                $('#edit_diskon_angka').val('')
            } else if (status == 'Tidak Ada') {
                $('#layout_diskon_angka').hide()
                $('#layout_diskon_persen').show()
                $('#edit_diskon_persen').prop('disabled', true)
                $('#edit_diskon_persen').val('')
                $('#edit_diskon_angka').val('')
                $('#detail_angka_edit').html("")
            }
        });

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
                url: '/master/instansi/show/' + id,
                success: function (response) {
                    var form = $('#formEdit')
                    $('#id_jenis_edit').val(response.id_jenis)
                    form.find('input[name="nama"]').val(response.nama)
                    form.find('input[name="id_instansi"]').val(response.id)

                    $('#status_edit').val(response.status)
                    if (response.status == 'Angka') {
                        $('#layout_diskon_angka').show()
                        $('#layout_diskon_persen').hide()
                        $('#edit_diskon_angka').val(response.diskon_angka)
                        var formated_angka = new Intl.NumberFormat('id', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        }).format(response.diskon_angka);
                        $('#detail_angka_edit').html(formated_angka)
                        console.log(response.status)
                    } else if (response.status == 'Persen') {
                        $('#layout_diskon_angka').hide()
                        $('#layout_diskon_persen').show()
                        $('#edit_diskon_persen').prop('disabled', false)
                        $('#edit_diskon_persen').val(response.diskon_online)
                        $('#detail_angka_edit').html(" ")
                    } else if (response.status == 'Tidak Ada') {
                        $('#layout_diskon_angka').hide()
                        $('#layout_diskon_persen').show()
                        $('#edit_diskon_persen').prop('disabled', true)
                    }
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
