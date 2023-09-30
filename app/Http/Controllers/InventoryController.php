<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Medicine;
use App\Models\Stock;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(){
        $medicines = Medicine::orderBy('name')->get();
        $stocks = Stock::orderBy('id')->get();
        $inventories = Inventory::orderBy('id')
        ->with('medicine')->get();
        return inertia('Inventory/Index',[
            'inventories' => $inventories,
            'medicines' => $medicines,
            'stocks' => $stocks

        ]);
    }


}
