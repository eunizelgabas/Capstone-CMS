<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\MedCategory;
use App\Models\Medicine;
use App\Models\MedType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as HttpRequest;


class MedicineController extends Controller
{
    public function index(){
        $type = MedType::orderBy('name')->get();
        $category = MedCategory::orderBy('name')->get();
        $inventory = Inventory::orderBy('created_at', 'asc')->get();

            $medicineQuery = Medicine::orderBy('created_at', 'desc')
            ->with('type')
            ->with('category')
            ->with('inventory');

        $search = HttpRequest::input('search');
        if ($search) {
            $medicineQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('measurement', 'like', '%' . $search . '%');
            });
        }

        $medicines = $medicineQuery->paginate(8)->withQueryString();

        return inertia('Medicine/Index',[
            'medicines' => $medicines,
            'type'      => $type,
            'category'  => $category,
            'inventory' =>$inventory,
            'filters' => HttpRequest::only(['search'])
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

    public function destroy(Medicine $medicine) {
        $medicine->delete();

        return back();
    }
}
