<?php

namespace App\Http\Controllers;

use App\Mail\TenantCredentialsMail;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::with('domains')->get();
        // dd($tenants->toArray());
        return view('tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        return view('tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:tenants,name,' . $tenant->id,
            'email' => 'required|email|max:255|unique:tenants,email,' . $tenant->id,
            'contact_person' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'status' => 'required|in:pending,approved,disabled',
            'subscription' => 'required|in:free,standard,premium',
            'admin_notes' => 'nullable|string',
        ]);

        $tenant->update($validatedData);

        // If tenant was approved, send credentials email
        if ($request->status === 'approved' && $tenant->wasChanged('status') && $tenant->getOriginal('status') !== 'approved') {
            // Generate a new password if not provided
            $plainPassword = Str::random(10);
            $tenant->update([
                'password' => bcrypt($plainPassword),
                'approved_at' => now(),
                'approved_by' => auth()->user()->name
            ]);
            
            // Find the domain
            $domain = $tenant->domains()->first();
            
            // Send email with credentials
            if ($domain) {
                Mail::to($tenant->email)->send(new TenantCredentialsMail($plainPassword, $tenant, $domain->domain));
            }
        }

        // Check if request is AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true, 
                'message' => 'Tenant updated successfully'
            ]);
        }

        return redirect()->route('tenants.index')->with('success', 'Tenant updated successfully.');
    }

    /**
     * Update the tenant's subscription.
     */
    public function updateSubscription(Request $request, Tenant $tenant)
    {
        // Don't allow subscription updates for rejected tenants
        if ($tenant->status === 'rejected') {
            return redirect()->route('tenants.index')->with('info', 'Cannot update subscription for rejected tenants.');
        }
        
        $validatedData = $request->validate([
            'subscription' => 'required|in:free,standard,premium',
        ]);

        $tenant->update($validatedData);

        return redirect()->route('tenants.index')->with('success', 'Tenant subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully.');
    }
}
