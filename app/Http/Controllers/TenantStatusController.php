<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use Illuminate\Support\Str;
use App\Mail\TenantCredentialsMail;
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
            'domain_name' => 'required|string|max:255|unique:domains,domain',
        ]);

        $validatedData['password'] =  Str::random(10);

        $validatedData['status'] = 'pending';


        // Create the tenant
        $tenant = Tenant::create($validatedData);

        // Create the domain
        $tenant->domains()->create([
            'domain' => $validatedData['domain_name'] . '.' . config('app.domain'),
        ]);
        
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
                'password' => bcrypt($plainPassword)
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
    

    public function reject(Request $request, Tenant $tenant)
    {
        $validatedData = $request->validate([
            'admin_notes' => 'required|string',
        ]);
        
        $tenant->update([
            'status' => 'rejected',
            'admin_notes' => $validatedData['admin_notes']
        ]);
        
        return redirect()->route('tenants.index')->with('success', 'Tenant application rejected.');
    }
}
