<!-- Patient Details Modal -->
<div class="modal fade" id="viewPatientModal" tabindex="-1" role="dialog" aria-labelledby="viewPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info">
                <h5 class="modal-title text-white" id="viewPatientModalLabel">Patient Details</h5>
                <button type="button" class="btn-close text-white" id="closeViewModal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info text-white">
                    <i class="material-symbols-rounded opacity-5 text-white me-2">person</i>
                    <span id="patient_name_header">Patient Information</span>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header p-3 bg-gradient-light">
                                <h6 class="mb-0">Personal Information</h6>
                            </div>
                            <div class="card-body p-3">
                                <div class="d-flex mb-2">
                                    <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                                        <span class="text-white text-uppercase" id="patient_initials">P</span>
                                    </div>
                                    <h6 class="mb-0 d-flex align-items-center" id="patient_full_name">Loading...</h6>
                                </div>
                                <p class="text-sm mb-2">
                                    <i class="material-symbols-rounded text-sm me-2">cake</i>
                                    <span id="patient_dob">Loading...</span>
                                </p>
                                <p class="text-sm mb-2">
                                    <i class="material-symbols-rounded text-sm me-2">wc</i>
                                    <span id="patient_gender">Loading...</span>
                                </p>
                                <p class="text-sm mb-2">
                                    <i class="material-symbols-rounded text-sm me-2">email</i>
                                    <span id="patient_email">Loading...</span>
                                </p>
                                <p class="text-sm mb-2">
                                    <i class="material-symbols-rounded text-sm me-2">phone</i>
                                    <span id="patient_phone">Loading...</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header p-3 bg-gradient-light">
                                <h6 class="mb-0">Service & Address</h6>
                            </div>
                            <div class="card-body p-3">
                                <p class="text-sm mb-2">
                                    <i class="material-symbols-rounded text-sm me-2">medical_services</i>
                                    <span id="patient_service">Loading...</span>
                                </p>
                                <p class="text-sm mb-2">
                                    <i class="material-symbols-rounded text-sm me-2">payments</i>
                                    <span id="patient_price">Loading...</span>
                                </p>
                                <p class="text-sm mb-2">
                                    <i class="material-symbols-rounded text-sm me-2">home</i>
                                    <span id="patient_address">Loading...</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mb-3">
                    <div class="card-header p-3 bg-gradient-light">
                        <h6 class="mb-0">Additional Notes</h6>
                    </div>
                    <div class="card-body p-3">
                        <p class="text-sm" id="patient_notes">No additional notes.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" id="closeViewDetailModal" data-bs-dismiss="modal">
                    <i class="material-symbols-rounded opacity-5 me-1">close</i>
                    Close
                </button>
                <button type="button" class="btn bg-gradient-success edit-from-view" id="editFromViewBtn">
                    <i class="material-symbols-rounded opacity-5 me-1">edit</i>
                    Edit Patient
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for the view patient modal functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // View modal functionality
        const viewModal = document.getElementById('viewPatientModal');
        const viewButtons = document.querySelectorAll('.view-patient');
        const closeViewButtons = document.querySelectorAll('#closeViewModal, #closeViewDetailModal');
        const editFromViewButton = document.getElementById('editFromViewBtn');
        
        // Current patient data for the view modal
        let currentPatientData = null;
        
        // View modal functions
        function openViewModal(patientData) {
            if (viewModal) {
                // Store current patient data
                currentPatientData = patientData;
                
                // Update modal elements with patient data
                document.getElementById('patient_name_header').textContent = patientData.firstName + ' ' + patientData.lastName;
                document.getElementById('patient_initials').textContent = patientData.firstName.charAt(0);
                document.getElementById('patient_full_name').textContent = patientData.firstName + ' ' + patientData.lastName;
                document.getElementById('patient_dob').textContent = formatDate(patientData.dob);
                document.getElementById('patient_gender').textContent = capitalize(patientData.gender);
                document.getElementById('patient_email').textContent = patientData.email || 'Not provided';
                document.getElementById('patient_phone').textContent = patientData.phone;
                document.getElementById('patient_service').textContent = patientData.serviceName || 'N/A';
                document.getElementById('patient_price').textContent = '₱' + formatNumber(patientData.servicePrice || 0);
                document.getElementById('patient_address').textContent = patientData.address || 'Not provided';
                document.getElementById('patient_notes').textContent = patientData.notes || 'No additional notes.';
                
                // Show modal
                if (typeof bootstrap !== 'undefined') {
                    try {
                        const bsModal = new bootstrap.Modal(viewModal);
                        bsModal.show();
                    } catch (e) {
                        // Fallback to manual showing
                        viewModal.classList.remove('hidden');
                        viewModal.classList.add('show');
                        viewModal.style.display = 'block';
                        document.body.classList.add('modal-open');
                    }
                } else {
                    // Fallback for Tailwind
                    viewModal.classList.remove('hidden');
                    viewModal.classList.add('show');
                    document.body.classList.add('overflow-hidden');
                }
            }
        }
        
        // Function to fetch and open patient data via AJAX
        function openViewModalWithAjax(patientId) {
            // Show loading state in the modal first
            const loadingPatientData = {
                id: patientId,
                firstName: 'Loading',
                lastName: '...',
                gender: '',
                dob: '',
                email: '',
                phone: '',
                address: '',
                service: '',
                serviceName: 'Loading...',
                servicePrice: '0',
                notes: 'Loading patient details...'
            };
            
            // Open modal with loading state
            openViewModal(loadingPatientData);
            
            // Fetch actual data via AJAX
            fetch(`/patient/${patientId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Create patient data object from the AJAX response
                const patientData = {
                    id: patientId,
                    firstName: data.patient.first_name,
                    lastName: data.patient.last_name,
                    gender: data.patient.gender,
                    dob: data.patient.date_of_birth,
                    email: data.patient.email,
                    phone: data.patient.phone,
                    address: data.patient.address,
                    service: data.patient.service_id,
                    serviceName: data.serviceName,
                    servicePrice: data.servicePrice,
                    notes: data.patient.notes
                };
                
                // Update modal with fetched data
                currentPatientData = patientData;
                document.getElementById('patient_name_header').textContent = patientData.firstName + ' ' + patientData.lastName;
                document.getElementById('patient_initials').textContent = patientData.firstName.charAt(0);
                document.getElementById('patient_full_name').textContent = patientData.firstName + ' ' + patientData.lastName;
                document.getElementById('patient_dob').textContent = formatDate(patientData.dob);
                document.getElementById('patient_gender').textContent = capitalize(patientData.gender);
                document.getElementById('patient_email').textContent = patientData.email || 'Not provided';
                document.getElementById('patient_phone').textContent = patientData.phone;
                document.getElementById('patient_service').textContent = patientData.serviceName || 'N/A';
                document.getElementById('patient_price').textContent = '₱' + formatNumber(patientData.servicePrice || 0);
                document.getElementById('patient_address').textContent = patientData.address || 'Not provided';
                document.getElementById('patient_notes').textContent = patientData.notes || 'No additional notes.';
            })
            .catch(error => {
                console.error('Error fetching patient data:', error);
                document.getElementById('patient_name_header').textContent = 'Error Loading Data';
                document.getElementById('patient_full_name').textContent = 'Could not load patient details';
            });
        }
        
        function closeViewModal() {
            if (viewModal) {
                if (typeof bootstrap !== 'undefined') {
                    try {
                        const bsModal = bootstrap.Modal.getInstance(viewModal);
                        if (bsModal) bsModal.hide();
                    } catch (e) {
                        // Fallback to manual hiding
                        viewModal.classList.add('hidden');
                        viewModal.classList.remove('show');
                        viewModal.style.display = 'none';
                        document.body.classList.remove('modal-open');
                        const backdrops = document.querySelectorAll('.modal-backdrop');
                        backdrops.forEach(backdrop => backdrop.remove());
                    }
                } else {
                    // Fallback for Tailwind
                    viewModal.classList.add('hidden');
                    viewModal.classList.remove('show');
                    document.body.classList.remove('overflow-hidden');
                }
            }
        }
        
        // Helper functions
        function formatDate(dateString) {
            if (!dateString) return 'Not provided';
            
            const date = new Date(dateString);
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }
        
        function formatNumber(number) {
            return parseFloat(number).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }
        
        function capitalize(string) {
            if (!string) return '';
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
        
        // Attach event handlers for view buttons
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const patientId = this.getAttribute('data-id');
                
                // If using direct data attributes (non-AJAX approach)
                if (this.hasAttribute('data-first-name')) {
                    const patientData = {
                        id: patientId,
                        firstName: this.getAttribute('data-first-name'),
                        lastName: this.getAttribute('data-last-name'),
                        gender: this.getAttribute('data-gender'),
                        dob: this.getAttribute('data-dob'),
                        email: this.getAttribute('data-email'),
                        phone: this.getAttribute('data-phone'),
                        address: this.getAttribute('data-address'),
                        service: this.getAttribute('data-service'),
                        serviceName: this.getAttribute('data-service-name'),
                        servicePrice: this.getAttribute('data-service-price'),
                        notes: this.getAttribute('data-notes')
                    };
                    
                    openViewModal(patientData);
                } else {
                    // Use AJAX approach if data attributes aren't available
                    openViewModalWithAjax(patientId);
                }
            });
        });
        
        // Attach event handlers for close buttons
        closeViewButtons.forEach(button => {
            if (button) button.addEventListener('click', closeViewModal);
        });
        
        // Handle edit from view button click
        if (editFromViewButton) {
            editFromViewButton.addEventListener('click', function() {
                // First close view modal
                closeViewModal();
                
                // Find edit button for this patient and click it
                if (currentPatientData && currentPatientData.id) {
                    setTimeout(() => {
                        const editButtons = document.querySelectorAll('.edit-patient');
                        const targetButton = Array.from(editButtons).find(
                            button => button.getAttribute('data-id') === currentPatientData.id
                        );
                        
                        if (targetButton) {
                            targetButton.click();
                        }
                    }, 300); // Small delay to ensure view modal is closed first
                }
            });
        }
        
        // Close view modal on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && viewModal && viewModal.classList.contains('show')) {
                closeViewModal();
            }
        });
        
        // Check for patient to view from flash message (from direct URL access)
        @if(session('patientToView'))
            openViewModalWithAjax("{{ session('patientToView') }}");
        @endif
    });
</script> 