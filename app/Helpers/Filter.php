<?php

namespace App\Helpers;

class Terbilang
{
    private static $angka = [
        "",
        "satu",
        "dua",
        "tiga",
        "empat",
        "lima",
        "enam",
        "tujuh",
        "delapan",
        "sembilan",
        "sepuluh",
        "sebelas"
    ];

    public static function convert($nilai)
    {
        $nilai = (int) preg_replace("/[^0-9]/", "", $nilai);

        if ($nilai < 0) return "minus " . trim(self::convert(-$nilai));
        if ($nilai < 12) return self::$angka[$nilai];
        if ($nilai < 20) return self::$angka[$nilai - 10] . " belas";
        if ($nilai < 100) {
            $hasil = self::$angka[floor($nilai / 10)] . " puluh";
            if ($nilai % 10 != 0) $hasil .= " " . self::$angka[$nilai % 10];
            return $hasil;
        }
        if ($nilai < 200) return "seratus " . self::convert($nilai - 100);
        if ($nilai < 1000) {
            $hasil = self::$angka[floor($nilai / 100)] . " ratus";
            if ($nilai % 100 != 0) $hasil .= " " . self::convert($nilai % 100);
            return $hasil;
        }
        if ($nilai < 2000) return "seribu " . self::convert($nilai - 1000);
        if ($nilai < 1000000) {
            $hasil = self::convert(floor($nilai / 1000)) . " ribu";
            if ($nilai % 1000 != 0) $hasil .= " " . self::convert($nilai % 1000);
            return $hasil;
        }
        if ($nilai < 1000000000) {
            $hasil = self::convert(floor($nilai / 1000000)) . " juta";
            if ($nilai % 1000000 != 0) $hasil .= " " . self::convert($nilai % 1000000);
            return $hasil;
        }
        return "Angka terlalu besar";
    }
}
class JutaanTerbilang {
    private static $angka = [
        "", "satu", "dua", "tiga", "empat", "lima",
        "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"
    ];

    public static function convert($nilai) {
        // Bersihkan input dari format dan konversi ke integer
        $nilai = (int) preg_replace("/[^0-9]/", "", $nilai);

        // Pecah nilai menjadi juta dan ribuannya
        $juta = floor($nilai / 1000000);
        $sisa = $nilai % 1000000;

        $hasil = "";

        // Convert jutaan
        if ($juta > 0) {
            $hasil .= self::convertAngka($juta) . " juta ";
        }

        // Convert ribuan
        if ($sisa > 0) {
            if ($sisa >= 1000) {
                $ribu = floor($sisa / 1000);
                $sisa_ribu = $sisa % 1000;

                $hasil .= self::convertAngka($ribu) . " ribu ";

                if ($sisa_ribu > 0) {
                    $hasil .= self::convertAngka($sisa_ribu);
                }
            } else {
                $hasil .= self::convertAngka($sisa);
            }
        }

        return trim($hasil);
    }

    private static function convertAngka($n) {
        if ($n < 12) return self::$angka[$n];
        elseif ($n < 20) return self::$angka[$n - 10] . " belas";
        elseif ($n < 100) {
            $hasil = self::$angka[floor($n / 10)] . " puluh";
            if ($n % 10 != 0) $hasil .= " " . self::$angka[$n % 10];
            return $hasil;
        }
        elseif ($n < 200) return "seratus " . self::convertAngka($n - 100);
        elseif ($n < 1000) {
            $hasil = self::$angka[floor($n / 100)] . " ratus";
            if ($n % 100 != 0) $hasil .= " " . self::convertAngka($n % 100);
            return $hasil;
        }
        return "";
    }
}
class Rupiah
{
    private static $angka = [
        "",
        "satu",
        "dua",
        "tiga",
        "empat",
        "lima",
        "enam",
        "tujuh",
        "delapan",
        "sembilan",
        "sepuluh",
        "sebelas"
    ];

    public static function convert($nilai)
    {
        $nilai = (int) preg_replace("/[^0-9]/", "", $nilai);

        if ($nilai < 0) return "minus " . trim(self::convert(-$nilai));
        if ($nilai < 12) return self::$angka[$nilai];
        if ($nilai < 20) return self::$angka[$nilai - 10] . " belas";
        if ($nilai < 100) {
            $hasil = self::$angka[floor($nilai / 10)] . " puluh";
            if ($nilai % 10 != 0) $hasil .= " " . self::$angka[$nilai % 10];
            return $hasil;
        }
        if ($nilai < 200) return "seratus " . self::convert($nilai - 100);
        if ($nilai < 1000) {
            $hasil = self::$angka[floor($nilai / 100)] . " ratus";
            if ($nilai % 100 != 0) $hasil .= " " . self::convert($nilai % 100);
            return $hasil;
        }
        if ($nilai < 2000) return "seribu " . self::convert($nilai - 1000);
        if ($nilai < 1000000) {
            $hasil = self::convert(floor($nilai / 1000)) . " ribu";
            if ($nilai % 1000 != 0) $hasil .= " " . self::convert($nilai % 1000);
            return $hasil;
        }
        if ($nilai < 1000000000) {
            $hasil = self::convert(floor($nilai / 1000000)) . " juta";
            if ($nilai % 1000000 != 0) $hasil .= " " . self::convert($nilai % 1000000);
            return $hasil;
        }
        return "Angka terlalu besar";
    }
}
class TanggalTerbilang
{
    private static $angka = [
        "",
        "satu",
        "dua",
        "tiga",
        "empat",
        "lima",
        "enam",
        "tujuh",
        "delapan",
        "sembilan",
        "sepuluh",
        "sebelas"
    ];

    private static $bulan = [
        1 => "satu",
        "dua",
        "tiga",
        "empat",
        "lima",
        "enam",
        "tujuh",
        "delapan",
        "sembilan",
        "sepuluh",
        "sebelas",
        "dua belas"
    ];

    public static function tanggal($nilai)
    {
        $nilai = (int)$nilai;
        if ($nilai < 12) return self::$angka[$nilai];
        if ($nilai < 20) return self::$angka[$nilai - 10] . " belas";
        if ($nilai < 100) {
            $hasil = self::$angka[floor($nilai / 10)] . " puluh";
            if ($nilai % 10 != 0) $hasil .= " " . self::$angka[$nilai % 10];
            return $hasil;
        }
        return "";
    }

    public static function bulan($nilai)
    {
        return self::$bulan[(int)$nilai];
    }

    public static function tahun($nilai)
    {
        $ribu = floor($nilai / 1000);
        $sisa = $nilai % 1000;

        $hasil = "dua ribu ";
        if ($sisa < 100) {
            $puluhan = floor($sisa / 10);
            $satuan = $sisa % 10;
            if ($puluhan == 2) {
                $hasil .= "dua puluh ";
                if ($satuan > 0) $hasil .= self::$angka[$satuan];
            }
        }
        return ucwords($hasil);
    }
}
