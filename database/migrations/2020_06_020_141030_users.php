<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration{

    public function up(){
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('password');
            $table->string('role')->comment('1 = staff, 2 = kasir')->default(1);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('users');
    }
}
