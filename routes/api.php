<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\FabricController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('suppliers', SupplierController::class);
    Route::get('suppliers/trashed', [SupplierController::class, 'trashed']);
    Route::post('suppliers/{supplier}/restore', [SupplierController::class, 'restore']);
    Route::post('suppliers/{supplier}/notes', [SupplierController::class, 'addNote']);

    Route::apiResource('fabrics', FabricController::class);
    Route::get('fabrics/trashed', [FabricController::class, 'trashed']);
    Route::post('fabrics/{id}/restore', [FabricController::class, 'restore']);
    Route::post('fabrics/{fabric}/stock', [FabricController::class, 'addStock']);
    Route::post('fabrics/{fabric}/barcodes', [FabricController::class, 'generateBarcode']);
    Route::get('barcodes/{barcode}/print', [FabricController::class, 'printBarcode']);
    Route::post('fabrics/{fabric}/notes', [FabricController::class, 'addNote']);
});
