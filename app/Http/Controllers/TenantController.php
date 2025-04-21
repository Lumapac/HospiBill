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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:tenants',
            'email' => 'required|email|max:255|unique:tenants',
            'domain_name' => 'required|string|max:255|unique:domains,domain',
        ]);

        $plainPassword = Str::random(10);
        $validatedData['password'] = bcrypt($plainPassword);

        // dd($validatedData);
        $tenant = Tenant::create($validatedData);

        $domain = $tenant->domains()->create([
            'domain' => $validatedData['domain_name'] . '.' . config('app.domain'),
        ]);

        // Send password via email
        Mail::to($tenant->email)->send(new TenantCredentialsMail($plainPassword, $tenant, $domain->domain));

        // Check if the request is coming from the central domain's landing page
        $referer = $request->headers->get('referer');
        
        if ($referer && strpos($referer, '/apply-tenant') === false && !$request->is('tenants/*')) {
            // If not from the admin dashboard, redirect back to the landing page
            return redirect('/')->with('success', 'Application submitted successfully! Check your email for login credentials.');
        }

        // Otherwise, redirect to the tenants index (admin dashboard)
        return redirect()->route('tenants.index')->with('success', 'Tenant created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}
