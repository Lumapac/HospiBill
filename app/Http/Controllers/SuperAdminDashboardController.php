<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class SuperAdminDashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index()
    {
        // Get all tenants for statistics
        $allTenants = Tenant::all();
        
        // Get the 5 most recent tenants for the table
        $recentTenants = Tenant::with('domains')->latest()->take(5)->get();
        
        return view('dashboard', [
            'tenants' => $recentTenants,
            'allTenants' => $allTenants
        ]);
    }
} 