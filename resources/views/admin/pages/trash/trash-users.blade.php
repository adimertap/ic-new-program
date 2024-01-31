@extends('admin.app')

@section('title')
Master Trash Users
@endsection

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
                    <div class="section-description section-description-inline">
                        <h1>Trash Users</h1>
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
                        <div class="card-body">
                            <table id="datatable1" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trashUsers as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name ?? 'user deleted' }}</td>
                                        <td>{{ $item->username ?? 'user deleted'}}</td>
                                        <td>{{ $item->email ?? 'user deleted'}}</td>
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
@endpush