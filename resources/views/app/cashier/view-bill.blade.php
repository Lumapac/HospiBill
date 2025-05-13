<x-tenant-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Bill Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('patient.bill') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Back to Billing
                </a>
                <a href="{{ route('patient.bill.pdf', $bill->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download PDF
                </a>
                @if($bill->status !== 'paid')
                <button type="button"
                    onclick="document.getElementById('processPaymentModal').style.display = 'block';"
                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-300 disabled:opacity-25 transition">
                    Process Payment
                </button>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Status Messages -->
            @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
            @endif

            @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p>{{ session('error') }}</p>
            </div>
            @endif

            <!-- Bill Information Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Bill Information</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">Bill Number:</span> {{ $bill->bill_number }}</p>
                                <p><span class="font-medium">Created Date:</span> {{ $bill->created_at->format('M d, Y') }}</p>
                                <p><span class="font-medium">Due Date:</span> {{ \Carbon\Carbon::parse($bill->due_date)->format('M d, Y') }}</p>
                                <p><span class="font-medium">Status:</span> 
                                    @if($bill->status === 'pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    @elseif($bill->status === 'partially_paid')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Partially Paid</span>
                                    @elseif($bill->status === 'overdue')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Overdue</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ ucfirst($bill->status) }}</span>
                                    @endif
                                </p>
                                @if($bill->notes)
                                <p><span class="font-medium">Notes:</span> {{ $bill->notes }}</p>
                                @endif
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Patient Information</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">Patient Name:</span> {{ $bill->patient->first_name }} {{ $bill->patient->last_name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $bill->patient->email }}</p>
                                <p><span class="font-medium">Phone:</span> {{ $bill->patient->phone }}</p>
                                <p><span class="font-medium">Service:</span> {{ $bill->service->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial Summary Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Financial Summary</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Amount</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">₱{{ number_format($bill->amount, 2) }}</p>
                        </div>
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Amount Paid</p>
                            <p class="text-2xl font-bold text-green-600">₱{{ number_format($bill->amount_paid, 2) }}</p>
                        </div>
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Remaining Balance</p>
                            <p class="text-2xl font-bold text-red-600">₱{{ number_format($bill->amount - $bill->amount_paid, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment History -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Payment History</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Payment Method</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Reference #</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Processed By</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Notes</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($bill->payments as $payment)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $payment->created_at->format('M d, Y h:i A') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-green-600">₱{{ number_format($payment->amount, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($payment->payment_method) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $payment->reference_number ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $payment->cashier->name ?? 'Unknown' }}</td>
                                    <td class="px-6 py-4">{{ $payment->notes ?? 'N/A' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No payment records found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Payment Modal -->
    <div id="processPaymentModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
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
                                Amount Due: PHP <span id="paymentAmountDue" class="font-bold"></span>
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
                    <button type="button" onclick="closePaymentModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Pre-fill the form with bill data
        const billId = "{{ $bill->id }}";
        const billNumber = "{{ $bill->bill_number }}";
        const patientName = "{{ $bill->patient->first_name }} {{ $bill->patient->last_name }}";
        const amountDue = "{{ $bill->amount - $bill->amount_paid }}";
        
        // Function to close the payment modal
        function closePaymentModal() {
            document.getElementById('processPaymentModal').style.display = 'none';
        }
        
        // Set the values when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('paymentPatientName').textContent = patientName;
            document.getElementById('paymentBillNumber').textContent = billNumber;
            document.getElementById('paymentAmountDue').textContent = parseFloat(amountDue).toFixed(2);
            
            document.getElementById('payment_amount').value = amountDue;
            document.getElementById('payment_amount').max = amountDue;
            document.getElementById('reference_number').value = billNumber;
            
            document.getElementById('processPaymentForm').action = `/billing/${billId}/process-payment`;
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            const modal = document.getElementById('processPaymentModal');
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</x-tenant-app-layout> 