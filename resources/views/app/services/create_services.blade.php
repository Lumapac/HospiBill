<!-- Create Modal -->
<div id="serviceModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <!-- Background overlay -->
        <div id="modalBackdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <!-- Modal panel -->
        <div
            class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                            Create New Service
                        </h3>
                        <div class="mt-4">
                            <form id="serviceForm" method="POST" action="{{ route('services.store') }}">
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div class="space-y-2">
                                        <x-input-label for="name" :value="__('Service')" class="text-lg font-medium" />
                                        <x-text-input id="name" class="block w-full shadow-sm" type="text" name="name"
                                            :value="old('name')" placeholder="Enter service name" required autofocus />
                                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                                    </div>

                                    <div class="space-y-2">
                                        <x-input-label for="price" :value="__('Price')" class="text-lg font-medium" />
                                        <div class="relative rounded-md shadow-sm">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">₱</span>
                                            </div>
                                            <x-text-input id="price" class="block w-full pl-7" type="number" min="0"
                                                step="0.01" name="price" :value="old('price')" placeholder="0.00"
                                                required />
                                        </div>
                                        <x-input-error :messages="$errors->get('price')" class="mt-1" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div class="space-y-2">
                                        <x-input-label for="category" :value="__('Category')"
                                            class="text-lg font-medium" />
                                        <select id="category" name="category"
                                            class="block w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                            required>
                                            <option value="">Select Category</option>
                                            <option value="Consultation" {{ old('category') == 'Consultation' ? 'selected' : '' }}>Consultation</option>
                                            <option value="Laboratory" {{ old('category') == 'Laboratory' ? 'selected' : '' }}>Laboratory</option>
                                            <option value="Surgery" {{ old('category') == 'Surgery' ? 'selected' : '' }}>
                                                Surgery</option>
                                            <option value="Therapy" {{ old('category') == 'Therapy' ? 'selected' : '' }}>
                                                Therapy</option>
                                            <option value="Diagnostic" {{ old('category') == 'Diagnostic' ? 'selected' : '' }}>Diagnostic</option>
                                            <option value="Wellness" {{ old('category') == 'Wellness' ? 'selected' : '' }}>Wellness</option>
                                            <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other
                                            </option>
                                        </select>
                                        <x-input-error :messages="$errors->get('category')" class="mt-1" />
                                    </div>

                                    <div class="space-y-2">
                                        <x-input-label for="duration" :value="__('Duration')"
                                            class="text-lg font-medium" />
                                        <div class="relative rounded-md shadow-sm">
                                            <x-text-input id="duration" class="block w-full" type="text" name="duration"
                                                :value="old('duration')" placeholder="e.g. 30 minutes, 1 hour" />
                                            <div
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">⏱️</span>
                                            </div>
                                        </div>
                                        <x-input-error :messages="$errors->get('duration')" class="mt-1" />
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <x-input-label for="description" :value="__('Description')"
                                        class="text-lg font-medium" />
                                    <textarea id="description" name="description" rows="3"
                                        class="block mt-1 w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        placeholder="Provide detailed information about this service">{{ old('description') }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-1" />
                                </div>

                                <div class="mb-6">
                                    <x-input-label for="requirements" :value="__('Requirements')"
                                        class="text-lg font-medium" />
                                    <textarea id="requirements" name="requirements" rows="2"
                                        class="block mt-1 w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        placeholder="List any prerequisites or requirements">{{ old('requirements') }}</textarea>
                                    <x-input-error :messages="$errors->get('requirements')" class="mt-1" />
                                </div>

                                <div class="mb-6">
                                    <x-input-label for="availability" :value="__('Availability')"
                                        class="text-lg font-medium" />
                                    <div class="relative rounded-md shadow-sm">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">📅</span>
                                        </div>
                                        <x-text-input id="availability" class="block w-full pl-10" type="text"
                                            name="availability" :value="old('availability')"
                                            placeholder="e.g. Mon-Fri, 9am-5pm" />
                                    </div>
                                    <x-input-error :messages="$errors->get('availability')" class="mt-1" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="submitForm"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Create Service
                </button>
                <button type="button" id="closeModal"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-gray-600 dark:text-gray-200 dark:border-gray-500 dark:hover:bg-gray-700">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>