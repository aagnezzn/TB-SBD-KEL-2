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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
    
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
        
        $table->integer('amount'); // Nominal pembayaran
        $table->string('payment_method'); // Misal: 'Bank Transfer', 'E-Wallet'
        $table->enum('status', ['pending', 'success', 'failed'])->default('success');
        $table->timestamp('paid_at')->useCurrent();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
