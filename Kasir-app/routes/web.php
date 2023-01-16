<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProdukController;
<<<<<<< HEAD
use App\Http\Controllers\MemberController;
=======
use App\Http\Controllers\SendEmail;
>>>>>>> ec8b79262249def4c1c525be34a66e0eecb8d62f
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn () => redirect()->route('login'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
    Route::resource('/kategori', KategoriController::class); // ini bukan array guys hati hati yah

    Route::get('/supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
    Route::resource('/supplier', SupplierController::class);

    Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');
    Route::post('/produk/delete-selected', [ProdukController::class, 'deleteselected'])->name('produk.delete_selected');
    Route::post('/produk/cetak-barcode', [ProdukController::class, 'cetakbarcode'])->name('produk.cetak_barcode');
    Route::resource('/produk', ProdukController::class);


    Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
    Route::resource('/member', MemberController::class);
    Route::post('/member/cetak-member', [MemberController::class, 'cetakmember'])->name('member.cetak_member');

    Route::get('/pengeluaran/data', [PengeluaranController::class, 'data'])->name('pengeluaran.data');
    Route::resource('/pengeluaran', PengeluaranController::class);
    Route::get('/send-email', [SendEmail::class, 'index'])->name('permintaan.barang');
});

// Route::get('/send-email', [SendEmail::class, 'index'])->name('permintaan.barang');