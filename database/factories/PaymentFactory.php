<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        $enrollment = Enrollment::inRandomOrder()->first();
        if (!$enrollment) {
            $enrollment = Enrollment::factory()->create();
        }
        
        return [
            'enrollment_id'  => $enrollment->id,
            'amount'         => $enrollment->course->price ?? 150000, 
            'payment_method' => $this->faker->randomElement(['OVO', 'Transfer Bank', 'Dana']),
            'status'         => 'success',
            'paid_at'        => $enrollment->enrolled_at ?? now(),
        ];
    }
}