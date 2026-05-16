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
        Schema::table('user_profiles', function (Blueprint $table) {
        // Hapus kolom yang tidak diperlukan di sini
        $table->dropColumn(['tiktok', 'youtube', 'linkedin']); 
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
        // Logika rollback: buat kembali kolomnya jika migration dibatalkan
        $table->string('tiktok')->nullable();
        $table->string('youtube')->nullable();
        $table->string('linkedin')->nullable();
    });
    }
};
