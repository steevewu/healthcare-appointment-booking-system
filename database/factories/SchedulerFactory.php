<?php

namespace Database\Factories;

use App\Models\Scheduler;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Scheduler>
 */
class SchedulerFactory extends Factory
{


    protected $model = Scheduler::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'fullname' => $this->faker->name(),
            'dob' => $this->faker->dateTimeBetween('-65 years, -20 years'),
        ];
    }


    public function configure()
    {
        return $this->afterCreating(
            function (Scheduler $scheduler) {

                $user = $scheduler->user;

                $user->assignRole('scheduler');
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
