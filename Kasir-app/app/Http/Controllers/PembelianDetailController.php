<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianDetailController extends Controller
{
    public function index()
    {
        $id_pembelian = session('id_pembelian');
        $produk = Produk::orderBy('nama_produk')->get();
        $supplier = Supplier::find(session('id_supplier'));
        if (!$supplier) {
            abort(404);
        }
        return view('pembelian_detail.index', compact('id_pembelian', 'produk', 'supplier'));
    }
}
