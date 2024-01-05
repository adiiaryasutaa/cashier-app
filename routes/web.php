<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('/users')->controller(UserController::class)->group(function () {
        Route::get('/', '__invoke')->name('users');
        Route::get('/{user}', 'show')->name('users.show');
    });

    Route::prefix('/items')->controller(ItemController::class)->group(function () {
        Route::get('/', '__invoke')->name('items');
        Route::get('/{item}', 'show')->name('items.show');
    });

    Route::prefix('/transactions')->controller(TransactionController::class)->group(function () {
        Route::get('/', '__invoke')->name('transactions');
        Route::get('/{transaction}', 'show')->name('transactions.show');
    });

    Route::get('/cashier', CashierController::class)->name('cashier');
});
