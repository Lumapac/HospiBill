<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stancl\Tenancy\Tenancy;

class CheckTenantStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app(Tenancy::class)->initialized) {
            $tenant = tenant();
            
            if ($tenant->status !== 'approved') {
                abort(403, 'Your tenant account is not active. Please contact the administrator for assistance.');
            }
        }

        return $next($request);
    }
}
