<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('suppliers')->insert([
            'name' => 'Rahman',
            'alamat' => 'Bali',
            'phone_number' => '0899034723'
        ]);

        DB::table('suppliers')->insert([
            'name' => 'Atika',
            'alamat' => 'Bali/Singaraja',
            'phone_number' => '08923827123'
        ]);

        DB::table('suppliers')->insert([
            'name' => 'Fayyad',
            'alamat' => 'Bali/JalakPutih',
            'phone_number' => '0899034722'
        ]);
    }
}
