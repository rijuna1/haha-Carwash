<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('no_trans');
            $table->string('name');
            $table->integer('type_car');
            $table->string('merk_car');
            $table->string('plat');
            $table->integer('type_wash');
            $table->string('information');
            $table->integer('price');
            $table->integer('discount');
            $table->integer('additional_discount');
            $table->integer('total_price');
            $table->string('user_in');
            $table->string('user_out')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
