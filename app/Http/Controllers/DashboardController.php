<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index()
    {
        $tenants = Tenant::with('domains')->latest()->take(5)->get();
        return view('dashboard', compact('tenants'));
    }
} 