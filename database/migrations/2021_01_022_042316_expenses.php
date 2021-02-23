<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Expenses extends Migration{
    
    public function up(){
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('expense')->comment('pengeluaran');
            $table->string('total')->nullable();
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('expenses');
    }
}

