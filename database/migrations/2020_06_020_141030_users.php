<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration{

    public function up(){
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('umur')->nullable();
            $table->string('alamat')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('password');
            $table->string('role')->comment('1 = staff, 2 = kasir')->default(1);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('users');
    }
}
