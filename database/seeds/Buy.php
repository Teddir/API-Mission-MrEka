<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Buy extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('buys')->insert([
            'barang' => 'Mie Sedap',
            'harga_barang' => '25000',
            'tbarang' => '10',
            'tbayar' => '250000',
            'supplier' => 'Atika',
        ]);
        DB::table('buys')->insert([
            'barang' => 'Mie Kuah',
            'harga_barang' => '25000',
            'tbarang' => '10',
            'tbayar' => '250000',
            'supplier' => 'Atika',
        ]);
    }
}
