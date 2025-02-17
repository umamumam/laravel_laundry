<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderStatusController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/orders/export-view', [OrderController::class, 'exportExcel'])->name('orders.export-view');
Route::get('/cek-status', [OrderStatusController::class, 'index'])->name('orders.status');
Route::post('/cek-status', [OrderStatusController::class, 'check'])->name('orders.check');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('customers', CustomerController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('statuses', StatusController::class);
    Route::resource('orders', OrderController::class);
    Route::get('/orders/{id}/pdf', [OrderController::class, 'generatePDF'])->name('orders.pdf');
    Route::patch('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::patch('/orders/bulk-update-status', [OrderController::class, 'bulkUpdateStatus'])->name('orders.bulkUpdateStatus');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
