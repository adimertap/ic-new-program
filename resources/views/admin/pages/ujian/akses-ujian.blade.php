@extends('admin.app')

@section('title')
Master Akses Ujian
@endsection

@push('css')
<link href="{{ asset('assets/plugins/highlight/styles/github-gist.css')}}" rel="stylesheet">
<link href="{{ asset('assets/plugins/datatables/datatables.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/plugins/dropzone/min/dropzone.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/plugins/datatables/rowGroup.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="app-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="section-description section-description-inline">
            <h1>Akses Ujian</h1>
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
                    <th>Kelas</th>
                    <th>Tgl Mulai</th>
                    <th>Tgl Selesai</th>
                    <th>Slug</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>{{ $item->tgl_mulai}}</td>
                    <td>{{ $item->tgl_selesai}}</td>
                    <td>{{ $item->slug}}</td>
                    <td class="d-flex flex-row">
                      <form action="{{ route('admin-akses-tahap-pertama')}}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="slug" value="{{ $item->slug }}">
                        <button class="btn btn-sm btn-info m-r-sm" type="submit" {{ $item->akses_ujian == '0' ? '' :
                          'disabled'}}>
                          Tahap Pertama
                        </button>
                      </form>
                      <form action="{{ route('admin-akses-tahap-kedua')}}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="slug" value="{{ $item->slug }}">
                        <button type="submit" class="btn btn-sm btn-success m-r-sm" {{ $item->akses_ujian == '2' ?
                          'disabled' :
                          '' }}>
                          Tahap Kedua
                        </button>
                      </form>
                      <form action="{{ route('admin-tutup-akses-ujian')}}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="slug" value="{{ $item->slug }}">
                        <button type="submit" class="btn btn-sm btn-danger">
                          Tutup akses
                        </button>
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
@endsection

@push('js')
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('assets/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('assets/js/pages/datatables.js')}}"></script>
<script src="{{ asset('assets/plugins/flatpickr/flatpickr.js')}}"></script>
<script src="{{ asset('assets/js/pages/datepickers.js')}}"></script>
@endpush