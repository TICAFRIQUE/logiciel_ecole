<?php

namespace App\Http\Controllers\configuration;

use App\Models\Cycle;
use App\Models\Niveau;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Stmt\TryCatch;
use RealRashid\SweetAlert\Facades\Alert;

class NiveauController extends Controller
{
    //

    public function index()
    {
        $data_cycle = Cycle::whereStatus('active')->OrderBy('position', 'ASC')->get();
        $data_niveaux = Niveau::with('cycle')->OrderBy('position', 'ASC')->get();

        // dd($data_niveaux->toArray());
        return view('backend.pages.configuration.niveau.index', compact('data_cycle', 'data_niveaux'));
    }



    public function store(Request $request)
    {
        //request validation .......

        $request->validate([
            'name' => 'required|unique:niveaux',
            'cycle' => 'required',
            'montant_inscription' => 'required',
            'montant_scolarite' => 'required',
            'capacite' => 'required',
            'status' => 'required',
        ]);

        // dd($request->toArray());


        $total_scolarite = $request['montant_inscription'] + $request['montant_scolarite'];

        $data_count = Niveau::count();

        $data_niveaux = Niveau::firstOrCreate([
            'name' => $request['name'],
            'cycle_id' => $request['cycle'],
            'montant_inscription' => $request['montant_inscription'],
            'montant_scolarite' => $request['montant_scolarite'],
            'total_scolarite' => $total_scolarite,
            'capacite' => $request['capacite'],
            'status' => $request['status'],
            'position' => $data_count + 1,
        ]);

        Alert::success('Operation réussi', 'Success Message');

        return back();
    }

    public function position(Request $request, $id)
    {
        $position = $request['position'];


        Niveau::find($id)->update([
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
                'cycle' => 'required',
                'montant_inscription' => 'required',
                'montant_scolarite' => 'required',
                'capacite' => 'required',
                'status' => 'required',
            ]);


            $total_scolarite = $request['montant_inscription'] + $request['montant_scolarite'];


            Niveau::find($id)->update([
                'name' => $request['name'],
                'cycle_id' => $request['cycle'],
                'montant_inscription' => $request['montant_inscription'],
                'montant_scolarite' => $request['montant_scolarite'],
                'total_scolarite' => $total_scolarite,
                'capacite' => $request['capacite'],
                'status' => $request['status'],
            ]);

            Alert::success('Opération réussi', 'Success Message');
            return back();
        } catch (\Throwable $e) {
            Alert::error($e->getMessage(), 'Error Message');

            return redirect()->route('niveau.index');
        }
    }


    public function delete($id)
    {
        Niveau::find($id)->delete();
        //
        $data_niveaux = Niveau::OrderBy('position', 'ASC')->get();

        foreach ($data_niveaux as $key => $value) {
            Niveau::whereId($value['id'])->update([
                'position' => $key + 1
            ]);
        }
        //
        return response()->json([
            'status' => 200,
        ]);
    }
}
