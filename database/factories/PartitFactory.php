<?php

namespace Database\Factories;

use App\Models\Equip;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartitFactory extends Factory
{
    public function definition(): array
    {
        $equipLocal = Equip::inRandomOrder()->first();
        $equipVisitant = Equip::where('id', '!=', $equipLocal->id)->inRandomOrder()->first();

        $golsLocal = rand(0, 5);
        $golsVisitant = rand(0, 5);

        return [
            'equip_local_id' => $equipLocal->id,
            'equip_visitant_id' => $equipVisitant->id,
            'data_partit' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'gols_local' => $golsLocal,
            'gols_visitant' => $golsVisitant,
        ];
    }
}
