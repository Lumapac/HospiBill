<x-tenant-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Patient Details') }}
            <a href="{{ route('patient.index') }}"
                class="ml-4 float-right inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-800 focus:outline-none focus:border-gray-700 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Back to Patients
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Personal Information
                            </h3>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                                <p class="mb-2"><span class="font-medium">Name:</span> {{ $patient->first_name }}
                                    {{ $patient->last_name }}</p>
                                <p class="mb-2"><span class="font-medium">Date of Birth:</span>
                                    {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('F d, Y') }}</p>
                                <p class="mb-2"><span class="font-medium">Gender:</span> {{ ucfirst($patient->gender) }}
                                </p>
                                <p class="mb-2"><span class="font-medium">Email:</span>
                                    {{ $patient->email ?? 'Not provided' }}</p>
                                <p><span class="font-medium">Phone:</span> {{ $patient->phone }}</p>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Service & Address</h3>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                                <p class="mb-2"><span class="font-medium">Service:</span>
                                    {{ $patient->service->name ?? 'N/A' }}</p>
                                <p class="mb-2"><span class="font-medium">Price:</span>
                                    ₱{{ number_format($patient->service->price ?? 0, 2) }}</p>
                                <p><span class="font-medium">Address:</span> {{ $patient->address ?? 'Not provided' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Additional Notes</h3>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                            <p>{{ $patient->notes ?? 'No additional notes.' }}</p>
                        </div>
                    </div>

                    <div class="flex space-x-4 mt-6">
                        <a href="{{ route('patient.edit', $patient) }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:border-yellow-700 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Edit Patient
                        </a>
                        <form method="POST" action="{{ route('patient.destroy', $patient) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150"
                                onclick="return confirm('Are you sure you want to delete this patient?')">
                                Delete Patient
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-tenant-app-layout>