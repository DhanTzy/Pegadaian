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

        .fontarial {
            font-family: "Arial Black", sans-serif;
            font-size: 40px;
            font-weight: bold;
            color: #0044cc;
            text-align: center;
            background: linear-gradient(to bottom, #0066ff, #0033cc);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
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
@php
    $logoPath = public_path('img/gadai.png');

    $type = pathinfo($logoPath, PATHINFO_EXTENSION);
    $data = file_get_contents($logoPath);
    $base64Logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
@endphp

<body>
    <div class="container">
        <img src="{{ $base64Logo }}" alt="Logo" style="width: 15%; height: auto; position: absolute; margin-top: 5px; margin-left: 5px;">
        <table>
            <tr>
                <td colspan="2" class="fontarial">Form Pendaftaran</td>
            </tr>
            <tr>
                <td style="padding: 0px; border-right: none;">
                        <p style="margin-left: 20px"><strong>Tanggal:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }} &nbsp;&nbsp;&nbsp;</p>
                        <p style="margin-left: 20px"><strong>Pangkal:</strong> {{ $transaksi->no_pangkal }}</p>
                </td>
                <td style="padding: 0px; border-left: none;">
                    <p style="margin-left: 20px"><strong>No.Pendaftaran:</strong> {{ $transaksi->no_pendaftaran }}</p>
                    <p></p>
                    <br>
                </td>
            </tr>
            <tr>
                <th colspan="2" class="section-title">Pendaftaran</th>
            </tr>
            <tr>
                <td
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
                    {{ $nasabah->nama_lengkap ?? '-' }}
                    <br>
                    {{ $nasabah->nomor_identitas ?? '-' }}
                    <br>
                    {{ $nasabah->alamat_lengkap ?? '-' }}
                    <br>
                    {{ $nasabah->kelurahan ?? '-' }}
                    <br>
                    {{ $nasabah->kecamatan ?? '-' }}
                    <br>
                    {{ $nasabah->kabupaten ?? '-' }}
                    <br>
                    {{ $nasabah->propinsi ?? '-' }}
                    <br>
                    {{ $nasabah->tempat_lahir ?? '-' }}
                    <br>
                    {{ $nasabah->tanggal_lahir ? \Carbon\Carbon::parse($nasabah->tanggal_lahir)->format('d-m-Y') : '-' }}
                    <br>
                    {{ $nasabah->telepon ?? '-' }}
                    <br>
                    {{ $transaksi->pengajuan_pinjaman ?? '-' }}
                    <br>
                    {{ $transaksi->jangka_waktu ?? '-' }}
                    <br>
                    {{ $transaksi->jenis_jaminan ?? '-' }}
                    <br>
                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; padding: 30px;">Tanda Tangan customer service :</td>
                <td style="font-size: 10px; padding: 30px;">Tanda Tangan debitur :</td>
            </tr>
            <tr>
                <th colspan="2" class="section-title">Appraisal</th>
            </tr>
            <tr>
                <td
                    Jenis Jaminan
                    <br>
                    Nilai Pasar Wajar
                    <br>
                    Nilai Likuiditas
                </td>
                <td>
                    {{ $transaksi->jenis_jaminan ?? '-' }}
                    <br>
                    {{ $transaksi->nilai_pasar_aps ?? '-' }}
                    <br>
                    {{ $transaksi->nilai_likuiditas_aps ?? '-' }}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 10px; padding: 30px;">Tanda tangan appraisal :</td>
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
                    {{ $transaksi->jenis_jaminan ?? '-' }}
                    <br>
                    {{ $transaksi->nilai_pasar_apv ?? '-' }}
                    <br>
                    {{ $transaksi->nilai_likuiditas_apv ?? '-' }}
                    <br>
                    {{ $transaksi->putusan_pinjaman ?? '-' }}
                    <br>
                    {{ $transaksi->jangka_waktu ?? '-' }}
                    <br>
                    {{ $transaksi->bunga ?? '-' }}
                    <br>
                    {{ $transaksi->bunga_perbulan ?? '-' }}
                    <br>
                    {{ $transaksi->pelunasan ?? '-' }}
                    <br>
                    {{ $transaksi->biaya_administrasi ?? '-' }}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 10px; padding: 30px;">Tanda tangan pemutus :</td>
            </tr>
        </table>
    </div>
</body>

</html>
