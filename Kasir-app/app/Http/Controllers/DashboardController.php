<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Member;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kategori = Kategori::count();
        $member = Member::count();
        $supplier = Supplier::count();
        $produk = Produk::count();

        if (auth()->user()->level == 1) {
            return view('welcome', compact('kategori', 'member', 'supplier', 'produk'));
        } else {
            return view('kasir.dashboard');
        }
    }
}
