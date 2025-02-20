<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak SPH</title>
    <style>
        body {
            font-family: " Arial", sans-serif;
            text-align: center;
            font-size: 13px;
            margin: 0;
            padding: 0;
        }

        h1,
        h2 {
            text-align: center;
        }

        h3 {
            margin: 0;
        }

        .content {
            text-align: justify;
        }

        .ttd {
            text-align: right;
            margin-top: 3cm;
        }

        .ttd p {
            margin-bottom: 4cm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        td {
            padding: 10px;
        }

        .text-center {
            text-align: center;
            font-size: 15px;
        }
        .text-right {
            text-align: right;
            font-size: 13px;
        }
        body {
            font-family: Arial, sans-serif;
        }
        .tablettd {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            border-collapse: collapse;
            text-align: center;
            height: 200px;
        }
        .ttd {
            padding: 20px;
            vertical-align: bottom;
        }
        .underline {
            display: inline-block;
            border-top: 1px solid black;
            padding-top: 5px;
            margin-top: 30px;
        }
    </style>
</head>
@php
    $logoPath = public_path('img/sigma.png');

$type = pathinfo($logoPath, PATHINFO_EXTENSION);
$data = file_get_contents($logoPath);
$base64Logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
@endphp
<body>
    <div class="content">
        <img src="{{ $base64Logo }}" alt="Logo" style="width: 20%; height: auto;">
        <h2>Surat Pengakuan Hutang</h2>
        <br>
        <p class="text-center">
            No SPH : .......
        </p>
        <p>
            Untuk Kepentingan PT Sigma Artha Nusantara. sebagai Badan Hukum yang berkedudukan di Jember berdasarkan
            Modal Dasar PT Sigma Artha Nusantara yang dimuat dalam Akta Nomor 4 tanggal 30 Oktober 2024 yang dibuat
            dihadapan Satria Pandutama, SH, MKn, Notaris di Royal City Cluster Sidney D 21/25 Jember yang telah mendapat
            Penerimaan Modal Dasar dari Menteri Hukum dan HAM RI Nomor AHU-0086493.AH.01.01.TAHUN 2024 Tanggal 31
            Oktober, bertindak untuk dan atas nama PT Sigma Artha Nusantara.
        </p>
        <p>
            Pada hari ini {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }} yang bertanda tangan dibawah ini :
        </p>
        <table style="width: 100%; margin-left: 20px;">
            <tr>
                <td>Nama</td>
                <td>: {{ $nasabah->nama_lengkap ?? "-" }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $nasabah->nomor_identitas ?? "-" }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $nasabah->alamat_lengkap ?? "-" }}</td>
            </tr>
            <tr>
                <td>Kelurahan</td>
                <td>: {{ $nasabah->kelurahan ?? "-" }}</td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>: {{ $nasabah->kecamatan ?? "-" }}</td>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td>: {{ $nasabah->kabupaten ?? "-" }}</td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td>: {{ $nasabah->propinsi ?? "-" }}</td>
            </tr>
        </table>
        <p>
            dengan ini menggabungkan diri masing-masing untuk menanggung hutang sejumlah dibawah ini atau segala hutang
            yang akan timbul sehubungan dengan Surat Pengakuan Hutang ini, sehingga dengan demikian baik bersama-sama
            maupun sendiri-sendiri atau salah seorang saja menanggung segala hutang (hoofdelijk), selanjutnya disebut
            YANG BERHUTANG, menyatakan mengaku berhutang kepada PT. Sigma Artha Nusantara selanjutnya disebut
            PERUSAHAAN,
            karena telah menerima uang sebagai pinjaman GADAI KITA sejumlah {{ $transaksi->putusan_pinjaman ?? "-"}} menurut syarat - syarat dan
            ketentuan-ketentuan sebagaimana tersebut dibawah ini :
        </p>
        <p class="text-center">Pasal 1</p>
        <p class="text-center">JUMLAH PENGGUNAAN PINJAMAN</p>
        <ol>
            <li>
                YANG BERHUTANG telah menerima dari PERUSAHAAN sejumlah uang sebagai pokok PERUSAHAAN
                sebesar {{ $transaksi->putusan_pinjaman ?? "-"}}
            </li>
            <li>
                HUTANG yang diterima oleh YANG BERHUTANG dari PERUSAHAAN dipergunakan untuk keperluan Rumah Tangga
            </li>
        </ol>
        <p class="text-center">Pasal 2</p>
        <p class="text-center">SUKU BUNGA, JANGKA WAKTU, ANGSURAN, DAN PELUNASAN MAJU</p>
        <ol>
            <li>
                YANG BERHUTANG wajib melunasi seluruh kewajibannya, namun tidak terbatas pada tagihan pokok,
                bunga, denda dan biaya lainnya (apabila ada) kepada PERUSAHAAN pada tanggal {{ \Carbon\Carbon::now()->addMonths((int) str_replace(' Bulan', '', $transaksi->jangka_waktu))->locale('id')->isoFormat('D MMMM Y') }}
                (selanjutnya disebut Tanggal Jatuh Tempo).
            </li>
            <li>
                Atas HUTANG yang diterimanya, YANG BERHUTANG wajib membayar bunga sebesar {{ $transaksi->bunga ?? "-"}} per bulan
            </li>
            <li>
                YANG BERHUTANG wajib melakukan pembayaran pokok dan bunga HUTANG dengan ketentuan sebagai
                berikut:
                <ul>
                    <li>
                        Pokok HUTANG berikut bunganya harus dibayar kembali oleh YANG BERHUTANG pada saat Tanggal
                        Jatuh Tempo dengan total sebesar {{ $transaksi->putusan_pinjaman ?? "-"}} {{ \App\Helpers\JutaanTerbilang::convert($transaksi->putusan_pinjaman) }} rupiah
                    </li>
                    <li>
                        Bunga HUTANG wajib dibayar kembali oleh YANG BERHUTANG setiap bulannya masing - masing sebesar
                        sebesar {{ $transaksi->bunga_perbulan ?? "-"}} {{ \App\Helpers\Rupiah::convert($transaksi->bunga_perbulan) }} rupiah selambat - lambatnya
                        setiap tanggal {{ \Carbon\Carbon::now()->addMonths((int) str_replace(' Bulan', '', $transaksi->jangka_waktu))->locale('id')->isoFormat('D') }} hingga seluruh kewajibannya dinyatakan lunas oleh PERUSAHAAN.
                        Pokok HUTANG wajib dibayar oleh YANG BERHUTANG secara sekaligus pada Tanggal Jatuh Tempo.
                    </li>
                    <li>
                        YANG BERHUTANG dapat mengajukan permohonan perpanjangan jatuh tempo apabila tidak dapat
                        melakukan
                        pelunasan, dengan cara membayar sebagian pokok sesuai perhitungan PERUSAHAAN apabila PERUSAHAAN
                        menganggap terjadi penurunan nilai atau harga jaminan.
                    </li>
                    <li>
                        YANG BERHUTANG wajib melunasi seluruh kewajiban bunga tertunggak apabila akan mengajukan
                        permohonan
                        perpanjangan jatuh tempo.
                    </li>
                </ul>
                <p>
                    Dalam hal tanggal pembayaran angsuran tersebut jatuh pada hari libur, maka angsuran harus dibayar oleh YANG
                    BERHUTANG pada hari kerja sebelumnya.
                </p>
            </li>
            <li>
                Pembayaran pokok berikut bunga HUTANG sebagaimana disebutkan dalam ayat 1 dan ayat 2 Pasal ini, dapat
                bersumber dari penjualan atau lelang barang yang telah dijaminan dan disimpan di PERUSAHAAN yaitu berupa
                barang {{ $transaksi->jenis_jaminan ?? "-"}} Untuk kepentingan dimaksud, maka YANG BERHUTANG mem -
                berikan kuasa dalam SURAT PENGAKUAN HUTANG ini kepada PERUSAHAAN untuk menjual atau melelang jaminan
                tanpa perlu dibuatkan Surat Kuasa terpisah.
            </li>
            <li>
                Apabila YANG BERHUTANG melunasi HUTANG sebelum berakhirnya jangka waktu HUTANG (pelunasan maju), maka atas pelunasan maju tersebut YANG BERHUTANG berkewajiban membayar :
                <ul>
                    <li>
                        Sisa Pokok*,
                    </li>
                    <li>
                        Kewajiban Bunga hingga jatuh tempo,
                    </li>
                    <li>
                        Denda/Pinalti keterlambatan pembayaran,
                    </li>
                </ul>
            </li>
        </ol>
        <p class="text-center">Pasal 3</p>
        <p class="text-center">DENDA DAN BIAYA - BIAYA</p>
        <ol>
            <li>
                YANG BERHUTANG harus membayar :
                <ul>
                    <li>
                        Biaya administrasi sebesar {{ $transaksi->biaya_administrasi ?? "-"}}
                    </li>
                    <li>
                        Asuransi
                    </li>
                </ul>
                <p>
                    Biaya-biaya tersebut dibayar sekaligus lunas saat pencairan, otomatis dikurangi dari uang hasil pencairan pinjaman  setelah penandatangan Surat Pengakuan Hutang ini.
                </p>
            </li>
            <li>
                Tiap-tiap jumlah angsuran baik pokok dan atau bunga yang terlambat dibayarkan oleh YANG BERHUTANG dikenakan Denda sebesar 50% x suku bunga x tunggakan (pokok + bunga) setiap bulannya dan dihitung untuk setiap bulan keterlambatan.
            </li>
            <li>
                Bea materai dan biaya lainnya yang timbul sehubungan dengan pemberian pinjaman ini merupakan beban yang harus dibayar oleh YANG BERHUTANG.
            </li>
        </ol>
        <p class="text-center">Pasal 4</p>
        <p class="text-center">ASURANSI/PENJAMINAN</p>
        <ol>
            <li>
                Apabila dianggap perlu, PERUSAHAAN dapat mempertanggungkan atau mengasuransikan jaminan sebagaimana dimaksud Pasal 4 SURAT PENGAKUAN HUTANG ini sampai dengan jatuh tempo HUTANG atau HUTANG- nya dinyatakan lunas oleh PERUSAHAAN sesuai dengan pertimbangan PERUSAHAAN.
            </li>
            <li>
                Polis asuransi/sertifikat penjaminan disimpan di PERUSAHAAN sampai YANG BERHUTANG melunasi HUTANG-nya.
            </li>
            <li>
                Pertanggungan atau asuransi sebagaimana ketentuan dalam SURAT PENGAKUAN HUTANG ini dilakukan oleh Perusahaan Penjaminan/Asuransi Rekanan PERUSAHAAN atau melalui Broker Asuransi Rekanan PERUSAHAAN untuk dan atas nama PERUSAHAAN, atas beban YANG BERHUTANG.
            </li>
        </ol>
        <p class="text-center">Pasal 5</p>
        <p class="text-center">PENGAKUAN HUTANG</p>
        <p>
            YANG BERHUTANG dengan ini menerangkan dengan sebenar-benarnya dan secara sah mengaku berhutang kepada PERUSAHAAN sejumlah hutang yang dapat ditagih yang terdiri dari pokok HUTANG berikut bunga, denda/penalti dan biaya - biaya lainnya yang timbul berdasarkan SURAT PENGAKUAN HUTANG ini, baik karena jatuh tempo hutang, karena wanprestasinya YANG BERHUTANG maupun alasan lainnya, dari waktu ke waktu sesuai dengan catatan atau pembukuan yang berlaku di PERUSAHAAN.
        </p>
        <p class="text-center">Pasal 6</p>
        <p class="text-center">PNGAWASAN DAN PEMERIKSAAN</p>
        <p>
            PERUSAHAAN berhak, baik dilakukan sendiri atau dilakukan oleh pihak lain yang ditunjuk PERUSAHAAN, untuk setiap waktu meminta keterangan dan melakukan pemeriksaan yang diperlukan kepada YANG BERHUTANG berkaitan dengan SURAT PENGAKUAN HUTANG ini.
        </p>
        <p class="text-center">Pasal 7</p>
        <p class="text-center">DOMISILI</p>
        <p>
            Tentang SURAT PENGAKUAN HUTANG ini dan segala akibatnya, serta pelaksanaannya, tunduk pada hukum Negara Republik Indonesia dan YANG BERHUTANG sepakat memilih tempat kedudukan hukum (domisili) yang tetap dan umum di Kantor Kepaniteraan Pengadilan Negeri Jember dengan tidak mengurangi hak dan wewenang PERUSAHAAN untuk menuntut pelaksanaan/eksekusi atau mengajukan tuntutan hukum terhadap YANG BERHUTANG berdasarkan SURAT PENGAKUAN HUTANG ini melalui atau dihadapan Pengadilan lainnya dimanapun juga di dalam wilayah Republik Indonesia.
        </p>
        <p class="text-center">Pasal 8</p>
        <p class="text-center">PERNYATAAN</p>
        <P>
            YANG BERHUTANG dengan tegas menyatakan :
        </P>
        <ol>
            <li>
                Bersedia memberikan setiap keterangan - keterangan dengan sebenar - benarnya yang diperlukan oleh PERUSAHAAN atau kuasanya guna keperluan pemberian HUTANG dan bersedia mempertanggung jawabkan setiap keterangan yang diberikan tersebut secara hukum apabila keterangan dimaksud tidak diberikan dengan sebenar - benarnya.
            </li>
            <li>
                YANG BERHUTANG telah memperoleh penjelasan dari PERUSAHAAN, sehingga YANG BERHUTANG sepenuhnya mengetahui dan mengerti serta menyetujui semua ketentuan dan syarat dalam SURAT PENGAKUAN HUTANG.
            </li>
        </ol>
        <p class="text-center">Pasal 9</p>
        <p class="text-center">WANPRESENTASI & PENYELESAIAN HUTANG</p>
        <P>
            Apabila YANG BERHUTANG melanggar dan/atau lalai dalam melaksanakan kewajibannya berdasarkan SURAT PENGAKUAN HUTANG ini, maka berlaku ketentuan sebagai berikut:
        </P>
        <ol>
            <li>
                PERUSAHAAN berhak dengan seketika menagih HUTANG-nya dan YANG BERHUTANG diwajibkan tanpa menunda - menunda lagi membayar seluruh HUTANG-nya berupa pokok, bunga, denda, biaya - biaya dan kewajiban lainnya yang mungkin timbul dengan seketika dan sekaligus lunas.
            </li>
            <li>
                PERUSAHAAN akan melakukan penyelesaian kredit termasuk namun tidak terbatas pada upaya penjualan jaminan baik secara di bawah tangan maupun melalui pelelangan umum, maupun melalui saluran hukum.
            </li>
        </ol>
        <p class="text-center">Pasal 10</p>
        <p class="text-center">DATA/INFORMASI NASABAH/YANG BERHUTANG</p>
        <P>
            YANG BERHUTANG dengan SURAT PENGAKUAN HUTANG ini memberikan Kuasa dan/atau Persetujuan kepada PERUSAHAAN untuk memberikan/melaporkan data dan/atau informasi YANG BERHUTANG, termasuk tetapi tidak terbatas pada data/informasi tentang HUTANG dan jaminannya pada PERUSAHAAN  kepada:
        </P>
        <ol>
            <li>
                Pihak yang berwajib, termasuk namun tidak terbatas pada Kepolisian, Kejaksaan, Komisi Pemberantasan Korupsi, Perpajakan, yang penyerahannya dilakukan dengan berpedoman pada ketentuan perundang - undangan yang berlaku.
            </li>
            <li>
                Pihak ketiga, termasuk namun tidak terbatas pada lembaga penjaminan dan asuransi, konsultan, akuntan dan auditor, yang penyerahannya dilakukan dengan didasarkan pada perjanjian kerahasiaan.
            </li>
        </ol>
        <p class="text-center">Pasal 11</p>
        <p class="text-center">PUBLIKASI</p>
        <P>
            Dalam rangka penyelesaian kewajiban YANG BERHUTANG, PERUSAHAAN berhak memanggil YANG BERHUTANG / PENJAMIN dan/atau mengumumkan nama YANG BERHUTANG / PENJAMIN yang hutangnya bermasalah dan/atau pengumuman penjualan jaminan dan segala keterangan yang berkaitan dengannya di media massa atau media lain yang ditentukan PERUSAHAAN dan atau melakukan perbuatan lain yang diperlukan, pengumuman tidak boleh diubah dan/atau dirusak oleh YANG BERHUTANG / PENJAMIN sampai dengan kewajiban YANG BERHUTANG lunas.
        </P>
        <p class="text-center">Pasal 12</p>
        <p class="text-center">KUASA-KUASA</p>
        <ol>
            <li>
                Apabila PERUSAHAAN memandang perlu, maka dengan ini YANG BERHUTANG memberi kuasa kepada PERUSAHAAN untuk memperjumpakan hutang YANG BERHUTANG yang timbul karena SURAT PENGAKUAN HUTANG ini maupun karena surat pengakuan hutang dan/atau perjanjian lain untuk kepentingan/dengan PERUSAHAAN dengan piutang - piutang YANG BERHUTANG yang ada pada PERUSAHAAN saat ini maupun yang akan ada, termasuk tetapi tidak terbatas pada, tabungan dan/atau harta lain milik YANG BERHUTANG yang ada pada PERUSAHAAN.
            </li>
            <li>
                Disamping kuasa - kuasa yang dalam SURAT PENGAKUAN HUTANG ini secara tegas diberikan oleh YANG BERHUTANG kepada PERUSAHAAN, maka untuk keperluan pelaksanaan SURAT PENGAKUAN HUTANG, dengan ini YANG BERHUTANG memberi kuasa kepada PERUSAHAAN untuk melaksanakan :
                <ul>
                    <li>
                        Pemblokiran, pembukaan blokir, pencairan dan/atau pendebetan sebagian atau seluruh tabungan YANG BERHUTANG pada PERUSAHAAN, baik pinjaman dan/atau tabungan, dan/atau mengalihkan harta lain milik YANG BERHUTANG yang ada pada pihak PERUSAHAAN saat ini  maupun yang akan ada, untuk pembayaran/pelunasan kewajiban YANG BERHUTANG kepada PERUSAHAAN.
                    </li>
                    <li>
                        Penandatanganan kwitansi dan dokumen lainnya, menghadap kepada pejabat yang berwenang memberi keterangan serta melakukan tindakan lainnya yang diperlukan yang berkaitan dengan pelaksanaan pemberian kuasa di atas.
                    </li>
                </ul>
            </li>
            <li>
                Seluruh kuasa yang termaktub dalam Pasal ini maupun Pasal lainnya dalam SURAT PENGAKUAN HUTANG ini dapat disubtitusikan dan merupakan bagian yang terpenting dari dan tidak dapat dipisahkan dari SURAT PENGAKUAN HUTANG ini. Oleh karena itu, kuasa-kuasa tersebut tidak dapat ditarik kembali dan/atau dibatalkan dengan cara apapun juga dan karena sebab - sebab yang dapat mengakhiri surat kuasa sebagaimana dimaksud dalam pasal 1813, 1814 dan 1816 Kitab Undang-Undang Hukum Perdata hingga seluruh kewajiban YANG BERHUTANG dinyatakan lunas oleh PERUSAHAAN. Kuasa dimaksud telah diberikan dengan ditandatanganinya SURAT PENGAKUAN HUTANG ini sehingga tidak diperlukan surat kuasa tersendiri.
            </li>
        </ol>
        <p class="text-center">Pasal 13</p>
        <p class="text-center">KETENTUAN - KETENTUAN LAIN</p>
        <ol>
            <li>
                Kelalaian atau keterlambatan PERUSAHAAN untuk menggunakan hak atau kekuasaannya sesuai dengan SURAT PENGAKUAN HUTANG tidak berarti sebagai waiver (pelepasan hak) kecuali hal tersebut dinyatakan secara tertulis oleh PERUSAHAAN.
            </li>
            <li>
                Semua perubahan, penambahan, pengurangan dan lampiran-lampiran dari SURAT PENGAKUAN HUTANG ini yang dibuat dari waktu ke waktu merupakan satu kesatuan yang tidak dapat dipisahkan dari SURAT PENGAKUAN HUTANG ini.
            </li>
            <li>
                Segala sesuatu yang belum cukup diatur dalam SURAT PENGAKUAN HUTANG ini yang oleh PERUSAHAAN diatur dalam surat menyurat maupun dibuatkan dengan dokumen/akta-akta lain, merupakan bagian yang tidak dapat dipisahkan dari SURAT PENGAKUAN HUTANG ini.
            </li>
            <li>
                Apabila selain hutang ini, YANG BERHUTANG memperoleh juga fasilitas hutang lainnya dari PT. Sigma Artha Nusantara, maka antara hutang - hutang tersebut berlaku cross default, yaitu apabila salah satu pinjaman macet maka mengakibatkan pinjaman lainnya macet pula, sehingga PT. Sigma Artha Nusantara mempunyai hak untuk mengeksekusi jaminan - jaminan yang telah diberikan pada masing - masing hutang.
            </li>
            <li>
                Adanya keadaan - keadaan di luar kekuasaan YANG BERHUTANG tidak mengurangi kewajiban YANG BERHUTANG untuk membayar HUTANG-nya kepada PERUSAHAAN. YANG BERHUTANG dengan ini melepaskan Pasal 1245 dan 1245 Kitab Undang-Undang Hukum Perdata sepanjang hal tersebut melepaskan YANG BERHUTANG dari membayar biaya, rugi dan bunga karena terjadinya sesuatu hal yang tak diduga.
            </li>
            <li>
                Terhadap SURAT PENGAKUAN HUTANG ini dan segala akibatnya berlaku pula 'Syarat-Syarat Umum SURAT PENGAKUAN HUTANG dan Hutang PT. Sigma Artha Nusantara' yang  telah disetujui oleh YANG BERHUTANG dan mengikat YANG BERHUTANG serta merupakan satu kesatuan yang tidak dapat dipisahkan dari SURAT PENGAKUAN HUTANG ini.
            </li>
        </ol>
        <br>
        <p>Demikian, Surat Pengakuan Hutang ini dibuat dan berlaku sejak tanggal ditandatanganinya.</p>
        <br>
        <br>
        <p class="text-right">Ditanda tangani di Jember Tanggal	{{ \Carbon\Carbon::now()->locale('id')->isoFormat(' D MMMM Y') }}</p>
        <table class="tablettd">
            <tr>
                <td class"ttd"><strong>Yang Berhutang</strong></td>
                <td class"ttd"><strong>Menerima Pengakuan dari</strong><br>PEMBERI HUTANG</td>
            </tr>
            <br>
            <br>
            <br>
            <br>
            <tr>
                <td class"ttd"><span class="underlinettd">{{ $nasabah->nama_lengkap ?? "-"}}</span></td>
                <td class"ttd"><span class="underlinettd">Perusahaan</span></td>
            </tr>
        </table>
    </div>
</body>

</html>
