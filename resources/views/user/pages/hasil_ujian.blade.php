@extends('user.layouts.user-app')

@section('content')
<main class="col-md-12 ms-sm-auto px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mt-3 mb-3">
    <div class="container-fluid content">
      <div class="row path_file mt-4 justify-content-between mb-4">
        <h4>Hasil Ujian</h4>
        @if (count($materi) != 0)
        @if (count($lulus) == 8)
          @if ($reqSertif == 2)
          <div>
            <a href="{{ route('print-sertifikat', $cekBrevet->id)}}" class="btn btn-primary"> Cetak Sertifikat</a>
            <a href="{{ route('print-nilai', $cekBrevet->id)}}" class="btn btn-primary">Cetak Nilai</a>
          </div>
          @else
        @if ($reqSertif != 1)
          @if ($dapodik)
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmRequestSertif">
            Request Sertifikat
          </button>
          @else
          <p>Harap Melengkapi <strong><a href="{{ route('profil') }}">Data Dapodik</a></strong> Terlebih Dahulu</p>
          @endif
        @else
        <p>Sukses request sertifikat, Harap ditunggu</p>
        @endif
        @endif
        @else
        <div>
          <h5 class="text-danger">Anda Belum Lulus</h5>
        </div>
        @endif
        @else
        <div class="row container mt-2 d-md-flex justify-content-center">
          <h3 class="text-danger">Anda Belum Mengambil Ujian</h3>
        </div>
        @endif
      </div>

      @if ( session()->has('success'))
      <div class="alert alert-success shadow mx-3">
        {{ session('success')}}
      </div>
      @endif

      @if ($materi)
      <div class="table-responsive">
        <table class="table table-bordered text-center">
          <thead>
            <tr>
              <th class="col-1">No</th>
              <th>Materi</th>
              <th>Tgl Mengerjakan</th>
              <th>Status</th>
              <th>Nilai</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($materi as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->description }}</td>
              @if ( $item->peserta )
              <td>{{ format_datetime($item->peserta->updated_at) }}</td>
              <th>{{ ($item->peserta->lulus == 'Lulus') ? 'Lulus' : 'Belum Lulus'}}</th>
              <th><a href="{{ route('pembahasan',[$item->id])}}"
                  class="{{ ($item->peserta->lulus == 'Lulus') ? 'text-success' : 'text-danger'}}">{{
                  $item->peserta->nilai_angka }} ( {{ $item->peserta->nilai_abjad }} )</a></th>
              @else
              <th colspan="3">Belum ambil</th>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>
  </div>
</main>

<div class="modal fade" id="confirmRequestSertif" tabindex="-1" role="dialog"
  aria-labelledby="confirmRequestSertifTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Request Sertifikat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Dengan melakukan request sertifikat, <strong>anda tidak dapat lagi mengambil perbaikan nilai dan kami anggap
            anda menerima hasil yang telah didapatkan</strong></p>
      </div>
      <div class="modal-footer">
        {{-- <form action="{{ route('sertifikat-user', $cekBrevet->id)}}" method="post"> --}}
        <form action="{{ route('request-sertifikat')}}" method="post">
          @csrf
          @method('put')
          <input type="hidden" name="username" value="{{ auth()->user()->username }}">
          <input type="hidden" name="id_keranjang" value="{{ $cekBrevet->id ?? '' }}">

          <button class="btn btn-primary" type="submit">Request Sertifikat</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('addon-style')
<link rel="stylesheet" href="{{ asset('user_dashboard/frontend/styles/menu-html.css')}}" />
@endpush