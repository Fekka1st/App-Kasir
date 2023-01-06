<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use DataTables;

class ProdukController extends Controller
{
     //
     public function index()
     {
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');

         return view('produk.index', compact('kategori'));
     }
 
     public function store(Request $request)
     {
         $produk = Produk::latest()->first();
         $request['kode_produk'] = 'P' .tambah_nol_didepan((int)$produk->id_produk +1, 6);
         $produk = Produk::create($request->all());
         
         return response()->json('Data berhasil disimpan', 200);
     }
 
     public function data()
     {
         $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', 'produk.id_kategori')
             ->select('produk.*', 'nama_kategori')
             ->orderBy('nama_produk', 'asc')
             ->get();

         return dataTables()
             ->of($produk)
             ->addIndexColumn()
             ->addColumn('kode_produk', function ($produk) {
                    return '<span class=" label label-success">'.$produk->kode_produk .'</span>';
             })
             ->addColumn('harga_beli', function ($produk) {
                    return format_uang($produk->harga_beli);

             })
             ->addColumn('harga_jual', function ($produk) {
                    return format_uang($produk->harga_jual);

             })
             ->addColumn('stok', function ($produk) {
                return format_uang($produk->stok);

             })
             ->addColumn('aksi', function ($produk) {
                 return
                     '<div class="btn-group">
                     <button onclick="edit(`' . route('produk.update', $produk->id_produk) . '`)" type="button" class="btn btn-info btn-flat">Edit</button>
                     <button onclick="hapus(`' . route('produk.destroy', $produk->id_produk) . '`)"  type="button" class="btn btn-danger btn-flat">Hapus</button>
                     </div>';
             })
             ->rawColumns(['aksi' , 'kode_produk'])
             ->make(true);
     }
 
     public function show($id)
     {
         $produk = Produk::find($id);
         return response()->json($produk);
     }
 
     public function update(Request $request, $id)
     {
        $produk = Produk::find($id);
        $produk ->update($request->all());
         return response()->json('Data berhasil diupdate', 200);
     }
 
     public function destroy($id)
     {
         $produk = Produk::find($id);
         $produk->delete();
         return response()->json(null, 204);
     }
}
