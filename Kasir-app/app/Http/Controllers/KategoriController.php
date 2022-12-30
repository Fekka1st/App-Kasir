<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;


class KategoriController extends Controller
{
    //
    public function index()
    {
        return view('kategori.index');
    }
}
