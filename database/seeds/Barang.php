<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Barang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('barangs')->insert([
            'name' => 'Sari Roti',
            'uid' => '343443',
            'hb' => '90000000',
            'hj' => '12000',
            'kategori' => 1,
            'kategori_id' => 1,
            'merek' => 'IndoFood',
            'stok' => '100',
            'diskon' => '2%',

        ]);

        DB::table('barangs')->insert([
            'name' => 'Floridina',
            'uid' => '123321',
            'hb' => '100000000',
            'hj' => '3000',
            'kategori' => 2,
            'kategori_id' => 2,
            'merek' => 'WingsFood',
            'stok' => '200',
            'diskon' => '2%',

        ]);

        DB::table('barangs')->insert([
            'name' => 'Sarimie 2',
            'uid' => '787898',
            'hb' => '50000000',
            'hj' => '4000',
            'kategori' => 1,
            'kategori_id' => 1,
            'merek' => 'IndoMie',
            'stok' => '500',
            'diskon' => '2%',

        ]);
    }
}
