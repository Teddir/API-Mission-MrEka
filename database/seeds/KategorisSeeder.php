<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategorisSeeder extends Seeder
{
    
    public function run()
    {
        //
        DB::table('kategoris')->insert([
            'name' => 'Makanan',
        ]);

        DB::table('kategoris')->insert([
            'name' => 'Minuman',
        ]);

        DB::table('kategoris')->insert([
            'name' => 'Eletronik',
        ]);

        DB::table('kategoris')->insert([
            'name' => 'dll',
        ]);
    }
}
