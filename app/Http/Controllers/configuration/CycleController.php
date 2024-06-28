<?php

namespace App\Http\Controllers\configuration;

use Carbon\Carbon;
use App\Models\Cycle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CycleController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data_cycle = Cycle::OrderBy('position', 'ASC')->get();


        return view('backend.pages.configuration.cycle.index', compact('data_cycle'));
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


        $data_count = Cycle::count();

        $data_cycle = Cycle::firstOrCreate([
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


        Cycle::find($id)->update([
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


        $data_cycle = Cycle::find($id)->update([
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
        Cycle::find($id)->delete();
        //
        $data_cycle = Cycle::OrderBy('position', 'ASC')->get();

        foreach ($data_cycle as $key => $value) {
            Cycle::whereId($value['id'])->update([
                'position' => $key + 1
            ]);
        }
        //
        return response()->json([
            'status' => 200,
        ]);
    }
}
