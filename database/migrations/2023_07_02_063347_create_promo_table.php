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
        Schema::create('promo', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->date('masa_aktif')->nullable();
            $table->bigInteger('potongan_harga')->nullable();
            $table->integer('status')->nullable(); // 0 = tidak aktif, 1 = aktif, 2 = expired
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo');
    }
};
