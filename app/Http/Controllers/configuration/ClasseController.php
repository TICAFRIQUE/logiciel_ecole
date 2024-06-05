<?php

namespace App\Http\Controllers\configuration;

use App\Models\Classe;
use App\Models\Niveau;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ClasseController extends Controller
{
    //

    public function index()
    {
        $data_niveaux = Niveau::whereStatus('active')->OrderBy('position', 'ASC')->get();
        $data_classe = Classe::with(['niveau' => fn ($q) => $q->with('cycle')])->OrderBy('position', 'ASC')->get();

        // dd($data_classe->toArray());
        return view('backend.pages.configuration.Classe.index', compact('data_niveaux', 'data_classe'));
    }



    public function store(Request $request)
    {
        //request validation .......

        $request->validate([
            'name' => 'required|unique:classes',
            'niveau' => 'required',
            'capacite_min' => 'required',
            'capacite_max' => 'required',
            'status' => 'required',
        ]);

        // dd($request->toArray());



        $data_count = Classe::count();

        $data_classe = Classe::firstOrCreate([
            'name' => $request['name'],
            'niveau_id' => $request['niveau'],
            'capacite_min' => $request['capacite_min'],
            'capacite_max' => $request['capacite_max'],
            'status' => $request['status'],
            'position' => $data_count + 1,
        ]);

        Alert::success('Operation réussi', 'Success Message');

        return back();
    }

    public function position(Request $request, $id)
    {
        $position = $request['position'];


        Classe::find($id)->update([
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
                'niveau' => 'required',
                'capacite_min' => 'required',
                'capacite_max' => 'required',
                'status' => 'required',
            ]);

            // dd($request->toArray());


            Classe::find($id)->update([
                'name' => $request['name'],
                'niveau_id' => $request['niveau'],
                'capacite_min' => $request['capacite_min'],
                'capacite_max' => $request['capacite_max'],
                'status' => $request['status'],
            ]);

            Alert::success('Opération réussi', 'Success Message');
            return back();
        } catch (\Throwable $e) {
            Alert::error($e->getMessage(), 'Error Message');

            return redirect()->route('classe.index');
        }
    }


    public function delete($id)
    {
        Classe::find($id)->delete();
        //
        $data_classe = Classe::OrderBy('position', 'ASC')->get();

        foreach ($data_classe as $key => $value) {
            Classe::whereId($value['id'])->update([
                'position' => $key + 1
            ]);
        }
        //
        return response()->json([
            'status' => 200,
        ]);
    }
}
