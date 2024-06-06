<?php

namespace App\Http\Controllers\configuration;

use App\Models\ModePaiement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ModePaiementController extends Controller
{
    //
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data_mode_paiement = ModePaiement::OrderBy('position', 'ASC')->get();


        return view('backend.pages.configuration.mode_paiement.index', compact('data_mode_paiement'));
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


        $data_count = ModePaiement::count();

        $data_mode_paiement = ModePaiement::firstOrCreate([
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


        ModePaiement::find($id)->update([
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


        $data_mode_paiement = ModePaiement::find($id)->update([
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
        ModePaiement::find($id)->delete();
        //
        $data_mode_paiement = ModePaiement::OrderBy('position', 'ASC')->get();

        foreach ($data_mode_paiement as $key => $value) {
            ModePaiement::whereId($value['id'])->update([
                'position' => $key + 1
            ]);
        }
        //
        return response()->json([
            'status' => 200,
        ]);
    }


    
}
