<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard with relevant data
     */
    public function adminDashboard()
    {
        $totalPatients = Patient::count();
        $totalServices = Service::count();
        $totalUsers = User::count();
        
        $recentPatients = Patient::with('service')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $serviceStats = Service::withCount('patients')
            ->orderBy('patients_count', 'desc')
            ->take(5)
            ->get();
            
        return view('app.admin-dashboard', compact(
            'totalPatients',
            'totalServices',
            'totalUsers',
            'recentPatients',
            'serviceStats'
        ));
    }
    
    /**
     * Display doctor dashboard with relevant data
     */
    public function doctorDashboard()
    {
        $totalPatients = Patient::count();
        
        $recentPatients = Patient::with('service')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $patientsByService = Service::withCount('patients')
            ->orderBy('patients_count', 'desc')
            ->get();
            
        return view('app.doctor-dashboard', compact(
            'totalPatients',
            'recentPatients',
            'patientsByService'
        ));
    }
    
    /**
     * Display cashier dashboard with relevant data
     */
    public function cashierDashboard()
    {
        $todayCollections = 0; // Replace with actual collection calculation when payment model is available
        $pendingPayments = 0; // Replace with actual pending payments count when payment model is available
        $completedTransactions = 0; // Replace with actual completed transactions count when payment model is available
        
        $recentPatients = Patient::with('service')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        return view('app.casher-dashboard', compact(
            'todayCollections',
            'pendingPayments',
            'completedTransactions',
            'recentPatients'
        ));
    }
} 