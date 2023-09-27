<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Stock;
use App\Models\TemporaryStock;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TemporaryStockController extends Controller
{

    public function index(){
        // $medicines = [];

        // $medicineOptions = Medicine::all();

        // return Inertia::render('Stock/Index', [
        //     'medicines' => $medicines,
        //     'medicineOptions' => $medicineOptions,
        // ]);

        $medicine = Medicine::all();
        $stocks = Stock::all();

        // I-pass ang mga tambal ngadto sa frontend gamit ang Inertia
        return Inertia::render('Stock/Index', [
            'stocks' => $stocks,
            'medicine' => $medicine
        ]);

    }

    public function addMedicineToList(Request $request)
    {
        // Validasyon sa request gikan sa frontend
        $request->validate([
            'med_id' => 'required',
            'qty' => 'required|integer|min:1',
            'expiry_date' => 'required|date',
        ]);

        // I-save ang tambal sa temporaryong listahan
        // Dapat i-store ang temporaryong listahan sa session o database table, depende sa imong kinahanglanon.
        $medicineData = [
            'med_id' => $request->med_id,
            'qty' => $request->qty,
            'expiry_date' => $request->expiry_date,
        ];

        // Ipasa ang $medicineData ngadto sa session o table nga moserve isip temporaryong listahan

        // Balik sa frontend
        return redirect()->back();
    }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'medicineList.*.med_id' => 'required|integer',
        'medicineList.*.qty' => 'required|integer',
        'medicineList.*.expiry_date' => 'required|date',
    ]);

    foreach ($validatedData['medicines'] as $medicineData) {
        Stock::create([
            'med_id' => $medicineData['med_id'],
            'qty' => $medicineData['qty'],
            'expiry_date' => $medicineData['expiry_date'],
        ]);
    }

    // I-redirect ang user pagkatapos sa pag-save
    return redirect()->route('stock.index');
}
}
