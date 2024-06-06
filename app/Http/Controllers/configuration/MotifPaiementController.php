<?php

namespace App\Http\Controllers\configuration;

use Illuminate\Http\Request;
use App\Models\MotifPaiement;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class MotifPaiementController extends Controller
{
    //
          /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data_motif_paiement = MotifPaiement::OrderBy('position', 'ASC')->get();


        return view('backend.pages.configuration.motif_paiement.index', compact('data_motif_paiement'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //request validation .......

        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);


        $data_count = MotifPaiement::count();

        $data_motif_paiement = MotifPaiement::firstOrCreate([
            'name' => $request['name'],
            'status' => $request['status'],
            'position' => $data_count + 1,
        ]);

        Alert::success('Operation réussi', 'Success Message');

        return back();
    }

    public function position(Request $request, $id)
    {
        $position = $request['position'];


        MotifPaiement::find($id)->update([
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

            'name' => 'required',
            'status' => 'required',
        ]);


        $data_motif_paiement = MotifPaiement::find($id)->update([
            'name' => $request['name'],
            'status' => $request['status'],
        ]);

        Alert::success('Opération réussi', 'Success Message');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        //delete content of category
        MotifPaiement::find($id)->delete();
        //
        $data_motif_paiement = MotifPaiement::OrderBy('position', 'ASC')->get();

        foreach ($data_motif_paiement as $key => $value) {
            MotifPaiement::whereId($value['id'])->update([
                'position' => $key + 1
            ]);
        }
        //
        return response()->json([
            'status' => 200,
        ]);
    }
}
