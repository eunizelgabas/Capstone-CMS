<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\MedCategory;
use App\Models\Medicine;
use App\Models\MedType;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(){
        $type = MedType::orderBy('name')->get();
        $category = MedCategory::orderBy('name')->get();
        $inventory = Inventory::orderBy('created_at', 'asc')->get();
        $medicines = Medicine::orderBy('id')
            ->with('type')
            ->with('category')
            ->with('inventory')
            ->get();
        return inertia('Medicine/Index',[
            'medicines' => $medicines,
            'type'      => $type,
            'category'  => $category,
            'inventory' =>$inventory
        ]);
    }


    public function store(Request $request) {
        $fields = $request->validate([
            'name'=>'required|string',
            'cat_id'=>'required',
            'type_id' =>'required',
            'measurement' =>'required|string',
            'description' =>'required|string'

        ]);

        Medicine::create($fields);

        return redirect('/medicine')->with('message', 'Medicine successfully created');
    }

    public function update(Request $request, Medicine $medicine){
        $fields = $request->validate([
            'name'=>'required|string',
            'cat_id'=>'required',
            'type_id' =>'required',
            'measurement' =>'required|string',
            'description' =>'required|string'
        ]);

        $medicine->update($fields);
        return redirect('/medicine')->with('message', "You successfully updated the medicine category");
    }
}
