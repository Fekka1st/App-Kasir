<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use DataTables;


class KategoriController extends Controller
{
    //
    public function index()
    {
        return view('kategori.index');
    }

    public function store(Request $request)
    {
        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        return response()->json('Data berhasil disimpan', 200);
    }

    public function data()
    {
        $kategori = Kategori::orderBy('id_kategori', 'desc')->get();
        return dataTables()
            ->of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                return
                    '<div class="btn-group">
                    <button type="button" class="btn btn-info btn-flat">Edit</button>
                    <button type="button" class="btn btn-danger btn-flat">Hapus</button>
                    </div>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
