<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $array = [1, 2, 3, 4, 5];
        // Arr::random($array)
        DB::table('kategoris')->insert(
            [
                [
        
                    'nama_kategori' => 'Makanan',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nama_kategori' => 'Minuman',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nama_kategori' => 'Alat Tulis',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nama_kategori' => 'Alat Mandi',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nama_kategori' => 'Kecantikan',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nama_kategori' => 'Sembako',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]    
        );
    }
}
