<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class suppliers extends Migration{
    
    public function up(){
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alamat');
            $table->string('phone_number')->unique();
            $table->string('out')->nullable();
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('suppliers');
    }
}