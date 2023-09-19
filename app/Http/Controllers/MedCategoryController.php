<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MedCategory;
class MedCategoryController extends Controller
{
    public function index(){
        $medcategories = MedCategory::orderBy('id')->get();
        return inertia('MedCategory/Index',[
            'medcategories' => $medcategories,
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

        MedCategory::create($fields);

        return redirect('/category')->with('message', 'Category successfully created');
    }

    // public function edit(MedCategory $medcategories)
    // {
    //     return inertia('MedCategory/Edit',[
    //        'medcategories' => $medcategories,
    //     ]);

    // }

    public function update(Request $request, MedCategory $medcategory){
        $fields = $request->validate([
            'name'=>'required|string',
        ]);

        $medcategory->update($fields);
        return redirect('/category')->with('message', "You successfully updated the medicine category");
    }
}
