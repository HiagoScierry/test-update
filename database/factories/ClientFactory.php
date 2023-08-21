<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class Client extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
            "document" => $this->faker->numerify('###########'),
            "birth_date" => $this->faker->date(),
            "sex" => $this->faker->randomElement(['M', 'F']),
            "address" => $this->faker->address(),
            "state" => $this->faker->state(),
            "city" => $this->faker->city(),
            
        ];
    }

}