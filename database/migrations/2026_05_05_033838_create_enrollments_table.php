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
    Schema::create('enrollments', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke Siswa (User)
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        // Menghubungkan ke Kursus
        $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
        
        $table->timestamp('enrolled_at')->useCurrent();
        // Di dalam create_enrollments_table.php
        $table->enum('status', ['pending', 'active', 'completed', 'dropped'])->default('pending');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
