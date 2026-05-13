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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke tabel categories dengan pengaman cascade
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            
            // FIX KONSISTENSI: Gunakan gaya penulisan constrained('users') murni agar indeks foreign key terkunci sempurna
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');
            
            $table->string('title');
            $table->text('description');
            $table->integer('price'); // INT aman untuk Rupiah murni
            $table->string('image_url')->nullable();
            
            // FIX: Tambahkan kolom status dengan nilai default agar seeder factory tidak crash
            $table->string('status')->default('active'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};