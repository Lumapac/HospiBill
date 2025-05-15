<?php

namespace App\Http\Controllers\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Patient;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::with('service')->latest()->get();
        $services = Service::select('id', 'name', 'price')->orderBy('name')->get();
        return view('app.patients.patients', compact('patients', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register()
    {
        $services = Service::select('id', 'name')->orderBy('name')->get();
        return view('app.patients.patient_modal_form', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'service_id' => 'required|exists:services,id',
            'notes' => 'nullable|string',
        ]);

        Patient::create($validated);

        return redirect()->route('patient.index')
            ->with('success', 'Patient registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Patient $patient)
    {
        $patient->load('service');
        
        // Check if this is an AJAX request, which would indicate it's for the modal
        if ($request->ajax()) {
            return response()->json([
                'patient' => $patient,
                'serviceName' => $patient->service->name ?? 'N/A',
                'servicePrice' => $patient->service->price ?? 0
            ]);
        }
        
        // For direct URL access or backward compatibility, redirect to the index page
        // with a flash message to view the patient details
        return redirect()->route('patient.index')
            ->with('patientToView', $patient->id)
            ->with('info', 'Patient details are now viewed in a modal. Please use the view button.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        $services = Service::select('id', 'name', 'price')->orderBy('name')->get();
        return view('app.patients.edit', compact('patient', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'service_id' => 'required|exists:services,id',
            'notes' => 'nullable|string',
        ]);

        $patient->update($validated);

        return redirect()->route('patient.index')
            ->with('success', 'Patient updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patient.index')
            ->with('success', 'Patient deleted successfully.');
    }
}
