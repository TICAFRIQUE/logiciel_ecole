<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Versement;
use App\Models\Inscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class VersementController extends Controller
{
    //
    public function index()
    {
    }


    public function create()
    {
    }

    public function store(Request $request)
    {
        // dd($request->toArray());
        try {
            $data = $request->validate([
                // 'code'=>'required',
                'montant_scolarite_paye' => 'required',
                'montant_scolarite_restant' => 'required',
                'montant_scolarite' => 'required', //montant total de la scolarite
                'mode_paiement_id' => 'required',
                'motif_paiement_id' => 'required',
                'inscription_id' => 'required',
            ]);

            // dd($data);

            $code = '';
            for ($i = 0; $i <= 4; $i++) {
                $code .= rand(0, 9);
            }

            $data_versement = Versement::create([
                'code' => 'v-' . $code . date('Y'),
                'inscription_id' => $request['inscription_id'],
                'montant_scolarite' => $request['montant_scolarite'], // from inscription request
                'montant_verse' => $request['montant_scolarite_paye'], // from inscription request
                'montant_restant' => $request['montant_scolarite_restant'], // from inscription request
                'mode_paiement_id' => $request['mode_paiement_id'],
                'motif_paiement_id' => $request['motif_paiement_id'],
                'user_id' => Auth::user()->id,     //user create
            ]);

            //modifier les infos de inscription montant restant & payé
            $versements_paye = versement::where('inscription_id', $request['inscription_id'])->sum('montant_verse');

            $inscription = Inscription::find($request['inscription_id']);

            $montant = $inscription->montant_remise_scolarite != null ? $inscription->montant_remise_scolarite : $inscription->montant_scolarite;

            $versements_restant = $montant - $versements_paye;

            $statut = "";
            if ($versements_restant == 0) {
                $statut = "solde";
            } else {
                $statut = "non solde";
            }

            $inscription->update([
                'montant_scolarite_paye' => $versements_paye,
                'montant_scolarite_restant' =>   $versements_restant,
                'statut' => $statut,
            ]);


            Alert::success('Operation réussi', 'Success Message');
            return back();
        } catch (\Throwable $e) {
            return  $e->getMessage();
            // Alert::error('Erreur', $e->getMessage());
            return back();
        }
    }


    public function show()
    {
    }


    public function edit()
    {
    }

    public function update()
    {
    }


    public function delete($id)
    {
        try {
            $versement = versement::find($id);
            //update in user delete and date delete
            $versement->update([
                'date_delete' => Carbon::now(),
                'user_delete' =>  Auth::user()->id,
            ]);

            $versement->delete();


            //modifier les infos de inscription montant restant & payé
            $versements_paye = versement::where('inscription_id',   $versement['inscription_id'])->sum('montant_verse');

            $inscription = Inscription::find($versement['inscription_id']);

            $montant = $inscription->montant_remise_scolarite != null ? $inscription->montant_remise_scolarite : $inscription->montant_scolarite;

            $versements_restant = $montant - $versements_paye;

            $statut = "";
            if ($versements_restant == 0) {
                $statut = "solde";
            } else {
                $statut = "non solde";
            }

            $inscription->update([
                'montant_scolarite_paye' => $versements_paye,
                'montant_scolarite_restant' =>   $versements_restant,
                'statut' => $statut,
            ]);



            // start --Mettre à jour la table versement au niveau de montant restant
            $versement_update = Versement::get();

            foreach ($versement_update as $key => $value) {

                Versement::whereId($value['id'])->update([
                    'montant_restant' => $value['montant_scolarite'] - $value['montant_verse']
                ]);
            }

            //end

            return response()->json([
                'status' => 200,
            ]);
        } catch (\Throwable $e) {
            return  $e->getMessage();
            // Alert::error('Erreur', $e->getMessage());
            return back();
        }
    }
}
