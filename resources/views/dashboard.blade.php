@extends('layouts.sidebar')
@section('title', 'Super Admin Dashboard')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('layouts.navbar', ['title' => 'Dashboard'])

        <div class="container-fluid py-2">
            <div class="row">
                <div class="ms-3">
                    <h3 class="mb-0 h4 font-weight-bolder">Super Admin Dashboard</h3>
                    <p class="mb-4">
                        Monitor and manage tenant registrations and system performance.
                    </p>
                </div>

                <!-- Tenant statistics cards -->
                <div class="row mb-3">
                    <div class="col-xl-3 col-md-6 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-2 ps-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="text-sm mb-0 text-capitalize">Active Tenants</p>
                                        <h4 class="mb-0">{{ $allTenants->whereNotIn('status', ['rejected'])->count() }}</h4>
                                    </div>
                                    <div
                                        class="icon icon-md icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-lg">
                                        <i class="material-symbols-rounded opacity-10">business</i>
                                    </div>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 ps-3">
                                <p class="mb-0 text-sm">
                                    <a href="{{ route('tenants.index') }}" class="text-primary font-weight-bolder">View all
                                        tenants</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-2 ps-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="text-sm mb-0 text-capitalize">Pending Approvals</p>
                                        <h4 class="mb-0">{{ $allTenants->where('status', 'pending')->count() }}</h4>
                                    </div>
                                    <div
                                        class="icon icon-md icon-shape bg-gradient-warning shadow-warning shadow text-center border-radius-lg">
                                        <i class="material-symbols-rounded opacity-10">hourglass_bottom</i>
                                    </div>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 ps-3">
                                <p class="mb-0 text-sm">
                                    <a href="{{ route('tenants.index') }}" class="text-warning font-weight-bolder">Review
                                        pending</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-2 ps-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="text-sm mb-0 text-capitalize">Approved Tenants</p>
                                        <h4 class="mb-0">{{ $allTenants->where('status', 'approved')->count() }}</h4>
                                    </div>
                                    <div
                                        class="icon icon-md icon-shape bg-gradient-success shadow-success shadow text-center border-radius-lg">
                                        <i class="material-symbols-rounded opacity-10">check_circle</i>
                                    </div>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 ps-3">
                                <p class="mb-0 text-sm">
                                    <span class="text-success font-weight-bolder">Active tenants</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-2 ps-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="text-sm mb-0 text-capitalize">Disabled Tenants</p>
                                        <h4 class="mb-0">{{ $allTenants->where('status', 'disabled')->count() }}</h4>
                                    </div>
                                    <div
                                        class="icon icon-md icon-shape bg-gradient-danger shadow-danger shadow text-center border-radius-lg">
                                        <i class="material-symbols-rounded opacity-10">block</i>
                                    </div>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 ps-3">
                                <p class="mb-0 text-sm">
                                    <span class="text-danger font-weight-bolder">Disabled tenants</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-2 ps-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="text-sm mb-0 text-capitalize">Rejected Applications</p>
                                        <h4 class="mb-0">{{ $allTenants->where('status', 'rejected')->count() }}</h4>
                                    </div>
                                    <div
                                        class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                        <i class="material-symbols-rounded opacity-10">cancel</i>
                                    </div>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 ps-3">
                                <p class="mb-0 text-sm">
                                    <span class="text-dark font-weight-bolder">Rejected applications</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Tenants Table -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Recent Tenant Registrations</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('tenants.index') }}" class="btn bg-gradient-dark mb-0">
                                        <i class="material-symbols-rounded text-sm">visibility</i>&nbsp;&nbsp;View All
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
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
                                                Created</th>
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
                                                        class="text-secondary text-xs font-weight-bold">{{ $tenant->created_at ? $tenant->created_at->format('M d, Y') : 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex">
                                                        <button type="button"
                                                            class="btn btn-link text-info px-1 mb-0 view-tenant-btn"
                                                            data-tenant-id="{{ $tenant->id }}"
                                                            data-tenant-name="{{ $tenant->name }}"
                                                            data-tenant-email="{{ $tenant->email }}"
                                                            data-tenant-status="{{ $tenant->status }}"
                                                            data-tenant-contact="{{ $tenant->contact_person }}"
                                                            data-tenant-phone="{{ $tenant->phone_number }}"
                                                            data-tenant-domains="@foreach($tenant->domains as $domain){{ $domain->domain }}{{ $loop->last ? '' : ', ' }}@endforeach"
                                                            data-tenant-created="{{ $tenant->created_at ? $tenant->created_at->format('F d, Y H:i') : 'N/A' }}"
                                                            data-tenant-notes="{{ $tenant->admin_notes }}">
                                                            <i class="material-symbols-rounded text-sm me-2">visibility</i>
                                                            View
                                                        </button>
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

            <!-- Rejected Tenants Table -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Recently Rejected Applications</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('tenants.index') }}" class="btn bg-gradient-danger mb-0">
                                        <i class="material-symbols-rounded text-sm">cancel</i>&nbsp;&nbsp;View All Rejected
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            @if($rejectedTenants->count() > 0)
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tenant</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Rejected By</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Rejection Reason</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Rejected At</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($rejectedTenants as $tenant)
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
                                                            {{ $tenant->rejected_by ?? 'Unknown' }}
                                                        </p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs">
                                                            {{ Str::limit($tenant->admin_notes, 40) }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold">
                                                            {{ $tenant->rejected_at ? date('M d, Y', strtotime($tenant->rejected_at)) : 'N/A' }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="d-flex">
                                                            <button type="button"
                                                                class="btn btn-link text-info px-1 mb-0 view-tenant-btn"
                                                                data-tenant-id="{{ $tenant->id }}"
                                                                data-tenant-name="{{ $tenant->name }}"
                                                                data-tenant-email="{{ $tenant->email }}"
                                                                data-tenant-status="{{ $tenant->status }}"
                                                                data-tenant-contact="{{ $tenant->contact_person }}"
                                                                data-tenant-phone="{{ $tenant->phone_number }}"
                                                                data-tenant-created="{{ $tenant->created_at ? $tenant->created_at->format('F d, Y H:i') : 'N/A' }}"
                                                                data-tenant-rejected="{{ $tenant->rejected_at ? date('F d, Y H:i', strtotime($tenant->rejected_at)) : 'N/A' }}"
                                                                data-tenant-rejected-by="{{ $tenant->rejected_by ?? 'N/A' }}"
                                                                data-tenant-notes="{{ $tenant->admin_notes }}">
                                                                <i class="material-symbols-rounded text-sm me-2">visibility</i>
                                                                View
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <p class="text-secondary mb-0">No rejected applications found</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-3">
                            <h6 class="mb-0">Quick Actions</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-4 mb-md-0 mb-4">
                                    <a href="{{ route('tenants.index') }}"
                                        class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row h-100">
                                        <i class="material-symbols-rounded text-warning text-lg mb-0 me-2">list_alt</i>
                                        <div class="w-100">
                                            <h6 class="mb-0">Manage Tenants</h6>
                                            <p class="text-xs mb-0">Review, approve, or manage tenant accounts</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 mb-md-0 mb-4">
                                    <a href="{{ route('reports.index') }}"
                                        class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row h-100">
                                        <i class="material-symbols-rounded text-primary text-lg mb-0 me-2">description</i>
                                        <div class="w-100">
                                            <h6 class="mb-0">Generate Reports</h6>
                                            <p class="text-xs mb-0">Create and download tenant PDF reports</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Include tenant modal components -->
    @include('components.tenant-view-modal')
    @include('components.tenant-edit-modal')
    @include('components.tenant-disable-modal')

    <!-- Include JavaScript for tenant modals -->
    <script src="{{ asset('js/tenant-modals.js') }}"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Disable functionality
            const rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
            const rejectButtons = document.querySelectorAll('.reject-btn');
            const confirmRejectBtn = document.getElementById('confirmReject');
            const tenantNameSpan = document.getElementById('tenantName');
            const rejectForm = document.getElementById('rejectForm');
            
            if (rejectButtons.length > 0 && confirmRejectBtn && rejectForm) {
                rejectButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const tenantId = this.getAttribute('data-tenant-id');
                        const tenantName = this.getAttribute('data-tenant-name');
                        
                        tenantNameSpan.textContent = tenantName;
                        rejectForm.action = `/tenants/${tenantId}/disable`;
                        rejectModal.show();
                    });
                });

                confirmRejectBtn.addEventListener('click', function () {
                    rejectForm.submit();
                });
            }
        });
    </script>
@endsection