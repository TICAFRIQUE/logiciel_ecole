<?php

namespace App\Http\Controllers\configuration;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class AnneeScolaireController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data_annee_scolaire = AnneeScolaire::OrderBy('position', 'ASC')->get();


        return view('backend.pages.configuration.annee_scolaire.index', compact('data_annee_scolaire'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //request validation .......

        $request->validate([
            'date_debut' => 'required',
            'date_fin' => 'required',
            'status' => 'required',
        ]);



        $date_debut = Carbon::parse($request['date_debut'])->format('Y-m-d');
        $date_fin = Carbon::parse($request['date_fin'])->format('Y-m-d');


        $indice = carbon::parse($date_debut)->format('Y') . '-' . carbon::parse($date_fin)->format('Y');

        $data_count = AnneeScolaire::count();

        $data_annee_scolaire = AnneeScolaire::firstOrCreate([
            'indice' => $indice,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'status' => $request['status'],
            'position' => $data_count + 1,
        ]);

             //update status where status are enable if status request is active
             if ($request['status'] == 'active') {
                $data_annee = AnneeScolaire::where('status', 'active')
                ->whereNotIn('id' ,[ $data_annee_scolaire->id] )
                ->update(['status' => 'desactive']);
            }

        Alert::success('Operation réussi', 'Success Message');

        return back();
    }

    public function position(Request $request, $id)
    {
        $position = $request['position'];


        AnneeScolaire::find($id)->update([
            'position' => $position,
        ]);

        Alert::success('Opération réussi', 'Success Message');
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        //request validation ......

        $request->validate([
            'date_debut' => 'required',
            'date_fin' => 'required',
            'status' => 'required',
        ]);
// dd($request->toArray());

        $date_debut = Carbon::parse($request['date_debut'])->format('Y-m-d');
        $date_fin = Carbon::parse($request['date_fin'])->format('Y-m-d');

        $indice = carbon::parse($date_debut)->format('Y') . '-' . carbon::parse($date_fin)->format('Y');

        $data_annee = AnneeScolaire::find($id)->update([
            'indice' => $indice,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'status' => $request['status'],
        ]);

        //update status where status are enable if status request is active
        if ($request['status'] == 'active') {
            $data_annee = AnneeScolaire::where('status', 'active')
            ->whereNotIn('id' ,[$id] )
            ->update(['status' => 'desactive']);
        }

        Alert::success('Opération réussi', 'Success Message');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        //delete content of category
        AnneeScolaire::find($id)->delete();

        //
        $data_annee_scolaire = AnneeScolaire::OrderBy('position', 'ASC')->get();

        foreach ($data_annee_scolaire as $key => $value) {
            AnneeScolaire::whereId($value['id'])->update([
                'position' => $key + 1
            ]);
        }
        //
        return response()->json([
            'status' => 200,
        ]);
    }
}
