<?php

namespace App\Http\Controllers\configuration;

use App\Models\Pays;
use App\Models\Eleve;
use App\Models\Ville;
use Illuminate\Http\Request;
use App\Models\GroupeSanguin;
use App\Http\Controllers\Controller;

class EleveController extends Controller
{
    //

    public function index(){
        $data_eleve = Eleve::get();
        return view('backend.pages.eleve.index' , compact('data_eleve'));
    }



    public function create(Request $request){

        $data_groupe_sanguin = GroupeSanguin::OrderBy('position', 'ASC')->get();
        $data_pays = Pays::orderBy('country', 'ASC')->get();
        $data_ville = Ville::OrderBy('city', 'ASC')->get();


        return view('backend.pages.eleve.create' , compact('data_groupe_sanguin' , 'data_pays' , 'data_ville'));
    }
}
