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
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $tenant->update($validatedData);

        // If tenant was approved, send credentials email
        if ($request->status === 'approved' && $tenant->wasChanged('status') && $tenant->getOriginal('status') !== 'approved') {
            // Generate a new password if not provided
            $plainPassword = Str::random(10);
            $tenant->update(['password' => bcrypt($plainPassword)]);
            
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
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully.');
    }
}
