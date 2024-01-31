@extends('admin.app')

@section('title')
Master Akses Ujian
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
            <h1>Hasil Ujian</h1>
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
              <div class="card-body">
                <table id="datatable4" class="display" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Peserta</th>
                      <th>Materi</th>
                      <th>Kelas</th>
                      <th>Nilai (Angka)</th>
                      <th>Nilai (Abjad)</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($hasil_ujian as $hasil)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $hasil->user->name ?? '' }}</td>
                      <td>{{ $hasil->materi->description}}</td>
                      <td>{{ $hasil->slug_product}}</td>
                      <td>{{ $hasil->nilai_angka}}</td>
                      <td>{{ $hasil->nilai_abjad}}</td>
                      <td>{{ $hasil->lulus}}</td>
                      <td>
                        <form action="{{ route('admin-hasil-ujian-delete', $hasil->id )}}" method="post"
                          id="delete-hasil">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-sm btn-danger" id="btn-delete-user">
                            <span class="material-icons-outlined">delete</span>
                          </button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama Peserta</th>
                      <th>Materi</th>
                      <th>Kelas</th>
                      <th>Nilai (Angka)</th>
                      <th>Nilai (Abjad)</th>
                      <th>Status</th>
                      <th>Aksi</th>
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
</div>
@endsection

@push('js')
<script src="{{ asset('/public/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('/public/assets/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{ asset('/public/assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/public/assets/js/pages/datatables.js')}}"></script>
@endpush