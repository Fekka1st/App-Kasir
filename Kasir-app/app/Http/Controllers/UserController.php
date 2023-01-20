<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use App\Models\User;
use PDF;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('user.index');
    }

    public function data()
    {
        $user = User::isNotAdmin()->orderBy('id', 'desc')->get();
        return $user;
        return datatables()
            ->of($user)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="edit(`' . route('user.update', $user->id) . '`)" class="btn btn-info "><i class="fas fa-pen"></i></button>
                    <button type="button" onclick="hapus(`' . route('user.destroy', $user->id) . '`)" class="btn btn-danger "><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show($id)
    {
        $user = Pengeluaran::find($id);

        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = Pengeluaran::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }



    public function update(Request $request, $id)
    {
        $user = Pengeluaran::find($id)->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    public function destroy($id)
    {
        $user = Pengeluaran::find($id)->delete();

        return response(null, 204);
    }

    public function report()
    {
        $user = Pengeluaran::all();

        $pdf = PDF::loadview('pengeluaran.print_preview', ['pengeluaran' => $user]);
        return $pdf->download('data_pengeluaran.pdf');
    }
}
