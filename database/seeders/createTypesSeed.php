<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class createTypesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typy = [
            ["normální", "Gray"],
            ["ohnivý", "#FF0000"],
            ["vodní", "#0000FF"],
            ["létající", "Brown"],
            ["psychický", "Purple"],
        ];

        foreach($typy as $typ)
        {
            DB::table("types")->insert([
                "nazev" => $typ[0],
                "barva" => $typ[1],
            ]);
        }
    }
}
