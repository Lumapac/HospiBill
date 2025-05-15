@extends('app.layouts.sidebar')
@section('title', 'Services Management')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('layouts.navbar', ['title' => 'Services Management'])
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3 mb-0">Services List</h6>
                            <button type="button" class="btn bg-gradient-dark mb-0 me-3" id="openModal">
                                <i class="material-symbols-rounded opacity-5 text-white me-1">add</i>
                                Add New Service
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

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible text-white mx-3" role="alert">
                                <span class="text-sm">{{ session('error') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Service Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($services as $service)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $service->name }}</h6>
                                                        @if($service->duration)
                                                            <p class="text-xs text-secondary mb-0">
                                                                <i class="material-symbols-rounded text-sm">schedule</i> {{ $service->duration }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-gradient-info">{{ $service->category }}</span>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">₱{{ number_format($service->price, 2) }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-center action-buttons">
                                                    <button type="button" class="btn btn-link text-info mb-0 me-2 view-service" 
                                                        data-id="{{ $service->id }}" 
                                                        data-name="{{ $service->name }}"
                                                        data-category="{{ $service->category }}" 
                                                        data-price="{{ $service->price }}"
                                                        data-description="{{ $service->description }}"
                                                        data-duration="{{ $service->duration }}"
                                                        data-requirements="{{ $service->requirements }}"
                                                        data-availability="{{ $service->availability }}"
                                                        data-toggle="tooltip" data-placement="top" title="View Details">
                                                        <i class="material-symbols-rounded text-lg position-relative">visibility</i>
                                                        <span class="sr-only">View</span>
                                                    </button>
                                                    
                                                    <button type="button" class="btn btn-link text-warning mb-0 me-2 edit-service" 
                                                        data-id="{{ $service->id }}" 
                                                        data-name="{{ $service->name }}"
                                                        data-category="{{ $service->category }}" 
                                                        data-price="{{ $service->price }}"
                                                        data-description="{{ $service->description }}"
                                                        data-duration="{{ $service->duration }}"
                                                        data-requirements="{{ $service->requirements }}"
                                                        data-availability="{{ $service->availability }}"
                                                        data-toggle="tooltip" data-placement="top" title="Edit Service">
                                                        <i class="material-symbols-rounded text-lg position-relative">edit</i>
                                                        <span class="sr-only">Edit</span>
                                                    </button>
                                                    
                                                    <form method="POST" action="{{ route('services.destroy', $service) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-danger mb-0"
                                                            data-toggle="tooltip" data-placement="top" 
                                                            title="Delete Service" 
                                                            onclick="return confirm('Are you sure you want to delete this service? If any patients are using this service, the deletion will be prevented.')">
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
                                                    <i class="material-symbols-rounded text-secondary" style="font-size: 48px;">healing</i>
                                                    <p class="text-secondary mt-2">No services found</p>
                                                    <button type="button" class="btn btn-sm bg-gradient-success mt-2" id="noServicesAdd">
                                                        <i class="material-symbols-rounded opacity-5 me-1">add</i> Add Your First Service
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

        @include('app.services.create_services')
        @include('app.services.edit_services')
        @include('app.services.view-modal')
        
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
                const modal = document.getElementById('serviceModal');
                const openButton = document.getElementById('openModal');
                const closeButton = document.getElementById('closeModal');
                const backdrop = document.getElementById('modalBackdrop');
                const submitButton = document.getElementById('submitForm');
                const form = document.getElementById('serviceForm');
                const priceInput = document.getElementById('price');
                
                // Add handler for "Add your first service" button
                const noServicesAddButton = document.getElementById('noServicesAdd');
                if (noServicesAddButton) {
                    noServicesAddButton.addEventListener('click', function() {
                        if (openButton) openButton.click();
                    });
                }

                // Edit modal functionality
                const editModal = document.getElementById('editServiceModal');
                const editButtons = document.querySelectorAll('.edit-service');
                const closeEditButton = document.getElementById('closeEditModal');
                const editBackdrop = document.getElementById('editModalBackdrop');
                const submitEditButton = document.getElementById('submitEditForm');
                const editForm = document.getElementById('editServiceForm');
                const editPriceInput = document.getElementById('edit-price');
                
                // View modal functionality
                const viewModal = document.getElementById('viewServiceModal');
                const viewButtons = document.querySelectorAll('.view-service');
                const viewEditBtn = document.querySelector('.view-edit-btn');

                // Prevent negative numbers in price fields
                if (priceInput) {
                    priceInput.addEventListener('input', function (e) {
                        if (this.value < 0) {
                            this.value = 0;
                        }
                    });
                }

                if (editPriceInput) {
                    editPriceInput.addEventListener('input', function (e) {
                        if (this.value < 0) {
                            this.value = 0;
                        }
                    });
                }

                // Create modal functions
                function openModal() {
                    if (modal) {
                        modal.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                        
                        // For Bootstrap modals
                        const bsModal = new bootstrap.Modal(modal);
                        bsModal.show();
                    }
                }

                function closeModal() {
                    if (modal) {
                        modal.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                        if (form) form.reset();
                        
                        // For Bootstrap modals
                        const bsModal = bootstrap.Modal.getInstance(modal);
                        if (bsModal) bsModal.hide();
                    }
                }

                // Edit modal functions
                function openEditModal(serviceData) {
                    // Set the form action URL
                    if (editForm) {
                        editForm.action = `/services/${serviceData.id}`;

                        // Fill in the form fields with the service data
                        document.getElementById('edit-name').value = serviceData.name;
                        document.getElementById('edit-price').value = serviceData.price;
                        document.getElementById('edit-category').value = serviceData.category;
                        document.getElementById('edit-duration').value = serviceData.duration;
                        document.getElementById('edit-description').value = serviceData.description;
                        document.getElementById('edit-requirements').value = serviceData.requirements;
                        document.getElementById('edit-availability').value = serviceData.availability;

                        // Show the modal
                        editModal.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                        
                        // For Bootstrap modals
                        const bsModal = new bootstrap.Modal(editModal);
                        bsModal.show();
                    }
                }

                function closeEditModal() {
                    if (editModal) {
                        editModal.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                        if (editForm) editForm.reset();
                        
                        // For Bootstrap modals
                        const bsModal = bootstrap.Modal.getInstance(editModal);
                        if (bsModal) bsModal.hide();
                    }
                }
                
                // View service modal functions
                function openViewModal(serviceData) {
                    // Set service details in the modal
                    document.getElementById('viewServiceModalLabel').textContent = "Service Details: " + serviceData.name;
                    document.getElementById('view-service-name').textContent = serviceData.name;
                    document.getElementById('view-service-category').textContent = serviceData.category;
                    document.getElementById('view-service-price').textContent = "₱" + Number(serviceData.price).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                    
                    // Set description or placeholder
                    const descriptionElement = document.getElementById('view-service-description');
                    if (serviceData.description && serviceData.description.trim() !== '') {
                        descriptionElement.textContent = serviceData.description;
                    } else {
                        descriptionElement.textContent = "No description provided.";
                        descriptionElement.classList.add('fst-italic');
                    }
                    
                    // Set other details
                    const durationText = document.querySelector('#view-detail-duration .duration-text');
                    if (serviceData.duration && serviceData.duration.trim() !== '') {
                        durationText.textContent = serviceData.duration;
                        document.getElementById('view-detail-duration').style.display = 'flex';
                    } else {
                        durationText.textContent = "Not specified";
                        document.getElementById('view-detail-duration').style.display = 'flex';
                    }
                    
                    const availabilityText = document.querySelector('#view-detail-availability .availability-text');
                    if (serviceData.availability && serviceData.availability.trim() !== '') {
                        availabilityText.textContent = serviceData.availability;
                        document.getElementById('view-detail-availability').style.display = 'flex';
                    } else {
                        availabilityText.textContent = "Not specified";
                        document.getElementById('view-detail-availability').style.display = 'flex';
                    }
                    
                    const requirementsElement = document.getElementById('view-detail-requirements');
                    if (serviceData.requirements && serviceData.requirements.trim() !== '') {
                        requirementsElement.textContent = serviceData.requirements;
                    } else {
                        requirementsElement.textContent = "No specific requirements";
                        requirementsElement.classList.add('fst-italic');
                    }
                    
                    document.getElementById('view-detail-category').textContent = serviceData.category;
                    document.getElementById('view-detail-id').textContent = serviceData.id;
                    
                    // Show the modal using Bootstrap
                    const bsModal = new bootstrap.Modal(viewModal);
                    bsModal.show();
                    
                    // Set up edit button to open edit modal
                    if (viewEditBtn) {
                        viewEditBtn.onclick = function() {
                            // Hide view modal
                            const viewModalInstance = bootstrap.Modal.getInstance(viewModal);
                            if (viewModalInstance) viewModalInstance.hide();
                            
                            // Open edit modal with a slight delay
                            setTimeout(() => {
                                openEditModal(serviceData);
                            }, 500);
                        };
                    }
                }

                // Event listeners for create modal
                if (openButton) openButton.addEventListener('click', openModal);
                if (closeButton) closeButton.addEventListener('click', closeModal);
                if (backdrop) backdrop.addEventListener('click', closeModal);
                if (submitButton && form) {
                    submitButton.addEventListener('click', function () {
                        form.submit();
                    });
                }

                // Event listeners for edit modal
                editButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const serviceData = {
                            id: this.getAttribute('data-id'),
                            name: this.getAttribute('data-name'),
                            category: this.getAttribute('data-category'),
                            price: this.getAttribute('data-price'),
                            description: this.getAttribute('data-description'),
                            duration: this.getAttribute('data-duration'),
                            requirements: this.getAttribute('data-requirements'),
                            availability: this.getAttribute('data-availability')
                        };
                        openEditModal(serviceData);
                    });
                });
                
                // Event listeners for view modal
                viewButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const serviceData = {
                            id: this.getAttribute('data-id'),
                            name: this.getAttribute('data-name'),
                            category: this.getAttribute('data-category'),
                            price: this.getAttribute('data-price'),
                            description: this.getAttribute('data-description'),
                            duration: this.getAttribute('data-duration'),
                            requirements: this.getAttribute('data-requirements'),
                            availability: this.getAttribute('data-availability')
                        };
                        openViewModal(serviceData);
                    });
                });

                if (closeEditButton) closeEditButton.addEventListener('click', closeEditModal);
                if (editBackdrop) editBackdrop.addEventListener('click', closeEditModal);
                if (submitEditButton && editForm) {
                    submitEditButton.addEventListener('click', function () {
                        editForm.submit();
                    });
                }

                // Close modals when pressing Escape key
                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape') {
                        if (modal && !modal.classList.contains('hidden')) {
                            closeModal();
                        }
                        if (editModal && !editModal.classList.contains('hidden')) {
                            closeEditModal();
                        }
                    }
                });
            });
        </script>
    </main>
@endsection