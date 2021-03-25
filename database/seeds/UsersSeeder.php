<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'avatar' => 'https://via.placeholder.com/150',
            'password' => Hash::make('admin'),
        ]);

        DB::table('projects')->insert([
            'title' => 'dataMission',
            'avatar' => 'https://via.placeholder.com/150',
            'desc' => 'Jangan lupa basmallah',
        ]);
    }
}
