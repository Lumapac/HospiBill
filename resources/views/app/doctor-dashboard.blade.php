<x-tenant-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Doctor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Stats Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <h3 class="text-lg font-semibold mb-2">Total Patients</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ $totalPatients }}</p>
                        </div>
                        <div class="text-center">
                            <h3 class="text-lg font-semibold mb-2">Patients Today</h3>
                            <p class="text-3xl font-bold text-green-600">
                                {{ $recentPatients->where('created_at', '>=', \Carbon\Carbon::today())->count() }}
                            </p>
                        </div>
                        <div class="text-center">
                            <h3 class="text-lg font-semibold mb-2">Available Services</h3>
                            <p class="text-3xl font-bold text-purple-600">{{ $patientsByService->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Patients -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Recent Patients</h3>
                    @if($recentPatients->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Service</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($recentPatients as $patient)
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $patient->first_name }} {{ $patient->last_name }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $patient->service->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $patient->created_at->format('M d, Y') }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <a href="{{ route('patient.show', $patient->id) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No recent patients.</p>
                    @endif
                </div>
            </div>

            <!-- Patients by Service -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Patients by Service</h3>
                    @if($patientsByService->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Service</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Patient Count</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($patientsByService as $service)
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $service->name }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $service->category }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $service->patients_count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No services data available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-tenant-app-layout>