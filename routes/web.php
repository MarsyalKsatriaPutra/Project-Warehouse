<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;   


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Product Routes
    Route::resource('products', ProductController::class);

    // Stock Routes
    Route::prefix('stocks')->group(function () {
        Route::get('/', [StockController::class, 'index'])->name('stocks.index');
        Route::post('/in', [StockController::class, 'stockIn'])->name('stocks.in');
        Route::post('/out', [StockController::class, 'stockOut'])->name('stocks.out');
        Route::get('/logs/{product}', [StockController::class, 'logs'])->name('stocks.logs');
    });
});

require __DIR__.'/auth.php';
