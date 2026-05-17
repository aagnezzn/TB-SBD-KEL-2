<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\User; // FAKTA: Ini wajib ada agar sistem mengenali model User
use App\Models\Course; // FAKTA: Ini wajib ada agar sistem mengenali model Course
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Mencari siswa acak untuk mengisi Foreign Key user_id
        $student = User::where('role', 'student')->inRandomOrder()->first();
        $studentId = $student ? $student->id : User::factory()->create(['role' => 'student'])->id;

        // Mencari kursus acak untuk mengisi Foreign Key course_id
        $course = Course::inRandomOrder()->first();
        $courseId = $course ? $course->id : Course::factory()->create()->id;

        return [
            'user_id'        => $studentId,
            'course_id'      => $courseId,
            'amount'         => $course ? $course->price : 150000, 
            'payment_method' => $this->faker->randomElement(['OVO', 'Transfer Bank', 'Dana']),
            'status'         => 'success', 
            'paid_at'        => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}