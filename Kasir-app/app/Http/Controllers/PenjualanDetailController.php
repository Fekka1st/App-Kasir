<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\setting;
use Illuminate\Http\Request;

class PenjualanDetailController extends Controller
{
    public function index()
    {

        $produk = Produk::orderBy('nama_produk')->get();
        $member = Member::orderBy('nama')->get();
        $setting = Setting::first();
    }

   
}
