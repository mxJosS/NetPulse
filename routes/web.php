<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', App\Http\Controllers\DashboardController::class)->name('dashboard');
    
    // Work Orders - Admin & Engineers shared
    Route::get('work-orders', [App\Http\Controllers\WorkOrderController::class, 'index'])->name('work-orders.index');
    Route::get('work-orders/{work_order}', [App\Http\Controllers\WorkOrderController::class, 'show'])->name('work-orders.show');
    Route::put('work-orders/{work_order}/status', [App\Http\Controllers\WorkOrderController::class, 'updateStatus'])->name('work-orders.update-status');

    // Admin only routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('clients', App\Http\Controllers\ClientController::class);
        Route::resource('devices', App\Http\Controllers\DeviceController::class);
        Route::resource('work-orders', App\Http\Controllers\WorkOrderController::class)->except(['index', 'show']);
    });
});

require __DIR__.'/settings.php';
