<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estadi;

class EstadisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Estadi::factory()->create(['nom' => 'Camp Nou', 'capacitat' => 99000, 'ciutat' => 'Barcelona']);
        Estadi::factory()->create(['nom' => 'Wanda Metropolitano', 'capacitat' => 68000, 'ciutat' => 'Madrid']);
        Estadi::factory()->create(['nom' => 'Santiago Bernabéu', 'capacitat' => 81000, 'ciutat' => 'Madrid']);

        Estadi::factory()->count(100)->create();
    }
}
