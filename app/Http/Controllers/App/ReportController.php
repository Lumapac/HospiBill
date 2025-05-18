<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Show the report generation form
     */
    public function index()
    {
        $services = Service::orderBy('name')->get();
        return view('app.reports.index', compact('services'));
    }
    
    /**
     * Generate and download the PDF report
     */
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'report_type' => 'required|in:bills,payments,patients,services',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'status' => 'nullable|string',
            'service_id' => 'nullable|exists:services,id',
        ]);
        
        $dateFrom = !empty($validated['date_from']) ? Carbon::parse($validated['date_from']) : null;
        $dateTo = !empty($validated['date_to']) ? Carbon::parse($validated['date_to'])->endOfDay() : null;
        
        switch($validated['report_type']) {
            case 'bills':
                return $this->generateBillsReport($validated, $dateFrom, $dateTo);
            case 'payments':
                return $this->generatePaymentsReport($validated, $dateFrom, $dateTo);
            case 'patients':
                return $this->generatePatientsReport($validated, $dateFrom, $dateTo);
            case 'services':
                return $this->generateServicesReport($validated, $dateFrom, $dateTo);
            default:
                return redirect()->back()->with('error', 'Invalid report type');
        }
    }
    
    /**
     * Generate bills report
     */
    private function generateBillsReport($validated, $dateFrom, $dateTo)
    {
        $query = Bill::with(['patient', 'service', 'payments']);
        
        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        
        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }
        
        if (!empty($validated['status']) && $validated['status'] !== 'all') {
            $query->where('status', $validated['status']);
        }
        
        if (!empty($validated['service_id'])) {
            $query->where('service_id', $validated['service_id']);
        }
        
        $bills = $query->get();
        $totalAmount = $bills->sum('amount');
        $totalPaid = $bills->sum('amount_paid');
        $totalRemaining = $totalAmount - $totalPaid;
        
        $reportTitle = "Bills Report";
        $dateRange = $this->getDateRangeText($dateFrom, $dateTo);
        
        $pdf = PDF::loadView('app.reports.bills', [
            'bills' => $bills,
            'reportTitle' => $reportTitle,
            'dateRange' => $dateRange,
            'totalAmount' => $totalAmount,
            'totalPaid' => $totalPaid,
            'totalRemaining' => $totalRemaining,
            'generatedAt' => Carbon::now()->format('F d, Y h:i A')
        ]);
        
        return $pdf->download("bills_report.pdf");
    }
    
    /**
     * Generate payments report
     */
    private function generatePaymentsReport($validated, $dateFrom, $dateTo)
    {
        $query = Payment::with(['bill.patient', 'bill.service', 'cashier']);
        
        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        
        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }
        
        if (!empty($validated['service_id'])) {
            $query->whereHas('bill', function($q) use ($validated) {
                $q->where('service_id', $validated['service_id']);
            });
        }
        
        $payments = $query->get();
        $totalAmount = $payments->sum('amount');
        
        $reportTitle = "Payments Report";
        $dateRange = $this->getDateRangeText($dateFrom, $dateTo);
        
        $pdf = PDF::loadView('app.reports.payments', [
            'payments' => $payments,
            'reportTitle' => $reportTitle,
            'dateRange' => $dateRange,
            'totalAmount' => $totalAmount,
            'generatedAt' => Carbon::now()->format('F d, Y h:i A')
        ]);
        
        return $pdf->download("payments_report.pdf");
    }
    
    /**
     * Generate patients report
     */
    private function generatePatientsReport($validated, $dateFrom, $dateTo)
    {
        $query = Patient::with(['service', 'bills']);
        
        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        
        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }
        
        if (!empty($validated['service_id'])) {
            $query->where('service_id', $validated['service_id']);
        }
        
        $patients = $query->get();
        
        $reportTitle = "Patients Report";
        $dateRange = $this->getDateRangeText($dateFrom, $dateTo);
        
        $pdf = PDF::loadView('app.reports.patients', [
            'patients' => $patients,
            'reportTitle' => $reportTitle,
            'dateRange' => $dateRange,
            'generatedAt' => Carbon::now()->format('F d, Y h:i A')
        ]);
        
        return $pdf->download("patients_report.pdf");
    }
    
    /**
     * Generate services report
     */
    private function generateServicesReport($validated, $dateFrom, $dateTo)
    {
        $query = Service::withCount(['patients', 'bills']);
        
        if (!empty($validated['service_id'])) {
            $query->where('id', $validated['service_id']);
        }
        
        $services = $query->get();
        
        // For each service, calculate revenue
        foreach ($services as $service) {
            $billQuery = Bill::where('service_id', $service->id);
            
            if ($dateFrom) {
                $billQuery->whereDate('created_at', '>=', $dateFrom);
            }
            
            if ($dateTo) {
                $billQuery->whereDate('created_at', '<=', $dateTo);
            }
            
            $service->total_revenue = $billQuery->sum('amount_paid');
            $service->total_billed = $billQuery->sum('amount');
        }
        
        $reportTitle = "Services Report";
        $dateRange = $this->getDateRangeText($dateFrom, $dateTo);
        
        $pdf = PDF::loadView('app.reports.services', [
            'services' => $services,
            'reportTitle' => $reportTitle,
            'dateRange' => $dateRange,
            'generatedAt' => Carbon::now()->format('F d, Y h:i A')
        ]);
        
        return $pdf->download("services_report.pdf");
    }
    
    /**
     * Get formatted date range text
     */
    private function getDateRangeText($dateFrom, $dateTo)
    {
        $dateRange = '';
        
        if ($dateFrom || $dateTo) {
            $from = $dateFrom ? $dateFrom->format('M d, Y') : 'Beginning';
            $to = $dateTo ? $dateTo->format('M d, Y') : 'Present';
            $dateRange = "($from to $to)";
        }
        
        return $dateRange;
    }
} 