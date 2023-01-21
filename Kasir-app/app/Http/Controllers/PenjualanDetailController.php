<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use App\Models\Setting;
use Illuminate\Http\Request;
use DB;

class PenjualanDetailController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('nama_produk')->get();
        $member = Member::orderBy('nama')->get();
        $setting = Setting::first();
        $transaksi = PenjualanDetail::all();
        $total = PenjualanDetail::sum('subtotal');
        $totalItem = PenjualanDetail::sum('jumlah');

        if ($id_penjualan = session('id_penjualan')) {
            $penjualan = Penjualan::find($id_penjualan);
            $memberSelected = $penjualan->member ?? new Member();

            return view('penjualan_detail.index', compact('totalItem', 'total', 'transaksi', 'produk', 'member', 'setting', 'id_penjualan', 'penjualan', 'memberSelected'));
        } else {
            if (auth()->user()->level == 1) {
                return redirect()->route('transaksi.baru');
            } else {
                return redirect()->route('home');
            }
        }
    }
    public function tambah(Request $request)
    {
        $cek = PenjualanDetail::where('id_produk', $request->id)->exists();
        if ($cek) {
            $ada = PenjualanDetail::where('id_produk', $request->id)->first();
            if ($request->filled('jumlah')) {
                DB::table('penjualandetails')->where('id_produk', $request->id)->update([
                    'jumlah' => $request->jumlah,
                    'subtotal' => $request->jumlah * $ada->harga_jual
                ]);
                return response()->json(['success'], 200);
            } else {
                DB::table('penjualandetails')->where('id_produk', $request->id)->update([
                    'jumlah' => $ada->jumlah + 1,
                    'subtotal' => $ada->jumlah * $ada->harga_jual
                ]);
            }
        } else {
            $produk = Produk::where('id_produk', $request->id)->first();
            $no = 1;
            $cart = session()->get('cart', []);
            $tambah = new PenjualanDetail;
            $tambah->id_penjualan = $no++;
            $tambah->id_produk = $produk->id_produk;
            $tambah->harga_jual = $produk->harga_beli;
            $tambah->jumlah = 1;
            $tambah->diskon = 0;
            $tambah->subtotal = $produk->harga_beli;
            $tambah->save();
        }
        return redirect()->back();
    }

    public function bayar(Request $request)
    {
        $total = PenjualanDetail::sum('subtotal');

        // $cart = session()->get('cart', []);

        // $cart = [
        //     'angsulan' => $total - $request->bayar,
        //     'bayar' => $request->bayar
        // ];
        session()->put('cart', $request->bayar);
        return response()->json(['success']);
    }
    public function simpanTransaksi(Request $request)
    {
        $p = PenjualanDetail::all();
        foreach($p as $no => $data){
            $produk[$no] = Produk::where('id_produk', $data->id_produk)->pluck('stok')->first();
            DB::table('produks')->where('id_produk', $data->id_produk)->update([
                'stok' => $produk[$no] - $data->jumlah
            ]);
        }
        Penjualan::create($request->all());
       
        DB::table('penjualandetails')->delete();
        session()->forget('cart');
        return redirect()->back();
    }
}
