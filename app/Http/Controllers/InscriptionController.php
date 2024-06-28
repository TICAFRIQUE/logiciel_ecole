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
        $data_inscription = Inscription::get();

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
                'montant_scolarite_paye' => 'required',
                'montant_scolarite_restant' => 'required',
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


            //enregistrer les données du versmement(1er versement)
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
            // dd($data_inscription->versements->toArray());


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
                'data_classe_edit'
            ));
        } catch (\Throwable $e) {
            return  $e->getMessage();
            // Alert::error('Erreur', $e->getMessage());
            return back();
        }
    }


    public function update(Request $request,  $id)
    {

        try {
            $data =  $request->validate([
                // 'numero_inscription' => '',
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
                'montant_scolarite_paye' => 'required',
                'montant_scolarite_restant' => 'required',
                'statut' => '',
            ]);
            $inscription = Inscription::find($id);
            $inscription->update($data);



            // //generer le numero d'inscription
            // $eleve = Eleve::whereId($request['eleve_id'])->first();
            // $nom = Str::substr($eleve['nom'], 0, 1);
            // $prenoms = Str::substr($eleve['prenoms'], 0, 1);
            // $code = '';
            // for ($i = 0; $i <= 4; $i++) {
            //     $code .= rand(0, 9);
            // }
            // $numero_inscription = $nom . $prenoms . $code . date('Y');

            // //Montant scolarite
            // $niveau = Niveau::whereId($request['niveau_id'])->first();
            // $montant_scolarite = $niveau['total_scolarite'];

            // //Montant remise
            // $montant_remise_scolarite = 0;
            // if ($request['remise']) {
            //     $montant_remise_scolarite += $request['montant_scolarite'];
            // }

            // //mise a jour du statut
            // $statut = '';
            // if ($request['montant_scolarite_restant'] == 0) {
            //     $statut = 'solde';
            // } else {
            //     $statut = 'impaye';
            // }


            // //enregistrer les données de inscription
            // $inscription = Inscription::find($id);

            // //update si niveau le change 
            // if (($inscription['niveau_id'] != $request['niveau_id'])  || ($inscription['remise'] != $request['remise'])) {
            //     $inscription->update([
            //         'statut' => $statut,
            //         'numero_inscription' => $numero_inscription,
            //         'montant_remise_scolarite' => $montant_remise_scolarite,
            //         'montant_scolarite' => $montant_scolarite,
            //     ], $data);


            //     //supprimer et inserer le versement
            //     $versement = Versement::where('inscription_id' , $id)->delete();
            //     //on enregistre le nouveau versement
            //     $code = '';
            //     for ($i = 0; $i <= 4; $i++) {
            //         $code .= rand(0, 9);
            //     }
            //     $data_versement = Versement::create([
            //         'code' => 'v-' . $code . date('Y'),
            //         'inscription_id' => $id,
            //         'montant_scolarite' => $request['montant_scolarite'], // from inscription request
            //         'montant_verse' => $request['montant_scolarite_paye'], // from inscription request
            //         'montant_restant' => $request['montant_scolarite_restant'], // from inscription request
            //         'mode_paiement_id' => $request['mode_paiement_id'],
            //         'motif_paiement_id' => $request['motif_paiement_id'],
            //     ]);
            // } else {  // si le niveau ne change pas
            //     $inscription->update([
            //         'redoublant' => $request['redoublant'],
            //         'affecte' => $request['affecte'],
            //         'boursier' => $request['boursier'],
            //         'nom_tuteur' => $request['nom_tuteur'],
            //         'prenoms_tuteur' => $request['prenoms_tuteur'],
            //         'contact1_tuteur' => $request['contact1_tuteur'],
            //         'contact2_tuteur' => $request['contact2_tuteur'],
            //         'email_tuteur' => $request['email_tuteur'],
            //         'remise' => $request['remise'],
            //     ]);
            // }

            Alert::success('Operation réussi', 'Success Message');
            return back();
        } catch (\Throwable $e) {
            return  $e->getMessage();
            // Alert::error('Erreur', $e->getMessage());
            return back();
        }
    }


    public function delete()
    {
    }
}
