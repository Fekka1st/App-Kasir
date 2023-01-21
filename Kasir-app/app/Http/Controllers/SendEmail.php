<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendingEmail;
use App\Models\Produk;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Controller
{
    public function index(){
        $produk = Produk::all();
        Mail::to('supplier@gmail.com')->queue(new SendingEmail($produk));

        return redirect()->back();
    }
    public function memberexports()
    {
        return Excel::download(new MemberExport, 'members.xlsx');
    }
}
