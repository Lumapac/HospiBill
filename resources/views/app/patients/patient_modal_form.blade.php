<!-- Register Patient Modal -->
<div class="modal fade" id="patientModal" tabindex="-1" role="dialog" aria-labelledby="patientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white" id="patientModalLabel">Register New Patient</h5>
                <button type="button" class="btn-close text-white" id="closeModal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info text-white">
                    <i class="material-symbols-rounded opacity-5 text-white me-2">info</i>
                    Register a new patient and assign them to a medical service.
                </div>
                
                <form id="patientForm" method="POST" action="{{ route('patient.store') }}" class="overflow-auto">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text"><i class="material-symbols-rounded opacity-6">person</i></span>
                                <div class="form-floating ps-0">
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required />
                                    <label for="first_name">First Name</label>
                                </div>
                            </div>
                            @error('first_name')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text"><i class="material-symbols-rounded opacity-6">badge</i></span>
                                <div class="form-floating ps-0">
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Family Name" required />
                                    <label for="last_name">Family Name</label>
                                </div>
                            </div>
                            @error('last_name')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date_of_birth" class="form-label ms-0 mb-2 d-flex align-items-center">
                                <i class="material-symbols-rounded opacity-6 me-2">cake</i>
                                Date of Birth
                            </label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required />
                            @error('date_of_birth')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label ms-0 mb-2 d-flex align-items-center">
                                <i class="material-symbols-rounded opacity-6 me-2">wc</i>
                                Gender
                            </label>
                            <select class="form-select" name="gender" id="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text"><i class="material-symbols-rounded opacity-6">email</i></span>
                                <div class="form-floating ps-0">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email" />
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            @error('email')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text"><i class="material-symbols-rounded opacity-6">phone</i></span>
                                <div class="form-floating ps-0">
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" required />
                                    <label for="phone">Phone Number</label>
                                </div>
                            </div>
                            @error('phone')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label ms-0 mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-6 me-2">home</i>
                            Address
                        </label>
                        <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter complete address">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="service_id" class="form-label ms-0 mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-6 me-2">medical_services</i>
                            Medical Service
                        </label>
                        <select class="form-select" name="service_id" id="service_id" required>
                            <option value="">Select Service</option>
                            @foreach(is_iterable($services) ? $services : [] as $service)
                                <option value="{{ is_object($service) ? $service->id : '' }}" {{ old('service_id') == (is_object($service) ? $service->id : '') ? 'selected' : '' }}>
                                    {{ is_object($service) ? $service->name : '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="notes" class="form-label ms-0 mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-6 me-2">notes</i>
                            Additional Notes
                        </label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Any additional information">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" id="closeModal" data-bs-dismiss="modal">
                    <i class="material-symbols-rounded opacity-5 me-1">close</i>
                    Cancel
                </button>
                <button type="button" class="btn bg-gradient-success" id="submitForm">
                    <i class="material-symbols-rounded opacity-5 me-1">save</i>
                    Register Patient
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Backdrop Element -->
<div id="modalBackdrop" class="d-none"></div>

<!-- Additional styles for modal scrolling and styling -->
<style>
    .modal-dialog-scrollable .modal-content {
        max-height: 100%;
        overflow: hidden;
    }
    
    .modal-dialog-scrollable .modal-body {
        overflow-y: auto;
        max-height: calc(100vh - 210px); /* Adjust based on header and footer height */
    }
    
    @media (max-height: 600px) {
        .modal-dialog-scrollable .modal-body {
            max-height: calc(100vh - 180px);
        }
    }
    
    /* Form styling to match create_service */
    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        opacity: 0.8;
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }

    .form-select {
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        border-radius: 0.5rem;
        border: 1px solid #d2d6da;
    }
    
    .input-group-text {
        background-color: transparent;
        border-right: 0;
    }
    
    .input-group-dynamic .form-control {
        border-left: 0;
        padding-left: 0;
    }
    
    /* Mobile optimizations */
    @media (max-width: 768px) {
        .input-group-dynamic,
        .form-floating {
            margin-bottom: 1rem !important;
        }
        
        .modal-header {
            padding: 0.75rem 1rem;
        }
        
        .modal-footer {
            padding: 0.75rem 1rem;
            flex-wrap: nowrap;
        }
    }
</style>

<!-- Update JavaScript for full functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle modal close button clicks (multiple elements with same ID)
        const closeButtons = document.querySelectorAll('#closeModal');
        const modal = document.getElementById('patientModal');
        const form = document.getElementById('patientForm');
        
        function closeModal() {
            if (typeof bootstrap !== 'undefined') {
                // Use Bootstrap's modal method if available
                const bsModal = bootstrap.Modal.getInstance(modal);
                if (bsModal) {
                    bsModal.hide();
                } else {
                    // Fallback to manual closing
                    modal.classList.add('hidden');
                    modal.classList.remove('show');
                    modal.style.display = 'none';
                    document.body.classList.remove('modal-open');
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());
                }
            } else {
                // Fallback for Tailwind
                modal.classList.add('hidden');
                modal.classList.remove('show');
                document.body.classList.remove('overflow-hidden');
            }
            
            // Reset the form
            if (form) form.reset();
        }
        
        // Attach event listeners to all close buttons
        closeButtons.forEach(button => {
            button.addEventListener('click', closeModal);
        });
        
        // Handle submit button
        const submitButton = document.getElementById('submitForm');
        if (submitButton && form) {
            submitButton.addEventListener('click', function() {
                form.submit();
            });
        }
    });
</script>