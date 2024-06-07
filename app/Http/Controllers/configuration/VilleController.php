<?php

namespace App\Http\Controllers\configuration;

use App\Models\Pays;
use App\Models\Ville;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class VilleController extends Controller
{
    //

    public function index()
    {
        //
        $data_pays = Pays::orderBy('country', 'ASC')->get();
        $data_ville = Ville::OrderBy('city', 'ASC')->get();


        return view('backend.pages.configuration.ville.index', compact('data_ville', 'data_pays'));
    }

    //insert data of json in table ville
    public function convertData()
    {
        $data_json = File::get(resource_path('json/cities2-list.json'));
        $data = json_decode($data_json);
        // dd($data);

        foreach ($data as $value) {
            $data_ville = Ville::firstOrcreate([
                'city' => $value->ville_titre,
                'pays_id' => 2546794827,
            ]);
        }

        Alert::success('Operation réussi', 'Success Message');

        return back();
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //request validation .......

        $request->validate([
            'city' => 'required|unique:villes',
            'country' => 'required',

        ]);


        // $data_count = Ville::count();

        $data_ville = Ville::firstOrCreate([
            'city' => $request['city'],
            'pays_id' => $request['country'],
            // 'iso2' => 'CI',
            // 'status' => $request['status'],
            // 'position' => $data_count + 1,
        ]);

        Alert::success('Operation réussi', 'Success Message');

        return back();
    }

    public function position(Request $request, $id)
    {
        $position = $request['position'];


        Ville::find($id)->update([
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

            'city' => 'required|unique:villes',
            'country' => 'required',
        ]);


        $data_ville = Ville::find($id)->update([
            'city' => $request['city'],
            'pays_id' => $request['country'],
            // 'status' => $request['status'],
        ]);

        Alert::success('Opération réussi', 'Success Message');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        //delete
        Ville::find($id)->delete();
        //

        //    $data_ville = Ville::OrderBy('position', 'ASC')->get();

        //    foreach ($data_ville as $key => $value) {
        //        Ville::whereId($value['id'])->update([
        //            'position' => $key + 1
        //        ]);
        //    }

        //
        return response()->json([
            'status' => 200,
        ]);
    }
}
