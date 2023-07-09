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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->references('id')->on('paket')->onDelete('cascade')->nullable();
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->nullable()->references('id')->on('customer')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->bigInteger('sales_id')->unsigned();
            $table->foreign('sales_id')->nullable()->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
