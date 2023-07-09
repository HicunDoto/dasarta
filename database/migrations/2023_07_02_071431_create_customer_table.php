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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->longText('alamat');
            $table->string('no_hp');
            $table->string('foto_ktp');
            $table->integer('jenis'); // 0 = cewek, 1 = cowok
            $table->string('nik'); // 0 = cewek, 1 = cowok
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
