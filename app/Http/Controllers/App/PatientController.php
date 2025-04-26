<?php

namespace App\Http\Controllers\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.patients.patients');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register()
    {
        return view('app.patients.patient_modal_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
       //
    }
}
