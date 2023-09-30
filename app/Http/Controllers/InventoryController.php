<?php

namespace App\Http\Controllers;

use App\Models\Dispensing;
use App\Models\Inventory;
use App\Models\Medicine;
use App\Models\Stock;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(){
        $medicine = Medicine::orderBy('name')->get();
        $inventories = Inventory::orderBy('id')
        ->with('medicine')->get();

        $inventories->each(function ($inventories) {
            $inventories->Available = $inventories->stock_out ? ($inventories->stock_in - $inventories->stock_out) : $inventories->stock_in;
        });
        
        // Calculate the total available stock by summing the stockAvail attribute
        // $totalAvail =$inventories->diff('Available');
        return inertia('Inventory/Index',[
            'inventories' => $inventories,
            'medicine' => $medicine,
        //    'totalAvail'=>  $totalAvail 

        ]);
    }

}
