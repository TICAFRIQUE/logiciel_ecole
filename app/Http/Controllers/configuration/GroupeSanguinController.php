<?php

namespace App\Http\Controllers\configuration;

use Illuminate\Http\Request;
use App\Models\GroupeSanguin;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class GroupeSanguinController extends Controller
{
    //
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data_groupe_sanguin = GroupeSanguin::OrderBy('position', 'ASC')->get();


        return view('backend.pages.configuration.groupe_sanguin.index', compact('data_groupe_sanguin'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //request validation .......

        $request->validate([
            'name' => 'required',
        ]);



      
        $data_count = GroupeSanguin::count();

        $data_groupe_sanguin = GroupeSanguin::firstOrCreate([
            'name' => $request['name'],
            'position' => $data_count + 1,
        ]);

        Alert::success('Operation réussi', 'Success Message');

        return back();
    }

    public function position(Request $request, $id)
    {
        $position = $request['position'];


        GroupeSanguin::find($id)->update([
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
           
        ]);


 

        $data_page = GroupeSanguin::find($id)->update([
            'name' => $request['name'],
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
        GroupeSanguin::find($id)->delete();

        //
        $data_groupe_sanguin = GroupeSanguin::OrderBy('position', 'ASC')->get();

        foreach ($data_groupe_sanguin as $key => $value) {
            GroupeSanguin::whereId($value['id'])->update([
                'position' => $key + 1
            ]);
        }
        //
        return response()->json([
            'status' => 200,
        ]);
    }
}
