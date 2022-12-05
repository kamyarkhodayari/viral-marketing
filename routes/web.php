<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PanelController;
use App\Http\Controllers\Panel\UsersController;
use App\Http\Controllers\Panel\ProductsController;

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
});
