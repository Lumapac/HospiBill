<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPremiumSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $tenant = tenant();
        
        // Check if tenant has premium subscription
        if (!$tenant || $tenant->subscription !== 'premium') {
            if ($request->ajax()) {
                return response()->json(['error' => 'This feature requires a premium subscription.'], 403);
            }
            
            return redirect()->route('dashboard')
                ->with('error', 'This feature requires a premium subscription. Please upgrade your plan to access reports.');
        }
        
        return $next($request);
    }
} 