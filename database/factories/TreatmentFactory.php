<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatment>
 */
class TreatmentFactory extends Factory
{
    protected $model = Treatment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new \DavidBadura\FakerMarkdownGenerator\FakerProvider($this->faker));
        return [
            'appointment_id' => Appointment::factory()->confirmed()->create(),
            'notes' => $this->faker->markdownNumberedList(),
            'medication' => $this->faker->markdownNumberedList()
        ];
    }
}
