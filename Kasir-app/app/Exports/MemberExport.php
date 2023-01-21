<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MemberExport implements FromArray, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        $members = Member::all();
        $members_filter = [];

        $no = 1;
        for ($i = 0; $i < $members->count(); $i++) {
            $members_filter[$i]['No'] = $no++;
            $members_filter[$i]['Kode Member'] = $members[$i]->kode_member;
            $members_filter[$i]['Nama'] = $members[$i]->nama;
            $members_filter[$i]['Alamat'] = $members[$i]->alamat;
            $members_filter[$i]['Telepon'] = $members[$i]->telpon;
        }
        return $members_filter;
    }
    public function headings(): array
    {
        return [
            'No',
            'Kode Member',
            'Nama',
            'Alamat',
            'Telpon'
        ];
    }
}
