<?php

function format_uang($nilai)
{
    return number_format($nilai, 0, ',', '.');
}

function terbilang($nilai)
{
    $nilai = abs($nilai);
    $read  = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas');
    $nominal = '';

    if ($nilai < 12) { // 0 - 11
        $nominal = ' ' . $read[$nilai];
    } elseif ($nilai < 20) { // 12 - 19
        $nominal = terbilang($nilai - 10) . ' belas';
    } elseif ($nilai < 100) { // 20 - 99
        $nominal = terbilang($nilai / 10) . ' puluh' . terbilang($nilai % 10);
    } elseif ($nilai < 200) { // 100 - 199
        $nominal = ' seratus' . terbilang($nilai - 100);
    } elseif ($nilai < 1000) { // 200 - 999
        $nominal = terbilang($nilai / 100) . ' ratus' . terbilang($nilai % 100);
    } elseif ($nilai < 2000) { // 1.000 - 1.999
        $nominal = ' seribu' . terbilang($nilai - 1000);
    } elseif ($nilai < 1000000) { // 2.000 - 999.999
        $nominal = terbilang($nilai / 1000) . ' ribu' . terbilang($nilai % 1000);
    } elseif ($nilai < 1000000000) { // 1000000 - 999.999.990
        $nominal = terbilang($nilai / 1000000) . ' juta' . terbilang($nilai % 1000000);
    }

    return $nominal;
}

function format_date($date, $tampil_hari = true)
{
    // format date ('YYYY-MM-DD') 
    $nama_hari  = array(
        'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'
    );
    $nama_bulan = array(
        1 =>
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $tahun   = substr($date, 0, 4);
    $bulan   = $nama_bulan[(int) substr($date, 5, 2)];
    $tanggal = substr($date, 8, 2);
    $text    = '';

    if ($tampil_hari) {
        $urutan_hari = date('w', mktime(0, 0, 0, substr($date, 5, 2), $tanggal, $tahun));
        $hari        = $nama_hari[$urutan_hari];
        $text       .= "$hari, $tanggal $bulan $tahun";
    } else {
        $text       .= "$tanggal $bulan $tahun";
    }

    return $text;
    

}
function tambah_nol_didepan($value, $threshold = null)
{
    return sprintf("%0". $threshold ."s",$value);
}
