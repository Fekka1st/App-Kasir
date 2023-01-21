<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('id_ID');
        DB::table('produks')->insert(
            [
                [     
                    'id_kategori' => 1,
                    'kode_produk' => 'P' . rand(000000, 999999),
                    'nama_produk' => 'Mie',
                    'merk' => 'Pop Mie',
                    'harga_beli' => 5600,
                    'diskon' =>2 ,
                    'harga_jual' =>6500,
                    'stok' =>15,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [     
                    'id_kategori' => 2,
                    'kode_produk' => 'P' . rand(000000, 999999),
                    'nama_produk' => 'Air',
                    'merk' => 'Aqua',
                    'harga_beli' => 3500,
                    'diskon' =>0,
                    'harga_jual' =>4500,
                    'stok' =>20,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [     
                    'id_kategori' => 3,
                    'kode_produk' => 'P' . rand(000000, 999999),
                    'nama_produk' => 'Buku',
                    'merk' => 'Big Boss',
                    'harga_beli' => 4700,
                    'diskon' =>2,
                    'harga_jual' =>5600,
                    'stok' =>17,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [     
                    'id_kategori' => 4,
                    'kode_produk' => 'P' . rand(000000, 999999),
                    'nama_produk' => 'Sikat Gigi',
                    'merk' => 'Formula',
                    'harga_beli' => 4000,
                    'diskon' =>5,
                    'harga_jual' =>6000,
                    'stok' =>5,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [     
                    'id_kategori' => 5,
                    'kode_produk' => 'P' . rand(000000, 999999),
                    'nama_produk' => 'Pelembab',
                    'merk' => 'Fair & Lovely',
                    'harga_beli' => 19000,
                    'diskon' =>7,
                    'harga_jual' =>23000,
                    'stok' =>33,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]    
        );
    }
}
