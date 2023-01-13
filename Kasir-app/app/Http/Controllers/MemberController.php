<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use PDF;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.index');
    }
    public function data()
    {
        $member = Member::orderBy('kode_member')->get();

        return dataTables()
            ->of($member)
            ->addIndexColumn()
            ->addColumn('select_all', function ($produk) {
                return '
                <input type="checkbox" name="id_member[]" value="'. $produk->id_produk .'">
                ';
            })

            ->addColumn('kode_member', function ($member) {
                return '<span class="label badge-success">' .$member->kode_member .'<span>';
            })
            ->addColumn('aksi', function ($member) {
                return
                    '<div class="btn-group">
                    <button onclick="edit(`' . route('member.update', $member->id_member) . '`)" type="button" class="btn btn-info btn-flat"><i class="fas fa-edit"></i>Edit</button>
                    <button onclick="hapus(`' . route('member.destroy', $member->id_member) . '`)"  type="button" class="btn btn-danger btn-flat"> <i class="fas fa-trash"></i>Hapus</button>
                    </div>';
            })
            ->rawColumns(['aksi' ,'select_all', 'kode_member'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = Member::latest()->first();
        $kode_member = $member->kode_member ?? 1;

        
        $request['kode_member'] = 'P' . ('0000000076');
        
        $member = new Member();
        $member->kode_member = tambah_nol_didepan($kode_member, 5);
        $member->kode_member = $request->kode_member;
        $member->nama = $request->nama;
        $member->alamat = $request->alamat;
        $member->telpon = $request->telpon;
        $member->save();


        return response()->json('Data berhasil disimpan', 200);
        return $member; 
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);
        return response()->json($member);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $member = Member::find($id)->update($request->all());

        return response()->json('Data berhasil diupdate', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        return response()->json(null, 204);
}

    public function cetakMember(Request $request)
    {
        $datamember = array();
            foreach ($request->id_member as $id) {  
            $member = Member::find($id);
            $datamember[] = $member;

        }
        $datamember =  $datamember(2);
     return $datamember;

        $no = 1;
        $pdf = PDF::loadView('member.cetak', compact('datamember', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('member.pdf');
    }
}
