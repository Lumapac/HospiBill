<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\PreventAccessFromTenants;
use App\Http\Middleware\CheckTenantStatus;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function(){
            $centralDomains = config('tenancy.central_domains');

            foreach($centralDomains as $domain) {
                Route::middleware('web')
                    ->domain($domain)
                    ->group(base_path('routes/web.php'));
            }

            // Route::middleware('web')->group(base_path('routes/web.php'));
        },
        
        // web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'central' => PreventAccessFromTenants::class,
            'tenant.status' => CheckTenantStatus::class,
            
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
        
        // Add global middleware
        $middleware->web(append: [
            CheckTenantStatus::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
