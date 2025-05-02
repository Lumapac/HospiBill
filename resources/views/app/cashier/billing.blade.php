<x-tenant-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Billing') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Unpaid Bills</h3>
                        <div class="flex space-x-2">
                            <input type="text" placeholder="Search patient..."
                                class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Bill ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Patient Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Service</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Amount Due</th>
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
                                <!-- Sample rows, replace with actual data -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">BILL-001</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Maria Santos</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Laboratory Test</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-red-600">₱2,500.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ now()->addDays(7)->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <button
                                                class="text-white bg-green-500 hover:bg-green-600 px-3 py-1 rounded-md text-sm">
                                                Process Payment
                                            </button>
                                            <button class="text-blue-600 hover:text-blue-900 text-sm">
                                                View Details
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">BILL-002</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Juan Cruz</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Consultation</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-red-600">₱1,000.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ now()->addDays(3)->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Overdue</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <button
                                                class="text-white bg-green-500 hover:bg-green-600 px-3 py-1 rounded-md text-sm">
                                                Process Payment
                                            </button>
                                            <button class="text-blue-600 hover:text-blue-900 text-sm">
                                                View Details
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="mt-4 flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Showing 1 to 2 of 2 entries
                        </div>
                        <div class="flex space-x-2">
                            <button
                                class="px-3 py-1 rounded bg-gray-200 text-gray-700 disabled:opacity-50">Previous</button>
                            <button
                                class="px-3 py-1 rounded bg-gray-200 text-gray-700 disabled:opacity-50">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-tenant-app-layout>