<?php

namespace App\Http\Controllers\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('app.services.services_list', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.services.create_services');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'duration' => 'nullable|string',
            'requirements' => 'nullable|string',
            'availability' => 'nullable|string',
        ]);
        
        Service::create($validatedData);
        
        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('app.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('app.services.edit_services', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'duration' => 'nullable|string',
            'requirements' => 'nullable|string',
            'availability' => 'nullable|string',
        ]);
        
        $service->update($validatedData);
        
        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // Check if any patients are using this service
        if ($service->patients()->count() > 0) {
            return redirect()->route('services.index')
                ->with('error', 'This service cannot be deleted because it is being used by one or more patients.');
        }
        
        $service->delete();
        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Return a list of services as JSON for dropdowns
     */
    public function list()
    {
        $services = Service::select('id', 'name', 'price')->get();
        return response()->json($services);
    }
}
