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
    Schema::create('lessons', function (Blueprint $table) {
        $table->id();
        // Foreign Key ke tabel courses
        $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
        
        $table->string('title'); // Judul bab (misal: "Pengenalan Database")
        $table->text('content'); // Isi materi atau ringkasan 
        $table->integer('duration'); // Durasi dalam menit (untuk query Aggregate nanti)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
