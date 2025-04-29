<!-- Create Modal -->
<div id="patientModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog"
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
                            Register Patient
                        </h3>
                        <div class="mt-4">
                            <form id="patientForm" method="POST" action="{{ route('patient.store') }}">
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div class="space-y-2">
                                        <x-input-label for="first_name" :value="__('First Name')"
                                            class="text-lg font-medium" />
                                        <x-text-input id="first_name" class="block w-full shadow-sm" type="text"
                                            name="first_name" :value="old('first_name')" placeholder="Enter first name"
                                            required autofocus />
                                        <x-input-error :messages="$errors->get('first_name')" class="mt-1" />
                                    </div>

                                    <div class="space-y-2">
                                        <x-input-label for="last_name" :value="__('Family Name')"
                                            class="text-lg font-medium" />
                                        <x-text-input id="last_name" class="block w-full shadow-sm" type="text"
                                            name="last_name" :value="old('last_name')" placeholder="Enter family name"
                                            required />
                                        <x-input-error :messages="$errors->get('last_name')" class="mt-1" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div class="space-y-2">
                                        <x-input-label for="date_of_birth" :value="__('Date of Birth')"
                                            class="text-lg font-medium" />
                                        <x-text-input id="date_of_birth" class="block w-full shadow-sm" type="date"
                                            name="date_of_birth" :value="old('date_of_birth')" required />
                                        <x-input-error :messages="$errors->get('date_of_birth')" class="mt-1" />
                                    </div>

                                    <div class="space-y-2">
                                        <x-input-label for="gender" :value="__('Gender')" class="text-lg font-medium" />
                                        <select id="gender" name="gender"
                                            class="block w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                            required>
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                Female</option>
                                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other
                                            </option>
                                        </select>
                                        <x-input-error :messages="$errors->get('gender')" class="mt-1" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div class="space-y-2">
                                        <x-input-label for="email" :value="__('Email')" class="text-lg font-medium" />
                                        <x-text-input id="email" class="block w-full shadow-sm" type="email"
                                            name="email" :value="old('email')" placeholder="patient@example.com" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                                    </div>

                                    <div class="space-y-2">
                                        <x-input-label for="phone" :value="__('Phone Number')"
                                            class="text-lg font-medium" />
                                        <x-text-input id="phone" class="block w-full shadow-sm" type="text" name="phone"
                                            :value="old('phone')" placeholder="e.g. 09123456789" required />
                                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <x-input-label for="address" :value="__('Address')" class="text-lg font-medium" />
                                    <textarea id="address" name="address" rows="2"
                                        class="block mt-1 w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        placeholder="Enter complete address">{{ old('address') }}</textarea>
                                    <x-input-error :messages="$errors->get('address')" class="mt-1" />
                                </div>

                                <div class="mb-6">
                                    <x-input-label for="service_id" :value="__('Service')"
                                        class="text-lg font-medium" />
                                    <select id="service_id" name="service_id"
                                        class="block w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        required>
                                        <option value="">Select Service</option>

                                        @foreach(is_iterable($services) ? $services : [] as $service)
                                            <option value="{{ is_object($service) ? $service->id : '' }}" {{ old('service_id') == (is_object($service) ? $service->id : '') ? 'selected' : '' }}>
                                                {{ is_object($service) ? $service->name : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('service_id')" class="mt-1" />
                                </div>

                                <div class="mb-6">
                                    <x-input-label for="notes" :value="__('Additional Notes')"
                                        class="text-lg font-medium" />
                                    <textarea id="notes" name="notes" rows="3"
                                        class="block mt-1 w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        placeholder="Any additional information">{{ old('notes') }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-1" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="submitForm"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Register Patient
                </button>
                <button type="button" id="closeModal"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-gray-600 dark:text-gray-200 dark:border-gray-500 dark:hover:bg-gray-700">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>