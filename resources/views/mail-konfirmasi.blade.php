<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Informasi {{ $produk == "seminar" ? "Pendaftaran" : "Pembayaran" }}</title>
</head>

<body>
  @if($produk == "seminar")
  <table border="0">
    <tr>
      <td colspan="3">Dear Bpk/Ibu {{ $nama }}</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">Selamat, anda sudah terdaftar mengikuti Seminar Online <span
          style="color: yellowgreen;font-size:24px;">NGO</span><span style="color: blue;font-size:24px;">P</span><span
          style="color: red;font-size:24px;">I</span> <span style="font-size:14px;">Ngobrol Pajak bareng IC</span> :
      </td>
    </tr>
    <tr>
      <td style="width: 130px;">Nama</td>
      <td style="width: 5px;">:</td>
      <td>{{ $nama }}</td>
    </tr>
    <tr>
      <td style="width: 130px;">Nomor HP</td>
      <td style="width: 5px;">:</td>
      <td>{{ $no_hp }}</td>
    </tr>
    <tr>
      <td style="width: 130px;">E-Mail</td>
      <td style="width: 5px;">:</td>
      <td>{{ $email }}</td>
    </tr>
    <tr>
      <td style="width: 130px;">Tanggal Seminar</td>
      <td style="width: 5px;">:</td>
      <td>{{ tgl_indo($tgl_mulai) }}</td>
    </tr>
    <tr>
      <td style="width: 130px;">Jam Seminar</td>
      <td style="width: 5px;">:</td>
      <td>{{ $jam_mulai }}</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">Seminar akan menggunakan Aplikasi ZOOM.</td>
    </tr>
    <tr>
      <td colspan="3">Silahkan download aplikasinya melalui link ini :</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">Android Klik : <a href="https://s.id/g7klX">https://s.id/g7klX</a></td>
    </tr>
    <tr>
      <td colspan="3">Iphone Klik : <a href="https://s.id/g5CA7">https://s.id/g5CA7</a></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">==LINK MEETING BARU BISA DIBUKA SAAT SEMINAR DIMULAI==</td>
    </tr>
    <tr>
      <td colspan="3">Untuk masuk ke Ruang Meeting di ZOOM :</td>
    </tr>
    <tr>
      <td colspan="3">klik <a
          href="https://us02web.zoom.us/j/2593263186?pwd=WmZ2OEQ2RkRJR1JqMGR4ekNuTG40dz09">https://us02web.zoom.us/j/2593263186?pwd=WmZ2OEQ2RkRJR1JqMGR4ekNuTG40dz09</a>
      </td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td style="width: 130px;">Meeting ID</td>
      <td style="width: 5px;">:</td>
      <td>2593263186</td>
    </tr>
    <tr>
      <td style="width: 130px;">Password Meeting</td>
      <td style="width: 5px;">:</td>
      <td>NgopiIC</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">Masih ada beberapa tempat, Silahkan ajak rekan anda lainnya untuk Daftar di Seminar ini.</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">Note :</td>
    </tr>
    <tr>
      <td colspan="3">Bagi yang ingin mendapatkan sertifikat,</td>
    </tr>
    <tr>
      <td colspan="3">Silahkan investasi Rp. 50,000,- Ke nomer rekening Bank Mandiri: 1240006777131</td>
    </tr>
    <tr>
      <td colspan="3">A.n : PT Indonesia Consultindo Global</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">Jika Anda memiliki pertanyaan, silakan hubungi Customer Service kami melalui email <a
          href="mailto:info@iceducatio.co.id">info@iceducatio.co.id</a> atau WA/Call 08111-474-251.</td>
    </tr>
    <tr>
      <td colspan="3">Mohon tidak mengirimkan balasan ke email ini.</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">Salam</td>
    </tr>
    <tr>
      <td colspan="3">Panitia Seminar Online</td>
    </tr>
    <tr>
      <td colspan="3"><span style="color: yellowgreen;font-size:24px;">NGO</span><span
          style="color: blue;font-size:24px;">P</span><span style="color: red;font-size:24px;">I</span> <span
          style="font-size:14px;">Ngobrol Pajak bareng IC</span></td>
    </tr>
  </table>
  @else
  <p>Dear {{$nama}}</p>
  <p>Terimakasih sudah melakukan pendaftaran di IC Education dan {{ $produk == "seminar" ? "Persyaratan" : "Pembayaran"
    }} Anda terkonfirmasi sudah kami terima.</p>
  <p><img style="width: 50px;height: auto;" src="{{ URL::asset('/images/sukses.png') }}" /></p>
  <p style="margin-top: -22px;font-style: italic;">{{ $produk == "seminar" ? "Persyaratan" : "Pembayaran" }} sukses</p>
  <p>Jika Anda memiliki pertanyaan, silakan hubungi Customer Service kami melalui email <a
      href="mailto:info@iceducatio.co.id">info@iceducatio.co.id</a> atau WA/Call 08111-474-251.</p>
  <p>Mohon tidak mengirimkan balasan ke email ini.</p>
  </br>
  <p>Hormat kami</p>
  <p>Admin IC Education</p>
  @endif
</body>

</html>