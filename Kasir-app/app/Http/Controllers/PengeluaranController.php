<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use PDF;

class PengeluaranController extends Controller
{
    //
    public function index()
    {
        return view('pengeluaran.index');
    }

    public function data()
    {
        $pengeluaran = Pengeluaran::orderBy('id_pengeluaran', 'desc')->get();

        return datatables()
            ->of($pengeluaran)
            ->addIndexColumn()
            ->addColumn('created_at', function ($pengeluaran) {
                return format_date($pengeluaran->created_at, false);
            })
            ->addColumn('nominal', function ($pengeluaran) {
                return format_uang($pengeluaran->nominal);
            })
            ->addColumn('aksi', function ($pengeluaran) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="edit(`' . route('pengeluaran.update', $pengeluaran->id_pengeluaran) . '`)" class="btn btn-info "><i class="fas fa-pen"></i></button>
                    <button type="button" onclick="hapus(`' . route('pengeluaran.destroy', $pengeluaran->id_pengeluaran) . '`)" class="btn btn-danger "><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show($id)
    {
        $pengeluaran = Pengeluaran::find($id);

        return response()->json($pengeluaran);
    }

    public function store(Request $request)
    {
        $pengeluaran = Pengeluaran::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }



    public function update(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::find($id)->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::find($id)->delete();

        return response(null, 204);
    }

    public function report(){
        $pengeluaran = Pengeluaran::all();

        $pdf = PDF::loadview('pengeluaran.print_preview', ['pengeluaran'=>$pengeluaran]);
        return $pdf->download('data_pengeluaran.pdf');
    }
}
