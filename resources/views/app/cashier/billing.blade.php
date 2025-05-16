@extends('app.layouts.sidebar')
@section('title', 'Cashier Billing')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    @include('layouts.navbar', ['title' => 'Billing Management'])
    
    <div class="container-fluid py-4">
            <!-- Success Message Notification -->
            @if(session('success'))
            <div class="alert alert-success text-white font-weight-bold alert-dismissible fade show" role="alert">
                <span class="alert-icon align-middle">
                    <span class="material-symbols-rounded">check_circle</span>
                </span>
                <span class="alert-text">{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
            
        <!-- Manage Bills Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Manage Bills</h6>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3 mb-3">
                                <div class="input-group input-group-static">
                                    <label for="statusFilter" class="ms-0">Status Filter</label>
                                    <select id="statusFilter" class="form-control">
                                <option value="">All Statuses</option>
                                <option value="pending">Pending</option>
                                <option value="partially_paid">Partially Paid</option>
                                <option value="paid">Paid</option>
                                <option value="overdue">Overdue</option>
                            </select>
                                </div>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Search patient or bill#...</label>
                                    <input type="text" id="searchBill" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bill #</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Patient</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Service</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Amount</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Remaining</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Due Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                                <tbody>
                                @forelse($pendingBills as $bill)
                                    <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $bill->bill_number }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $bill->patient->first_name }} {{ $bill->patient->last_name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold">
                                                    {{ $bill->service->name }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold">
                                                    ₱{{ number_format($bill->amount, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold text-danger">
                                                    ₱{{ number_format($bill->amount - $bill->amount_paid, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold">
                                                    {{ \Carbon\Carbon::parse($bill->due_date)->format('M d, Y') }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                            @if($bill->status === 'pending')
                                                    <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                            @elseif($bill->status === 'partially_paid')
                                                    <span class="badge badge-sm bg-gradient-info">Partially Paid</span>
                                            @elseif($bill->status === 'overdue')
                                                    <span class="badge badge-sm bg-gradient-danger">Overdue</span>
                                            @else
                                                    <span class="badge badge-sm bg-gradient-success">{{ ucfirst($bill->status) }}</span>
                                            @endif
                                        </td>
                                            <td class="align-middle text-center">
                                                <button type="button" 
                                                        class="btn btn-link text-primary px-3 mb-0 view-bill-btn" 
                                                        data-bill-id="{{ $bill->id }}">
                                                    <i class="material-symbols-rounded text-sm me-1">visibility</i>View
                                                </button>
                                                <a href="{{ route('patient.bill.pdf', $bill->id) }}" class="btn btn-link text-dark px-3 mb-0">
                                                    <i class="material-symbols-rounded text-sm me-1">download</i>PDF
                                                </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                            <td colspan="8" class="text-center py-4 text-secondary">No bills found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($pendingBills->hasPages())
                            <div class="d-flex justify-content-between align-items-center mx-4 row mt-4">
                                <div class="col-sm-12 col-md-5">
                                    <div class="text-sm text-secondary">
                                        Showing {{ $pendingBills->firstItem() }} to {{ $pendingBills->lastItem() }} of {{ $pendingBills->total() }} entries
                                    </div>
                            </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="pagination pagination-secondary">
                                {{ $pendingBills->links() }}
                                    </div>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
                </div>
            </div>

        <!-- Recent Patients Card -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Recent Patients</h6>
                        </div>
                        <p class="text-sm mb-0 text-muted">Patients available for billing</p>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Patient</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Service</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Registration Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                                <tbody>
                                @forelse($recentPatients as $patient)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                                                        <span class="text-white text-uppercase">{{ substr($patient->first_name ?? '', 0, 1) }}</span>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $patient->full_name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $patient->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-0 text-sm">{{ $patient->service->name ?? 'N/A' }}</h6>
                                            @if($patient->service && $patient->service->description)
                                                        <p class="text-xs text-secondary mb-0">{{ Str::limit($patient->service->description, 50) }}</p>
                                                    @endif
                                                </div>
                                        </td>
                                            <td>
                                                <span class="badge bg-gradient-info">
                                                {{ $patient->service->category ?? 'General' }}
                                            </span>
                                        </td>
                                            <td>
                                                <span class="text-xs font-weight-bold">
                                                ₱{{ number_format($patient->service->price ?? 0, 2) }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ $patient->created_at->format('M d, Y') }}
                                                    </span>
                                                    <span class="text-xs text-secondary">{{ $patient->created_at->diffForHumans() }}</span>
                                            </div>
                                        </td>
                                            <td class="align-middle text-center">
                                                <button class="btn bg-gradient-primary btn-sm mb-0 create-bill"
                                                data-patient-id="{{ $patient->id }}"
                                                data-patient-name="{{ $patient->full_name }}"
                                                data-service-id="{{ $patient->service_id }}"
                                                data-service-name="{{ $patient->service->name ?? 'N/A' }}"
                                                    data-service-price="{{ $patient->service->price ?? 0 }}">
                                                    <i class="material-symbols-rounded text-sm me-1">receipt</i>Create Bill
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                            <td colspan="6" class="text-center py-4 text-secondary">No patients found</td>
                                    </tr>
                                @endforelse
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
@include('app.cashier.create-bill-modal')
@include('app.cashier.view-bill-modal')

<!-- Scripts for handling the modal display -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Open Modal when clicking the create bill button
        if (document.getElementById('openCreateBillModal')) {
            document.getElementById('openCreateBillModal').addEventListener('click', function() {
                var modal = new bootstrap.Modal(document.getElementById('createBillModal'));
                modal.show();
            });
        }
        
        // Populate price when selecting a service
        document.getElementById('service_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption && selectedOption.dataset.price) {
                document.getElementById('amount').value = selectedOption.dataset.price;
            }
        });
        
        // Set date input to current date plus 30 days
        const today = new Date();
        today.setDate(today.getDate() + 30);
        document.getElementById('due_date').valueAsDate = today;
        
        // Add event listeners to all "Create Bill" buttons with patient data
        document.querySelectorAll('.create-bill').forEach(function(button) {
            button.addEventListener('click', function() {
                const patientId = this.getAttribute('data-patient-id');
                const serviceId = this.getAttribute('data-service-id');
                const servicePrice = this.getAttribute('data-service-price');
                
                // Set values in the form
                document.getElementById('patient_id').value = patientId;
                if (serviceId) {
                    document.getElementById('service_id').value = serviceId;
                }
                if (servicePrice) {
                    document.getElementById('amount').value = servicePrice;
                }
                
                var modal = new bootstrap.Modal(document.getElementById('createBillModal'));
                modal.show();
            });
        });
        
        // Initialize modals
        const viewBillModal = new bootstrap.Modal(document.getElementById('viewBillModal'));
        const processPaymentModal = new bootstrap.Modal(document.getElementById('processPaymentModal'));
        let currentBillId = null;
        
        // Event listener for view bill buttons
        document.querySelectorAll('.view-bill-btn').forEach(button => {
            button.addEventListener('click', function() {
                const billId = this.getAttribute('data-bill-id');
                currentBillId = billId;
                
                // Set the PDF download link
                document.getElementById('downloadPdfLink').href = `/billing/${billId}/pdf`;
                
                // Show the modal
                viewBillModal.show();
                
                // Fetch bill details using AJAX
                fetch(`/api/bills/${billId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update modal with bill details
                        updateViewBillModal(data);
                    })
                    .catch(error => {
                        console.error('Error fetching bill details:', error);
                    });
            });
        });
        
        // Function to update the view bill modal with data
        function updateViewBillModal(data) {
            // Bill Information
            document.getElementById('billNumber').textContent = data.bill_number;
            document.getElementById('createdDate').textContent = new Date(data.created_at).toLocaleDateString('en-US', {
                year: 'numeric', month: 'short', day: 'numeric'
            });
            document.getElementById('dueDate').textContent = new Date(data.due_date).toLocaleDateString('en-US', {
                year: 'numeric', month: 'short', day: 'numeric'
            });
            
            // Set status badge
            const statusBadge = document.getElementById('billStatus');
            statusBadge.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
            
            if (data.status === 'pending') {
                statusBadge.className = 'badge badge-sm bg-gradient-warning';
            } else if (data.status === 'partially_paid') {
                statusBadge.className = 'badge badge-sm bg-gradient-info';
            } else if (data.status === 'overdue') {
                statusBadge.className = 'badge badge-sm bg-gradient-danger';
            } else {
                statusBadge.className = 'badge badge-sm bg-gradient-success';
            }
            
            document.getElementById('billNotes').textContent = data.notes || 'No notes';
            
            // Patient Information
            document.getElementById('patientName').textContent = `${data.patient.first_name} ${data.patient.last_name}`;
            document.getElementById('patientEmail').textContent = data.patient.email || 'N/A';
            document.getElementById('patientPhone').textContent = data.patient.phone || 'N/A';
            document.getElementById('serviceName').textContent = data.service.name;
            
            // Financial Summary
            document.getElementById('totalAmount').textContent = `₱${parseFloat(data.amount).toFixed(2)}`;
            document.getElementById('amountPaid').textContent = `₱${parseFloat(data.amount_paid).toFixed(2)}`;
            document.getElementById('remainingBalance').textContent = `₱${parseFloat(data.amount - data.amount_paid).toFixed(2)}`;
            
            // Process Payment Button visibility
            const processPaymentBtn = document.getElementById('processPaymentBtn');
            if (data.status === 'paid') {
                processPaymentBtn.style.display = 'none';
            } else {
                processPaymentBtn.style.display = 'inline-block';
            }
            
            // Fill payment history table
            const paymentHistoryBody = document.getElementById('paymentHistoryBody');
            paymentHistoryBody.innerHTML = '';
            
            if (data.payments && data.payments.length > 0) {
                data.payments.forEach(payment => {
                    const row = document.createElement('tr');
                    
                    row.innerHTML = `
                        <td>
                            <span class="text-xs">${new Date(payment.created_at).toLocaleString('en-US')}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold text-success">₱${parseFloat(payment.amount).toFixed(2)}</span>
                        </td>
                        <td>
                            <span class="text-xs">${payment.payment_method.charAt(0).toUpperCase() + payment.payment_method.slice(1)}</span>
                        </td>
                        <td>
                            <span class="text-xs">${payment.reference_number || 'N/A'}</span>
                        </td>
                        <td>
                            <span class="text-xs">${payment.cashier ? payment.cashier.name : 'Unknown'}</span>
                        </td>
                        <td>
                            <span class="text-xs">${payment.notes || 'N/A'}</span>
                        </td>
                    `;
                    
                    paymentHistoryBody.appendChild(row);
                });
            } else {
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = `<td colspan="6" class="text-center py-4 text-secondary">No payment records found</td>`;
                paymentHistoryBody.appendChild(emptyRow);
            }
        }
        
        // Process Payment button event
        document.getElementById('processPaymentBtn').addEventListener('click', function() {
            if (!currentBillId) return;
            
            // Get information from the view modal
            const patientName = document.getElementById('patientName').textContent;
            const billNumber = document.getElementById('billNumber').textContent;
            const amountDue = document.getElementById('remainingBalance').textContent.replace('₱', '');
            
            // Fill the payment modal
            document.getElementById('paymentPatientName').textContent = patientName;
            document.getElementById('paymentBillNumber').textContent = billNumber;
            document.getElementById('paymentAmountDue').textContent = `₱${amountDue}`;
            
            // Set form values
            document.getElementById('payment_amount').value = amountDue;
            document.getElementById('payment_amount').max = amountDue;
            document.getElementById('reference_number').value = billNumber;
            
            // Set the form action
            document.getElementById('processPaymentForm').action = `/billing/${currentBillId}/process-payment`;
            
            // Hide the view modal and show the payment modal
            viewBillModal.hide();
            processPaymentModal.show();
        });
        
        // Status filter functionality
        document.getElementById('statusFilter').addEventListener('change', function() {
            filterTable();
        });
        
        // Search functionality
        document.getElementById('searchBill').addEventListener('keyup', function() {
            filterTable();
        });
        
        function filterTable() {
            const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
            const searchFilter = document.getElementById('searchBill').value.toLowerCase();
            
            const tableRows = document.querySelectorAll('table tbody tr');
            
            tableRows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(7)');
                const patientCell = row.querySelector('td:nth-child(2)');
                const billNumberCell = row.querySelector('td:nth-child(1)');
                
                let showRow = true;
                
                if (statusFilter && statusCell) {
                    const status = statusCell.textContent.toLowerCase();
                    if (!status.includes(statusFilter)) {
                        showRow = false;
                    }
                }
                
                if (searchFilter && patientCell && billNumberCell) {
                    const patientName = patientCell.textContent.toLowerCase();
                    const billNumber = billNumberCell.textContent.toLowerCase();
                    
                    if (!patientName.includes(searchFilter) && !billNumber.includes(searchFilter)) {
                        showRow = false;
                    }
                }
                
                row.style.display = showRow ? '' : 'none';
            });
        }
    });
</script>
@endsection
   