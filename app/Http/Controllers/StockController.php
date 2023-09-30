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
        $stocks   = Stock::orderBy('id')->with('medicine')->get();
        return inertia('Stock/Index',[
            'medicine' => $medicine,
            'stocks'    =>$stocks
        ]);
    }

    public function create(){
        $medicine = Medicine::orderBy('name')->get();
        return inertia('Inventory/Create',[
            'inventories' => Inventory::orderBy('created_at','asc'),
            'stocks' => Stock::orderBy('created_at','asc')
            ->with('medicine')->get(),
            'medicine' => $medicine,
        ]);
    }

    public function store(Request $request) {
        $fields = $request->validate([
            'med_id'=>'required|numeric',
            'purchase_date' => 'required|date',
            'qty'=>'required',
            'expiry_date' =>'required',

        ]);

        $stock = Stock::create($fields);

        $medicine = Medicine::findOrFail($fields['med_id']);
        $medicine->increment('stock', $fields['qty']);

        $inventory = Inventory::where('med_id', $stock->med_id)->first();
        if($inventory){
            $inventory->stock_in += $stock->qty;
            // $inventory->stock_in += $stock->qty;
            $inventory->save();
        }else{
            $inventory = new Inventory([
                'med_id' => $medicine->id,
                'stock_in' => $stock->qty,
                
            ]);
            $inventory->save();
        }


        return redirect()->route('stock.index')->with('message', 'Stock successfully added');
    }

    public function update(Request $request, Stock $stock){
        $fields = $request->validate([
            'med_id'=>'required|numeric',
            'qty'=>'required',
            'purchase_date' => 'required|date',
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
