<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantStatusController;
use Illuminate\Support\Facades\Route;


foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', fn() => view('welcome'));
        Route::post('/apply-tenant', [TenantStatusController::class, 'store'])->name('tenants.store');
    });
}

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::patch('/tenants/{tenant}/reject', [TenantStatusController::class, 'reject'])->name('tenants.reject');
});

require __DIR__ . '/auth.php';
