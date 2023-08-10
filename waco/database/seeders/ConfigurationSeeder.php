<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Configuration;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuration::create([
            'url' => 'https://pokeapi.co/api/v2/pokemon',
            'amount_pokemon' => 1000,
            'option' => 1
        ]);
    }
}
