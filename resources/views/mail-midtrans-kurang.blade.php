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
   
    <tr>
      <td>
        Pembayaran Cicilan Kelas {{ $produk }} sebesar Rp. {{ $besaran }} dapat dibayarkan melalui link berikut Ini:
    </tr>
    <tr></tr>
    <tr></tr>
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