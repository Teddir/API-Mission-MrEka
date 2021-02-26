<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Buys extends Migration{
    
    public function up(){
        Schema::create('buys', function (Blueprint $table) {
            $table->id();
            $table->string('supplier');
            $table->string('barang');
            $table->string('tbarang');
            $table->string('tbayar');            
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('buys');
    }
}