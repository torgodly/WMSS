<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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


    //get warehouse
    Route::get('/warehouse', [\App\Http\Controllers\WarehouseController::class, 'index'])->name('warehouse.index');
    //store warehouse
    Route::post('/warehouse', [\App\Http\Controllers\WarehouseController::class, 'store'])->name('warehouse.store');
    //destory
    Route::delete('/warehouse/{warehouse}', [\App\Http\Controllers\WarehouseController::class, 'destroy'])->name('warehouse.destroy');
    //show
    Route::get('/warehouse/{warehouse}', [\App\Http\Controllers\WarehouseController::class, 'show'])->name('warehouse.show');
    //update
    Route::patch('/warehouse/{warehouse}', [\App\Http\Controllers\WarehouseController::class, 'update'])->name('warehouse.update');
    //add product to warehouse
    Route::post('/warehouse/{warehouse}/product', [\App\Http\Controllers\WarehouseController::class, 'attachProduct'])->name('warehouse.addProduct');


    //get product
    Route::get('/product', [\App\Http\Controllers\ProductController::class, 'index'])->name('product.index');

    //store product
    Route::post('/product', [\App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
    //destory
    Route::delete('/product/{product}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');
    //show
    Route::get('/product/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
    //update
    Route::patch('/product/{product}', [\App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
});

require __DIR__.'/auth.php';
