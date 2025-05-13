<x-tenant-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Billing') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Success Message Notification -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            
            <!-- Search and Filter Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div
                        class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 space-y-4 md:space-y-0">
                        <h3 class="text-lg font-semibold">Manage Bills</h3>
                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                            <select id="statusFilter"
                                class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">All Statuses</option>
                                <option value="pending">Pending</option>
                                <option value="partially_paid">Partially Paid</option>
                                <option value="paid">Paid</option>
                                <option value="overdue">Overdue</option>
                            </select>
                            <input type="text" id="searchBill" placeholder="Search patient or bill#..."
                                class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>
                    </div>

                    <!-- Bills Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Bill #</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Patient</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Service</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Total Amount</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Remaining</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Due Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($pendingBills as $bill)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $bill->bill_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $bill->patient->first_name }}
                                            {{ $bill->patient->last_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $bill->service->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">₱{{ number_format($bill->amount, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-red-600">
                                            ₱{{ number_format($bill->amount - $bill->amount_paid, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($bill->due_date)->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($bill->status === 'pending')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                            @elseif($bill->status === 'partially_paid')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Partially
                                                    Paid</span>
                                            @elseif($bill->status === 'overdue')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Overdue</span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ ucfirst($bill->status) }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex space-x-2">
                                                @if($bill->status !== 'paid')
                                                    <button data-bill-id="{{ $bill->id }}"
                                                        data-bill-number="{{ $bill->bill_number }}"
                                                        data-patient-name="{{ $bill->patient->first_name }} {{ $bill->patient->last_name }}"
                                                        data-amount-due="{{ $bill->amount - $bill->amount_paid }}"
                                                        class="processPaymentBtn text-white bg-green-500 hover:bg-green-600 px-3 py-1 rounded-md text-sm"
                                                        onclick="event.preventDefault(); document.getElementById('processPaymentModal').classList.remove('hidden'); document.getElementById('processPaymentModal').classList.add('modal-visible'); document.getElementById('paymentPatientName').textContent = this.dataset.patientName; document.getElementById('paymentBillNumber').textContent = this.dataset.billNumber; document.getElementById('paymentAmountDue').textContent = parseFloat(this.dataset.amountDue).toFixed(2); document.getElementById('payment_amount').value = this.dataset.amountDue; document.getElementById('processPaymentForm').action = '/billing/' + this.dataset.billId + '/process-payment';">
                                                        Process Payment
                                                    </button>
                                                @endif
                                                <a href="{{ route('patient.bill.view', $bill->id) }}"
                                                    class="text-blue-600 hover:text-blue-900 text-sm">
                                                    View Details
                                                </a>
                                                <a href="{{ route('patient.bill.pdf', $bill->id) }}"
                                                    class="text-blue-600 hover:text-blue-900 text-sm flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                    PDF
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">No bills found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($pendingBills->hasPages())
                        <div class="mt-4 flex items-center justify-between">
                            <div class="text-sm text-gray-500">
                                Showing {{ $pendingBills->firstItem() }} to {{ $pendingBills->lastItem() }} of
                                {{ $pendingBills->total() }} entries
                            </div>
                            <div class="flex space-x-2">
                                {{ $pendingBills->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Patients Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Recent Patients</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Patient Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Service</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Category</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Price</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Registration Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($recentPatients as $patient)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $patient->full_name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $patient->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ $patient->service->name ?? 'N/A' }}</div>
                                            @if($patient->service && $patient->service->description)
                                                <div class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-xs">
                                                    {{ Str::limit($patient->service->description, 50) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100">
                                                {{ $patient->service->category ?? 'General' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white font-medium">
                                                ₱{{ number_format($patient->service->price ?? 0, 2) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ $patient->created_at->format('M d, Y') }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $patient->created_at->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button 
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-300 disabled:opacity-25 transition" 
                                                data-patient-id="{{ $patient->id }}"
                                                data-patient-name="{{ $patient->full_name }}"
                                                data-service-id="{{ $patient->service_id }}"
                                                data-service-name="{{ $patient->service->name ?? 'N/A' }}"
                                                data-service-price="{{ $patient->service->price ?? 0 }}"
                                                onclick="event.preventDefault(); 
                                                    document.getElementById('patient_id').value = this.dataset.patientId;
                                                    document.getElementById('service_id').value = this.dataset.serviceId;
                                                    document.getElementById('amount').value = this.dataset.servicePrice;
                                                    document.getElementById('createBillModal').classList.remove('hidden');
                                                    document.getElementById('createBillModal').classList.add('modal-visible');">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                                Create Bill
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No patients found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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
            <div
                class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">Create New Bill
                        </h3>
                        <form id="createBillForm" action="{{ route('patient.bill.create') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="patient_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Patient</label>
                                <select id="patient_id" name="patient_id" required onchange="handlePatientChange(this.value)"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="">Select a patient</option>
                                    @foreach($allPatients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->first_name }}
                                            {{ $patient->last_name }}</option>
                                    @endforeach
                                </select>
                                <p class="mt-1 text-xs text-gray-500">When you select a patient, their availed service will automatically be selected.</p>
                            </div>

                            <!-- Patient Service Information -->
                            <div id="patientServiceInfo" class="mb-4 p-3 bg-gray-100 dark:bg-gray-700 rounded-md hidden">
                                <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Patient Service Information</h4>
                                <div class="text-xs text-gray-600 dark:text-gray-400 space-y-1">
                                    <p><span class="font-medium">Service:</span> <span id="patientServiceName">-</span></p>
                                    <p><span class="font-medium">Service Category:</span> <span id="patientServiceCategory">-</span></p>
                                    <p><span class="font-medium">Service Price:</span> ₱<span id="patientServicePrice">-</span></p>
                                    <p><span class="font-medium">Registration Date:</span> <span id="patientRegistrationDate">-</span></p>
                                </div>
                            </div>

                            <input type="hidden" id="service_id" name="service_id">
                            <input type="hidden" id="amount" name="amount">

                            <div class="mb-4">
                                <label for="due_date"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
                                <input type="date" id="due_date" name="due_date" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            <div class="mb-4">
                                <label for="notes"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                <textarea id="notes" name="notes" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" form="createBillForm"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Create Bill
                    </button>
                    <button type="button" id="cancelCreateBill"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        onclick="document.getElementById('createBillModal').classList.add('hidden');">
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
            <div
                class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
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
                                <input type="number" step="0.01" id="payment_amount" name="amount" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            <div class="mb-4">
                                <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Method</label>
                                <select id="payment_method" name="payment_method" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="reference_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reference Number</label>
                                <input type="text" id="reference_number" name="reference_number"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            <div class="mb-4">
                                <label for="payment_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                <textarea id="payment_notes" name="notes" rows="2"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" form="processPaymentForm"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Complete Payment
                    </button>
                    <button type="button" id="cancelProcessPayment"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        onclick="document.getElementById('processPaymentModal').classList.add('hidden');">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <style>
            .modal-visible {
                display: block !important;
                z-index: 9999 !important;
            }
            
            .modal-backdrop {
                background-color: rgba(0, 0, 0, 0.5);
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 9998;
            }
        </style>
        <script>
            // Function to handle patient selection change
            function handlePatientChange(patientId) {
                console.log('Patient changed to ID:', patientId);
                if (!patientId) {
                    // Hide the service info if no patient selected
                    document.getElementById('patientServiceInfo').classList.add('hidden');
                    return;
                }
                
                // Fetch the patient's service info
                fetch(`/patient/${patientId}/services`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Patient service data:', data);
                        if (data.service) {
                            // Set the hidden fields
                            document.getElementById('service_id').value = data.service.id;
                            document.getElementById('amount').value = data.service.price;
                            
                            // Update the info display
                            const infoDiv = document.getElementById('patientServiceInfo');
                            const nameSpan = document.getElementById('patientServiceName');
                            const categorySpan = document.getElementById('patientServiceCategory');
                            const priceSpan = document.getElementById('patientServicePrice');
                            const dateSpan = document.getElementById('patientRegistrationDate');
                            
                            if (infoDiv) {
                                infoDiv.classList.remove('hidden');
                                if (nameSpan) nameSpan.textContent = data.service.name || 'N/A';
                                if (categorySpan) categorySpan.textContent = data.service.category || 'N/A';
                                if (priceSpan) priceSpan.textContent = parseFloat(data.service.price || 0).toFixed(2);
                                
                                // Show current date
                                if (dateSpan) {
                                    const now = new Date();
                                    dateSpan.textContent = now.toLocaleDateString('en-US', {
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    });
                                }
                            }
                        } else {
                            // Hide service info if no service found
                            document.getElementById('patientServiceInfo').classList.add('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching patient service:', error);
                        document.getElementById('patientServiceInfo').classList.add('hidden');
                    });
            }
            
            document.addEventListener('DOMContentLoaded', function () {
                console.log('DOM loaded');
                
                // Get elements
                const createBillModal = document.getElementById('createBillModal');
                const cancelCreateBill = document.getElementById('cancelCreateBill');
                const processPaymentModal = document.getElementById('processPaymentModal');
                const cancelProcessPayment = document.getElementById('cancelProcessPayment');
                const dueDateInput = document.getElementById('due_date');
                
                // Helper function to hide modal
                function hideModal(modal) {
                    if (modal) {
                        modal.classList.add('hidden');
                        modal.classList.remove('modal-visible');
                    }
                }
                
                // Cancel button for create bill modal
                if (cancelCreateBill) {
                    cancelCreateBill.addEventListener('click', function(e) {
                        e.preventDefault();
                        hideModal(createBillModal);
                    });
                }
                
                // Cancel payment button
                if (cancelProcessPayment) {
                    cancelProcessPayment.addEventListener('click', function(e) {
                        e.preventDefault();
                        hideModal(processPaymentModal);
                    });
                }
                
                // Set default due date to 7 days from now
                const defaultDueDate = new Date();
                defaultDueDate.setDate(defaultDueDate.getDate() + 7);
                if (dueDateInput) {
                    dueDateInput.value = defaultDueDate.toISOString().split('T')[0];
                }
                
                // Handle form submission
                const createBillForm = document.getElementById('createBillForm');
                if (createBillForm) {
                    createBillForm.addEventListener('submit', function(e) {
                        // Basic validation
                        if (!document.getElementById('patient_id').value || !dueDateInput.value) {
                            e.preventDefault();
                            alert('Please select a patient and due date');
                            return false;
                        }
                        
                        // Ensure service_id and amount are set
                        if (!document.getElementById('service_id').value || !document.getElementById('amount').value) {
                            e.preventDefault();
                            alert('Service information is missing. Please try again or select a different patient.');
                            return false;
                        }
                        
                        // The form will now submit normally and redirect to the billing page with a success message
                        // After redirect, the patient will be removed from the Recent Patients list
                    });
                }
                
                // Close modals when clicking outside
                window.addEventListener('click', function(e) {
                    if (e.target === createBillModal) {
                        hideModal(createBillModal);
                    }
                    
                    if (e.target === processPaymentModal) {
                        hideModal(processPaymentModal);
                    }
                });
            });
        </script>
    @endpush
</x-tenant-app-layout>