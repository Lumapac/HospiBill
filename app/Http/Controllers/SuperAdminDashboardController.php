<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $recentTenants = Tenant::with('domains')
            ->select('id', 'name', 'email', 'status', 'contact_person', 'phone_number', 'admin_notes', 'created_at')
            ->latest()
            ->take(5)
            ->get();
        
        return view('dashboard', [
            'tenants' => $recentTenants,
            'allTenants' => $allTenants
        ]);
    }
} 