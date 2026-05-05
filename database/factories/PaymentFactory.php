<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
    {
    // Ambil pendaftaran secara acak
    $enrollment = \App\Models\Enrollment::inRandomOrder()->first();
    
    return [
        'enrollment_id' => $enrollment->id,
        // Ambil harga dari kursus yang terkait dengan pendaftaran tersebut
        'amount' => $enrollment->course->price ?? 150000, 
        'payment_method' => fake()->randomElement(['GoPay', 'OVO', 'Transfer Bank', 'Dana']),
        'status' => 'success',
        'paid_at' => $enrollment->enrolled_at,
    ];
    }
}
