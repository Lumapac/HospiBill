@extends('layouts.sidebar')
@section('title', 'Manage Tenants')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @include('layouts.navbar', ['title' => 'Tenants'])

        <div class="container-fluid py-2">
            <div class="row">
                <div class="ms-3">
                    <h3 class="mb-0 h4 font-weight-bolder">Tenant Management</h3>
                    <p class="mb-4">
                        Manage hospital tenants, review applications, and update their information.
                    </p>
                </div>
            </div>

            <!-- Status Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-icon align-middle">
                        <span class="material-symbols-rounded opacity-10">thumb_up</span>
                    </span>
                    <span class="alert-text">{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                        </div>
                    @endif
                    
                    @if (session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <span class="alert-icon align-middle">
                        <span class="material-symbols-rounded opacity-10">info</span>
                    </span>
                    <span class="alert-text">{{ session('info') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                        </div>
                    @endif
                    
            <!-- Tenants Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">All Tenants</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="tenants-table">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tenant</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Domain</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Contact</th>
                                            <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                        @foreach($tenants as $tenant)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-3 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $tenant->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $tenant->email }}</p>
                                                        </div>
                                                    </div>
                                        </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                            @foreach ($tenant->domains as $domain)
                                                {{ $domain->domain }}{{ $loop->last ? '' : ', ' }}
                                            @endforeach
                                                    </p>
                                        </td>
                                                <td class="align-middle text-center text-sm">
                                            {!! $tenant->status_badge !!}
                                        </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $tenant->contact_person ?? 'N/A' }}</span>
                                                    <p class="text-xs text-secondary mb-0">{{ $tenant->phone_number ?? 'N/A' }}
                                                    </p>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="ms-auto">
                                                        <button type="button"
                                                            class="btn btn-link text-info px-1 mb-0 view-tenant-btn"
                                                            data-tenant-id="{{ $tenant->id }}"
                                                            data-tenant-name="{{ $tenant->name }}"
                                                            data-tenant-email="{{ $tenant->email }}"
                                                            data-tenant-status="{{ $tenant->status }}"
                                                            data-tenant-contact="{{ $tenant->contact_person }}"
                                                            data-tenant-phone="{{ $tenant->phone_number }}"
                                                            data-tenant-domains="@foreach($tenant->domains as $domain){{ $domain->domain }}{{ $loop->last ? '' : ', ' }}@endforeach"
                                                            data-tenant-created="{{ $tenant->created_at->format('F d, Y H:i') }}"
                                                            data-tenant-notes="{{ $tenant->admin_notes }}">
                                                            <i class="material-symbols-rounded text-sm me-2">visibility</i>
                                                            View
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-link text-dark px-1 mb-0 edit-tenant-btn"
                                                            data-tenant-id="{{ $tenant->id }}"
                                                            data-tenant-name="{{ $tenant->name }}"
                                                            data-tenant-email="{{ $tenant->email }}"
                                                            data-tenant-status="{{ $tenant->status }}"
                                                            data-tenant-contact="{{ $tenant->contact_person }}"
                                                            data-tenant-phone="{{ $tenant->phone_number }}"
                                                            data-tenant-notes="{{ $tenant->admin_notes }}">
                                                            <i class="material-symbols-rounded text-sm me-2">edit</i>
                                                            Edit
                                                        </button>
                                            
                                            @if($tenant->status === 'pending')
                                                            <form action="{{ route('tenants.approve', $tenant) }}" method="POST"
                                                                class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                                <button type="submit" class="btn btn-link text-success px-1 mb-0">
                                                                    <i
                                                                        class="material-symbols-rounded text-sm me-2">check_circle</i>
                                                                    Approve
                                                                </button>
                                                </form>
                                                
                                                            <button type="button"
                                                                class="btn btn-link text-danger px-1 mb-0 reject-btn"
                                                    data-tenant-id="{{ $tenant->id }}"
                                                                data-tenant-name="{{ $tenant->name }}">
                                                                <i class="material-symbols-rounded text-sm me-2">cancel</i>
                                                    Reject
                                                </button>
                                            @endif
                                            
                                                        <form action="{{ route('tenants.destroy', $tenant) }}" method="POST"
                                                            class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-link text-danger px-1 mb-0 delete-btn">
                                                                <i class="material-symbols-rounded text-sm me-2">delete</i>
                                                                Delete
                                                            </button>
                                            </form>
                                                    </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </main>

    <!-- Include modals -->
    @include('components.tenant-view-modal')
    @include('components.tenant-edit-modal')
    
    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Tenant Application</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Please provide a reason for rejecting <span id="tenantName" class="font-weight-bold"></span>'s
                        application:</p>
            
            <form id="rejectForm" method="POST">
                @csrf
                @method('PATCH')
                
                        <div class="input-group input-group-static mb-4">
                            <label for="admin_notes">Notes/Reason</label>
                            <textarea id="admin_notes" name="admin_notes" class="form-control" rows="4" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn bg-gradient-danger" id="confirmReject">Reject Application</button>
                </div>
            </div>
        </div>
                </div>
                
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this tenant? This action cannot be undone.</p>
                    <p>All data associated with this tenant will be permanently removed from the system.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn bg-gradient-danger" id="confirmDelete">Delete Tenant</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include JavaScript for tenant modals -->
    <script src="{{ asset('js/tenant-modals.js') }}"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Reject functionality
            const rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
            const rejectButtons = document.querySelectorAll('.reject-btn');
            const confirmRejectBtn = document.getElementById('confirmReject');
            const tenantNameSpan = document.getElementById('tenantName');
            const rejectForm = document.getElementById('rejectForm');
            
            rejectButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const tenantId = this.getAttribute('data-tenant-id');
                    const tenantName = this.getAttribute('data-tenant-name');
                    
                    tenantNameSpan.textContent = tenantName;
                    rejectForm.action = `/tenants/${tenantId}/reject`;
                    rejectModal.show();
                });
            });

            confirmRejectBtn.addEventListener('click', function () {
                rejectForm.submit();
            });

            // Delete functionality
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const confirmDeleteBtn = document.getElementById('confirmDelete');
            let currentDeleteForm = null;

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    currentDeleteForm = this.closest('.delete-form');
                    deleteModal.show();
                });
            });
            
            confirmDeleteBtn.addEventListener('click', function () {
                if (currentDeleteForm) {
                    currentDeleteForm.submit();
                }
                deleteModal.hide();
            });

            // Search functionality
            const searchInput = document.getElementById('tenant-search');
            const table = document.getElementById('tenants-table');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            searchInput.addEventListener('keyup', function () {
                const searchTerm = searchInput.value.toLowerCase();

                for (let i = 0; i < rows.length; i++) {
                    const tenantName = rows[i].getElementsByTagName('td')[0].textContent.toLowerCase();
                    const tenantEmail = rows[i].getElementsByTagName('td')[0].textContent.toLowerCase();
                    const tenantDomain = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();

                    if (tenantName.includes(searchTerm) || tenantEmail.includes(searchTerm) || tenantDomain.includes(searchTerm)) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            });
        });
    </script>
@endsection