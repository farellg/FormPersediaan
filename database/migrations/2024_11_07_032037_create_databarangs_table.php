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
        Schema::create('databarang', function (Blueprint $table) {
            $table->integer('kode_barang');
            $table->unique('kode_barang');
            $table->string('image_barang');
            $table->string('nama_barang');
            $table->string('satuan');
            $table->integer('saldo_disistem');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('databarang');
    }
};
