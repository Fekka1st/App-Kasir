<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use DataTables;

class SupplierController extends Controller
{
    public function index()
    {
        return view('supplier.index');
    }

    public function store(Request $request)
    {
        // $supplier = Supplier::create($request->all());

        // return response()->json('Data berhasil disimpan', 200);
        $supplier = new Supplier();
        $supplier->nama = $request->nama;
        $supplier->alamat = $request->alamat;
        $supplier->telpon = $request->telpon;
        $supplier->save();
        return response()->json('Data berhasil disimpan', 200);
    }

    public function data()
    {
        $supplier = Supplier::orderBy('id_supplier', 'desc')->get();

        return datatables()
            ->of($supplier)
            ->addIndexColumn()
            ->addColumn('aksi', function ($supplier) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`' . route('supplier.update', $supplier->id_supplier) .'`)" class="btn btn-info "><i class="fas fa-pen"></i></button>
                    <button type="button" onclick="deleteData(`' . route('supplier.destroy', $supplier->id_supplier) .'`)"class="btn btn-danger "><i class="fa fa-trash"></i></button>
                </div>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);

        return response()->json($supplier);
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->nama = $request->nama;
        $supplier->alamat = $request->alamat;
        $supplier->telpon = $request->telpon;
        $supplier->update();
        return response()->json('Data berhasil diupdate', 200);
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return response()->json(null, 204);
    }
}