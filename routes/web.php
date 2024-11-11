<?php

use App\Models\Pokemon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $pokemoni = Pokemon::all();

    return view('welcome', ["pokemonos" => $pokemoni]);
});
// TODO: pojmenované routy
Route::get('/detail', function () {
    return view('detail');
});
