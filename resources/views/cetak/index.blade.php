<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px
        }

        .container {
            width: 80%;
            margin: auto;
        }

        h2 {
            text-align: center;
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
            text-align: left;
        }

        .header {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        .section-title {
            font-weight: bold;
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">Gadai Kita</div>
        <h2>Form Pendaftaran</h2>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }} &nbsp;&nbsp;&nbsp; <strong>No. Pendaftaran:</strong> 001/Pend-01/2025</p>
        <p><strong>Pangkal:</strong> 012</p>

        <table>
            <tr>
                <th colspan="2" class="section-title">Pendaftaran</th>
            </tr>
            <tr>
                <td>
                    Nama Debitur
                    <br>
                    NIK
                    <br>
                    Alamat
                    <br>
                    Kecamatan
                    <br>
                    Kabupaten
                    <br>
                    Provinsi
                    <br>
                    Tempat Lahir
                    <br>
                    Tanggal Lahir
                    <br>
                    Nomor HP
                    <br>
                    Pengajuan Pinjaman
                    <br>
                    Jangka Waktu
                    <br>
                    Jenis Jaminan
                </td>
                <td>
                    {{ $nasabah->nama_lengkap }}
                    <br>
                    {{ $nasabah->nomor_identitas }}
                    <br>
                    {{ $nasabah->alamat_lengkap }}
                    <br>
                    {{ $nasabah->kelurahan }}
                    <br>
                    {{ $nasabah->kecamatan }}
                    <br>
                    {{ $nasabah->kabupaten }}
                    <br>
                    {{ $nasabah->propinsi }}
                    <br>
                    {{ $nasabah->tempat_lahir }}
                    <br>
                    {{ \Carbon\Carbon::parse($nasabah->tanggal_lahir)->format('d F Y') }}
                    <br>
                    {{ $nasabah->telepon }}
                    <br>
                    {{ $transaksi->pengajuan_pinjaman }}
                    <br>
                    {{ $transaksi->jangka_waktu }}
                    <br>
                    {{ $transaksi->jenis_jaminan }}
                    <br>
                </td>
            </tr>
            <tr>
                <td colspan="2">Tanda Tangan customer service :</td>
            </tr>
            <tr>
                <td colspan="2">Tanda Tangan debitur :</td>
            </tr>
            <tr>
                <th colspan="2" class="section-title">Appraisal</th>
            </tr>
            <tr>
                <td>
                    Jenis Jaminan
                    <br>
                    Nilai Pasar Wajar
                    <br>
                    Nilai Likuiditas
                </td>
                <td>
                    {{ $transaksi->jenis_jaminan }}
                    <br>
                    {{ $transaksi->nilai_pasar }}
                    <br>
                    {{ $transaksi->nilai_likuiditas }}
                </td>
            </tr>
            <tr>
                <td colspan="2">Tanda tangan appraisal :</td>
            </tr>
            <tr>
                <th colspan="2" class="section-title">Putusan</th>
            </tr>
            <tr>
                <td>
                    Jenis Jaminan
                    <br>
                    Nilai Pasar Wajar
                    <br>
                    Nilai Likuiditas
                    <br>
                    Putusan Pinjaman
                    <br>
                    Jangka Waktu
                    <br>
                    Bunga %
                    <br>
                    Bunga Perbulan
                    <br>
                    Pelunasan
                    <br>
                    Biaya Administrasi
                </td>
                <td>
                    {{ $transaksi->jenis_jaminan }}
                    <br>
                    {{ $transaksi->nilai_pasar }}
                    <br>
                    {{ $transaksi->nilai_likuiditas }}
                    <br>
                    {{ $transaksi->putusan_pinjaman }}
                    <br>
                    {{ $transaksi->jangka_waktu }}
                    <br>
                    {{ $transaksi->bunga }}
                    <br>
                    {{ $transaksi->bunga_perbulan }}
                    <br>
                    {{ $transaksi->pelunasan }}
                    <br>
                    {{ $transaksi->biaya_administrasi }}
                </td>
            </tr>
            <tr>
                <td colspan="2">Tanda tangan pemutus :</td>
            </tr>
        </table>
    </div>
</body>

</html>
