<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MedCategoryController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\MedTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StockController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/category', [MedCategoryController::class, 'index'])->name('category.index');
    Route::put('/category/{medcategory}',[MedCategoryController::class, 'update']);
    Route::post('/category',[MedCategoryController::class, 'store']);
    Route::delete('/category/{medcategory}', [MedCategoryController::class, 'destroy']);

    Route::get('/type', [MedTypeController::class, 'index'])->name('type.index');
    Route::put('/type/{medtype}',[MedTypeController::class, 'update']);
    Route::post('/type',[MedTypeController::class, 'store']);
    Route::delete('/type/{medtype}', [MedTypeController::class, 'destroy']);

    Route::get('/medicine', [MedicineController::class, 'index'])->name('medicine.index');
    Route::put('/medicine/{medicine}',[MedicineController::class, 'update']);
    Route::post('/medicine',[MedicineController::class, 'store']);
    Route::delete('/medicine/{medicine}', [MedicineController::class, 'destroy']);

    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');


    Route::get('/stock/create', [InventoryController::class, 'create'])->name('inventory.create');
    Route::get('/stock',[StockController::class, 'index'])->name('stock.index');
    Route::post('/stock',[StockController::class, 'store'])->name('stock.create');
    Route::get('/stock/edit/{stock}', [StockController::class, 'edit']);
    Route::put('/stock/{stock}',[StockController::class, 'update']);
    Route::delete('/stock/{stock}', [StockController::class, 'destroy']);

    Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::get('/service',[ServiceController::class, 'index'])->name('service.index');
    Route::post('/service',[ServiceController::class, 'store'])->name('service.create');
    Route::get('/service/edit/{service}', [ServiceController::class, 'edit']);
    Route::put('/service/{service}',[ServiceController::class, 'update']);
    Route::delete('/service/{service}', [ServiceController::class, 'destroy']);
});


require __DIR__.'/auth.php';
