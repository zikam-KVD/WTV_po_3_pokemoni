<?php

use App\Models\Pokemon;
use App\Models\Typ;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $pokemoni = Pokemon::all();

    return view('welcome', ["pokemonos" => $pokemoni]);
})->name('index');

Route::get('/pokemon/detail/{id}', function (int $id) {

    $pokemon = Pokemon::find($id);

    if($pokemon === null)
    {
        return abort(404);
    }

    $typ = Typ::find($pokemon->druh);

    return view('detail', ["poke" => $pokemon, 'typ' => $typ]);

})->name('detail');
