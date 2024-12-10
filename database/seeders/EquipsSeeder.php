<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estadi;
use App\Models\Equip;

class EquipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $campNou = Estadi::where('nom', 'Camp Nou')->first();
        $campNou->equips()->create([
            'nom' => 'Barça Femení',
            'titols' => 30,
        ]);

        $wanda = Estadi::where('nom', 'Wanda Metropolitano')->first();
        $wanda->equips()->create([
            'nom' => 'Atlètic de Madrid',
            'titols' => 10,
        ]);

        $bernabeu = Estadi::where('nom', 'Santiago Bernabéu')->first();
        $bernabeu->equips()->create([
            'nom' => 'Real Madrid Femení',
            'titols' => 5,
        ]);

        Equip::factory()->count(20)->create();
    }
}
