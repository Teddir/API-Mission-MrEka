<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class barangs extends Migration
{

    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('uid')->comment('kode produk / barcode')->nullable();
            $table->string('hb')->comment('harga beli')->nullable();
            $table->string('hj')->comment('harga jual');
            $table->string('kategori')->nullable();
            $table->string('merek')->nullable();
            $table->string('stok')->default(0);
            $table->string('diskon')->default(0)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('barangs');
    }
}
