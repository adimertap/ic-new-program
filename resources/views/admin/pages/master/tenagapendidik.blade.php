@extends('admin.app')

@section('title')
Tenaga Pendidik
@endsection

@push('css')
<link href="{{ asset('/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css')}}"
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
                        <h1>Tenaga Pendidik</h1>
                    </div>
                    <div class="card">
                        <div class="card-body small">
                            <button type="button" class="btn btn-primary m-b-sm" data-bs-toggle="modal"
                                data-bs-target="#modalTambah">Tambah Tenaga Pendidik</button>
                            <hr class="mt-0">
                            <div id="tableExample"
                                data-list='{"valueNames":["no","nama_pendidik","riwayat_pendidikan","pengalaman_kerja","photo_profile", "status"],"page":20,"pagination":true}'>
                                <div class="table-responsive scrollbar">
                                    <table id="example" class="table table-striped" style="width:100%">
                                        <thead class="bg-200 text-900">
                                            <tr class="">
                                                <th class="sort text-center" data-sort="no">No.</th>
                                                <th class="sort text-center" data-sort="nama_pendidik">Nama Tenaga
                                                    Pendidik</th>
                                                <th class="sort text-center" data-sort="riwayat_pendidikan">Riwayat
                                                    Pendidikan</th>
                                                <th class="sort text-center" data-sort="pengalaman_kerja">Pengalaman
                                                    Kerja</th>
                                                <th class="sort text-center" data-sort="status">Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach ($pendidik as $item)
                                            <tr role="row" class="odd ">
                                                <th scope="row" class="no">{{ $loop->iteration  }}</th>
                                                <td class="text-center nama_pendidik">{{ $item->nama_pendidik }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-light riwayat"
                                                        value="{{ $item->id_pendidik }}">Riwayat</button>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-light pengalaman"
                                                        value="{{ $item->id_pendidik }}">Pengalaman</button>
                                                </td>
                                                {{-- <td class="status text-center">
                                                    
                                                    @if($item->status == 1)
                                                    <div class="badge badge-success">Aktif</div>
                                                    @else
                                                    <div class="badge badge-danger">Tidak Aktif</div>
                                                    @endif
                                                </td> --}}
                                                <td class="status">
                                                    <form id="statusForm-{{ $item->id_pendidik }}" action="{{ route('admin-aktif-pendidik', $item->id_pendidik) }}" method="POST">
                                                        @csrf
                                                        <div class="form-check form-switch">
                                                            <input data-id="{{ $item->id_pendidik }}"
                                                                class="form-check-input is_active" type="checkbox"
                                                                data-toggle="toggle" data-on="1" data-off="0" value="{{ $item->id_company }}"
                                                                name="is_active" {{ $item->status == '1' ? "checked" : "" }}>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td class="text-center">
                                                    <button href="" class="btn btn-sm btn-light text-center editBtn" style="padding-right:5px" value="{{ $item->id_pendidik }}" type="button"><i class="fa-solid fa-pen-to-square fa-xs" style="font-size:16px"></i>
                                                    </button>
                                                    <button href="" class="btn btn-sm btn-danger text-center deleteBtn" style="padding-right:2px" value="{{ $item->id_pendidik }}" type="button" onclick="myFunction({{ $item->id_pendidik }})">
                                                        <i class="fa-solid fa-trash fa-xs" style="font-size:16px"></i>
                                                    </button>
                                                    <form id="delete-form-{{ $item->id_pendidik }}" action="{{ route('admin-master-pendidik.destroy', $item->id_pendidik) }}" method="post" style="display: none">
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
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4" id="addInstansiLabel">Edit Data Pendidik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEdit" class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin-master-pendidik.update','1') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_pendidik" />
                    <div class="form-group m-b-sm">
                        <div class="col-12">
                            <label class="control-label">Nama Tenaga Pendidik</label> <span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input type="text" value="{{ old('nama_pendidik') }}" class="form-control form-control-sm"
                                name="nama_pendidik" autocomplete="off" autocorrect="off" spellcheck="false" required>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <div>
                                    <label class="control-label">Riwayat Pendidikan Tenaga Pendidik</label>
                                    <input type="text" value="{{ old('pendidikan_1') }}"
                                        class="form-control form-control-sm" name="pendidikan_1">
                                    <input type="text" value="{{ old('pendidikan_2') }}"
                                        class="form-control form-control-sm mt-1" name="pendidikan_2">
                                    <input type="text" value="{{ old('pendidikan_3') }}"
                                        class="form-control form-control-sm mt-1" name="pendidikan_3">
                                    <input type="text" value="{{ old('pendidikan_4') }}"
                                        class="form-control form-control-sm mt-1" name="pendidikan_4">
                                    <input type="text" value="{{ old('pendidikan_5') }}"
                                        class="form-control form-control-sm mt-1" name="pendidikan_5">
                                    <input type="text" value="{{ old('pendidikan_6') }}"
                                        class="form-control form-control-sm mt-1" name="pendidikan_6">
                                    <p class="text-muted small">Note: Isikan Riwayat Pendidikan satu per satu</p>
                                </div>
                                <div class="mt-3">
                                    <label class="control-label">Pengalaman Kerja Tenaga Pendidik</label>
                                    <input type="text" value="{{ old('pengalaman_1') }}"
                                        class="form-control form-control-sm" name="pengalaman_1">
                                    <input type="text" value="{{ old('pengalaman_2') }}"
                                        class="form-control form-control-sm mt-1" name="pengalaman_2">
                                    <input type="text" value="{{ old('pengalaman_3') }}"
                                        class="form-control form-control-sm mt-1" name="pengalaman_3">
                                    <input type="text" value="{{ old('pengalaman_4') }}"
                                        class="form-control form-control-sm mt-1" name="pengalaman_4">
                                    <input type="text" value="{{ old('pengalaman_5') }}"
                                        class="form-control form-control-sm mt-1" name="pengalaman_5">
                                    <input type="text" value="{{ old('pengalaman_6') }}"
                                        class="form-control form-control-sm mt-1" name="pengalaman_6">
                                    <p class="text-muted small">Note: Isikan Pengalaman Kerja satu per satu</p>
                                </div>
                               

                            </div>
                            <div class="col-6">
                                <div>
                                    <label class="control-label">Profile Picture</label>
                                    <input type="file" class="form-control form-control-sm" name="image" autocomplete="off"
                                        autocorrect="off" spellcheck="false">
                                    <p class="text-danger small mt-3">(*) Wajib diisi</p>
                                </div>
                              
                                <div class="col-12">
                                    <img src="{{asset('images/new/brevet.png')}}" id="images" class="img-fluid-kelas" accept=".png, .jpg, .jpeg" alt="">
    
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-info" id="dismis-modal-edit"
                    data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4" id="addInstansiLabel">Tambah Data Pendidik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="myForm" name="myForm" class="form-horizontal" enctype="multipart/form-data"
                    action="{{ route('admin-master-pendidik.store')}}" method="POST">
                    @csrf
                    <div class="form-group m-b-sm">
                        <div class="col-12">
                            <label class="control-label">Nama Tenaga Pendidik</label> <span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input type="text" value="{{ old('nama_pendidik') }}" class="form-control form-control-sm"
                                name="nama_pendidik" autocomplete="off" autocorrect="off" spellcheck="false" required>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <label class="control-label">Riwayat Pendidikan Tenaga Pendidik</label>
                                <input type="text" value="{{ old('pendidikan_1') }}"
                                    class="form-control form-control-sm" name="pendidikan_1">
                                <input type="text" value="{{ old('pendidikan_2') }}"
                                    class="form-control form-control-sm mt-1" name="pendidikan_2">
                                <input type="text" value="{{ old('pendidikan_3') }}"
                                    class="form-control form-control-sm mt-1" name="pendidikan_3">
                                <input type="text" value="{{ old('pendidikan_4') }}"
                                    class="form-control form-control-sm mt-1" name="pendidikan_4">
                                <input type="text" value="{{ old('pendidikan_5') }}"
                                    class="form-control form-control-sm mt-1" name="pendidikan_5">
                                <input type="text" value="{{ old('pendidikan_6') }}"
                                    class="form-control form-control-sm mt-1" name="pendidikan_6">
                                <p class="text-muted small">Note: Isikan Riwayat Pendidikan satu per satu</p>
                            </div>
                            <div class="col-6">
                                <label class="control-label">Pengalaman Kerja Tenaga Pendidik</label>
                                <input type="text" value="{{ old('pengalaman_1') }}"
                                    class="form-control form-control-sm" name="pengalaman_1">
                                <input type="text" value="{{ old('pengalaman_2') }}"
                                    class="form-control form-control-sm mt-1" name="pengalaman_2">
                                <input type="text" value="{{ old('pengalaman_3') }}"
                                    class="form-control form-control-sm mt-1" name="pengalaman_3">
                                <input type="text" value="{{ old('pengalaman_4') }}"
                                    class="form-control form-control-sm mt-1" name="pengalaman_4">
                                <input type="text" value="{{ old('pengalaman_5') }}"
                                    class="form-control form-control-sm mt-1" name="pengalaman_5">
                                <input type="text" value="{{ old('pengalaman_6') }}"
                                    class="form-control form-control-sm mt-1" name="pengalaman_6">
                                <p class="text-muted small">Note: Isikan Pengalaman Kerja satu per satu</p>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="control-label">Profile Picture</label>
                                <input type="file" class="form-control form-control-sm" name="image" accept=".png, .jpg, .jpeg" required>
                            </div>
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

<div class="modal fade" id="modalRiwayat" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4" id="addInstansiLabel">Riwayat Pendidikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="form-group m-b-sm">
                        <p id="nama_riwayat"></p>
                        <ul>
                            <li id="pendidikan_1"></li>
                            <li id="pendidikan_2"></li>
                            <li id="pendidikan_3"></li>
                            <li id="pendidikan_4"></li>
                            <li id="pendidikan_5"></li>
                            <li id="pendidikan_6"></li>

                        </ul>
                    </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-info" id="dismis-modal-riwayat"  data-dismiss="modal">Back</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPengalaman" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="addInstansiLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title h4" id="addInstansiLabel">Pengalaman Kerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    <div class="form-group m-b-sm">
                        <p id="nama_pengalaman"></p>
                        <ul>
                            <li id="pengalaman_1"></li>
                            <li id="pengalaman_2"></li>
                            <li id="pengalaman_3"></li>
                            <li id="pengalaman_4"></li>
                            <li id="pengalaman_5"></li>
                            <li id="pengalaman_6"></li>
                        </ul>
                    </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-info" id="dismis-modal-pengalaman"  data-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>



@endsection

@push('js')
<script>
    $(document).ready(function () {
        $('#dismis-modal-create').click(function () {
        $('#modalTambah').modal('hide')
        });

        $('#dismis-modal-riwayat').click(function () {
            $('#modalRiwayat').modal('hide')
        });

        $('#dismis-modal-pengalaman').click(function () {
            $('#modalPengalaman').modal('hide')
        });
        var table = $('#example').DataTable();
        table.on('click', '.riwayat', function () {
                $('#modalRiwayat').modal('show');
                var id = $(this).val();
                console.log(id)
                $.ajax({
                    method: 'get',
                    url: '/master/master-pendidik/' + id,
                    success: function (response) {
                        $('#nama_riwayat').html(response.nama_pendidik)
                        $('#pendidikan_1').html(response.pendidikan_1 ?? 'Tidak Ada Riwayat')
                        $('#pendidikan_2').html(response.pendidikan_2 ?? 'Tidak Ada Riwayat')
                        $('#pendidikan_3').html(response.pendidikan_3 ?? 'Tidak Ada Riwayat')
                        $('#pendidikan_4').html(response.pendidikan_4 ?? 'Tidak Ada Riwayat')
                        $('#pendidikan_5').html(response.pendidikan_5 ?? 'Tidak Ada Riwayat')
                        $('#pendidikan_6').html(response.pendidikan_6 ?? 'Tidak Ada Riwayat')
                    },
                    error: function (response) {
                        console.log(response)
                    },
                })
        })

        table.on('click', '.pengalaman', function () {
                $('#modalPengalaman').modal('show');
                var id = $(this).val();
                $.ajax({
                    method: 'get',
                    url: '/master/master-pendidik/' + id,
                    success: function (response) {
                        $('#nama_pengalaman').html(response.nama_pendidik)
                        $('#pengalaman_1').html(response.pengalaman_1 ?? 'Tidak Ada Pengalaman Kerja')
                        $('#pengalaman_2').html(response.pengalaman_2 ?? 'Tidak Ada Pengalaman Kerja')
                        $('#pengalaman_3').html(response.pengalaman_3 ?? 'Tidak Ada Pengalaman Kerja')
                        $('#pengalaman_4').html(response.pengalaman_4 ?? 'Tidak Ada Pengalaman Kerja')
                        $('#pengalaman_5').html(response.pengalaman_5 ?? 'Tidak Ada Pengalaman Kerja')
                        $('#pengalaman_6').html(response.pengalaman_6 ?? 'Tidak Ada Pengalaman Kerja')
                    },
                    error: function (response) {
                        console.log(response)
                    },
                })
        })

        table.on('click', '.editBtn', function () {
                $('#modalEdit').modal('show');
                var id = $(this).val();
                $.ajax({
                    method: 'get',
                    url: '/master/master-pendidik/' + id,
                    success: function (response) {
                        console.log(response)
                        var form = $('#formEdit')
                        form.find('input[name="id_pendidik"]').val(response.id_pendidik)
                        form.find('input[name="nama_pendidik"]').val(response.nama_pendidik)
                        form.find('input[name="pendidikan_1"]').val(response.pendidikan_1)
                        form.find('input[name="pendidikan_2"]').val(response.pendidikan_2)
                        form.find('input[name="pendidikan_3"]').val(response.pendidikan_3)
                        form.find('input[name="pendidikan_4"]').val(response.pendidikan_4)
                        form.find('input[name="pendidikan_5"]').val(response.pendidikan_5)
                        form.find('input[name="pendidikan_6"]').val(response.pendidikan_6)
                        form.find('input[name="pengalaman_1"]').val(response.pengalaman_1)
                        form.find('input[name="pengalaman_2"]').val(response.pengalaman_2)
                        form.find('input[name="pengalaman_3"]').val(response.pengalaman_3)
                        form.find('input[name="pengalaman_4"]').val(response.pengalaman_4)
                        form.find('input[name="pengalaman_5"]').val(response.pengalaman_5)
                        form.find('input[name="pengalaman_6"]').val(response.pengalaman_6)
                        var imageUrl = '/pendidik/' + response.photo_profile;

                        // Replace the image source with the generated image URL
                        $('#images').attr('src', imageUrl);
                        console.log(imageUrl)
                    },
                    error: function (response) {
                        console.log(response)
                    },
                })
        })
    })
    const checkboxes = document.querySelectorAll('.form-check-input.is_active');

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var id = this.getAttribute('data-id');
            const form = document.getElementById(`statusForm-${id}`);
            form.submit();
        });
    });

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
</script>


<script src="{{ asset('/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('/assets/plugins/highlight/highlight.pack.js')}}"></script>
{{-- <script src="{{ asset('/assets/plugins/datatables/datatables.min.js')}}"></script> --}}
<script src="{{ asset('/assets/js/pages/datatables.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
@endpush
