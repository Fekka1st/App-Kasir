<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'id_setting' => 1,
            'nama_perusahaan' => 'HadirMart',
            'alamat' => 'Kp PandanJaya',
            'telpon' => '081224669182',
            'tipe_nota' => 1,
            'diskon' => 0,
            'path_logo' => '/img/Logo.png',
            'path_kartu_member' => 'img/Member.png',

        ]);
    }
}
