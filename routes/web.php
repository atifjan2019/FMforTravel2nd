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

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\DashboardController;
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource routes for all main entities
    Route::resource('customers', App\Http\Controllers\CustomerController::class);
    Route::resource('suppliers', App\Http\Controllers\SupplierController::class);
    Route::resource('items', App\Http\Controllers\ItemController::class);
    Route::resource('purchases', App\Http\Controllers\PurchaseController::class);
    Route::resource('incomes', App\Http\Controllers\IncomeController::class);
    Route::resource('expenses', App\Http\Controllers\ExpenseController::class);
    Route::resource('customer-payments', App\Http\Controllers\CustomerPaymentController::class);
    Route::resource('supplier-payments', App\Http\Controllers\SupplierPaymentController::class);
});

require __DIR__.'/auth.php';
