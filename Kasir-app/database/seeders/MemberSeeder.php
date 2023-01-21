<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 20; $i++) {
            DB::table('members')->insert([
                'kode_member' => 'M' . rand(000000, 999999),
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'telpon' => $faker->phoneNumber,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
