<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
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
        return view('reports.index');
    }
    
    /**
     * Generate and download the PDF report
     */
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'report_type' => 'required|in:all,pending,approved,rejected',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
        ]);
        
        $query = Tenant::with('domains');
        
        // Filter by report type
        if ($validated['report_type'] !== 'all') {
            $query->where('status', $validated['report_type']);
        }
        
        // Filter by date range if provided
        if (!empty($validated['date_from'])) {
            $query->whereDate('created_at', '>=', $validated['date_from']);
        }
        
        if (!empty($validated['date_to'])) {
            $query->whereDate('created_at', '<=', $validated['date_to']);
        }
        
        $tenants = $query->get();
        
        $reportTitle = ucfirst($validated['report_type']) . ' Tenants Report';
        $dateRange = '';
        
        if (!empty($validated['date_from']) || !empty($validated['date_to'])) {
            $dateFrom = !empty($validated['date_from']) ? Carbon::parse($validated['date_from'])->format('M d, Y') : 'Beginning';
            $dateTo = !empty($validated['date_to']) ? Carbon::parse($validated['date_to'])->format('M d, Y') : 'Present';
            $dateRange = "($dateFrom to $dateTo)";
        }
        
        $pdf = PDF::loadView('reports.tenant_report', [
            'tenants' => $tenants,
            'reportTitle' => $reportTitle, 
            'dateRange' => $dateRange,
            'generatedAt' => Carbon::now()->format('F d, Y h:i A')
        ]);
        
        return $pdf->download("tenant_report_{$validated['report_type']}.pdf");
    }
} 