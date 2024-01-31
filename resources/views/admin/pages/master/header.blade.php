@extends('admin.app')

@section('title')
Master Header
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
                        <h1>Master Header Description</h1>
                    </div>
                    <div class="card">
                        <div class="card-body small">
                            <nav class="mb-5">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true">Description on Landing</button>
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Description on Kelas</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab" tabindex="0">
                                    <div id="tableExample"
                                        data-list='{"valueNames":["no","pages","section","description"],"page":20,"pagination":true}'>
                                        <div class="table-responsive scrollbar">
                                            <table id="example" class="table table-striped" style="width:100%">
                                                <thead class="bg-200 text-900">
                                                    <tr class="">
                                                        <th class="sort text-center" data-sort="no">No.</th>
                                                        <th class="sort text-center" data-sort="pages">Pages</th>
                                                        <th class="sort text-center" data-sort="section">Section</th>
                                                        <th class="sort text-center" data-sort="section">Jenis</th>
                                                        <th class="sort text-center" data-sort="description">Description
                                                        </th>
                                                        <th class="text-center">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list">
                                                    @foreach ($header as $item)
                                                    <tr role="row" class="odd ">
                                                        <th scope="row" class="no">{{ $loop->iteration  }}</th>
                                                        <td class="text-center pages">{{ $item->pages }}</td>
                                                        <td class="text-center section">
                                                            @if($item->section_3)
                                                                Judul
                                                            @else
                                                            {{ $item->section }}

                                                            @endif
                                                        </td>
                                                        <td class="text-center section">{{ $item->section_2 ?? '-' }}</td>

                                                        <td class="description">{{ substr($item->description, 0, 100) }}
                                                            .....
                                                        </td>
                                                        <td class="text-center">
                                                           <button href="" class="btn btn-sm btn-light text-center editBtn" style="padding-right:5px"
                                                                value="{{ $item->id_header }}" type="button"><i class="fa-solid fa-pen-to-square fa-xs" style="font-size:16px"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                 <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                                    <div id="tableExample"
                                        data-list='{"valueNames":["no","nama_pendidik","riwayat_pendidikan","pengalaman_kerja","photo_profile", "status"],"page":20,"pagination":true}'>
                                        <div class="table-responsive scrollbar">
                                            <table id="example_kelas" class="table table-striped" style="width:100%">
                                                <thead class="bg-200 text-900">
                                                    <tr class="">
                                                        <th class="sort text-center" data-sort="no">No.</th>
                                                        <th class="sort text-center" data-sort="kelas">Kelas</th>
                                                        <th class="sort text-center" data-sort="description_1">
                                                            Description 1</th>
                                                        <th class="sort text-center" data-sort="description_2">
                                                            Description 2
                                                        </th>
                                                        <th class="text-center">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list">
                                                    @foreach ($header_kelas as $item)
                                                    <tr role="row" class="odd ">
                                                        <th scope="row" class="no">{{ $loop->iteration  }}</th>
                                                        <td class="text-center pages">{{ $item->kelas }} 
                                                        @if($item->section)
                                                            (Judul)
                                                        @endif
                                                        
                                                        </td>
                                                        <td class="description_1">
                                                            {{ substr($item->description_1, 0, 50) }}
                                                            .....
                                                        </td>
                                                        <td class="description_2">
                                                            {{ substr($item->description_2, 0, 50) }}
                                                            .....
                                                        </td>
                                                        <td class="text-center">
                                                            <button href=""
                                                                class="btn btn-sm btn-light text-center editBtn_2"
                                                                style="padding-right:5px"
                                                                value="{{ $item->id_header_kelas }}" type="button"><i
                                                                    class="fa-solid fa-pen-to-square fa-xs"
                                                                    style="font-size:16px"></i>
                                                            </button>
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
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4" id="addInstansiLabel">Edit Data Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEdit" class="form-horizontal" enctype="multipart/form-data"
                    action="{{ route('admin-master-header.update','1') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="jenis">
                    <input type="hidden" name="id_header" />
                    <div class="form-group m-b-sm">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="control-label">Pages</label>
                                <input type="text" value="{{ old('pages') }}" class="form-control form-control-sm"
                                    name="pages" readonly>
                            </div>
                            <div class="col-6">
                                <label class="control-label">Section</label>
                                <input type="text" value="{{ old('section') }}" class="form-control form-control-sm"
                                    name="section" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="control-label">Text</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <textarea type="text" value="{{ old('description') }}" class="form-control form-control-sm"
                                name="description" id="description" rows="6"></textarea>
                        </div>
                        <p class="text-danger small mt-3">(*) Wajib diisi</p>
                    </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-info" id="dismis-modal-edit" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEditKelas" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4" id="addInstansiLabel">Edit Data Kelas Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditKelas" class="form-horizontal" enctype="multipart/form-data"
                    action="{{ route('admin-master-header.update','1') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="jenis">
                    <input type="hidden" name="id_header_kelas" />
                    <div class="form-group m-b-sm">
                        <div class="col-12">
                            <label class="control-label">Kelas</label>
                            <input type="text" value="{{ old('kelas') }}" class="form-control form-control-sm"
                                name="kelas" readonly>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="control-label">Description 1</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <textarea type="text" value="{{ old('description_1') }}"
                                class="form-control form-control-sm" name="description_1" id="description_1"
                                rows="6"></textarea>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="control-label">Description 2</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <textarea type="text" value="{{ old('description_2') }}"
                                class="form-control form-control-sm" name="description_2" id="description_2"
                                rows="6"></textarea>
                        </div>
                        <p class="text-danger small mt-3">(*) Wajib diisi</p>
                    </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-info" id="dismis-modal-edit" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')
{{-- <script src='https://cdn.ckeditor.com/4.20.0/full/ckeditor.js'></script> --}}

<script>
    $(document).ready(function () {
        var table = $('#example').DataTable();
        table.on('click', '.editBtn', function () {
            $('#modalEdit').modal('show');
            var id = $(this).val();
            $.ajax({
                method: 'get',
                url: '/master/master-header/' + id,
                success: function (response) {
                    var form = $('#formEdit')
                    form.find('input[name="jenis"]').val("Landing")
                    form.find('input[name="id_header"]').val(response.id_header)
                    form.find('input[name="pages"]').val(response.pages)
                    form.find('input[name="section"]').val(response.section)
                    $('#description').html(response.description)

                },
                error: function (response) {
                    console.log(response)
                },
            })
        })


        var table_kelas = $('#example_kelas').DataTable();
        table_kelas.on('click', '.editBtn_2', function () {
            $('#modalEditKelas').modal('show');
            var id = $(this).val();
            $.ajax({
                method: 'get',
                url: '/master/master-header/'+id+'/edit',
                success: function (response) {
                    var form = $('#formEditKelas')
                    form.find('input[name="jenis"]').val("Kelas")
                    form.find('input[name="id_header_kelas"]').val(response.id_header_kelas)
                    form.find('input[name="kelas"]').val(response.kelas)
                    $('#description_1').html(response.description_1)
                    $('#description_2').html(response.description_2)
                },
                error: function (response) {
                    console.log(response)
                },
            })
        })

    })

</script>


<script src="{{ asset('/public/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('/public/assets/plugins/highlight/highlight.pack.js')}}"></script>
{{-- <script src="{{ asset('/public/assets/plugins/datatables/datatables.min.js')}}"></script> --}}
<script src="{{ asset('/public/assets/js/pages/datatables.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
@endpush
