<?php

namespace App\Http\Controllers\configuration;

use App\Models\Pays;
use App\Models\Eleve;
use App\Models\Ville;
use Nette\Utils\Random;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GroupeSanguin;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class EleveController extends Controller
{
    //

    public function index()
    {
        $data_eleve = Eleve::get();
        return view('backend.pages.eleve.index', compact('data_eleve'));
    }



    public function create(Request $request)
    {

        $data_groupe_sanguin = GroupeSanguin::OrderBy('position', 'ASC')->get();
        $data_pays = Pays::orderBy('country', 'ASC')->get();
        $data_ville = Ville::OrderBy('city', 'ASC')->get();


        return view('backend.pages.eleve.create', compact('data_groupe_sanguin', 'data_pays', 'data_ville'));
    }


    public function store(Request $request)
    {
        // dd($request->toArray());
        try {
            
        $data =  $request->validate([
            'matricule' => 'required|unique:eleves',
            'numero_extrait' => 'required|unique:eleves',
            'handicap' => 'required',
            'sexe' => 'required',
            'groupe_sanguin_id' => 'required',
            'nom' => 'required',
            'prenoms' => 'required',
            'email' => 'required',
            'contact' => 'required|unique:eleves',
            'date_naissance' => 'required',
            'lieu_naissance' => 'required',
            'pays_id' => 'required', //pays de naissance
            'ville_id' => 'required', //commune de residence
            'quartier' => 'required', //quartier de residence
            'etablissement_origine' => '',
            'nom_pere' => 'required',
            'prenoms_pere' => 'required',
            'contact_pere' => 'required',
            'statut_vivant_pere' => 'required', //boolean --oui ou non
            'nom_mere' => 'required',
            'prenoms_mere' => 'required',
            'contact_mere' => 'required',
            'statut_vivant_mere' => 'required', //boolean --oui ou non
            'date_admission' => 'required',
            'date_sortie' => 'required',
        ]);


        // $nationalite = Pays::whereId($request['id'])->select('nationality')->first();

        $code ='';
        for ($i=0; $i <=4 ; $i++) { 
           $code .= rand(0,9);
        }

        $data_eleve = Eleve::firstOrCreate([

            'code' => $code,
            // 'matricule' => $request['matricule'],
            // 'numero_extrait' => $request['numero_extrait'],
            // 'handicap' => $request['handicap'],
            // 'sexe' => $request['sexe'],
            // 'groupe_sanguin_id' => $request['groupe_sanguin_id'],
            // 'nom' => $request['nom'],
            // 'prenoms' => $request['prenoms'],
            // 'email' => $request['email'],
            // 'contact' => $request['contact'],
            // 'date_naissance' => $request['date_naissance'],
            // 'lieu_naissance' => $request['lieu_naissance'],
            // 'pays_id' => $request['pays_id'],
            // 'ville_id' => $request['ville_id'],
            // 'quartier' => $request['quartier'],
            // 'etablissement_origine' => $request['etablissement_origine'],
            // 'nom_pere' => $request['nom_pere'],
            // 'prenoms_pere' => $request['prenoms_pere'],
            // 'contact_pere' => $request['contact_pere'],
            // 'statut_vivant_pere' => $request['statut_vivant_pere'],
            // 'nom_mere' => $request['nom_mere'],
            // 'prenoms_mere'=>$request['prenoms_mere'],
            // 'contact_mere'=>$request['contact_mere'],
            // 'statut_vivant_mere'=>$request['statut_vivant_mere'],
            // 'date_admission'=>$request['date_admission'],
            // 'date_sortie'=>$request['date_sortie'],
        ] , $data);

        Alert::success('Operation réussi', 'Success Message');

        return back();
          
        } catch (\Throwable $e) {
            Alert::error('Erreur', $e->getMessage());
            return back();
        }
    }
}
