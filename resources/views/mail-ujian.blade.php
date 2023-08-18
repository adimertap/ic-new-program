<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Notifikasi</title>
</head>

<body>
  <table border="0">
    <tr>
      <td>Dear {{ $nama }}</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    @if ($cek_ujian == "0")
    <tr>
      <td>Berikut detail ujian anda:</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Nama Peserta</td>
      <td>:</td>
      <td>{{ $nama }}</td>
    </tr>
    <tr>
      <td>Kelas</td>
      <td>:</td>
      <td>{{ $kelas }}</td>
    </tr>
    <tr>
      <td>Angkatan</td>
      <td>:</td>
      <td>{{ $Angkatan }}</td>
    </tr>
    <tr>
      <td>Tanggal Ujian</td>
      <td>:</td>
      <td>{{ $tanggal_ujian }}</td>
    </tr>
    <tr>
      <td>Materi Ujian</td>
      <td>:</td>
      <td>{{ $materi_ujian }}</td>
    </tr>
    <tr>
      <td>Nilai</td>
      <td>:</td>
      <td>{{ $nilai_ujian }}</td>
    </tr>
    <tr>
      <td>Status</td>
      <td>:</td>
      <td>{{ $status_ujian }}</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    @elseif ($cek_ujian == "1")
    <tr>
      <td>Terima kasih telah menyelesaikan ujian.</td>
    </tr>
    <tr>
      <td>Berikut data ujian anda:</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    @foreach ($hasil_ujian as $hasil)
    <tr>
      <td>Nilai {{ $hasil->materi->description }}</td>
      <td>:</td>
      <td>{{ $hasil->nilai_angka }}</td>
    </tr>
    @endforeach
    {{-- @if (isset($cek_hasil->lulus) == 'TIDAK LULUS')
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>
        Nilai anda sudah lengkap, namun masih ada materi yang TIDAK LULUS, silahkan klik Ambil Lagi pada materi yang
        akan diulang.
      </td>
    </tr>
    @else
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>
        Nilai anda sudah lengkap dan LULUS semuanya, silahkan klik tombol request sertifikat pada halaman Hasil Ujian
        untuk download/cetak sertifikat.
      </td>
    </tr>
    @endif --}}
    <tr>
      <td>&nbsp;</td>
    </tr>
    @endif
    <tr>
      <td>Terima kasih telah mengikuti ujian bersama IC Education</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Hormat Kami</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Marketing IC Education</td>
    </tr>
  </table>
</body>

</html>