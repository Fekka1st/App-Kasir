<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'pengeluarans';
    protected $primaryKey = 'id_pengeluaran';
    protected $guarded = [];
    // protected $fillable = ['deskripsi','nominal'];

    public static function getData(){
        $pengeluaran = Pengeluaran::all();

        $item = [];

        $no = 1;

        for($i=0; $i<$pengeluaran->count(); $i++){
            $item[$i]['no'] = $no++;
            $item[$i]['tanggal'] = $pengeluaran[$i]->created_at;
            $item[$i]['nominal'] = $pengeluaran[$i]->nominal;
            $item[$i]['keterangan'] = $pengeluaran[$i]->deskripsi;
        }

        return $item;
    }
}
