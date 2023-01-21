<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Sabberworm\CSS\Settings;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            Users::class,
            SettingSeeder::class,
            KategoriSeeder::class,
            MemberSeeder::class,
            ProdukSeeder::class,
            SupplierSeeder::class,

        ]);
    }
}
