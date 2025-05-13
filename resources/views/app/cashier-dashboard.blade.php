<x-tenant-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cashier Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Quick Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">Today's Collections</h3>
                        <p class="text-3xl font-bold text-blue-600">₱{{ number_format($todayCollections, 2) }}</p>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">Pending Payments</h3>
                        <p class="text-3xl font-bold text-yellow-600">{{ $pendingPayments }}</p>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">Completed Transactions</h3>
                        <p class="text-3xl font-bold text-green-600">{{ $completedTransactions }}</p>
                    </div>
                </div>
            </div>
            <!-- Unpaid Bills -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Unpaid Bills</h3>
                        <div class="flex space-x-2">
                            <input type="text" id="searchPatient" placeholder="Search patient..." 
                                class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Bill ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Patient Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Service</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount Due</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Due Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="unpaidBillsTable" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($pendingBills ?? [] as $bill)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $bill->bill_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $bill->patient->first_name }} {{ $bill->patient->last_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $bill->service->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-red-600">₱{{ number_format($bill->amount - $bill->amount_paid, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($bill->due_date)->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($bill->status === 'pending')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        @elseif($bill->status === 'partially_paid')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Partially Paid</span>
                                        @elseif($bill->status === 'overdue')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Overdue</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ ucfirst($bill->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('patient.bill.view', $bill->id) }}" class="text-blue-600 hover:text-blue-900 text-sm">
                                                View Details
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if(count($pendingBills ?? []) === 0)
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No unpaid bills found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    @if(isset($pendingBills) && $pendingBills->hasPages())
                    <div class="mt-4 flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Showing {{ $pendingBills->firstItem() }} to {{ $pendingBills->lastItem() }} of {{ $pendingBills->total() }} entries
                        </div>
                        <div class="flex space-x-2">
                            {{ $pendingBills->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Create Bill Modal -->
    <div id="createBillModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">Create New Bill</h3>
                        <form id="createBillForm" action="{{ route('patient.bill.create') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="patient_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Patient</label>
                                <select id="patient_id" name="patient_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="">Select a patient</option>
                                    @foreach($recentPatients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="service_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Service</label>
                                <select id="service_id" name="service_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="">Select a service</option>
                                    @foreach($services ?? [] as $service)
                                        <option value="{{ $service->id }}" data-price="{{ $service->price }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
                                <input type="number" step="0.01" id="amount" name="amount" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            <div class="mb-4">
                                <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
                                <input type="date" id="due_date" name="due_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            <div class="mb-4">
                                <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" form="createBillForm" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Create Bill
                    </button>
                    <button type="button" id="cancelCreateBill" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Payment Modal -->
    <div id="processPaymentModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">Process Payment</h3>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Processing payment for <span id="paymentPatientName" class="font-bold"></span>
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Bill #: <span id="paymentBillNumber" class="font-bold"></span>
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Amount Due: ₱<span id="paymentAmountDue" class="font-bold"></span>
                            </p>
                        </div>
                        <form id="processPaymentForm" action="" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="payment_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Amount</label>
                                <input type="number" step="0.01" id="payment_amount" name="amount" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            <div class="mb-4">
                                <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Method</label>
                                <select id="payment_method" name="payment_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="reference_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reference Number</label>
                                <input type="text" id="reference_number" name="reference_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            <div class="mb-4">
                                <label for="payment_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                <textarea id="payment_notes" name="notes" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" form="processPaymentForm" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Complete Payment
                    </button>
                    <button type="button" id="cancelProcessPayment" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create Bill Modal Logic
            const createBillBtn = document.getElementById('createBillBtn');
            const createBillModal = document.getElementById('createBillModal');
            const cancelCreateBill = document.getElementById('cancelCreateBill');
            const patientSelect = document.getElementById('patient_id');
            const serviceSelect = document.getElementById('service_id');
            const amountInput = document.getElementById('amount');
            const dueDateInput = document.getElementById('due_date');
            
            // Set default due date to 7 days from now
            const defaultDueDate = new Date();
            defaultDueDate.setDate(defaultDueDate.getDate() + 7);
            dueDateInput.value = defaultDueDate.toISOString().split('T')[0];
            
            createBillBtn.addEventListener('click', function() {
                createBillModal.classList.remove('hidden');
            });
            
            cancelCreateBill.addEventListener('click', function() {
                createBillModal.classList.add('hidden');
            });
            
            // Update amount when service is selected
            serviceSelect.addEventListener('change', function() {
                const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                if (selectedOption && selectedOption.dataset.price) {
                    amountInput.value = selectedOption.dataset.price;
                }
            });
            
            // Create bill for specific patient buttons
            const createBillForPatientBtns = document.querySelectorAll('.createBillForPatient');
            createBillForPatientBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const patientId = this.dataset.patientId;
                    const serviceId = this.dataset.serviceId;
                    const servicePrice = this.dataset.servicePrice;
                    
                    // Set the values in the modal
                    patientSelect.value = patientId;
                    serviceSelect.value = serviceId;
                    amountInput.value = servicePrice;
                    
                    // Show the modal
                    createBillModal.classList.remove('hidden');
                });
            });

            // Form submission handling
            const createBillForm = document.getElementById('createBillForm');
            createBillForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Basic validation
                if (!patientSelect.value || !serviceSelect.value || !amountInput.value || !dueDateInput.value) {
                    alert('Please fill in all required fields');
                    return;
                }
                
                try {
                    // Log form data for debugging
                    console.log('Submitting form with data:', {
                        patient_id: patientSelect.value,
                        service_id: serviceSelect.value,
                        amount: amountInput.value,
                        due_date: dueDateInput.value,
                        notes: document.getElementById('notes').value
                    });
                    
                    // Submit the form
                    this.submit();
                } catch (error) {
                    console.error('Error submitting form:', error);
                    alert('An error occurred while submitting the form. Please try again.');
                }
            });

            // Close modal when clicking outside
            window.addEventListener('click', function(e) {
                if (e.target === createBillModal) {
                    createBillModal.classList.add('hidden');
                }
            });

            // Process Payment Modal Logic
            const processPaymentBtns = document.querySelectorAll('.processPaymentBtn');
            const processPaymentModal = document.getElementById('processPaymentModal');
            const cancelProcessPayment = document.getElementById('cancelProcessPayment');
            const paymentPatientName = document.getElementById('paymentPatientName');
            const paymentBillNumber = document.getElementById('paymentBillNumber');
            const paymentAmountDue = document.getElementById('paymentAmountDue');
            const paymentForm = document.getElementById('processPaymentForm');
            const paymentAmountInput = document.getElementById('payment_amount');
            
            processPaymentBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const billId = this.dataset.billId;
                    const billNumber = this.dataset.billNumber;
                    const patientName = this.dataset.patientName;
                    const amountDue = this.dataset.amountDue;
                    
                    // Set the values in the modal
                    paymentPatientName.textContent = patientName;
                    paymentBillNumber.textContent = billNumber;
                    paymentAmountDue.textContent = parseFloat(amountDue).toFixed(2);
                    paymentAmountInput.value = amountDue;
                    paymentAmountInput.max = amountDue;
                    
                    // Set the form action
                    paymentForm.action = `/billing/${billId}/process-payment`;
                    
                    // Show the modal
                    processPaymentModal.classList.remove('hidden');
                });
            });
            
            cancelProcessPayment.addEventListener('click', function() {
                processPaymentModal.classList.add('hidden');
            });
            
            // Search patients logic
            const searchPatientInput = document.getElementById('searchPatient');
            const unpaidBillsTable = document.getElementById('unpaidBillsTable');
            
            searchPatientInput.addEventListener('input', function() {
                if (this.value.length < 2) return; // Only search if at least 2 characters
                
                fetch(`/billing/search-patients?search=${this.value}`)
                    .then(response => response.json())
                    .then(patients => {
                        // Implementation to filter the bills table based on patient search
                        // This would typically update the DOM elements in the bills table
                    });
            });
        });
    </script>
    @endpush
</x-tenant-app-layout> 