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
