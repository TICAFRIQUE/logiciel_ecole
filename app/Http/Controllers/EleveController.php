<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Models\Eleve;
use App\Models\Ville;
use App\Models\Classe;
use Nette\Utils\Random;
use Illuminate\Support\Str;
use App\Models\ModePaiement;
use Illuminate\Http\Request;
use App\Models\GroupeSanguin;
use App\Models\MotifPaiement;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class EleveController extends Controller
{
    //

    public function index()
    {
        $data_eleve = Eleve::with('media')->get();
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
                'handicap' => '',
                'sexe' => 'required',
                'groupe_sanguin_id' => '',
                'nom' => 'required',
                'prenoms' => 'required',
                'email' => '',
                'contact' => '',
                'date_naissance' => '',
                'lieu_naissance' => '',
                'pays_id' => '', //pays de naissance
                'ville_id' => '', //commune de residence
                'quartier' => '', //quartier de residence
                'etablissement_origine' => '',
                'nom_pere' => '',
                'prenoms_pere' => '',
                'contact_pere' => '',
                'statut_vivant_pere' => '', //boolean --oui ou non
                'nom_mere' => '',
                'prenoms_mere' => '',
                'contact_mere' => '',
                'statut_vivant_mere' => '', //boolean --oui ou non
                'date_admission' => '',
                'date_sortie' => '',
            ]);


            // $nationalite = Pays::whereId($request['id'])->select('nationality')->first();

            $code = '';
            for ($i = 0; $i <= 4; $i++) {
                $code .= rand(0, 9);
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
            ], $data);

            if (request()->hasFile('profil_file')) {
                $data_eleve->addMediaFromRequest('profil_file')->toMediaCollection('profilFile');
            }

            if (request()->hasFile('extrait_file')) {
                $data_eleve->addMediaFromRequest('extrait_file')->toMediaCollection('extraitFile');
            }


            Alert::success('Operation réussi', 'Success Message');

            return back();
        } catch (\Throwable $e) {
            Alert::error('Erreur', $e->getMessage());
            return back();
        }
    }


    public function detail($id)
    {

        try {
            $data_eleve = Eleve::find($id);

            // dd($data_eleve->inscriptions->toArray());

            //recuperer la classe en cour de l'eleve
            $data_classe = Eleve::with(['inscriptions' => fn ($q) => $q->withWhereHas(
                'anneeScolaire',
                fn ($q) => $q->whereStatus('active')
            )])->withCount('inscriptions')->whereId($id)->first();
            
            // dd($data_classe->inscriptions->count());


            // $classe = '';
            // if ($data_classe->inscriptions_count > 0) {
            //     $classe = Classe::whereId($data_classe->inscriptions[0]->classe_id)->first();
            // } //
            // dd($data_classe->inscriptions[0]->classe->toArray());

            // liste des reliquats of user
            $data_reliquat = Eleve::with(['inscriptions' => fn ($q) => $q->withWhereHas(
                'anneeScolaire',
                fn ($q) => $q->whereStatus('desactive')
            )])->whereId($id)->first();

            $data_mode_paiement = ModePaiement::whereStatus('active')->OrderBy('position', 'ASC')->get();
            $data_motif_paiement = MotifPaiement::whereStatus('active')->OrderBy('position', 'ASC')->get();

            // dd($data_reliquat->toArray());


            return view('backend.pages.eleve.detail', compact(
                'data_eleve', 
                'data_classe',
                'data_reliquat',
                'data_mode_paiement',
                'data_motif_paiement'

            ));
        } catch (\Throwable $th) {
            Alert::error('Erreur', $th->getMessage());
            return back();
        }
    }


    public function edit($id)
    {
        try {
            $data_eleve = Eleve::findOrFail($id);
            // dd($data_eleve->toArray());
            $data_groupe_sanguin = GroupeSanguin::OrderBy('position', 'ASC')->get();
            $data_pays = Pays::orderBy('country', 'ASC')->get();
            $data_ville = Ville::OrderBy('city', 'ASC')->get();
            return view('backend.pages.eleve.edit', compact('data_eleve', 'data_groupe_sanguin', 'data_pays', 'data_ville'));
        } catch (\Throwable $th) {
            Alert::error('Erreur', $th->getMessage());
            return back();
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $data =  $request->validate([
                'matricule' => 'required',
                'numero_extrait' => 'required',
                'handicap' => '',
                'sexe' => 'required',
                'groupe_sanguin_id' => '',
                'nom' => 'required',
                'prenoms' => 'required',
                'email' => '',
                'contact' => '',
                'date_naissance' => '',
                'lieu_naissance' => '',
                'pays_id' => '', //pays de naissance
                'ville_id' => '', //commune de residence
                'quartier' => '', //quartier de residence
                'etablissement_origine' => '',
                'nom_pere' => '',
                'prenoms_pere' => '',
                'contact_pere' => '',
                'statut_vivant_pere' => '', //boolean --oui ou non
                'nom_mere' => '',
                'prenoms_mere' => '',
                'contact_mere' => '',
                'statut_vivant_mere' => '', //boolean --oui ou non
                'date_admission' => '',
                'date_sortie' => '',
            ]);
            $eleve = Eleve::find($id);
            $eleve->update($data);

            if (request()->hasFile('profil_file')) {
                $eleve->clearMediaCollection('profilFile');
                $eleve->addMediaFromRequest('profil_file')->toMediaCollection('profilFile');
            }
            if (request()->hasFile('extrait_file')) {
                $eleve->clearMediaCollection('extraitFile');
                $eleve->addMediaFromRequest('extrait_file')->toMediaCollection('extraitFile');
            }

            Alert::success('Opération réussi', 'Success Message');
            return back();
        } catch (\Throwable $e) {
            Alert::error('Erreur', $e->getMessage());
            return back();
        }
    }


    public function delete($id)
    {

        try {
            Eleve::find($id)->delete();
            return response()->json([
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            Alert::error('Erreur', $th->getMessage());
            return back();
        }
    }
}
