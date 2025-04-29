<x-tenant-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Services') }}

            <button id="openModal" class="ml-4 float-right inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                Add Service
            </button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded relative" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-4 rounded relative" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Service Name</th>
                                    <th scope="col" class="px-6 py-3">Category</th>
                                    <th scope="col" class="px-6 py-3">Price</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($services as $service)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">{{ $service->name }}</td>
                                        <td class="px-6 py-4">{{ $service->category }}</td>
                                        <td class="px-6 py-4">₱{{ number_format($service->price, 2) }}</td>
                                        <td class="px-6 py-4">
                                            <button type="button" class="edit-service text-blue-600 hover:underline mr-2" 
                                                data-id="{{ $service->id }}"
                                                data-name="{{ $service->name }}"
                                                data-category="{{ $service->category }}"
                                                data-price="{{ $service->price }}"
                                                data-description="{{ $service->description }}"
                                                data-duration="{{ $service->duration }}"
                                                data-requirements="{{ $service->requirements }}"
                                                data-availability="{{ $service->availability }}">
                                                Edit
                                            </button>
                                            <form method="POST" action="{{ route('services.destroy', $service) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this service? If any patients are using this service, the deletion will be prevented.')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="4" class="px-6 py-4 text-center">No services found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   @include('app.services.create_services');
   @include('app.services.edit_services');
   
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create modal functionality
            const modal = document.getElementById('serviceModal');
            const openButton = document.getElementById('openModal');
            const closeButton = document.getElementById('closeModal');
            const backdrop = document.getElementById('modalBackdrop');
            const submitButton = document.getElementById('submitForm');
            const form = document.getElementById('serviceForm');
            const priceInput = document.getElementById('price');
            
            // Edit modal functionality
            const editModal = document.getElementById('editServiceModal');
            const editButtons = document.querySelectorAll('.edit-service');
            const closeEditButton = document.getElementById('closeEditModal');
            const editBackdrop = document.getElementById('editModalBackdrop');
            const submitEditButton = document.getElementById('submitEditForm');
            const editForm = document.getElementById('editServiceForm');
            const editPriceInput = document.getElementById('edit-price');
            
            // Prevent negative numbers in price fields
            priceInput.addEventListener('input', function(e) {
                if (this.value < 0) {
                    this.value = 0;
                }
            });
            
            editPriceInput.addEventListener('input', function(e) {
                if (this.value < 0) {
                    this.value = 0;
                }
            });
            
            // Create modal functions
            function openModal() {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }
            
            function closeModal() {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                form.reset();
            }
            
            // Edit modal functions
            function openEditModal(serviceData) {
                // Set the form action URL
                editForm.action = `/services/${serviceData.id}`;
                
                // Fill in the form fields with the service data
                document.getElementById('edit-name').value = serviceData.name;
                document.getElementById('edit-price').value = serviceData.price;
                document.getElementById('edit-category').value = serviceData.category;
                document.getElementById('edit-duration').value = serviceData.duration;
                document.getElementById('edit-description').value = serviceData.description;
                document.getElementById('edit-requirements').value = serviceData.requirements;
                document.getElementById('edit-availability').value = serviceData.availability;
                
                // Show the modal
                editModal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }
            
            function closeEditModal() {
                editModal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                editForm.reset();
            }
            
            // Event listeners for create modal
            openButton.addEventListener('click', openModal);
            closeButton.addEventListener('click', closeModal);
            backdrop.addEventListener('click', closeModal);
            
            submitButton.addEventListener('click', function() {
                form.submit();
            });
            
            // Event listeners for edit modal
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const serviceData = {
                        id: this.getAttribute('data-id'),
                        name: this.getAttribute('data-name'),
                        category: this.getAttribute('data-category'),
                        price: this.getAttribute('data-price'),
                        description: this.getAttribute('data-description'),
                        duration: this.getAttribute('data-duration'),
                        requirements: this.getAttribute('data-requirements'),
                        availability: this.getAttribute('data-availability')
                    };
                    openEditModal(serviceData);
                });
            });
            
            closeEditButton.addEventListener('click', closeEditModal);
            editBackdrop.addEventListener('click', closeEditModal);
            
            submitEditButton.addEventListener('click', function() {
                editForm.submit();
            });
            
            // Close modals when pressing Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    if (!modal.classList.contains('hidden')) {
                        closeModal();
                    }
                    if (!editModal.classList.contains('hidden')) {
                        closeEditModal();
                    }
                }
            });
        });
    </script>
</x-tenant-app-layout>