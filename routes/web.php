<?php

use App\Models\Pokemon;
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

    return view('detail', ["poke" => $pokemon]);

})->name('detail');
