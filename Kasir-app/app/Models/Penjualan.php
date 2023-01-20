<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'Penjualans';
    protected $primaryKey = 'id_Penjualan';
    protected $guarded = [];
}
