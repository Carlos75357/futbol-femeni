<?php

namespace Database\Seeders;

use App\Models\Jugador;
use Illuminate\Database\Seeder;
use App\Models\Equip;

class JugadorsSeeder extends Seeder
{
    public function run()
    {
        $equipos = Equip::all();

        foreach ($equipos as $equipo) {
            Jugador::factory(2)->create([
                'equip_id' => $equipo->id,
                'posicio' => 'Portero'
            ]);

            Jugador::factory(5)->create([
                'equip_id' => $equipo->id,
                'posicio' => 'Defensa'
            ]);

            Jugador::factory(4)->create([
                'equip_id' => $equipo->id,
                'posicio' => 'Centrocampista'
            ]);

            Jugador::factory(2)->create([
                'equip_id' => $equipo->id,
                'posicio' => 'Delantero'
            ]);

            Jugador::factory(2)->create([
                'equip_id' => $equipo->id,
            ]);
        }
    }
}

