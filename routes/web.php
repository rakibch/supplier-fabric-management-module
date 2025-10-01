<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\SupplierWebController;
use App\Http\Controllers\Web\FabricWebController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('suppliers')->name('web.suppliers.')->group(function () {
    Route::get('/', [SupplierWebController::class, 'index'])->name('index');
    Route::get('/create', [SupplierWebController::class, 'create'])->name('create');
    Route::post('/', [SupplierWebController::class, 'store'])->name('store');
    Route::get('/{supplier}/edit', [SupplierWebController::class, 'edit'])->name('edit');
    Route::put('/{supplier}', [SupplierWebController::class, 'update'])->name('update');
    Route::delete('/{supplier}', [SupplierWebController::class, 'destroy'])->name('destroy');
    Route::get('trashed', [SupplierWebController::class, 'trashed'])->name('trashed');
    Route::post('restore/{id}', [SupplierWebController::class, 'restore'])->name('restore');
});

Route::prefix('fabrics')->name('web.fabrics.')->group(function () {
    Route::get('/', [FabricWebController::class, 'index'])->name('index');
    Route::get('/create', [FabricWebController::class, 'create'])->name('create');
    Route::post('/', [FabricWebController::class, 'store'])->name('store');
    Route::get('/{fabric}', [FabricWebController::class, 'show'])->name('show');
    Route::get('/{fabric}/edit', [FabricWebController::class, 'edit'])->name('edit');
    Route::put('/{fabric}', [FabricWebController::class, 'update'])->name('update');
    Route::delete('/{fabric}', [FabricWebController::class, 'destroy'])->name('destroy');
    Route::get('/trash', [FabricWebController::class, 'trash'])->name('trash');
    Route::post('/{id}/restore', [FabricWebController::class, 'restore'])->name('restore');

    // stock, barcode, print PDF
    Route::post('/{fabric}/stock', [FabricWebController::class, 'addStock'])->name('addStock');
    Route::get('/{fabric}/barcode', [FabricWebController::class, 'barcode'])->name('barcode'); // show latest barcode
    Route::get('/barcodes/{barcode}/print', [FabricWebController::class, 'printBarcode'])->name('barcode.print'); // print pdf
});

require __DIR__ . '/auth.php';
