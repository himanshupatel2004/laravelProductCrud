<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('products.create');
})->name('create');

// Route::resource('products', ProductController::class);

Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::get('list', 'index')->name('products.list');
    Route::get('create', 'create')->name('products.create');
    Route::post('store', 'store')->name('products.store');
    Route::get('show/{id}', 'show')->name('products.show');
    Route::get('edit/{id}', 'edit')->name('products.edit');
    Route::post('update', 'update')->name('products.update');
    Route::get('delete/{id}', 'delete')->name('products.delete'); // load delete confirm page
    Route::post('destroy', 'destroy')->name('products.destroy'); // process delete
});

// Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
// Route::get('products/list', [ProductController::class, 'index'])->name('products.list');