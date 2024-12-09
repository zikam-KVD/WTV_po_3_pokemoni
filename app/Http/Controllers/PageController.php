<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Typ;
use Exception;
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

    //zobrazuje mi typy pokemonu v AR
    public function jaNemamNejmensiPoneti()
    {
        return view(
            'typyFormular',
            ["typy" => Typ::all()
        ]);
    }

    //zpracovani dat z formulare
    public function nevim(Request $request)
    {
        try{
            //zvaliduji data a ulozim to do $val
            $val = $request->validate([
                "typ-nazev" => 'required|min:4|max:18|unique:types,nazev',
                "typ-barva" => 'required|hex_color'
            ]);

            //vlozim novy typ s ok udaji
            Typ::insert([
                "nazev" => $val["typ-nazev"],
                "barva" => $request["typ-barva"],
            ]);

            return back()->with("message", "Vložil jsi nový typ.");
        } catch(Exception $e) {
            return back()->with("message", "Chyba: " . $e->getMessage());
        }
    }
}
