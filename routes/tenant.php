<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\ScopeSessions;
use App\Http\Middleware\CheckPremiumSubscription;
use App\Http\Controllers\App\{
    ProfileController,
    UserController,
    ServiceController,
    PatientController,
    CashierController,
    DashboardController,
    ReportController
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
    })->name('app.welcome');

    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->hasRole('doctor')) {
            return app(DashboardController::class)->doctorDashboard();
        } elseif ($user->hasRole('cashier')) {
            return app(DashboardController::class)->cashierDashboard();
        } elseif ($user->hasRole('admin')) {
            return app(DashboardController::class)->adminDashboard();
        }
    })->middleware(['auth', 'verified'])->name('dashboard');


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::group(['middleware' => ['role:admin']], function () {
            Route::get('users', [UserController::class, 'index'])->name('users.index');
            Route::resource('users', UserController::class);
            
            // Report routes - premium feature
            Route::middleware([CheckPremiumSubscription::class])->group(function () {
                Route::get('/reports', [ReportController::class, 'index'])->name('tenant.reports.index');
                Route::post('/reports/generate', [ReportController::class, 'generate'])->name('tenant.reports.generate');
            });
        });

        Route::group(['middleware' => ['role:admin']], function () {
            Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
            Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
            Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
            Route::get('/services/list', [ServiceController::class, 'list'])->name('services.list');
            Route::resource('services', ServiceController::class);
        });

        // Patient routes - show route accessible to both doctors and cashiers
        Route::get('/patient/{patient}', [PatientController::class, 'show'])->name('patient.show');
        
        Route::group(['middleware' => ['role:doctor']], function () {
            Route::get('/patient', [PatientController::class, 'index'])->name('patient.index');
            Route::get('/patient/register', [PatientController::class, 'register'])->name('patient.register');
            Route::post('/patient/store', [PatientController::class, 'store'])->name('patient.store');
            Route::get('/patient/{patient}/edit', [PatientController::class, 'edit'])->name('patient.edit');
            Route::put('/patient/{patient}', [PatientController::class, 'update'])->name('patient.update');
            Route::delete('/patient/{patient}', [PatientController::class, 'destroy'])->name('patient.destroy');
        });


        Route::group(['middleware' => ['role:cashier']], function () {
            Route::get('/billing', [CashierController::class, 'billing'])->name('patient.bill');
            Route::post('/billing/create', [CashierController::class, 'createBill'])->name('patient.bill.create');
            Route::get('/billing/{bill}', [CashierController::class, 'viewBill'])->name('patient.bill.view');
            Route::get('/billing/{bill}/pdf', [CashierController::class, 'downloadBillPdf'])->name('patient.bill.pdf');
            Route::post('/billing/{bill}/process-payment', [CashierController::class, 'processPayment'])->name('patient.bill.payment');
            Route::get('/billing/search-patients', [CashierController::class, 'searchPatients'])->name('patient.bill.search');
            Route::get('/patient/{patient}/services', [CashierController::class, 'getPatientServices'])->name('patient.services');
            Route::get('/billing/all', [CashierController::class, 'listAllBills'])->name('patient.bill.all');
        });

        // API route for bill details
        Route::get('/api/bills/{bill}', function(App\Models\Bill $bill) {
            $bill->load(['patient', 'service', 'payments.cashier']);
            return response()->json($bill);
        })->name('api.bill.show');
    });


    require __DIR__ . '/tenant-auth.php';

});
