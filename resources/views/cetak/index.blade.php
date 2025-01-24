<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Transaksi</title>
</head>

<body>
    <h1 style="text-align: center;">Cetak Data Transaksi</h1>
    <table border="1" cellpadding="5" cellspacing="0"
        style="width: 100%; border-collapse: collapse; text-align: center;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Debitur</th>
                <th>Pengajuan Pinjaman</th>
                <th>Jangka Waktu</th>
                <th>Putusan Pinjaman</th>
                <th>Bunga</th>
                <th>Bunga Perbulan</th>
                <th>Pelunasan</th>
                <th>Biaya Administrasi</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 20; $i++)
                <tr>
                    <td>1</td>
                    <td>Debitur 1</td>
                    <td>Rp 10.000.000</td>
                    <td>1 Bulan</td>
                    <td>Rp 10.000.000</td>
                    <td>Rp 10.000.000</td>
                    <td>0</td>
                    <td>0</td>
                    <td>Rp 10.000.000</td>
                </tr>
            @endfor
        </tbody>
    </table>
</body>

</html>
