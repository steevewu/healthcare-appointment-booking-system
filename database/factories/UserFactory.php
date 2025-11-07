<?php

namespace Database\Factories;

use App\Models\User;
use Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{


    protected $model = User::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeemail(),
            'password' => Hash::make('phenikaa'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }


    public function withEmail(string $email){
        return $this->state(
            fn () => [
                'email' => $email
            ]
        );
    }
}
