@extends('app.layouts.sidebar')
@section('title', 'Doctor Dashboard')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @include('layouts.navbar', ['title' => 'Doctor Dashboard'])
        
        <div class="container-fluid py-4">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-symbols-rounded opacity-10">personal_injury</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Patients</p>
                                <h4 class="mb-0">{{ $totalPatients }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <div class="d-flex">
                                <p class="mb-0 text-sm">Registered patients in the system</p>
                                <i class="material-symbols-rounded text-success ms-auto">groups</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-symbols-rounded opacity-10">today</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Patients Today</p>
                                <h4 class="mb-0">{{ $recentPatients->where('created_at', '>=', \Carbon\Carbon::today())->count() }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <div class="d-flex">
                                <p class="mb-0 text-sm">Patients registered today</p>
                                <i class="material-symbols-rounded text-primary ms-auto">calendar_today</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-symbols-rounded opacity-10">medical_services</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Available Services</p>
                                <h4 class="mb-0">{{ $patientsByService->count() }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <div class="d-flex">
                                <p class="mb-0 text-sm">Medical services available</p>
                                <i class="material-symbols-rounded text-info ms-auto">inventory_2</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Recent Patients Table -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Recent Patients</h6>
                                <a href="{{ route('patient.index') }}" class="btn btn-link text-dark px-3 mb-0">
                                    <i class="material-symbols-rounded text-sm me-1">visibility</i>View All
                                </a>
                            </div>
                            <p class="text-sm mb-0 text-muted">Recently registered patients</p>
                        </div>
                        <div class="card-body px-0 pb-2">
                            @if($recentPatients->count() > 0)
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Patient</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Service</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="patientTableBody">
                                            @foreach($recentPatients as $patient)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                                                                <span class="text-white text-uppercase">{{ substr($patient->first_name, 0, 1) }}</span>
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $patient->first_name }} {{ $patient->last_name }}</h6>
                                                                <p class="text-xs text-secondary mb-0">{{ $patient->email }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-gradient-info">{{ $patient->service->name ?? 'N/A' }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold">
                                                            {{ $patient->created_at->format('M d, Y') }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        @if($patient->created_at->isToday())
                                                            <span class="badge bg-gradient-success">New</span>
                                                        @else
                                                            <span class="badge bg-gradient-secondary">Registered</span>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="{{ route('patient.show', $patient->id) }}" class="btn btn-link text-dark px-2 mb-0" data-toggle="tooltip" data-original-title="View patient">
                                                            <i class="material-symbols-rounded text-sm">visibility</i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <div class="icon icon-shape icon-xl bg-gradient-secondary shadow text-center border-radius-lg mb-3">
                                        <i class="material-symbols-rounded opacity-10" aria-hidden="true">person_off</i>
                                    </div>
                                    <h5>No patients registered</h5>
                                    <p class="text-sm text-secondary">No patients have been registered yet.</p>
                                    <a href="{{ route('patient.register') }}" class="btn btn-sm bg-gradient-primary mt-3">
                                        <i class="material-symbols-rounded me-1">add</i>
                                        Register New Patient
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Patient Service Distribution -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Patients by Service</h6>
                            </div>
                            <p class="text-sm mb-0 text-muted">Patient distribution by service</p>
                        </div>
                        <div class="card-body px-0 pb-2">
                            @if($patientsByService->count() > 0)
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Service</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Patient Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalPatientCount = $patientsByService->sum('patients_count');
                                            @endphp

                                            @foreach($patientsByService as $service)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="icon icon-sm icon-shape shadow text-center border-radius-md me-2 d-flex align-items-center justify-content-center">
                                                                <i class="material-symbols-rounded opacity-10 text-primary">medical_services</i>
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $service->name }}</h6>
                                                                <p class="text-xs text-secondary mb-0">{{ $service->category }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2 text-sm font-weight-bold">{{ $service->patients_count }}</span>
                                                            <div>
                                                                <div class="progress" style="width: 100px; height: 5px;">
                                                                    <div class="progress-bar bg-gradient-info" role="progressbar"
                                                                        aria-valuenow="{{ $service->patients_count }}"
                                                                        aria-valuemin="0"
                                                                        style="width: {{ min(100, $service->patients_count * 5) }}%">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <div class="icon icon-shape icon-lg bg-gradient-secondary shadow text-center border-radius-lg mb-3">
                                        <i class="material-symbols-rounded opacity-10" aria-hidden="true">no_accounts</i>
                                    </div>
                                    <p class="text-sm text-secondary">No services data available.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Patient search functionality
                    const searchPatient = document.getElementById('searchPatient');
                    const patientTableBody = document.getElementById('patientTableBody');

                    if (searchPatient && patientTableBody) {
                        searchPatient.addEventListener('keyup', function () {
                            const searchTerm = this.value.toLowerCase();
                            const rows = patientTableBody.querySelectorAll('tr');

                            rows.forEach(row => {
                                const patientName = row.querySelector('td:first-child').textContent.toLowerCase();
                                if (patientName.includes(searchTerm)) {
                                    row.style.display = '';
                                } else {
                                    row.style.display = 'none';
                                }
                            });
                        });
                    }
                });
            </script>
        @endpush
    </main>
@endsection