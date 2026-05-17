<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke kategori
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            
            // Relasi ke instruktur (User)
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');
            
            $table->string('title');
            $table->text('description');
            $table->integer('price'); 
            $table->integer('subscribers_count')->default(0);
            $table->integer('reviews_count')->default(0);
            $table->string('image_url')->nullable();
            
            // FIX: Tambahkan kolom status untuk mendukung data Factory & Controller
            $table->string('status')->default('active'); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};