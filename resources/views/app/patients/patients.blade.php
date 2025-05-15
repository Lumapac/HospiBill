@extends('app.layouts.sidebar')
@section('title', 'Patient Management')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @include('layouts.navbar', ['title' => 'Patient Management'])
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3 mb-0">Patients List</h6>
                            <button type="button" class="btn bg-gradient-dark mb-0 me-3" id="openModal">
                                <i class="material-symbols-rounded opacity-5 text-white me-1">add</i>
                                Register New Patient
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible text-white mx-3" role="alert">
                                <span class="text-sm">{{ session('success') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        
                        @if(session('info'))
                            <div class="alert alert-info alert-dismissible text-white mx-3" role="alert">
                                <span class="text-sm">{{ session('info') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Patient Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Service</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($patients as $patient)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                                                        <span class="text-white text-uppercase">{{ substr($patient->first_name, 0, 1) }}</span>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $patient->first_name }} {{ $patient->last_name }}</h6>
                                                        @if($patient->date_of_birth)
                                                            <p class="text-xs text-secondary mb-0">
                                                                <i class="material-symbols-rounded text-sm">cake</i> {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('M d, Y') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-gradient-info">{{ $patient->service->name ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $patient->phone }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $patient->email }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-center action-buttons">
                                                    <button type="button" class="btn btn-link text-info mb-0 me-2 view-patient" 
                                                        data-toggle="tooltip" data-placement="top" title="View Patient"
                                                        data-id="{{ $patient->id }}"
                                                        data-first-name="{{ $patient->first_name }}"
                                                        data-last-name="{{ $patient->last_name }}"
                                                        data-gender="{{ $patient->gender }}"
                                                        data-dob="{{ $patient->date_of_birth }}"
                                                        data-email="{{ $patient->email }}"
                                                        data-phone="{{ $patient->phone }}"
                                                        data-address="{{ $patient->address }}"
                                                        data-service="{{ $patient->service_id }}"
                                                        data-service-name="{{ $patient->service->name ?? 'N/A' }}"
                                                        data-service-price="{{ $patient->service->price ?? '0' }}"
                                                        data-notes="{{ $patient->notes }}">
                                                        <i class="material-symbols-rounded text-lg position-relative">visibility</i>
                                                        <span class="sr-only">View</span>
                                                    </button>
                                                    
                                                    <button type="button" class="btn btn-link text-warning mb-0 me-2 edit-patient"
                                                        data-id="{{ $patient->id }}"
                                                        data-first-name="{{ $patient->first_name }}"
                                                        data-last-name="{{ $patient->last_name }}"
                                                        data-gender="{{ $patient->gender }}"
                                                        data-dob="{{ $patient->date_of_birth }}"
                                                        data-email="{{ $patient->email }}"
                                                        data-phone="{{ $patient->phone }}"
                                                        data-address="{{ $patient->address }}"
                                                        data-service="{{ $patient->service_id }}"
                                                        data-notes="{{ $patient->notes }}"
                                                        data-toggle="tooltip" data-placement="top" title="Edit Patient">
                                                        <i class="material-symbols-rounded text-lg position-relative">edit</i>
                                                        <span class="sr-only">Edit</span>
                                                    </button>
                                                    
                                                    <form method="POST" action="{{ route('patient.destroy', $patient) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-danger mb-0"
                                                            data-toggle="tooltip" data-placement="top" 
                                                            title="Delete Patient" 
                                                            onclick="return confirm('Are you sure you want to delete this patient?')">
                                                            <i class="material-symbols-rounded text-lg position-relative">delete</i>
                                                            <span class="sr-only">Delete</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="material-symbols-rounded text-secondary" style="font-size: 48px;">person_off</i>
                                                    <p class="text-secondary mt-2">No patients found</p>
                                                    <button type="button" class="btn btn-sm bg-gradient-primary mt-2" id="noPatientAdd">
                                                        <i class="material-symbols-rounded opacity-5 me-1">add</i> Register Your First Patient
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('app.patients.patient_modal_form', ['services' => $services ?? App\Models\Service::select('id', 'name', 'price')->orderBy('name')->get()])
        @include('app.patients.edit_patient_modal', ['services' => $services ?? App\Models\Service::select('id', 'name', 'price')->orderBy('name')->get()])
        @include('app.patients.view_patient_modal')
        
        <style>
            .action-buttons .btn-link {
                padding: 5px;
                margin: 0 2px;
                border-radius: 6px;
                transition: all 0.2s ease;
            }
            
            .action-buttons .btn-link:hover {
                background-color: rgba(233, 236, 239, 0.8);
                transform: translateY(-3px);
                box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
            }
            
            .action-buttons .text-info:hover {
                color: #11cdef !important;
            }
            .action-buttons .text-warning:hover {
                color: #fb6340 !important;
            }
            .action-buttons .text-danger:hover {
                color: #f5365c !important;
            }
            
            /* Modal overrides to make Tailwind modal work with Bootstrap styling */
            #patientModal, #editPatientModal, #viewPatientModal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1050;
                width: 100%;
                height: 100%;
                overflow: hidden;
                outline: 0;
            }
            
            #patientModal.show, #editPatientModal.show, #viewPatientModal.show {
                display: block;
            }
            
            #modalBackdrop {
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1040;
                width: 100vw;
                height: 100vh;
                background-color: rgba(0, 0, 0, 0.5);
            }
            
            .modal-dialog {
                max-width: 700px;
                margin: 1.75rem auto;
            }
            
            /* Make labels appear correctly in filled form fields */
            .form-floating > .form-control:not(:placeholder-shown) ~ label {
                opacity: 0.8;
                transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
            }
        </style>
        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Initialize tooltips
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
                if (typeof bootstrap !== 'undefined') {
                    tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl)
                    });
                }
                
                // Create modal functionality
                const modal = document.getElementById('patientModal');
                const openButton = document.getElementById('openModal');
                const closeButton = document.getElementById('closeModal');
                const backdrop = document.getElementById('modalBackdrop');
                const submitButton = document.getElementById('submitForm');
                const form = document.getElementById('patientForm');
                
                // Add handler for "Register your first patient" button
                const noPatientAddButton = document.getElementById('noPatientAdd');
                if (noPatientAddButton) {
                    noPatientAddButton.addEventListener('click', function() {
                        if (openButton) openButton.click();
                    });
                }

                // Create modal functions
                function openModal() {
                    if (modal) {
                        modal.classList.remove('hidden');
                        modal.classList.add('show');
                        document.body.classList.add('overflow-hidden');
                        
                        // Handle Tailwind vs Bootstrap modal differences
                        if (typeof bootstrap !== 'undefined') {
                            try {
                                const bsModal = new bootstrap.Modal(modal);
                                bsModal.show();
                            } catch (e) {
                                console.log('Bootstrap modal not available, using custom show/hide');
                            }
                        }
                    }
                }

                function closeModal() {
                    if (modal) {
                        modal.classList.add('hidden');
                        modal.classList.remove('show');
                        document.body.classList.remove('overflow-hidden');
                        if (form) form.reset();
                        
                        // Handle Tailwind vs Bootstrap modal differences
                        if (typeof bootstrap !== 'undefined') {
                            try {
                                const bsModal = bootstrap.Modal.getInstance(modal);
                                if (bsModal) bsModal.hide();
                            } catch (e) {
                                console.log('Bootstrap modal not available, using custom show/hide');
                            }
                        }
                    }
                }

                // Event listeners for create modal
                if (openButton) openButton.addEventListener('click', openModal);
                if (closeButton) closeButton.addEventListener('click', closeModal);
                if (backdrop) backdrop.addEventListener('click', closeModal);
                if (submitButton && form) {
                    submitButton.addEventListener('click', function () {
                        if (form) form.submit();
                    });
                }

                // Close modal when pressing Escape key
                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                        closeModal();
                    }
                });
            });
        </script>
    </main>
@endsection