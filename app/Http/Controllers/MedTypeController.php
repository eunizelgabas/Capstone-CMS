<?php

namespace App\Http\Controllers;

use App\Models\MedType;
use Illuminate\Http\Request;

class MedTypeController extends Controller
{
    public function index(){
        $medtypes = MedType::orderBy('id')->get();
        return inertia('MedType/Index',[
            'medtypes' => $medtypes,
        ]);
    }

    // public function create(){
    //     return inertia('MedCategory/Index',[
    //         'medcategories' => MedCategory::orderBy('name')->get()
    //     ]);
    // }

    public function store(Request $request) {
        $fields = $request->validate([
            'name'=>'required',
        ]);

        MedType::create($fields);

        return redirect('/type')->with('message', 'Medicine type successfully created');
    }

    public function update(Request $request, MedType $medtype){
        $fields = $request->validate([
            'name'=>'required|string',
        ]);

        $medtype->update($fields);
        return redirect('/type')->with('message', "You successfully updated the medicine category");
    }

    public function destroy(MedType $medtype) {
        $medtype->delete();

        return back();
    }
}
