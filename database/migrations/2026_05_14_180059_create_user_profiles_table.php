<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            // Relasi One-to-One terkunci sempurna ke tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('headline', 60)->nullable();
            $table->text('bio')->nullable();
            
            $table->string('photo')->nullable(); 
            
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};