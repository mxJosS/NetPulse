<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\WorkOrderController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    // Admin only routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('staff', StaffController::class)->parameters(['staff' => 'staff']);
        Route::resource('clients', ClientController::class);
        Route::resource('devices', DeviceController::class);
        Route::resource('work-orders', WorkOrderController::class)->except(['index', 'show']);

        // Executive Reports
        Route::get('admin/reports/weekly', [DashboardController::class, 'weeklyReport'])->name('admin.reports.weekly');
        Route::get('admin/reports/monthly', [DashboardController::class, 'monthlyReport'])->name('admin.reports.monthly');
        Route::get('admin/reports/yearly', [DashboardController::class, 'yearlyReport'])->name('admin.reports.yearly');
    });

    // Work Orders - Admin & Engineers shared
    Route::get('work-orders', [WorkOrderController::class, 'index'])->name('work-orders.index');
    Route::get('work-orders/{work_order}', [WorkOrderController::class, 'show'])->name('work-orders.show');
    Route::put('work-orders/{work_order}/status', [WorkOrderController::class, 'updateStatus'])->name('work-orders.update-status');
    Route::post('work-orders/{work_order}/report', [WorkOrderController::class, 'generateReport'])->name('work-orders.report');
    Route::get('work-orders/{work_order}/download', [WorkOrderController::class, 'downloadReport'])->name('work-orders.download');
});

require __DIR__.'/settings.php';
