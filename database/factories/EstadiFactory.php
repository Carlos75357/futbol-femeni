<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Equip;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estadi>
 */
class EstadiFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->city.' Stadium',
            'capacitat' => $this->faker->numberBetween(10000, 100000),
            'ciutat' => $this->faker->city,
        ];
    }
    
}
