<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => User::factory(),
            'fullname' => $this->faker->name,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Doctor $doctor) {
            $faker = \Faker\Factory::create();
            // Assign role to the associated user
            $user = $doctor->user;

            $doctor->forceFill(
                [
                    'depart_id' => Department::inRandomOrder()->value('id')
                ]
            );
            $user->forceFill([
                'created_at' => $faker->dateTimeBetween('-5 year', 'now'),
                'updated_at' => now(),
            ]);

            $user->assignRole('doctor');
            $user->save();
            $doctor->save();
        });
    }
}
