<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use DataTables;


class KategoriController extends Controller
{
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
                    <button type="button" onclick="edit(`' . route('kategori.update', $kategori->id_kategori) . '`)"  class="btn btn-info "><i class="fas fa-pen"></i></button>
                    <button type="button" onclick="hapus(`' . route('kategori.destroy', $kategori->id_kategori) . '`)"  class="btn btn-danger "><i class="fa fa-trash"></i></button>
                    </div>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show($id)
    {
        $kategori = Kategori::find($id);
        return response()->json($kategori);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->update();
        return response()->json('Data berhasil diupdate', 200);
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return response()->json(null, 204);
    }
}
