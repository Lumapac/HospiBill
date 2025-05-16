@extends('app.layouts.sidebar')
@section('title', 'Cashier Dashboard')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @include('layouts.navbar', ['title' => 'Cashier Dashboard'])
        
        <div class="container-fluid py-4">         
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-symbols-rounded opacity-10">payments</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Today's Collections</p>
                                <h4 class="mb-0">₱{{ number_format($todayCollections, 2) }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <div class="d-flex">
                                <p class="mb-0 text-sm">Collections for {{ now()->format('M d, Y') }}</p>
                                <i class="material-symbols-rounded text-success ms-auto">paid</i>
                                <span class="text-success text-sm font-weight-bolder">Active</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-symbols-rounded opacity-10">pending_actions</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Pending Payments</p>
                                <h4 class="mb-0">{{ $pendingPayments }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <div class="d-flex">
                                <p class="mb-0 text-sm">Bills requiring payment</p>
                                <i class="material-symbols-rounded text-warning ms-auto">update</i>
                                <span class="text-warning text-sm font-weight-bolder">Pending</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-symbols-rounded opacity-10">task_alt</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Completed Transactions</p>
                                <h4 class="mb-0">{{ $completedTransactions }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <div class="d-flex">
                                <p class="mb-0 text-sm">Fully paid bills</p>
                                <i class="material-symbols-rounded text-primary ms-auto">verified</i>
                                <span class="text-primary text-sm font-weight-bolder">Completed</span>
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

                            </div>
                            <p class="text-sm mb-0 text-muted">Recently registered patients</p>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Patient</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Service</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Date</th>
                                            <th 
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentPatients as $patient)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                                                            <span class="text-white text-uppercase">{{ substr($patient->first_name, 0, 1) }}</span>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $patient->first_name }}
                                                                {{ $patient->last_name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $patient->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-gradient-info">
                                                        {{ $patient->service ? $patient->service->name : 'No service' }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ $patient->created_at->format('M d, Y') }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <button class="btn btn-link text-primary px-3 mb-0 view-patient" data-id="{{ $patient->id }}">
                                                        <i class="material-symbols-rounded text-sm me-1">visibility</i>View
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pending Bills -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Pending Bills</h6>
                                <a href="{{ route('patient.bill') }}" class="btn btn-link text-dark px-3 mb-0">
                                    <i class="material-symbols-rounded text-sm me-1">visibility</i>View All
                                </a>
                            </div>
                            <p class="text-sm mb-0 text-muted">Bills requiring payment attention</p>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Bill ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Patient</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Amount Due</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendingBills->take(5) as $bill)
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
                                                            <p class="text-xs text-secondary mb-0">{{ $bill->service->name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold text-danger">
                                                        ₱{{ number_format($bill->amount - $bill->amount_paid, 2) }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if($bill->status === 'pending')
                                                        <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                                    @elseif($bill->status === 'partially_paid')
                                                        <span class="badge badge-sm bg-gradient-info">Partially Paid</span>
                                                    @elseif($bill->status === 'overdue')
                                                        <span class="badge badge-sm bg-gradient-danger">Overdue</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if(count($pendingBills ?? []) === 0)
                                            <tr>
                                                <td colspan="4" class="text-center py-4 text-secondary">No pending bills found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Paid Bills -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Recent Payments</h6>
                            </div>
                            <p class="text-sm mb-0 text-muted">Recent fully paid bills</p>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Bill ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Patient</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Amount Paid</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Payment Date</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Payment Method</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($paidBills->take(5) as $bill)
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
                                                            <p class="text-xs text-secondary mb-0">{{ $bill->service->name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold text-success">
                                                        ₱{{ number_format($bill->amount, 2) }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ \Carbon\Carbon::parse($bill->updated_at)->format('M d, Y') }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if($bill->payments->isNotEmpty())
                                                        @php 
                                                            $lastPayment = $bill->payments->sortByDesc('created_at')->first();
                                                            $paymentMethod = ucfirst($lastPayment->payment_method);
                                                        @endphp
                                                        <span class="badge badge-sm bg-gradient-success">{{ $paymentMethod }}</span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-secondary">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    <button type="button"
                                                        class="btn btn-link text-primary px-3 mb-0 view-bill-btn"
                                                        data-bill-id="{{ $bill->id }}">
                                                        <i class="material-symbols-rounded text-sm me-1">visibility</i>View
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if(count($paidBills ?? []) === 0)
                                            <tr>
                                                <td colspan="6" class="text-center py-4 text-secondary">No paid bills found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Include Bill View Modal -->
    @php
        $viewBillModalPath = 'app.cashier.view-bill-modal';
        echo "<!-- Including modal from: $viewBillModalPath -->";
    @endphp
    @include($viewBillModalPath)
    
    <!-- Include Patient View Modal -->
    @include('app.patients.view_patient_modal')

    <!-- Scripts for handling the modal display -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // The view_patient_modal.blade.php contains its own event listeners
            // No additional code needed for patient view functionality

            // Add event listeners to all "View Bill" buttons
            document.querySelectorAll('.view-bill-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const billId = this.getAttribute('data-bill-id');
                    
                    // Set the PDF link
                    const downloadPdfLink = document.getElementById('downloadPdfLink');
                    if (downloadPdfLink) {
                        downloadPdfLink.href = `/billing/${billId}/pdf`;
                    }
                    
                    // Fetch bill data and populate modal
                    fetch(`/api/bills/${billId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Populate Bill Information
                            document.getElementById('billNumber').textContent = data.bill_number;
                            document.getElementById('createdDate').textContent = new Date(data.created_at).toLocaleDateString('en-US', {year: 'numeric', month: 'short', day: 'numeric'});
                            document.getElementById('dueDate').textContent = new Date(data.due_date).toLocaleDateString('en-US', {year: 'numeric', month: 'short', day: 'numeric'});
                            
                            // Set status with appropriate badge class
                            const statusElement = document.getElementById('billStatus');
                            statusElement.textContent = data.status.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
                            
                            // Clear existing classes and add new ones
                            statusElement.className = 'badge badge-sm';
                            if (data.status === 'paid') {
                                statusElement.classList.add('bg-gradient-success');
                            } else if (data.status === 'partially_paid') {
                                statusElement.classList.add('bg-gradient-info');
                            } else if (data.status === 'pending') {
                                statusElement.classList.add('bg-gradient-warning');
                            } else if (data.status === 'overdue') {
                                statusElement.classList.add('bg-gradient-danger');
                            }
                            
                            document.getElementById('billNotes').textContent = data.notes || 'No notes';
                            
                            // Populate Patient Information
                            document.getElementById('patientName').textContent = `${data.patient.first_name} ${data.patient.last_name}`;
                            document.getElementById('patientEmail').textContent = data.patient.email || 'No email';
                            document.getElementById('patientPhone').textContent = data.patient.phone || 'No phone';
                            document.getElementById('serviceName').textContent = data.service ? data.service.name : 'No service';
                            
                            // Populate Financial Summary
                            document.getElementById('totalAmount').textContent = `₱${parseFloat(data.amount).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                            document.getElementById('amountPaid').textContent = `₱${parseFloat(data.amount_paid).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                            
                            const remainingBalance = parseFloat(data.amount) - parseFloat(data.amount_paid);
                            document.getElementById('remainingBalance').textContent = `₱${remainingBalance.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                            
                            // Populate Payment History
                            const paymentHistoryBody = document.getElementById('paymentHistoryBody');
                            paymentHistoryBody.innerHTML = '';
                            
                            if (data.payments && data.payments.length > 0) {
                                data.payments.forEach(payment => {
                                    const row = document.createElement('tr');
                                    
                                    // Payment Date
                                    const dateCell = document.createElement('td');
                                    dateCell.className = 'text-xs';
                                    dateCell.textContent = new Date(payment.created_at).toLocaleDateString('en-US', {year: 'numeric', month: 'short', day: 'numeric'});
                                    row.appendChild(dateCell);
                                    
                                    // Amount
                                    const amountCell = document.createElement('td');
                                    amountCell.className = 'text-xs font-weight-bold text-success';
                                    amountCell.textContent = `₱${parseFloat(payment.amount).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                                    row.appendChild(amountCell);
                                    
                                    // Payment Method
                                    const methodCell = document.createElement('td');
                                    methodCell.className = 'text-xs';
                                    methodCell.textContent = payment.payment_method.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
                                    row.appendChild(methodCell);
                                    
                                    // Reference Number
                                    const referenceCell = document.createElement('td');
                                    referenceCell.className = 'text-xs';
                                    referenceCell.textContent = payment.reference_number || 'N/A';
                                    row.appendChild(referenceCell);
                                    
                                    // Processed By
                                    const processedByCell = document.createElement('td');
                                    processedByCell.className = 'text-xs';
                                    processedByCell.textContent = payment.processed_by ? payment.processed_by.name : 'System';
                                    row.appendChild(processedByCell);
                                    
                                    // Notes
                                    const notesCell = document.createElement('td');
                                    notesCell.className = 'text-xs';
                                    notesCell.textContent = payment.notes || 'No notes';
                                    row.appendChild(notesCell);
                                    
                                    paymentHistoryBody.appendChild(row);
                                });
                            } else {
                                const row = document.createElement('tr');
                                const cell = document.createElement('td');
                                cell.colSpan = 6;
                                cell.className = 'text-center py-4 text-secondary';
                                cell.textContent = 'No payment history found';
                                row.appendChild(cell);
                                paymentHistoryBody.appendChild(row);
                            }
                            
                            // Set up process payment functionality
                            const processPaymentBtn = document.getElementById('processPaymentBtn');
                            if (processPaymentBtn) {
                                // Hide process payment button if bill is already paid
                                if (data.status === 'paid') {
                                    processPaymentBtn.style.display = 'none';
                                } else {
                                    processPaymentBtn.style.display = '';
                                }
                                
                                processPaymentBtn.onclick = function() {
                                    // Setup payment modal
                                    document.getElementById('paymentPatientName').textContent = `${data.patient.first_name} ${data.patient.last_name}`;
                                    document.getElementById('paymentBillNumber').textContent = data.bill_number;
                                    document.getElementById('paymentAmountDue').textContent = `₱${remainingBalance.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                                    document.getElementById('payment_amount').value = remainingBalance.toFixed(2);
                                    document.getElementById('processPaymentForm').action = `/patient/bill/${billId}/payment`;
                                    
                                    // Hide the view modal and show the payment modal
                                    bootstrap.Modal.getInstance(document.getElementById('viewBillModal')).hide();
                                    const paymentModal = new bootstrap.Modal(document.getElementById('processPaymentModal'));
                                    paymentModal.show();
                                };
                            }
                            
                            // Show the modal
                            const viewModal = new bootstrap.Modal(document.getElementById('viewBillModal'));
                            viewModal.show();
                        })
                        .catch(error => {
                            console.error('Error fetching bill data:', error);
                            alert('Error loading bill data. Please try again.');
                        });
                });
            });
        });
    </script>
@endsection
   