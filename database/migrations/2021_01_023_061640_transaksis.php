<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaksis extends Migration{
    
    public function up(){
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('barang');
            $table->string('jb')->comment('jumlah barang')->nullable();
            $table->string('ht')->comment('harga total');
            $table->string('pay')->comment('membayar');
            $table->string('change')->comment('kembalian');
            $table->string('kode_member')->nullable(); 
            $table->string('pin_kasir');
            $table->string('diskon');
            $table->timestamps(); 
        });
    }

    public function down(){
        Schema::dropIfExists('transaksis');
    }
}