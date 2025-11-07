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

    protected $model = Doctor::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $this->faker->addProvider(new \DavidBadura\FakerMarkdownGenerator\FakerProvider($this->faker));
        return [
            'user_id' => User::factory(),
            'fullname' => $this->faker->name(),
            'dob' => $this->faker->dateTimeBetween('-75 years', '-30 years'),
            'depart_id' => Department::inRandomOrder()->value('id'),
            'resume' => $this->faker->markdownNumberedList()
        ];
    }


    public function configure()
    {
        return $this->afterCreating(
            function (Doctor $doctor) {
                $user = $doctor->user;
                $user->assignRole('doctor');
                $user->save();
            }
        );
    }


    public function withEmail(string $email){
        return $this->state(
            fn() => [
                'user_id' => User::factory()->withEmail($email)
            ]
        );
    }


}
