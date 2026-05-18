<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\User; 
use App\Models\Course; 
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        // WAJIB ambil siswa yang sudah ada
        $studentId = User::where('role', 'student')->inRandomOrder()->value('id');
        if (!$studentId) {
            $studentId = User::factory()->create(['role' => 'student'])->id;
        }

        // WAJIB ambil kursus yang sudah ada
        $course = Course::inRandomOrder()->first();
        $courseId = $course ? $course->id : Course::factory()->create()->id;
        $amount = $course ? $course->price : 150000;

        return [
            'user_id'        => $studentId,
            'course_id'      => $courseId,
            'amount'         => $amount, 
            'payment_method' => $this->faker->randomElement(['OVO', 'Transfer Bank', 'Dana']),
            'status'         => 'success', 
            'paid_at'        => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}