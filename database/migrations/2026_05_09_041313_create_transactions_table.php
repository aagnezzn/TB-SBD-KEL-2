<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); 
            $table->string('payment_method'); // Contoh: Transfer Bank, E-Wallet
            $table->decimal('amount', 15, 2); // Total harga
            $table->string('status')->default('success'); 
            $table->timestamp('paid_at')->nullable(); // Tanggal bayar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
