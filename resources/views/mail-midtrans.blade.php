<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Invoice</title>
</head>

<body>
  <table border="0">
    <tr>
      <td>Dear {{ $nama }}</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    @if ($produk == "seminar")
    <tr>
      <td>Berikut syarat untuk mengikuti seminar: </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>1. Follow and tag 3 temen di komen Instagram ic.consultant, iceducation_id</td>
    </tr>
    <tr>
      <td>2. Follow and tag 3 temen di komen Facebook ICConsultant</td>
    </tr>
    <tr>
      <td>3. Follow and tag 3 temen di komen Twitter ic_consultant</td>
    </tr>
    <tr>
      <td>#kirim capture ke nomor whatsapp <a href="https://api.whatsapp.com/send?phone=+628111474251">08111474251</a>
      </td>
    </tr>
    @else
    <tr>
      @if($isregonly == "0")
      @if (!empty($change_transaction))
      <td>Pengajuan Perubahan Transaksi Anda Telah Kami Setujui dan Telah Kami Perbaharui, terimakasih atas
        kepercayaannya untuk mengikuti {{$produk}} di IC Education, untuk memastikan mendapatkan slot di kelas ini
        peserta yang sudah melakukan pendaftaran dipersilahkan untuk melakukan pembayaran (via transfer bank) sesuai
        dengan invoice terlampir berikut ini </td>
      @else
      <table border="1" style="border-collapse: collapse; width: 100%">
        <tr>
          <th style="width: 40%">Produk</th>
          <td>{{ $produk }}</td>
        </tr>
        <tr>
          <th>Kelas</th>
          <td>{{ $kelas }}</td>
        </tr>
        <tr>
          <th>Tanggal Pemesanan</th>
          <td>{{ $tanggal }}</td>
        </tr>
        <tr>
          <th>Kode Produk</th>
          <td>{{ $slug }}</td>
        </tr>
      </table>
    <tr>
      <td>Pendaftaran Anda sudah kami terima, terimakasih atas kepercayaannya untuk mengikuti {{$produk}} di IC
        Education, untuk memastikan mendapatkan slot di kelas ini peserta yang sudah melakukan pendaftaran dipersilahkan
        untuk melakukan pembayaran melalui platform Midtrans.</td>
    </tr>
    <tr></tr>
    <tr></tr>
    @endif
    <tr>
      <td>
        Anda dapat mengakses link pembayaran pada url berikut ini: {{ $link }}.
      </td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr>
      <td>
        Link akan valid selama 1 hari atau 24 Jam, jika melewati batas waktu tersebut link akan kedaluarsa dan Anda diharuskan melakukan checkout ulang kembali pada portal.
        Pastikan Anda telah membayar sebelum link kedaluarsa. Butuh bantuan pembayaran bisa melalui whatsapp <a href="https://api.whatsapp.com/send?phone=+62 811-1474-251">+62 811-1474-251 </a> atau email
        kami di <a href="mailto:info@iceducation.co.id">info@iceducation.co.id</a>
      </td>
    </tr>
    <tr></tr>
    @elseif ($isregonly == '2')
    <td>Pembayaran Anda sudah kami konfirmasi, terimakasih atas kepercayaannya untuk mengikuti {{$produk}} di IC
      Education,</td>
    @elseif ($isregonly == '3')
    <td>Pembayaran Anda sudah kami konfirmasi, silahkan login ke <a
        href="https://dev.iceducation.co.id/list-materi">dashboard anda</a> untuk mengerjakan ujian ulang anda, terima
      kasih atas kepercayaannya untuk mengikuti {{ $produk }} di IC Education,</td>
    @endif
    {{-- @endif --}}
    </tr>
    @endif
    @if(!empty($username))
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Untuk login ke aplikasi silahkan gunakan:</td>
    </tr>
    <tr>
      <td>Username: {{$username}}</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    @endif
    <tr>
      <td>Atas perhatian dan kerjasamanya kami ucapkan terimakasih</td>
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