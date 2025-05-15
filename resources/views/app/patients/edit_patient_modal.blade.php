<!-- Edit Patient Modal -->
<div class="modal fade" id="editPatientModal" tabindex="-1" role="dialog" aria-labelledby="editPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-success">
                <h5 class="modal-title text-white" id="editPatientModalLabel">Edit Patient</h5>
                <button type="button" class="btn-close text-white" id="closeEditModal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning text-white">
                    <i class="material-symbols-rounded opacity-5 text-white me-2">info</i>
                    Update patient information and medical service.
                </div>
                
                <form id="editPatientForm" method="POST" action="" class="overflow-auto">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text"><i class="material-symbols-rounded opacity-6">person</i></span>
                                <div class="form-floating ps-0">
                                    <input type="text" class="form-control" id="edit_first_name" name="first_name" placeholder="First Name" required />
                                    <label for="edit_first_name">First Name</label>
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
                                    <input type="text" class="form-control" id="edit_last_name" name="last_name" placeholder="Family Name" required />
                                    <label for="edit_last_name">Family Name</label>
                                </div>
                            </div>
                            @error('last_name')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_date_of_birth" class="form-label ms-0 mb-2 d-flex align-items-center">
                                <i class="material-symbols-rounded opacity-6 me-2">cake</i>
                                Date of Birth
                            </label>
                            <input type="date" class="form-control" id="edit_date_of_birth" name="date_of_birth" required />
                            @error('date_of_birth')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_gender" class="form-label ms-0 mb-2 d-flex align-items-center">
                                <i class="material-symbols-rounded opacity-6 me-2">wc</i>
                                Gender
                            </label>
                            <select class="form-select" name="gender" id="edit_gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
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
                                    <input type="email" class="form-control" id="edit_email" name="email" placeholder="Email" />
                                    <label for="edit_email">Email</label>
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
                                    <input type="text" class="form-control" id="edit_phone" name="phone" placeholder="Phone Number" required />
                                    <label for="edit_phone">Phone Number</label>
                                </div>
                            </div>
                            @error('phone')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_address" class="form-label ms-0 mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-6 me-2">home</i>
                            Address
                        </label>
                        <textarea class="form-control" id="edit_address" name="address" rows="2" placeholder="Enter complete address"></textarea>
                        @error('address')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_service_id" class="form-label ms-0 mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-6 me-2">medical_services</i>
                            Medical Service
                        </label>
                        <select class="form-select" name="service_id" id="edit_service_id" required>
                            <option value="">Select Service</option>
                            @foreach($services ?? App\Models\Service::select('id', 'name', 'price')->orderBy('name')->get() as $service)
                                <option value="{{ $service->id }}">
                                    {{ $service->name }} - ₱{{ number_format($service->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_notes" class="form-label ms-0 mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-6 me-2">notes</i>
                            Additional Notes
                        </label>
                        <textarea class="form-control" id="edit_notes" name="notes" rows="3" placeholder="Any additional information"></textarea>
                        @error('notes')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" id="closeEditModal" data-bs-dismiss="modal">
                    <i class="material-symbols-rounded opacity-5 me-1">close</i>
                    Cancel
                </button>
                <button type="button" class="btn bg-gradient-warning" id="submitEditForm">
                    <i class="material-symbols-rounded opacity-5 me-1">save</i>
                    Update Patient
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add JavaScript for the edit modal functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Edit modal functionality
        const editModal = document.getElementById('editPatientModal');
        const editButtons = document.querySelectorAll('.edit-patient');
        const closeEditButtons = document.querySelectorAll('#closeEditModal');
        const submitEditButton = document.getElementById('submitEditForm');
        const editForm = document.getElementById('editPatientForm');
        
        // Edit modal functions
        function openEditModal(patientData) {
            // Set form action URL
            if (editForm) {
                editForm.action = `/patient/${patientData.id}`;
                
                // Fill form fields with patient data
                document.getElementById('edit_first_name').value = patientData.firstName;
                document.getElementById('edit_last_name').value = patientData.lastName;
                document.getElementById('edit_date_of_birth').value = patientData.dob;
                document.getElementById('edit_gender').value = patientData.gender;
                document.getElementById('edit_email').value = patientData.email;
                document.getElementById('edit_phone').value = patientData.phone;
                document.getElementById('edit_address').value = patientData.address;
                document.getElementById('edit_service_id').value = patientData.service;
                document.getElementById('edit_notes').value = patientData.notes;
                
                // Update labels for dynamic inputs (force them to float up)
                const dynamicInputs = editForm.querySelectorAll('.form-floating .form-control');
                dynamicInputs.forEach(input => {
                    if (input.value) {
                        input.setAttribute('placeholder', ' ');
                    }
                });
                
                // Show modal
                if (typeof bootstrap !== 'undefined') {
                    try {
                        const bsModal = new bootstrap.Modal(editModal);
                        bsModal.show();
                    } catch (e) {
                        // Fallback to manual showing
                        editModal.classList.remove('hidden');
                        editModal.classList.add('show');
                        editModal.style.display = 'block';
                        document.body.classList.add('modal-open');
                    }
                } else {
                    // Fallback for Tailwind
                    editModal.classList.remove('hidden');
                    editModal.classList.add('show');
                    document.body.classList.add('overflow-hidden');
                }
            }
        }
        
        function closeEditModal() {
            if (editModal) {
                if (typeof bootstrap !== 'undefined') {
                    try {
                        const bsModal = bootstrap.Modal.getInstance(editModal);
                        if (bsModal) bsModal.hide();
                    } catch (e) {
                        // Fallback to manual hiding
                        editModal.classList.add('hidden');
                        editModal.classList.remove('show');
                        editModal.style.display = 'none';
                        document.body.classList.remove('modal-open');
                        const backdrops = document.querySelectorAll('.modal-backdrop');
                        backdrops.forEach(backdrop => backdrop.remove());
                    }
                } else {
                    // Fallback for Tailwind
                    editModal.classList.add('hidden');
                    editModal.classList.remove('show');
                    document.body.classList.remove('overflow-hidden');
                }
                
                // Reset form
                if (editForm) editForm.reset();
            }
        }
        
        // Attach event handlers for edit buttons
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const patientData = {
                    id: this.getAttribute('data-id'),
                    firstName: this.getAttribute('data-first-name'),
                    lastName: this.getAttribute('data-last-name'),
                    gender: this.getAttribute('data-gender'),
                    dob: this.getAttribute('data-dob'),
                    email: this.getAttribute('data-email'),
                    phone: this.getAttribute('data-phone'),
                    address: this.getAttribute('data-address'),
                    service: this.getAttribute('data-service'),
                    notes: this.getAttribute('data-notes')
                };
                openEditModal(patientData);
            });
        });
        
        // Attach event handlers for edit modal close buttons
        closeEditButtons.forEach(button => {
            button.addEventListener('click', closeEditModal);
        });
        
        // Handle edit form submission
        if (submitEditButton && editForm) {
            submitEditButton.addEventListener('click', function() {
                editForm.submit();
            });
        }
        
        // Close edit modal on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && editModal && editModal.classList.contains('show')) {
                closeEditModal();
            }
        });
    });
</script> 