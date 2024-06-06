<?php

namespace App\Http\Controllers\configuration;

use Illuminate\Support\Facades\File;
use App\Models\Ville;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class VilleController extends Controller
{
    //

    public function index()
    {
        //
        $data_ville = Ville::OrderBy('city', 'ASC')->get();


        return view('backend.pages.configuration.ville.index', compact('data_ville'));
    }

    //insert data of json in table ville
    public function convertData()
    {
        $data_json = File::get(resource_path('json/cities2-list.json'));
        $data = json_decode($data_json);

        foreach ($data as $value) {
            $data_ville = Ville::firstOrcreate([
                'city' => $value->ville_titre,
                'country' =>'Côte d’Ivoire',
                'iso2' => 'CI',
            ]);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //request validation .......

        $request->validate([
            'city' => 'required|unique:villes',
        ]);


        // $data_count = Ville::count();

        $data_ville = Ville::firstOrCreate([
            'city' => $request['city'],
            'country' =>'Côte d’Ivoire',
            'iso2' => 'CI',
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
        ]);


        $data_ville = Ville::find($id)->update([
            'city' => $request['city'],
            'country' =>'Côte d’Ivoire',
            'iso2' => 'CI',
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
