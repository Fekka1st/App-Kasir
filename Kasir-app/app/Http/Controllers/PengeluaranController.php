<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;

class PengeluaranController extends Controller
{
    //
    public function index()
    {
        return view('pengeluaran.index');
    }
}
