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
            'posicio' => $posicions[array_rand($posicions)],
            'foto' => $this->faker->imageUrl(),
        ];
    }
}
