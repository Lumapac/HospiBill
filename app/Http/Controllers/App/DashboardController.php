<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Service;
use App\Models\User;
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
        // Get today's collections (sum of all payments made today)
        $todayCollections = Payment::whereDate('created_at', Carbon::today())
            ->sum('amount');
        
        // Get count of pending payments (bills that are not fully paid)
        $pendingPayments = Bill::where('status', '!=', 'paid')
            ->count();
        
        // Get count of completed transactions (bills that are fully paid)
        $completedTransactions = Bill::where('status', 'paid')
            ->count();
        
        // Get recent patients
        $recentPatients = Patient::with('service')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Get pending bills with pagination
        $pendingBills = Bill::with(['patient', 'service'])
            ->where('status', '!=', 'paid')
            ->orderBy('due_date', 'asc')
            ->paginate(10);
            
        // Get a list of services for the create bill form
        $services = Service::orderBy('name')->get();
            
        return view('app.cashier-dashboard', compact(
            'todayCollections',
            'pendingPayments',
            'completedTransactions',
            'recentPatients',
            'pendingBills',
            'services'
        ));
    }
} 