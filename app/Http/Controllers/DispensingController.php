<?php

namespace App\Http\Controllers;

use App\Models\Dispensing;
use App\Models\Inventory;
use App\Models\Medicine;
use Illuminate\Http\Request;

class DispensingController extends Controller
{

    public function index(){
        $medicine = Medicine::orderBy('name')->get();
        $dispenses = Dispensing::orderBy('id')
            ->with('medicine')
            ->get();
        return inertia('Dispense/Index',[
            'medicine' => $medicine,
            'dispenses' => $dispenses
        ]);
    }

    public function store(Request $request) {
        $fields = $request->validate([
            'name'=>'required',
            'qty' =>'required',
            'med_id'=>'required'
        ]);

        $des  =  Dispensing::create($fields);

        
        $medicine = Medicine::findOrFail($fields['med_id']);
        $medicine->decrement('stock', $fields['qty']);

        $inventory = Inventory::where('med_id', $des->med_id)->first();
        if($inventory){
            $inventory->stock_out += $des->qty;
            // $inventory->stock_in += $stock->qty;
            $inventory->save();
        }

        return redirect('/dispense')->with('message', 'Medicine type successfully created');
    }

}
