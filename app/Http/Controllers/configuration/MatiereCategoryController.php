<?php

namespace App\Http\Controllers\configuration;

use Illuminate\Http\Request;
use App\Models\MatiereCategory;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class MatiereCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data_matiere_category = MatiereCategory::OrderBy('position', 'ASC')->get();


        return view('backend.pages.configuration.matiere.category.index', compact('data_matiere_category'));
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

        $data_count = MatiereCategory::count();

        MatiereCategory::firstOrCreate([
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


        MatiereCategory::find($id)->update([
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

        MatiereCategory::find($id)->update([
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
        MatiereCategory::find($id)->delete();

        // update position 
        $data_matiere_category = MatiereCategory::OrderBy('position', 'ASC')->get();

        foreach ($data_matiere_category as $key => $value) {
            MatiereCategory::whereId($value['id'])->update([
                'position' => $key + 1
            ]);
        }
        //
        return response()->json([
            'status' => 200,
        ]);
    }
}
