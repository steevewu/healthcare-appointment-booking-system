<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Workshift;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{

    protected $model = Appointment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new \DavidBadura\FakerMarkdownGenerator\FakerProvider($this->faker));
        return [
            'workshift_id' => Workshift::factory(),
            'patient_id' => Patient::inRandomOrder()->value('id'),
            'status' => $this->faker->randomElement(['pending', 'canceled', 'confirmed']),
            'message' => $this->faker->markdownNumberedList(),
        ];
    }


    public function confirmed()
    {
        return $this->state(
            fn() => [
                'status' => 'confirmed'
            ]
        );
    }
}
