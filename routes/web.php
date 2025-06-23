<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
    // Route::resource('products', ProductController::class);


// Dashboard - requires auth
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Inventory Resource Routes
    Route::resource('products', ProductController::class);
    // Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');

    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);

    // Stock Handling
    Route::post('products/{id}/increase-stock', [ProductController::class, 'increaseStock'])->name('products.increaseStock');
    Route::post('products/{id}/decrease-stock', [ProductController::class, 'decreaseStock'])->name('products.decreaseStock');

    // Soft Deletes (Optional)
    Route::get('products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
    Route::post('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');

    // Export (Optional)
    Route::get('products/export/csv', [ProductController::class, 'exportCsv'])->name('products.export.csv');
    Route::get('products/export/excel', [ProductController::class, 'exportExcel'])->name('products.export.excel');
});

// Auth scaffolding routes
require __DIR__.'/auth.php';
