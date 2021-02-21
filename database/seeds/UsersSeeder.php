<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder{

    public function run(){
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'phone_number' => '0899030402',
        ]);

        DB::table('users')->insert([
            'name' => 'kasir',
            'email' => 'kasir@admin.com',
            'password' => Hash::make('kasir'),
            'umur' => '12',
            'alamat' => 'singaraja',
            'role' => 2
        ]);
    }
}
