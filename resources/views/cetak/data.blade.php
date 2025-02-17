<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px
        }

        .container {
            width: 90%;
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
            padding: 15px;
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
        <table>
            <tr>
                <th colspan="2" class="section-title">Pendaftaran</th>
            </tr>
            <tr>
                <td>
                    Kalender
                    <br>
                    Hari
                    <br>
                    Tanggal
                    <br>
                    Bulan
                    <br>
                    Tahun
                    <br>
                    No. Pendaftaran
                    <br>
                    No. Pangkal
                </td>
                <td>
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}
                    <br>
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd') }}
                    <br>
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D') }}({{ \App\Helpers\TanggalTerbilang::tanggal(\Carbon\Carbon::now()->format('d')) }})
                    <br>
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('MM') }}({{ \App\Helpers\TanggalTerbilang::tanggal(\Carbon\Carbon::now()->format('m')) }})
                    <br>
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('Y') }}({{ \App\Helpers\TanggalTerbilang::tahun(\Carbon\Carbon::now()->format('Y')) }})
                    <br>
                    {{ $transaksi->no_pendaftaran ?? '-' }}
                    <br>
                    {{ $transaksi->no_pangkal ?? '-' }}
                </td>
            </tr>
            <tr>
                <th colspan="2" class="section-title">Debitur</th>
            </tr>
            <tr>
                <td>
                    Nama Debitur
                    <br>
                    NIK
                    <br>
                    Alamat
                    <br>
                    Kelurahan
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
                    {{ $nasabah->tanggal_lahir ? \Carbon\Carbon::parse($nasabah->tanggal_lahir)->format('d F Y') : '-' }}
                    <br>
                    {{ $nasabah->telepon ?? '-' }}
                    <br>
                    {{ $transaksi->pengajuan_pinjaman ?? '-' }}
                    <br>
                    {{ $transaksi->jangka_waktu ?? '-' }}
                    <br>
                    {{ $transaksi->jenis_jaminan ?? '-' }}
                </td>
            </tr>
            <tr>
                <th colspan="2" class="section-title">Appraisal</th>
            </tr>
            <tr>
                <td>
                    Jenis Jaminan
                    <br>
                    Nilai Wajar Pasar
                    <br>
                    Nilai Liquiditas
                    <br>
                    Rekomendasi Pinjaman
                    <br>
                    Jangka Waktu
                    <br>
                    Bunga %
                    <br>
                    Bunga Perbulan
                    <br>
                    Pelunasan
                </td>
                <td>
                    {{ $transaksi->jenis_jaminan ?? '-' }}
                    <br>
                    {{ $transaksi->nilai_pasar_aps ?? '-' }}
                    <br>
                    {{ $transaksi->nilai_likuiditas_aps ?? '-' }}
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
            </tr>
            <tr>
                <th colspan="2" class="section-title">Putusan</th>
            </tr>
            <tr>
                <td>
                    Jenis Jaminan
                    <br>
                    Nilai Wajar Pasar
                    <br>
                    Nilai Liquiditas
                    <br>
                    Rekomendasi Pinjaman
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
                    {{ $transaksi->nilai_pasar_aps ?? '-' }}
                    <br>
                    {{ $transaksi->nilai_likuiditas_aps ?? '-' }}
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
            </tr>
        </table>
        {{-- <table>
            <tr class="section-title">
                <td><strong>1 Bulan</strong></td>
                <td><strong>4 Bulan</strong></td>
                <td><strong>Cabang</strong></td>
            </tr>
            <tr>
                <td>10%</td>
                <td>8%</td>
                <td>Jember</td>
            </tr>
        </table>
        <table class="mb-0">
            <tr>
            </tr>
        </table> --}}
    </div>
</body>

</html>
