<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Foreign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // Schema::table('users', function (Blueprint $table) {
        //     $table->foreignId('chat_id')->nullable()->constrained('chats')->onDelete('cascade')->onUpdate('cascade');
        // });

        Schema::table('barangs', function (Blueprint $table) {
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('buy_id')->nullable()->constrained('buys')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreignId('member_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('kasir_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('barang_id')->nullable()->constrained('barangs')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('buys', function (Blueprint $table) {
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreignId('barang_id')->nullable()->constrained('barangs')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('barang_id')->nullable()->constrained('barangs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
