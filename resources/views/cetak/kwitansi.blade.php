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


        .keterangan {
            margin-left: 500px;
            font-size: 13px;
        }

        .keterangan-hari {
            margin-top: 30px;
        }

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

        hr {
            position: absolute;
            top: 50px;
            left: 0;
            width: 100%;
            color: rgb(116, 255, 66);
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
    <img src="{{ $base64Logo1 }}" alt="Logo Gadai" style="width: 20%; height: auto; position: absolute; top: 0; left: 0;">
    <img src="{{ $base64Logo2 }}" alt="Logo Sigma"
        style="width: 15%; height: auto; position: absolute; top: 0; right: 0;">
    <P class="keterangan keterangan-hari">Hari : {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd') }}</P>
    <P class="keterangan">Tanggal : {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</P>
    <P class="keterangan">SPH No :</P>
    <hr style="position: absolute; top: 60; left: 0; width: 100%; color: rgb(116, 255, 66);">
    <h3 style="position: absolute; top: 60; margin-left: 40%">KWITANSI</h3>
    <table>
        <tr>
            <th style="border-left: none;">URAIAN</th>
            <th style="border-right: none;">JUMLAH</th>
        </tr>
        <tr>
            <td style="border-left: none;">
                <p>Telah dibayar pinjaman a.n {{ $nasabah->nama_lengkap }}</p>
                <p>Sebesar {{ $transaksi->putusan_pinjaman }}</p>
                <p class="angsuran">Angsuran :</p>
                <ul class="angsuran">
                    <li>Bunga per bulan : {{ $transaksi->bunga_perbulan }}</li>
                    <li>Pelunasan : {{ $transaksi->pelunasan }}</li>
                </ul>
                <p class="angsuran">Pembayaran paling lambat tanggal : {{ \Carbon\Carbon::now()->addMonths((int) str_replace(' Bulan', '', $transaksi->jangka_waktu))->locale('id')->isoFormat('D') }}</p>
                <p>Dengan perjanjian gadai berupa barang : {{ $transaksi->jenis_jaminan }}</p>
            </td>
            <td style="border-right: none;">
                <P>{{ $transaksi->putusan_pinjaman }}</P>
                <p></p>
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
            <td style="border-right: none;">
                <p>{{ $transaksi->putusan_pinjaman }}</p>
                <p></p>
                <p></p>
            </td>
        </tr>
    </table>
    <table style="border-collapse: collapse; width: 100%; border: none;">
        <tr>
            <td style="border: none; padding: 10px; text-align: center;">
                <p></p>
                <p></p>
                <br>
                <br>
                <br>
                <p style="text-align: center;">______________</p>
                <p style="text-align: center;">Approval</p>
            </td>
            <td style="border: none; padding: 10px; text-align: center;">
                <p style="text-align: center;">PETUGAS</p>
                <br>
                <br>
                <p style="text-align: center;">______________</p>
                <p style="text-align: center;">Appraisal</p>
            </td>
            <td style="border: none; padding: 10px; text-align: center;">
                <p></p>
                <p></p>
                <br>
                <br>
                <br>
                <p style="text-align: center;">______________</p>
                <p style="text-align: center;">Customer Service</p>
            </td>
            <td style="border: none; padding: 10px; text-align: center;">
                <p style="text-align: center;">DEBITUR</p>
                <br>
                <p style="text-align: center;">(materai 10.000)</p>
                <p style="text-align: center;">______________</p>
                <p></p>
                <p></p>
            </td>
        </tr>
    </table>
</body>

</html>
