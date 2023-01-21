<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;

class MemberImport implements WithHeadingRow,ToModel 
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {   
        $member = Member::latest()->first() ?? new Member();
        return new Member([
            'kode_member' => 'M' . tambah_nol_didepan((int)$member->id_member + 1, 6),
            'nama' => $row['nama'],
            'alamat' => $row['alamat'],
            'telepon' => $row['telepon'],
        ]);
    }
}
