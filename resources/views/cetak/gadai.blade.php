<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Gadai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px
        }

        .container {
            width: 80%;
            margin: auto;
        }

        h1 {
            text-align: center;
        }
        h2 {
            text-align: center;
        }
        .text-right {
            text-align: right;
            font-size: 13px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 20px;
            text-align: center;
        }
        .mr {
            margin-right: 75px;
        }
    </style>
</head>
<body>
    <h2>PENYERAHAN HAK KEPEMILIKAN SECARA</h2>
    <h2>KEPERCAYAAN TERHADAP BARANG</h2>
    <br>
    <p class="text-right">Jember, Tanggal : {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</p>
    <p class="text-right">Kepada Yth. Direktur PT. Sigma Artha Nusantara</p>
    <p class="text-right">di Jember</p>
    <br>
    <p>Dengan Hormat,</p>
    <p>
        Sesuai dengan Perjanjian Penyerahan hak kepemilikan secara kepercayaan terhadap barang antara PT. Sigma Artha
        Nusantara dengan kami,  Nomor :	{{ $transaksi->no_pendaftaran }}	tanggal	{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}
        dengan  ini  kami  menyerahkan  hak  kepemilikan  secara  Kepercayaan  terhadap  barang  -  barang  yang  tersebut
        dibawah  ini,  penyerahan mana telah diterima  baik  oleh  PERUSAHAAN dan sejak  penyerahan ini barang - barang
        tersebut menjadi milik PERUSAHAAN.
    </p>
    <br>
    <table>
        <tr>
            <th>Barang - barang yang diserahkan</th>
            <th>Bukti Kepemilikan / pembelian barang ( jenis dan nomor )</th>
            <th>Harga Taksiran (Rp)    (Nilai Likuidasi )</th>
            <th>Tempat penyimpanan barang - barang</th>
        </tr>
        <tr>
            <td>{{ $transaksi->jenis_jaminan }}</td>
            <td></td>
            <td>{{ $transaksi->nilai_likuiditas_apv }}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">Jumlah</td>
            <td colspan="2">{{ $transaksi->nilai_likuiditas_apv }}</td>
        </tr>
    </table>
    <p>{{ \App\Helpers\Terbilang::convert($transaksi->nilai_likuiditas_apv) }} rupiah</p>
    <p>
        Selanjutnya kami menerangkan bahwa pada saat ini juga kami telah menerima kembali barang - barang tersebut dari PERUSAHAAN, untuk kami simpan / pergunakan dengan sebaik - baiknya untuk dan atas nama PERUSAHAAN, serta dengan ini kami berjanji dan sanggup memelihara / merawat barang - barang tersebut dengan baik dan dengan segala resiko dan menjadi tanggung jawab kami.
    </p>
    <p>
        Demikian surat penyerahan ini dibuat dengan sebenarnya.
    </p>
    <br>
    <p class="text-right mr">Hormat saya,</p>
    <br>
    <br>
    <br>
    <br>
    <p class="text-right mr">{{ $nasabah->nama_lengkap }}</p>
    {{-- <table class="tablettd">
        <tr>
            <td class"ttd"><strong>Hormat saya,</strong></td>
        </tr>
        <br>
        <tr>
            <td class"ttd"><span class="underlinettd">Siti Junariyah</span></td>
        </tr>
    </table> --}}
</body>
</html>
