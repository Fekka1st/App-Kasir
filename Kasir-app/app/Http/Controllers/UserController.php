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
        $user = User::find($id);

        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 2;
        $user->foto = '/img/fotouser.jpg';
        $user->save();
        return response()->json('Data Berhasil', 200);
    }



    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 2;
        $user->foto = '/img/fotouser.jpg';
        $user->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return response(null, 204);
    }
}
