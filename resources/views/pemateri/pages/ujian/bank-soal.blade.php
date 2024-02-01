@extends('pemateri.app')

@section('title')
Master Bank Soal
@endsection

@push('css')
<link href="{{ asset('/assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/datatables/datatables.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/dropzone/min/dropzone.min.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/datatables/rowGroup.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="section-description section-description-inline">
                        <h1>Bank Soal</h1>
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
                            <table id="datatable4" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Soal</th>
                                        <th>Materi</th>
                                        <th>Soal</th>
                                        <th>A</th>
                                        <th>B</th>
                                        <th>C</th>
                                        <th>D</th>
                                        <th>Jawaban Benar</th>
                                        <th>Pembahasan</th>
                                        <th>Kode Soal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bankSoal as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_soal ?? 'user deleted' }}</td>
                                        <td>{{ $item->materi->description?? 'user deleted'}}</td>
                                        <td>{{ $item->soal ?? 'user deleted'}}</td>
                                        <td>{{ $item->a ?? 'user deleted'}}</td>
                                        <td>{{ $item->b ?? 'user deleted'}}</td>
                                        <td>{{ $item->c ?? 'user deleted'}}</td>
                                        <td>{{ $item->d ?? 'user deleted'}}</td>
                                        <td>{{ $item->jawaban ?? 'user deleted'}}</td>
                                        <td>{{ $item->pembahasan ?? 'user deleted'}}</td>
                                        <td>{{ $item->kode_soal ?? 'user deleted'}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>No Soal</th>
                                        <th>Materi</th>
                                        <th>Soal</th>
                                        <th>A</th>
                                        <th>B</th>
                                        <th>C</th>
                                        <th>D</th>
                                        <th>Jawaban Benar</th>
                                        <th>Pembahasan</th>
                                        <th>Kode Soal</th>
                                    </tr>
                                </tfoot>
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
@endpush