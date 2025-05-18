<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use Illuminate\Support\Str;
use App\Mail\TenantCredentialsMail;
use App\Mail\TenantRejectionMail;
use Illuminate\Support\Facades\Mail;

class TenantStatusController extends Controller
{
    /**
     * Store a newly created tenant in pending status.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:tenants',
            'email' => 'required|email|max:255|unique:tenants',
            'contact_person' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'domain_name' => 'required|string|max:255|unique:domains,domain',
        ]);

        $validatedData['password'] =  Str::random(10);

        $validatedData['status'] = 'pending';


        // Create the tenant
        $tenant = Tenant::create($validatedData);

        if ($tenant->status !== 'rejected') {
            $tenant->domains()->create([
                'domain' => $validatedData['domain_name'] . '.' . config('app.domain'),
            ]);
        }
        
        return redirect('/')->with('success', 'Application submitted successfully! Your application is pending approval. Check your email for login credentials once approved.');
    }

    /**
     * Approve tenant application
     */
    public function approve(Tenant $tenant)
    {
        if ($tenant->status !== 'approved') {
     
            $plainPassword = $tenant->password;
            $tenant->update([
                'status' => 'approved',
                'password' => bcrypt($plainPassword),
                'approved_at' => now(),
                'approved_by' => auth()->user()->name
            ]); 
            
            // Find the domain
            $domain = $tenant->domains()->first();
            
            // Send email with credentials
            if ($domain) {
                Mail::to($tenant->email)->send(
                    new TenantCredentialsMail($plainPassword, $tenant, $domain->domain));
            }
            
            return redirect()->route('tenants.index')->with('success', 'Tenant application approved successfully.');
        }
        
        return redirect()->route('tenants.index')->with('info', 'Tenant already approved.');
    }
    
    /**
     * Disable an approved tenant
     */
    public function disable(Request $request, Tenant $tenant)
    {
        $validatedData = $request->validate([
            'admin_notes' => 'required|string',
        ]);
        
        // Store disable info
        $tenant->update([
            'status' => 'disabled',
            'admin_notes' => $validatedData['admin_notes'],
        ]);
        
        return redirect()->route('tenants.index')->with('success', 'Tenant has been disabled successfully.');
    }
    
    /**
     * Reject tenant application
     */
    public function reject(Request $request, Tenant $tenant)
    {
        $validatedData = $request->validate([
            'admin_notes' => 'required|string',
        ]);
        
        // Store rejection info
        $tenant->update([
            'status' => 'rejected',
            'admin_notes' => $validatedData['admin_notes'],
            'rejected_at' => now(),
            'rejected_by' => auth()->user()->name
        ]);
        
        // Delete the tenant database if it's already created
        if ($tenant->databaseExists()) {
            try {
                // Mark for deletion but don't actually delete to prevent errors in active connections
                $tenant->update(['should_delete_database' => true]);
            } catch (\Exception $e) {
                // Log any errors but continue with the rejection process
                \Log::error('Failed to mark tenant database for deletion: ' . $e->getMessage());
            }
        }
        
        // Delete any domains associated with this tenant
        try {
            $tenant->domains()->delete();
        } catch (\Exception $e) {
            \Log::error('Failed to delete tenant domains: ' . $e->getMessage());
        }
        
        // Send rejection email
        Mail::to($tenant->email)->send(
            new TenantRejectionMail($tenant, $validatedData['admin_notes'])
        );
        
        return redirect()->route('tenants.index')->with('success', 'Tenant application has been rejected and the applicant has been notified.');
    }
}
