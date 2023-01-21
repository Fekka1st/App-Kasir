<?php

namespace App\Http\Controllers;

use App\Models\pembelian;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\pembeliandetail;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PembelianDetailController extends Controller
{
    public function index()
    {
        $id_pembelian = session('id_pembelian');
        $produk = Produk::orderBy('nama_produk')->get();
        $supplier = Supplier::find(session('id_supplier'));

        $diskon = pembelian::find($id_pembelian)->diskon ?? 0;

        return view('pembelian_detail.index', compact('id_pembelian', 'produk', 'supplier', 'diskon'));
    }

    public function store(Request $request)
    {
        $produk = Produk::where('id_produk', $request->id_produk)->first();
        if (!$produk) {
            return response()->json('Data gagal disimpan', 400);
        }

        $detail = new PembelianDetail();
        $detail->id_pembelian = $request->id_pembelian;
        $detail->id_produk = $produk->id_produk;
        $detail->harga_beli = $produk->harga_beli;
        $detail->jumlah = 1;
        $detail->subtotal = $produk->harga_beli;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function data($id)
    {
        // $detail = PembelianDetail::with('produk')
        //     ->where('id_pembelian', $id)
        //     ->get();

        // $data = array();
        // $total = 0;
        // $total_item = 0;
        // return datatables()
        //     ->of($detail)
        //     ->addIndexColumn()
        //     ->addColumn('nama_produk', function ($detail) {
        //         return  $detail->produk['nama_produk'];
        //     })
        //     ->addColumn('kode_produk', function ($detail) {
        //         return '<span class="badge bg-success">' . $detail->produk['kode_produk'] . '</span>';
        //     })
        //     ->addColumn('harga_beli', function ($detail) {
        //         return 'RP. ' . $detail->produk['harga_beli'];
        //     })
        //     ->addColumn('jumlah', function ($detail) {
        //         return '<input type="number" class="form-control input-sm quantity" data-id="' . $detail->id_pembelian_detail . '" value="' . $detail->jumlah . '">';
        //     })
        //     ->addColumn('subtotal', function ($detail) {
        //         return 'RP. ' . $detail->subtotal;
        //     })404
        //     ->addColumn('aksi', function ($detail) {
        //         return '
        //         <button type="button" onclick="hapus(`' . route('pembelian_detail.destroy', $detail->id_pembelian_detail) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i>hapus</button>';
        //     })
        //     ->rawColumns(['aksi', 'kode_produk', 'jumlah'])
        //     ->make(true);

        $detail = PembelianDetail::with('produk')
            ->where('id_pembelian', $id)
            ->get();
        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['kode_produk'] = '<span class="label label-success">' . $item->produk['kode_produk'] . '</span';
            $row['nama_produk'] = $item->produk['nama_produk'];
            $row['harga_beli']  = 'Rp. ' . format_uang($item->harga_beli);
            $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id="' . $item->id_pembelian_detail . '" value="' . $item->jumlah . '">';
            $row['subtotal']    = 'Rp. ' . format_uang($item->subtotal);
            $row['aksi']        = '<div class="btn-group">
                                    <button onclick="hapus(`' . route('pembelian_detail.destroy', $item->id_pembelian_detail) . '`)" class="btn btn-danger "><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;

            $total += $item->harga_beli * $item->jumlah;
            $total_item += $item->jumlah;
        }
        $data[] = [
            'kode_produk' => '
                <div class="total hide">' . $total . '</div>
                <div class="total_item hide">' . $total_item . '</div>',
            'nama_produk' => '',
            'harga_beli'  => '',
            'jumlah'      => '',
            'subtotal'    => '',
            'aksi'        => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi', 'kode_produk', 'jumlah'])
            ->make(true);
    }

    public function destroy($id)
    {
        $pembelian = pembeliandetail::find($id);
        $pembelian->delete();
        return response()->json(null, 204);
    }

    public function update(Request $request, $id)
    {
        $detail = PembelianDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga_beli * $request->jumlah;
        $detail->update();
    }

    public function loadForm($diskon, $total)
    {
        $bayar = $total - ($diskon / 100 * $total);
        $data  = [
            'totalrp' => format_uang($total),
            'bayar' => $bayar,
            'bayarrp' => format_uang($bayar),
            'terbilang' => ucwords(terbilang($bayar) . ' Rupiah')
        ];

        return response()->json($data);
    }
}
