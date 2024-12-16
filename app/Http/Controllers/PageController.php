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
    //vykresli view pokemoniFormular a posle tam do $typy vsechny pokemonni typy
    public function pokemoniFormularVykresleni()
    {
        return view('pokemoniFormular', ["typy" => Typ::all()]);
    }

    public function createPokemon(Request $req)
    {
        //zvaliduji data a ulozim to do $val
        $val = $req->validate([
            "pokemon-nazev" => 'required|min:4|max:18|unique:pokemons,nazev',
            "pokemon-typ" => 'required|exists:types,id',
            "pokemon-obrazek" => 'required|extensions:png',
        ]);

        //vlozim novy typ s ok udaji
        $poke = Pokemon::create([
            "nazev" => $val["pokemon-nazev"],
            "druh" => $req["pokemon-typ"],
        ]);
        $poke->save();

        $obrazek = $req->file('pokemon-obrazek');
        $obrazekNazev = $poke->id ."." . $obrazek->getClientOriginalExtension();
        $obrazek->move(public_path('img'), $obrazekNazev);

        return back()->with("message", "Vložil jsi nového pokemona $poke->nazev.");
    }

    public function deleteTyp(int $id)
    {
        $typ = Typ::find($id);

        if(null !== $typ) {

            foreach($typ->pokemons as $poke){
                $poke->delete();
            }

            $typ->delete();
            return back()->with("message", "Hurá, smazáno.");
        }
    }
}
