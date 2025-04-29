<x-tenant-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Patient') }}

            <button id="openModal"
                class="ml-4 float-right inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                Register Patient
            </button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded relative"
                            role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Firstname</th>
                                    <th scope="col" class="px-6 py-3">Family Name</th>
                                    <th scope="col" class="px-6 py-3">Service Avail</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($patients as $patient)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $patient->first_name }}</td>
                                        <td class="px-6 py-4">{{ $patient->last_name }}</td>
                                        <td class="px-6 py-4">{{ $patient->service->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 space-x-2">
                                            <a href="{{ route('patient.show', $patient) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                                            <a href="{{ route('patient.edit', $patient) }}" class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Edit</a>
                                            <form method="POST" action="{{ route('patient.destroy', $patient) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this patient?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center">No patients found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   @include('app.patients.patient_modal_form', ['services' => $services ?? App\Models\Service::select('id', 'name', 'price')->orderBy('name')->get()])
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Create modal functionality
            const modal = document.getElementById('patientModal');
            const openButton = document.getElementById('openModal');
            const closeButton = document.getElementById('closeModal');
            const backdrop = document.getElementById('modalBackdrop');
            const submitButton = document.getElementById('submitForm');
            const form = document.getElementById('patientForm');

            // Create modal functions
            function openModal() {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeModal() {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                if (form) form.reset();
            }
            
            // Event listeners for create modal
            openButton.addEventListener('click', openModal);
            closeButton.addEventListener('click', closeModal);
            backdrop.addEventListener('click', closeModal);
            
            submitButton.addEventListener('click', function() {
                if (form) form.submit();
            });
            
            // Close modal when pressing Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
            
            // We don't need this anymore since we're loading services from the backend directly
            /*
            // Fetch services for the dropdown
            fetch('/services/list')
                .then(response => response.json())
                .then(services => {
                    const serviceSelect = document.getElementById('service_id');
                    if (serviceSelect) {
                        services.forEach(service => {
                            const option = document.createElement('option');
                            option.value = service.id;
                            option.textContent = service.name;
                            serviceSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error fetching services:', error));
            */
        });
    </script>
</x-tenant-app-layout>