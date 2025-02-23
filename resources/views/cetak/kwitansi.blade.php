<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kwitansi</title>
    @php
        $logoPath1 = public_path('img/gadaibiru.png');
        $logoPath2 = public_path('img/sanbiru.png');
        $logoPath3 = public_path('img/backgroundkwitansi.png');

        $type1 = pathinfo($logoPath1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($logoPath1);
        $base64Logo1 = 'data:image/' . $type1 . ';base64,' . base64_encode($data1);

        $type2 = pathinfo($logoPath2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($logoPath2);
        $base64Logo2 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);

        $type3 = pathinfo($logoPath3, PATHINFO_EXTENSION);
        $data3 = file_get_contents($logoPath3);
        $base64Logo3 = 'data:image/' . $type3 . ';base64,' . base64_encode($data3);
    @endphp

    <style>
        body {
            font-family: Arial, sans-serif;
            color: rgb(4, 80, 232);
            font-weight: bold;
            margin: 0;
            padding: 5px;
            line-height: 1.2;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 70;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ $base64Logo3 }}');
            background-position: top;
            background-repeat: no-repeat;
            opacity: 0.3;
        }


        /* .keterangan {
            margin-left: 500px;
            font-size: 13px;
        }

        .keterangan-hari {
            margin-top: 30px;
        } */

        .header {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .logo img {
            height: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-left: none;
            border-right: none;
        }

        th,
        td {
            border: 1px solid rgb(4, 80, 232);
            padding: 5px;
        }

        .angsuran {
            color: red;
            margin: 0;
            padding: 0;
        }

        .angsuran li {
            margin-left: 10px;
            padding: 0;
        }

        table tr td p {
            margin: 3px 0;
        }

        h3 {
            position: absolute;
            top: 55px;
            margin-left: 42%;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <img src="{{ $base64Logo1 }}" alt="Logo Gadai" style="width: 15%; height: auto; position: absolute; top: 0; left: 0;">
    <img src="{{ $base64Logo2 }}" alt="Logo Sigma" style="width: 15%; height: auto; position: absolute; top: 0; right: 0;">
    <p style="position: absolute; top: 15px; margin-left: 35%; font-size: 11px; font-weight: normal;">0021-01-004130-56-0</p>
    <p style="position: absolute; top: 35px; margin-left: 35%; font-size: 11px; font-weight: normal;">PT. SIGMA ARTHA NUSANTARA</p>
    <table style="margin-left: 490px; margin-top: 20px; margin-bottom: 10px; width: 30%; border-collapse: collapse;">
        <tr>
            <td style="font-size: 11px; border: none; padding: 2;">HARI</td>
            <td style="font-size: 11px; border: none; padding: 2;">: {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd') }}</td>
        </tr>
        <tr>
            <td style="font-size: 11px; border: none; padding: 2;">TANGGAL</td>
            <td style="font-size: 11px; border: none; padding: 2;">: {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</td>
        </tr>
        <tr>
            <td style="font-size: 11px; border: none; padding: 2;">SPH NO</td>
            <td style="font-size: 11px; border: none; padding: 2;">:</td>
        </tr>
    </table>

    <hr style="position: absolute; top: 40; left: 0; width: 100%;">
    <h3 style="position: absolute; top: 40; margin-left: 43%">KWITANSI</h3>
    <table>
        <tr>
            <th style="border-left: none;">URAIAN</th>
            <th style="border-right: none;">JUMLAH</th>
        </tr>
        <tr>
            <td style="border-left: none;">
                <p>Telah dibayar pinjaman a.n   {{ $nasabah->nama_lengkap }}</p>
                <p>Sebesar {{ $transaksi->putusan_pinjaman }}</p>
                <p>Angsuran :</p>
                <table style="width: 60%; border-collapse: collapse;">
                    <tr>
                        <td style="border: none; padding: 1;">- Bunga per bulan</td>
                        <td class="angsuran" style="border: none; padding: 2;">: {{ $transaksi->bunga_perbulan }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 1;">- Pelunasan</td>
                        <td class="angsuran" style="border: none; padding: 2;">: {{ $transaksi->pelunasan }}</td>
                    </tr>
                </table>
                <table style="width: 70%;">
                    <tr>
                        <td style="border: none; padding: 0;">Pembayaran paling lambat tanggal :</td>
                        <td class="angsuran" style="border: none; padding: 0;">{{ \Carbon\Carbon::now()->addMonths((int) str_replace(' Bulan', '', $transaksi->jangka_waktu))->locale('id')->isoFormat('D') }}</td>
                    </tr>
                </table>
                <p>Dengan perjanjian gadai berupa barang :</p>
                <p class="angsuran">{{ $transaksi->jenis_jaminan }}</p>
            </td>
            <td style="border-right: none; padding-left: 70px;">
                <P>{{ $transaksi->putusan_pinjaman }}</P>
                <p></p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td style="border-left: none;">
                <p class="text-right">JUMLAH</p>
                <p>TERBILANG : {{ \App\Helpers\JutaanTerbilang::convert($transaksi->putusan_pinjaman) }} rupiah</p>
            </td>
            <td style="border-right: none;  padding-left: 50px;">
                <p>{{ $transaksi->putusan_pinjaman }}</p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
            </td>
        </tr>
    </table>
    <table style="border-collapse: collapse; width: 100%; border: none; margin: 0;">
        <tr>
            <td style="text-align: center; border: none;"></td>
            <td style="text-align: center; border: none;">PETUGAS</td>
            <td style="text-align: center; border: none;"></td>
            <td style="text-align: center; border: none;">DEBITUR</td>
        </tr>
        <tr>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;"></td>
            <td style="border: none;">
                <p style="text-align: center; font-weight: normal; font-size: 10px" >materai</p>
                <p style="text-align: center; font-weight: normal; font-size: 10px" >10.000</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 0; border: none;">
                <p style="text-align: center;">______________</p>
                <p style="text-align: center;">Approval</p>
            </td>
            <td style="padding: 0; border: none;">
                <p style="text-align: center;">______________</p>
                <p style="text-align: center;">Apprisal</p>
            </td>
            <td style="padding: 0; border: none;">
                <p style="text-align: center;">______________</p>
                <p style="text-align: center;">Customer Service</p>
            </td>
            <td style="padding: 0; border: none;">
                <p style="text-align: center;">______________</p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
            </td>
        </tr>
    </table>
</body>

</html>
