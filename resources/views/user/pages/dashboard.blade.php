@extends('user.layouts.user-app')

@section('title')
Dashboard
@endsection

@section('content')

<div class="container-fluid">
  
    <div class="d-sm-flex align-items-center justify-content-between">
        <h1 class="h3 mb-0 text-gray-800">Dashboard User</h1>
        
    </div>
    <p class="mb-4 text-muted">Selamat Datang, {{ Auth::user()->name }}</p>
    <hr class="mb-4">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ (session()->get('success')) }}</strong>
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        5 Transaksi Terbaru
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem"
                            src="{{ asset('userAdmin/img/undraw_posting_photo.svg')}}" alt="..." />
                    </div>
                    <div class="table-event table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">
                                        Produk
                                    </th>
                                    <th scope="col">
                                        Kelas
                                    </th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksi as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $item->kelas->nama_produk ?? 'Ujian' }}</td>
                                    <td>{{ $item->kelas->kelas ?? 'Mengulang' }}</td>
                                    <td>
                                        @if($item->tenor == 25 && $item->payment_status == 'Cicilan')
                                        25%
                                    @elseif($item->tenor == 50 && $item->payment_status == 'Cicilan')
                                        50%
                                    @elseif($item->tenor == 75 && $item->payment_status == 'Cicilan')
                                        75%
                                    @elseif($item->tenor == 'Full' && $item->payment_status == 'Paid')
                                        Lunas
                                    @elseif ($item->payment_status == 'Pending')
                                        Menunggu Konfirmasi
                                    @endif
                                    </td>
                                    
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="4">Belum ada transaksi</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="alert alert-info shadow mb-4">
                Klik <a href="{{ route('home-brevet')}}"><strong>Pilihan Kelas</strong></a> untuk pembelian kelas
            </div>
            @if (!$dapodik)
            <div class="alert alert-danger shadow mb-4">
                Cek <a href="{{ route('profil')}}"><strong>Profil Saya</strong></a>, harap dilengkapi untuk keperluan
                DAPODIK
            </div>
            @endif
            <div class="alert alert-primary shadow mb-4">
                Kunjungi <a href="https://instagram.com/iceducation_id?igshid=YmMyMTA2M2Y="
                    target="_blank"><strong>@iceducation_id</strong></a>
                untuk diskon dan event terbaru kami
            </div>
            <div class="alert alert-primary shadow mb-4">
                Kunjungi <a href="https://youtube.com/c/InfoTAXment" target="_blank"><strong>infoTAXmant</strong></a>
                untuk
                mendengar sarasehan
                dari beberapa Konsultan Senior, share, comment dan subscribe ya
            </div>
            {{-- <div class="alert alert-success shadow mb-4">
        Selamat, kamu punya <a href="{{ route('home-brevet') }}"><strong>Diskon</strong></a> brevet sebagai peserta
            <strong>{{
          $instansi->kerjasama->nama }}</strong>
        </div> --}}
    </div>
</div>
</div>


@endsection
