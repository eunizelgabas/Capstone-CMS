<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Medicine;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function index(){
        $medicine = Medicine::orderBy('name')->get();
        return inertia('Inventory/Create',[
            'medicine' => $medicine
        ]);
    }

    public function create(){
        $medicine = Medicine::orderBy('name')->get();
        return inertia('Inventory/Create',[
            'inventories' => Inventory::orderBy('created_at','asc'),
            'stocks' => Stock::orderBy('created_at','asc')
            ->with('medicine', 'inventory')->get(),
            'medicine' => $medicine,
        ]);
    }

    public function store(Request $request) {
        $fields = $request->validate([
            'med_id'=>'required|numeric',
            'qty'=>'required',
            'expiry_date' =>'required',

        ]);

        $stock = Stock::create($fields);

        $inventory = Inventory::where('med_id', $stock->med_id)->first();
        if ($inventory) {
            $inventory->stocks += $stock->qty;
            $inventory->save();
        } else {
            Inventory::create([
                'med_id' => $stock->med_id,
                'stocks' => $stock->qty,
            ]);
        }


        return redirect()->route('inventory.index')->with('message', 'Stock successfully added');
    }

    public function update(Request $request, Stock $stock){
        $fields = $request->validate([
            'med_id'=>'required|numeric',
            'qty'=>'required',
            'expiry_date' =>'required',

        ]);

        $stock->update($fields);
        // $stock = Stock::update($fields);

        $medicine = Inventory::where('med_id', $stock->med_id)->firstOrFail();
        $medicine->stocks+= $stock->qty;
        $medicine->save();


        return redirect('/inventory')->with('message', "You successfully updated the medicine inventory");
    }
}
