<?php

use App\Http\Controllers\cartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PopularproductController;
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

Route::get('/', [HomeController::class, 'welcome']);




Route::middleware('auth')->group(function () {
   
Route::get('/cart', [cartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [cartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [cartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [cartController::class, 'clear'])->name('cart.clear');
Route::get('/product/{id}', [PopularproductController::class, 'show'])->name('product.show');

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/products', function () {
        return view('Admin.admin');
    })->name('Admin.admin');
    Route::get('/products', [PopularproductController::class, 'index'])->name('products.index');
 Route::get('/products/create', [PopularproductController::class, 'create'])->name('products.create');
 Route::post('/products', [PopularproductController::class, 'store'])->name('products.store');
 Route::get('products/{id}/edit', [PopularproductController::class, 'edit'])->name('products.edit');
Route::put('products/{id}', [PopularproductController::class, 'update'])->name('products.update');
    Route::delete('products/{id}', [PopularproductController::class, 'destroy'])->name('products.destroy');
});

require __DIR__.'/auth.php';
