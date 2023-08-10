<?php

namespace App\Http\Controllers\pokemon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\services\RequestController;
use App\Models\Configuration;

class PokemonController extends Controller
{
    public function get(Request $request) {

        $statusOk = 200;
        $pokemonList = [];
        $counter = [];

        $dataApiPokemon = Configuration::where('option', 1)->select('url', 'amount_pokemon')->first();

        $uri = $dataApiPokemon->url."?limit=".$dataApiPokemon->amount_pokemon;
        $method = 'GET';
        $responseApiPk = (new RequestController)->makeGetRequest($uri, $method);

        if($responseApiPk['status_code'] == $statusOk){
            $pokemonList = $responseApiPk['response_body']['results'];
            $counter = count($pokemonList);
        }

        return view('dashboard', ['pokemonList' => $pokemonList, 'counter' => $counter]);
    }
}
