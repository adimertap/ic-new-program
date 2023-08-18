<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
</head>

<body
    style="position:relative;margin:0 auto;color:#001028;background:#FFF;font-family:Arial, sans-serif;font-size:12px;font-family:Arial;">
    <header style="padding: 10px 0;">
        <h3>IC EDUCATION</h3>
        <div style="text-align: center;line-height: 7px;">
            <h2 style="text-decoration: underline;">INVOICE</h2>
            <h3>{{ $transaksi->no_invoice }}</h3>
            <h3>Date : {{date('d/m/Y',strtotime($transaksi->updated_at))}}</h3>
        </div>
    </header>
    <table style='width:100%; font-size:8pt; font-family:calibri; border-collapse: collapse;' border="0">
        <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
            <div
                style="border: 1px solid #ddd;width: 250px;align-items:center !important;padding-left: 25px;margin-top: 25px;margin-bottom: 25px;">
                <p style="white-space:nowrap;color:#5D6975;">Bill To:</p>
                <p style="white-space:nowrap;font-weight: bold;">{{$transaksi->user->name}}</p>
            </div>
        </td>
        <td style='vertical-align:top' width='30%' align='left'>
            <div style="margin-top: 25px;margin-bottom: 25px;text-align: right;">
                <p style="font-weight: bold;font-size: 12px;">PT. Indonesia Consultindo Global</p>
                <p>GP Plaza, Unit R3, Ground Floor Jl. Gelora II No. 01, Gelora Jakarta - Pusat<br>Telp:
                    021-225-309-53<br>E-mail: <a href="mailto:info@iceducation.co.id"
                        style="color: #000000;text-decoration: none;">info@iceducation.co.id</a> </p>
            </div>
        </td>
    </table>
    <main style="padding-bottom: 50px;">
        <table style="width:100%;border-collapse:collapse;border-spacing:0;margin-bottom:20px;border: 1px solid #eee;">
            <thead>
                <tr>
                    <th
                        style="text-align:center;padding:5px 20px;color:#5D6975;border-bottom:1px solid #C1CED9;white-space:nowrap;font-weight:400;width: 5px;">
                        NO</th>
                    <th
                        style="text-align:center;padding:5px 20px;color:#5D6975;border-bottom:1px solid #C1CED9;white-space:nowrap;font-weight:400;">
                        DESCRIPTION</th>
                    <th
                        style="text-align:center;padding:5px 20px;color:#5D6975;border-bottom:1px solid #C1CED9;white-space:nowrap;font-weight:400;width: 100px;">
                        AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                <tr style="background: #F5F5F5;">
                    <td style="padding: 15px;text-align: center;vertical-align: top;">1</td>
                    <td style="padding: 15px;text-align: left;vertical-align: top;">Produk {{ $nama_produk }} Hari
                        {{ $produk->kelas }} {{ $isOnline }}
                    </td>
                    <td style="padding: 15px;text-align: right;font-size: 1.2em;">Rp.
                        {{convert_to_rupiah($transaksi->harga_kelas)}}</td>
                </tr>
                <tr style="background: #F5F5F5">
                    <td style="padding-left: 15px;padding-bottom: 15px; text-align: center;vertical-align: top;"></td>
                    <td style="padding-left: 15px;padding-bottom: 15px; text-align: left;vertical-align: top;">Pembelian Produk
                        @if($transaksi->tenor != 'Full')
                        <span style="color: red">dengan Tenor {{ $transaksi->tenor }} %</span>

                        @else
                        <span style="color: red">Lunas</span>
                        @endif
                    </td>
                    <td style="padding-right: 15px;padding-bottom: 15px;text-align: right;font-size: 1.2em;">
                        @if($transaksi->tenor == '75')
                        Rp. {{ convert_to_rupiah($transaksi->harga_kelas *75/100) }}
                        @elseif($transaksi->tenor == '50')
                        Rp. {{ convert_to_rupiah($transaksi->harga_kelas *50/100) }}
                        @elseif($transaksi->tenor == '25')
                        Rp. {{ convert_to_rupiah($transaksi->harga_kelas *25/100) }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top: 7px;text-align: right;">
                        @if($transaksi->type_diskon == 'Angka')
                        Discount &nbsp;({{$transaksi->diskon}})
                        @else
                        Discount {{ $transaksi->diskon }} %
                        @endif
                    </td>
                    <td style="padding-top: 7px;padding-right: 15px;text-align: right;font-size: 1.2em;">
                        Rp. {{convert_to_rupiah($transaksi->total_price)}}
                    </td>
                </tr>
                @if($transaksi->type_pembayaran == 'Otomatis')
                <tr>
                    <td colspan="2" style="padding-top: 7px;text-align: right;">
                        + Biaya Admin
                    </td>
                    <td style="padding-top: 7px;padding-right: 15px;text-align: right;font-size: 1.2em;">
                       {{convert_to_rupiah(5000)}}
                    </td>
                </tr>
                @endif
               
                <tr>
                    <td colspan="2" style="padding-top: 7px;text-align: right;">TOTAL</td>
                    <td style="padding-top: 7px;padding-right: 15px;text-align: right;font-size: 1.2em;">
                        @if($transaksi->type_pembayaran == 'Otomatis')
                        Rp. {{convert_to_rupiah($transaksi->total_price + 5000)}}
                        @else
                        Rp. {{convert_to_rupiah($transaksi->total_price)}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top: 7px;padding-bottom: 15px;text-align: right;">Balance Due</td>
                    <td
                        style="padding-top: 7px;padding-right: 15px;padding-bottom: 15px;text-align: right;font-size: 1.2em;">
                        <?php
                          if ($transaksi->type_diskon == 'Angka') {
                             $afterDiskon = $transaksi->harga_kelas - $transaksi->diskon;
                          }else{
                              $afterDiskon1 = $transaksi->harga_kelas * $transaksi->diskon/100;
                              $afterDiskon = $transaksi->harga_kelas - $afterDiskon1;
                          }

                          $hitung = $afterDiskon - $transaksi->total_price;
                        ?>
                        Rp. {{convert_to_rupiah($hitung)}}
                    </td>
                </tr>
            </tbody>
            <tfoot style="line-height: 18px;">
                <tr>
                    <td colspan="3" style="color:#5D6975;border-top:1px solid #eee;font-size: 1em;padding-left: 15px;">
                        AMOUNT IN
                        WORDS :</td>
                </tr>
                <tr>
                    <td colspan="3" style="color:#5D6975;font-size: 1em;padding-left: 15px;">#
                        {{ucwords(terbilang($transaksi->total_price + 5000))}} #
                    </td>
                </tr>
                @if($transaksi->type_pembayaran == 'Manual')
                  <tr>
                    <td colspan="3" style="color:#5D6975;font-size: 1em;border-top:1px solid #eee;padding-left: 15px;">
                        Please
                        Transfer Payment to:</td>
                </tr>
                <tr>
                    <td colspan="3" style="color:#5D6975;font-size: 1em;padding-left: 15px;">PT. Indonesia Consultindo
                        Global</td>
                </tr>
                <tr>
                    <td colspan="3" style="color:#5D6975;font-size: 1em;padding-left: 15px;">Bank Mandiri A/C No.
                        124-00-0677713-1
                    </td>
                </tr>
                @else
                <tr>
                  <td colspan="3" style="color:#5D6975;font-size: 1em;border-top:1px solid #eee;padding-left: 15px;">
                      Powered By: Midtrans Automatic Payment</td>
                  </tr>
                @endif
               
            </tfoot>
        </table>
        <table style="float: right;text-align: center;padding-left: 15px;padding-right: 30px;" border="0">
            <tr>
                <td>Jakarta, {{date('d M Y',strtotime($transaksi->updated_at))}}</td>
            </tr>
            <tr>
                <td>Finance</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Novita Mardika</td>
            </tr>
        </table>
    </main>
</body>

</html>
