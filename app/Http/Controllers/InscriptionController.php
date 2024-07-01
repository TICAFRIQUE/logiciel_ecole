<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Versement;
use App\Models\Inscription;
use Illuminate\Support\Str;
use App\Models\ModePaiement;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\MotifPaiement;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class InscriptionController extends Controller
{
    //

    public function index()
    {
        $data_inscription = Inscription::with('versements')->withCount('versements')->get();
        // dd($data_inscription->toArray());

        return view('backend.pages.inscription.index', compact('data_inscription'));
    }

    public function create(Request $request)
    {

        $data_eleve = Eleve::with(['inscriptions' => fn ($q) => $q->withWhereHas(
            'anneeScolaire',
            fn ($q) => $q->whereStatus('active')
        )])->withCount(['inscriptions' => fn ($q) => $q->withWhereHas(
            'anneeScolaire',
            fn ($q) => $q->whereStatus('active')
        )])->get();
        $data_eleve =  $data_eleve->where('inscriptions_count', '=', 0);

        // dd($data_eleve->toArray());
        $data_annee_scolaire = AnneeScolaire::whereStatus('active')->OrderBy('position', 'ASC')->get();
        $data_niveaux = Niveau::OrderBy('position', 'ASC')->get();
        $data_classe = Classe::OrderBy('position', 'ASC')->get();
        $data_mode_paiement = ModePaiement::whereStatus('active')->OrderBy('position', 'ASC')->get();
        $data_motif_paiement = MotifPaiement::whereStatus('active')->OrderBy('position', 'ASC')->get();

        return view('backend.pages.inscription.create', compact(
            'data_eleve',
            'data_annee_scolaire',
            'data_niveaux',
            'data_classe',
            'data_mode_paiement',
            'data_motif_paiement'
        ));
    }


    public function store(Request $request)
    {

        try {
            // dd($request->toArray());
            $data =  $request->validate([
                'numero_inscription' => '',
                'type_inscription' => '',
                'redoublant' => '',
                'affecte' => '',
                'boursier' => '',
                'eleve_id' => 'required',
                'annee_scolaire_id' => 'required',
                'niveau_id' => 'required',
                'classe_id' => '',

                //tuteur
                'nom_tuteur' => 'required',
                'prenoms_tuteur' => 'required',
                'contact1_tuteur' => 'required',
                'contact2_tuteur' => '',
                'email_tuteur' => '',

                //scolarite
                'remise' => '',
                // 'montant_scolarite' => 'required',
                'montant_remise_scolarite' => '',
                'montant_scolarite_paye' => '',
                'montant_scolarite_restant' => '',
                'statut' => '',
                // 'mode_paiement_id' => 'required',
                // 'motif_paiement_id' => 'required',
            ]);

            //generer le numero d'inscription
            $eleve = Eleve::whereId($request['eleve_id'])->first();
            $nom = Str::substr($eleve['nom'], 0, 1);
            $prenoms = Str::substr($eleve['prenoms'], 0, 1);
            $code = '';
            for ($i = 0; $i <= 4; $i++) {
                $code .= rand(0, 9);
            }
            $numero_inscription = $nom . $prenoms . $code . date('Y');

            //Montant scolarite
            $niveau = Niveau::whereId($request['niveau_id'])->first();
            $montant_scolarite = $niveau['total_scolarite'];

            //Montant remise
            $montant_remise_scolarite = 0;
            if ($request['remise']) {
                $montant_remise_scolarite += $request['montant_scolarite'];
            }



            //mise a jour du statut
            $statut = '';
            if ($request['montant_scolarite_restant'] == 0) {
                $statut = 'solde';
            } else {
                $statut = 'impaye';
            }


            //enregistrer les données de inscription
            $data_inscription = Inscription::firstOrCreate([
                'statut' => $statut,
                'numero_inscription' => $numero_inscription,
                'montant_remise_scolarite' => $montant_remise_scolarite,
                'montant_scolarite' => $montant_scolarite,
            ], $data);


            //enregistrer les données du versemement(1er versement)
            if ($request['montant_scolarite_paye']) {  // si unmontant versement est entré
                $code = '';
                for ($i = 0; $i <= 4; $i++) {
                    $code .= rand(0, 9);
                }
                $data_versement = Versement::create([
                    'code' => 'v-' . $code . date('Y'),
                    'inscription_id' => $data_inscription['id'],
                    'montant_scolarite' => $request['montant_scolarite'], // from inscription request
                    'montant_verse' => $request['montant_scolarite_paye'], // from inscription request
                    'montant_restant' => $request['montant_scolarite_restant'], // from inscription request
                    'mode_paiement_id' => $request['mode_paiement_id'],
                    'motif_paiement_id' => $request['motif_paiement_id'],
                ]);
            }

            Alert::success('Operation réussi', 'Success Message');
            return back();
        } catch (\Throwable $e) {
            return  $e->getMessage();
            // Alert::error('Erreur', $e->getMessage());
            return back();
        }
    }



    public function edit($id)
    {
        try {
            $data_inscription = Inscription::find($id);

            //recuperer le 1er versement lié a l'inscription
            $versement = $data_inscription->versements;
            // dd($versement->count());
            if ($versement->count() <= 1) {

                // $data_eleve = Eleve::with(['inscriptions' => fn ($q) => $q->withWhereHas(
                //     'anneeScolaire',
                //     fn ($q) => $q->whereStatus('active')
                // )])->withCount(['inscriptions' => fn ($q) => $q->withWhereHas(
                //     'anneeScolaire',
                //     fn ($q) => $q->whereStatus('active')
                // )])->get();
                // $data_eleve =  $data_eleve->where('inscriptions_count', '=', 0);


                $data_eleve = Eleve::get();
                $data_annee_scolaire = AnneeScolaire::whereStatus('active')->OrderBy('position', 'ASC')->get();
                $data_niveaux = Niveau::OrderBy('position', 'ASC')->get();
                $data_classe = Classe::OrderBy('position', 'ASC')->get();
                $data_mode_paiement = ModePaiement::whereStatus('active')->OrderBy('position', 'ASC')->get();
                $data_motif_paiement = MotifPaiement::whereStatus('active')->OrderBy('position', 'ASC')->get();

                //new data for edit
                $data_classe_edit = Classe::where('niveau_id',   $data_inscription['niveau_id'])->OrderBy('position', 'ASC')->get();
                // dd($data_classe->toArray());


                return view('backend.pages.inscription.edit', compact(
                    'data_inscription',
                    'data_eleve',
                    'data_annee_scolaire',
                    'data_niveaux',
                    'data_classe',
                    'data_mode_paiement',
                    'data_motif_paiement',

                    //
                    'data_classe_edit',
                    'versement'
                ));
            }
        } catch (\Throwable $e) {
            return  $e->getMessage();
            // Alert::error('Erreur', $e->getMessage());
            return back();
        }
    }


    public function update(Request $request,  $id)
    {

        try {
            // dd($request->toArray());
            $data =  $request->validate([
                // 'numero_inscription' => '',
                'type_inscription' => '',
                'redoublant' => '',
                'affecte' => '',
                'boursier' => '',
                'eleve_id' => 'required',
                'annee_scolaire_id' => 'required',
                'niveau_id' => 'required',
                'classe_id' => 'required',

                //tuteur
                'nom_tuteur' => 'required',
                'prenoms_tuteur' => 'required',
                'contact1_tuteur' => 'required',
                'contact2_tuteur' => '',
                'email_tuteur' => '',

                //scolarite
                'remise' => '',
                // 'montant_scolarite' => 'required',
                // 'montant_remise_scolarite' => '',
                'montant_scolarite_paye' => '',
                'montant_scolarite_restant' => '',
                // 'statut' => '',
            ]);


            $inscription = Inscription::find($id);
            //generer le numero d'inscription
            $numero_inscription = '';
            if ($inscription['eleve_id'] != $request['eleve_id']) {
                $eleve = Eleve::whereId($request['eleve_id'])->first();
                $nom = Str::substr($eleve['nom'], 0, 1);
                $prenoms = Str::substr($eleve['prenoms'], 0, 1);
                $code = '';
                for ($i = 0; $i <= 4; $i++) {
                    $code .= rand(0, 9);
                }
                $numero_inscription = ucfirst($nom) . ucfirst($prenoms) . $code . date('Y');
            } else {
                $numero_inscription = $inscription['numero_inscription'];
            }

            //Montant scolarite
            $montant_scolarite = 0;
            if ($inscription['niveau_id'] != $request['niveau_id']) {
                $niveau = Niveau::whereId($request['niveau_id'])->first();
                $montant_scolarite = $niveau['total_scolarite'];
            } else {
                $montant_scolarite = $inscription['montant_scolarite'];
            }


            //Montant remise
            $montant_remise_scolarite = 0;
            if ($request['remise']) {
                $montant_remise_scolarite = $request['montant_scolarite'];
            }

            //mise a jour du statut
            $statut = '';
            if ($request['montant_scolarite_restant'] == 0) {
                $statut = 'solde';
            } else {
                $statut = 'impaye';
            }


            //enregistrer les données de inscription

            $data_inscription = tap(Inscription::find($id))->update(
                [
                    'numero_inscription' => $numero_inscription,
                    'redoublant' => $request['redoublant'],
                    'affecte' =>  $request['affecte'],
                    'boursier' =>  $request['boursier'],

                    'eleve_id' => $request['eleve_id'],
                    'annee_scolaire_id' => $request['annee_scolaire_id'],
                    'niveau_id' => $request['niveau_id'],
                    'classe_id' => $request['classe_id'],

                    'nom_tuteur' => $request['nom_tuteur'],
                    'prenoms_tuteur' => $request['prenoms_tuteur'],
                    'contact1_tuteur' => $request['contact1_tuteur'],
                    'contact2_tuteur' => $request['contact2_tuteur'],

                    'remise' => $request['remise'],
                    'statut' => $statut,
                    'montant_remise_scolarite' => $montant_remise_scolarite,
                    'montant_scolarite' => $montant_scolarite,
                    'montant_scolarite_paye' => $request['montant_scolarite_paye'],
                    'montant_scolarite_restant' => $request['montant_scolarite_restant'],
                ]

            );

            // dd($data_inscription->toArray());


            //modifier ou enregistrer les données du versemement(1er versement)
            if ($request['montant_scolarite_paye']) {

                //on supprime le premier versement
                Versement::where('inscription_id', $data_inscription['id'])->delete();
                // si unmontant versement est entré
                $code = '';
                for ($i = 0; $i <= 4; $i++) {
                    $code .= rand(0, 9);
                }
                $data_versement = Versement::create([
                    'code' => 'v-' . $code . date('Y'),
                    'inscription_id' => $data_inscription['id'],
                    'montant_scolarite' => $request['montant_scolarite'], // from inscription request
                    'montant_verse' => $request['montant_scolarite_paye'], // from inscription request
                    'montant_restant' => $request['montant_scolarite_restant'], // from inscription request
                    'mode_paiement_id' => $request['mode_paiement_id'],
                    'motif_paiement_id' => $request['motif_paiement_id'],
                ]);
            }







            Alert::success('Operation réussi', 'Success Message');
            return back();
        } catch (\Throwable $e) {
            return  $e->getMessage();
            // Alert::error('Erreur', $e->getMessage());
            return back();
        }
    }


    public function detail($id)
    {
        try {
            $data_inscription = Inscription::find($id);
            $data_eleve = Eleve::find($data_inscription['eleve_id']);

            $data_versement = Versement::where('inscription_id' , $id)->with(['inscription' , 'modePaiement' ,'motifPaiement'])->get();
            // dd($data_versement[0]->modePaiement->toArray());

            return view('backend.pages.inscription.detail', compact(
                'data_inscription',
                'data_eleve',
                'data_versement'
            ));
        } catch (\Throwable $e) {
            return  $e->getMessage();
            // Alert::error('Erreur', $e->getMessage());
            return back();
        }
    }


    public function delete($id)
    {

        try {
            Inscription::find($id)->delete();
            return response()->json([
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            Alert::error('Erreur', $th->getMessage());
            return back();
        }
    }
}
