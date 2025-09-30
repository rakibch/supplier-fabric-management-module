<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\FabricController;

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

    /**
     * Supplier Management Routes
     */
    Route::prefix('suppliers')->name('suppliers.')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('index'); // list with filters
        Route::get('/create', [SupplierController::class, 'create'])->name('create'); // form
        Route::post('/', [SupplierController::class, 'store'])->name('store'); // save
        Route::get('/{supplier}/edit', [SupplierController::class, 'edit'])->name('edit'); // edit form
        Route::put('/{supplier}', [SupplierController::class, 'update'])->name('update'); // update
        Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('destroy'); // delete
        Route::get('/trash', [SupplierController::class, 'trash'])->name('trash'); // soft-deleted
        Route::post('/{id}/restore', [SupplierController::class, 'restore'])->name('restore'); // restore deleted
    });

     /**
     * Fabric Management Routes
     */
    Route::prefix('fabrics')->name('fabrics.')->group(function () {
        Route::get('/', [FabricController::class, 'index'])->name('index'); // list with filters
        Route::get('/create', [FabricController::class, 'create'])->name('create'); // form
        Route::post('/', [FabricController::class, 'store'])->name('store'); // save
        Route::get('/{fabric}/edit', [FabricController::class, 'edit'])->name('edit'); // edit form
        Route::put('/{fabric}', [FabricController::class, 'update'])->name('update'); // update
        Route::delete('/{fabric}', [FabricController::class, 'destroy'])->name('destroy'); // delete
        Route::get('/trash', [FabricController::class, 'trash'])->name('trash'); // soft-deleted
        Route::post('/{id}/restore', [FabricController::class, 'restore'])->name('restore'); // restore deleted

        // Extra routes
        Route::get('/{fabric}/barcode', [FabricController::class, 'barcode'])->name('barcode'); // show barcode
        Route::get('/{fabric}/balance', [FabricController::class, 'balance'])->name('balance'); // stock balance
    });
});

require __DIR__.'/auth.php';
