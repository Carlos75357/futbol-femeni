<?php

namespace Database\Factories;

use App\Models\Equip;
use Illuminate\Database\Eloquent\Factories\Factory;

class JugadorFactory extends Factory
{
    public function definition(): array
    {
        $equip = Equip::inRandomOrder()->first();
        $posicions = ['Portero', 'Defensa', 'Centrocampista', 'Delantero'];

        return [
            'nom' => $this->faker->name(),
            'equip_id' => $equip->id,
            'dorsal' => rand(1, 11),
            'posicio' => $posicions[array_rand($posicions)],
            'foto' => $this->faker->imageUrl(),
            'data_naixement' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
        ];
    }
}

