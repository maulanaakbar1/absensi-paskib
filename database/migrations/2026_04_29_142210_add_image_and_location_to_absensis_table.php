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
        Schema::table('absensis', function (Blueprint $table) {
            // Kita gunakan longText karena data foto Base64 sangat panjang
            $table->longText('foto')->after('jam_masuk'); 
            
            // Kolom lokasi untuk menyimpan latitude & longitude
            $table->string('lokasi')->after('foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            // Untuk jaga-jaga kalau mau di-rollback
            $table->dropColumn(['foto', 'lokasi']);
        });
    }
};