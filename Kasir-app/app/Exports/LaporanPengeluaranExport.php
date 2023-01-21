<?php

namespace App\Exports;

use App\Models\Pengeluaran;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// class LaporanPengeluaranExport implements FromCollection
class LaporanPengeluaranExport implements FromArray, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Pengeluaran::all();
    // }

    public function array() : array{
        return Pengeluaran::getData();
    }

    public function headings(): array{
        return [
            'No', 'Tanggal', 'Nominal', 'Keterangan'
        ];
    }
}
