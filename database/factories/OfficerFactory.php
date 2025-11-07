<?php

namespace Database\Factories;

use App\Models\Officer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Officer>
 */
class OfficerFactory extends Factory
{


    protected $model = Officer::class;
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
            'fullname' => $this->faker->name(),
            'dob' => $this->faker->dateTimeBetween('-65 years', '-25 years'),
        ];
    }


    public function configure(){
        return $this->afterCreating(
            function (Officer $officer){

                $user = $officer->user;
                $user->assignRole('officer');
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
