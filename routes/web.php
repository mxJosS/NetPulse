<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', App\Http\Controllers\DashboardController::class)->name('dashboard');
    
    // Admin only routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('staff', App\Http\Controllers\StaffController::class)->parameters(['staff' => 'staff']);
        Route::resource('clients', App\Http\Controllers\ClientController::class);
        Route::resource('devices', App\Http\Controllers\DeviceController::class);
        Route::resource('work-orders', App\Http\Controllers\WorkOrderController::class)->except(['index', 'show']);

        // Executive Reports
        Route::get('admin/reports/weekly', [App\Http\Controllers\DashboardController::class, 'weeklyReport'])->name('admin.reports.weekly');
        Route::get('admin/reports/monthly', [App\Http\Controllers\DashboardController::class, 'monthlyReport'])->name('admin.reports.monthly');
        Route::get('admin/reports/yearly', [App\Http\Controllers\DashboardController::class, 'yearlyReport'])->name('admin.reports.yearly');
    });

    // Work Orders - Admin & Engineers shared
    Route::get('work-orders', [App\Http\Controllers\WorkOrderController::class, 'index'])->name('work-orders.index');
    Route::get('work-orders/{work_order}', [App\Http\Controllers\WorkOrderController::class, 'show'])->name('work-orders.show');
    Route::put('work-orders/{work_order}/status', [App\Http\Controllers\WorkOrderController::class, 'updateStatus'])->name('work-orders.update-status');
    Route::post('work-orders/{work_order}/report', [App\Http\Controllers\WorkOrderController::class, 'generateReport'])->name('work-orders.report');
});

require __DIR__.'/settings.php';
