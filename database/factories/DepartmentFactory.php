<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->jobTitle() . ' Department';
        $alias = strtoupper($this->faker->unique()->bothify('???##'));


        return [
            //
            'name' => Str::limit($name, 50, ''),
            'alias' => $alias,

        ];
    }
}
