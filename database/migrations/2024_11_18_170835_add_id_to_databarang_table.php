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
        Schema::table('databarang', function (Blueprint $table) {
            $table->id()->first(); // Menambahkan kolom 'id' sebagai primary key di awal tabel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('databarang', function (Blueprint $table) {
            $table->dropColumn('id'); // Menghapus kolom 'id' jika migrasi di-rollback
        });
    }
};
