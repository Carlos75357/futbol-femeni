<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Equip;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create managers for each Equip
        Equip::all()->each(function ($equip) use ($faker) {
            $email = str_replace(
                [' ', ',', '-', 'ç', 'í', 'ó', 'ú', 'ñ', 'è', 'á', 'é', 'à'],
                ['', '', '', 'c', 'i', 'o', 'u', 'n', 'e', 'a', 'e', 'a'], 
                $equip->nom
            ) . '@manager.com';

            User::factory()->create([
                'name' => "Manager {$equip->nom}",
                'email' => $email,
                'password' => Hash::make('1234'),
                'role' => 'manager',
                'equip_id' => $equip->id,
            ]);
        });

        // Create arbitres
        User::factory()->count(30)->arbitre()->create();
    }
}