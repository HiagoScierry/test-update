<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            "document" => $this->faker->numerify('###########'),
            'birth_date' => $this->faker->date(),
            'sex' => $this->faker->randomElement(['M', 'F']),
            'address' => $this->faker->streetAddress,
            'state' => $this->faker->stateAbbr,
            'city' => $this->faker->city,
        ];
    }
}
