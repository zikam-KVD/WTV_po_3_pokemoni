<?php

namespace Database\Seeders;

use App\Models\Pokemon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class vytvorPokemony extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //"nazev", "druh"
        $pokemoni = [
            ["name" => "Cadabra", "type" => 5],
            ["name" => "Pidgeotto", "type" => 4],
            ["name" => "Charizard", "type" => 2],
            ["name" => "Blastoise", "type" => 3],
        ];

        foreach($pokemoni as $p)
        {
            Pokemon::insert([
                "nazev" => $p["name"],
                "druh" => $p["type"],
            ]);
        }
    }
}
