<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class barangs extends Migration{
    
    public function up(){
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('uid')->comment('kode produk / barcode')->unique();
            $table->string('hb')->comment('harga beli');
            $table->string('hj')->comment('harga jual')->nullable();
            $table->string('kategori');
            $table->string('merek');
            $table->string('stok');
            $table->string('diskon');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('barangs');
    }
}
