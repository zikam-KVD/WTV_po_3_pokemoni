<?php

use App\Http\Controllers\PageController;
use App\Models\Pokemon;
use App\Models\Typ;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'ukazIndex'])->name('index');

Route::get('/pokemon/detail/{id}', function (int $id) {

    $pokemon = Pokemon::find($id);
    if($pokemon === null)
    {
        return abort(404);
    }

return view('detail', ["poke" => $pokemon]);

})->name('detail');

Route::get('/pokemoni-podle-typu/{typ}', [PageController::class, 'pokemoniPodleTypu'])->name('podleTypu');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get(
        '/typy',
        [PageController::class, 'jaNemamNejmensiPoneti'],
    )->name('jaTakyNe');

    Route::post(
        '/typy',
        [PageController::class, 'nevim'],
    )->name('vlozTyp');
    //tohgle vykresluje view s formularem pridavajici pokemona
    Route::get(
        '/pokemoni',
        [PageController::class, 'pokemoniFormularVykresleni']
    )->name('admin.pokemoni');
    //vytvoření noveho pokemona pomoci GET metody u formulare
    Route::post(
        '/pokemon/create',
        [PageController::class, 'createPokemon']
    )->name('vlozPokemona');

    //routa mazajici typ pokemona podle promenne {id}
    Route::post(
        '/typ/{id}/delete/',
        [PageController::class, 'deleteTyp']
    )->name('smazTyp');

});
