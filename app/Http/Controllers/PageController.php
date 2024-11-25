<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Typ;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //tohle mi zobrazuje index
    public function ukazIndex()
    {
        $pokemoni = Pokemon::all();
        return view('welcome', ["pokemonos" => $pokemoni]);
    }

    //tohle mi ukazuje podkemony podle $typId
    public function pokemoniPodleTypu($typId)
    {
        $dbTyp = Typ::find($typId);

        if(null == $dbTyp){
            abort(404);
        }

        $pokemons = $dbTyp->pokemons;

        return view('typy', ['pokemonos' => $pokemons]);
    }
}
