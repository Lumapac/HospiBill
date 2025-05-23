<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantStatusController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;


foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', fn() => view('welcome'))->name('welcome');
        Route::post('/apply-tenant', [TenantStatusController::class, 'store'])->name('tenants.store');
    });
}

Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Tenant resource routes (excluding store method)
    Route::resource('tenants', TenantController::class)->except(['store']);
    
    // Admin tenant creation route (different from public application)
    Route::post('/tenants', [TenantStatusController::class, 'store'])->name('admin.tenants.store');
    
    // Tenant approval/rejection routes
    Route::patch('/tenants/{tenant}/approve', [TenantStatusController::class, 'approve'])->name('tenants.approve');
    Route::patch('/tenants/{tenant}/disable', [TenantStatusController::class, 'disable'])->name('tenants.disable');
    Route::patch('/tenants/{tenant}/reject', [TenantStatusController::class, 'reject'])->name('tenants.reject');
    
    // Tenant subscription route
    Route::patch('/tenants/{tenant}/subscription', [TenantController::class, 'updateSubscription'])->name('tenants.update.subscription');
});

// Report routes
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');

require __DIR__ . '/auth.php';
