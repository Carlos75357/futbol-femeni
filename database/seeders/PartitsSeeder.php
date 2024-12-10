<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Partit;
use Illuminate\Database\Seeder;

class PartitsSeeder extends Seeder
{
    public function run()
    {
        $equipos = Equip::all();  

        foreach ($equipos as $equipo) {
            Partit::factory(3)->create([
                'equip_local_id' => $equipo->id,  
            ]);
            Partit::factory(3)->create([
                'equip_visitant_id' => $equipo->id, 
            ]);
        }
    }
}