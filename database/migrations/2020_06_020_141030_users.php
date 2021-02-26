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
            $table->string('password')->nullable();
            $table->string('pin_kasir')->nullable()->unique();
            $table->string('kode_member')->nullable()->unique();
            $table->string('saldo')->nullable();
            $table->string('role')->comment('1 = staff, 2 = kasir, 3 = member')->default(1);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('users');
    }
}
