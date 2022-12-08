<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PanelController;
use App\Http\Controllers\Panel\UsersController;
use App\Http\Controllers\Panel\ProductsController;
use App\Http\Controllers\Panel\SharesController;
use App\Http\Controllers\Panel\PurchasesController;

//Front
use App\Http\Controllers\ProductsController as FrontProductsController;

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

Auth::routes();

Route::get('/', function () {
    return view('index');
})->name('index');

Route::prefix('products')->group(function () {
    Route::get('/view/{product}', [FrontProductsController::class, 'show']);
});


Route::prefix('panel')->middleware(['auth'])->group(function () {
    Route::get('/', [PanelController::class, 'index'])->name('panel');

    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('panel_users');
        Route::get('/promote/{user}', [UsersController::class, 'promote']);
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductsController::class, 'index'])->name('panel_products');
        Route::get('/create', [ProductsController::class, 'create']);
        Route::get('/edit/{product}', [ProductsController::class, 'edit']);

        Route::post('/create', [ProductsController::class, 'store']);
        Route::post('/edit/{product}', [ProductsController::class, 'update']);
    });

    Route::prefix('shares')->group(function () {
        Route::get('/', [SharesController::class, 'index'])->name('panel_shares');
    });

    Route::prefix('purchases')->group(function () {
        Route::get('/', [PurchasesController::class, 'index'])->name('panel_purchases');
        Route::get('/create/{product}', [PurchasesController::class, 'create']);
        Route::get('/verify/{purchase}', [PurchasesController::class, 'verify']);
    });
});
