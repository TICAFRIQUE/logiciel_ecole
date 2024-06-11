<?php

namespace App\Http\Controllers\configuration;

use App\Models\Matiere;
use Illuminate\Http\Request;
use App\Models\MatiereCategory;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class MatiereController extends Controller
{
    //

    public function index()
    {
        $data_matiere_category = MatiereCategory::whereStatus('active')->OrderBy('position', 'ASC')->get();
        $data_matiere = Matiere::with('matiere_category')->OrderBy('position', 'ASC')->get();

        // dd($data_matiere->toArray());
        return view('backend.pages.configuration.matiere.matiere.index', compact('data_matiere_category', 'data_matiere'));
    }



    public function store(Request $request)
    {
        //request validation .......

        $request->validate([
            'name' => 'required|unique:matieres',
            'abreviation' => '',
            'status' => 'required',
            'matiere_categorie' => 'required',

        ]);

        // dd($request->toArray());



        $data_count = Matiere::count();

        Matiere::firstOrCreate([
            'name' => $request['name'],
            'matiere_categories_id' => $request['matiere_categorie'],
            'abreviation' => $request['abreviation'],
            'status' => $request['status'],
            'position' => $data_count + 1,
        ]);

        Alert::success('Operation réussi', 'Success Message');

        return back();
    }

    public function position(Request $request, $id)
    {
        $position = $request['position'];


        Matiere::find($id)->update([
            'position' => $position,
        ]);

        Alert::success('Opération réussi', 'Success Message');
        return back();
    }


    public function update(Request $request, $id)
    {
        try {
            //request validation .......

            $request->validate([
                'name' => 'required',
                'abreviation' => '',
                'status' => 'required',
                'matiere_categorie' => 'required',

            ]);

            // dd($request->toArray());


            Matiere::find($id)->update([
                'name' => $request['name'],
                'abreviation' => $request['abreviation'],
                'status' => $request['status'],
                'matiere_categories_id' => $request['matiere_categorie'],

            ]);

            Alert::success('Opération réussi', 'Success Message');
            return back();
        } catch (\Throwable $e) {
            Alert::error($e->getMessage(), 'Error Message');

            return redirect()->route('Matiere.index');
        }
    }


    public function delete($id)
    {
        Matiere::find($id)->delete();
        //
        $data_matiere = Matiere::OrderBy('position', 'ASC')->get();

        foreach ($data_matiere as $key => $value) {
            Matiere::whereId($value['id'])->update([
                'position' => $key + 1
            ]);
        }
        //
        return response()->json([
            'status' => 200,
        ]);
    }
}
