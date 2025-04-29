<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\ScopeSessions;
use App\Http\Controllers\App\{
    ProfileController,
    UserController,
    ServiceController,
    PatientController
};

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
        // InitializeTenancyBySubdomain::class,
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    ScopeSessions::class
])->group(function () {

    Route::get('/', function () {
        return view('app.welcome');
    });

    Route::get('/dashboard', function () {
        return view('app.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
        Route::group(['middleware' => ['role:admin']], function () { 
            Route::get('users', [UserController::class, 'index'])->name('users.index');
            Route::resource('users', UserController::class);
        });

        Route::group(['middleware' => ['role:admin']], function () { 
            Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
            Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
            Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
            Route::get('/services/list', [ServiceController::class, 'list'])->name('services.list');
            Route::resource('services', ServiceController::class);
        });

        Route::group(['middleware' => ['role:doctor']], function () { 
            Route::get('/patient', [PatientController::class, 'index'])->name('patient.index');
            Route::get('/patient/register', [PatientController::class, 'register'])->name('patient.register');
            Route::post('/patient/store', [PatientController::class, 'store'])->name('patient.store');
            Route::get('/patient/{patient}', [PatientController::class, 'show'])->name('patient.show');
            Route::get('/patient/{patient}/edit', [PatientController::class, 'edit'])->name('patient.edit');
            Route::put('/patient/{patient}', [PatientController::class, 'update'])->name('patient.update');
            Route::delete('/patient/{patient}', [PatientController::class, 'destroy'])->name('patient.destroy');
        });
    });
    

    require __DIR__ . '/tenant-auth.php';

});
