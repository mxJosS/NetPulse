<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', App\Http\Controllers\DashboardController::class)->name('dashboard');
    
    // Clients - Only Admin can manage clients
    Route::middleware('role:admin')->group(function () {
        Route::resource('clients', App\Http\Controllers\ClientController::class);
        Route::resource('devices', App\Http\Controllers\DeviceController::class);
    });

    // Work Orders - Accessible to Admin and Engineers
    Route::resource('work-orders', App\Http\Controllers\WorkOrderController::class);
});

require __DIR__.'/settings.php';
