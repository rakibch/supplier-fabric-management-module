<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\SupplierWebController;

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

require __DIR__.'/auth.php';
