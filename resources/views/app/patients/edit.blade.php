<x-tenant-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Patient') }}
            <a href="{{ route('patient.index') }}" class="ml-4 float-right inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-800 focus:outline-none focus:border-gray-700 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Back to Patients
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('patient.update', $patient) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2">
                                <x-input-label for="first_name" :value="__('First Name')"
                                    class="text-lg font-medium" />
                                <x-text-input id="first_name" class="block w-full shadow-sm" type="text"
                                    name="first_name" :value="old('first_name', $patient->first_name)" required autofocus />
                                <x-input-error :messages="$errors->get('first_name')" class="mt-1" />
                            </div>

                            <div class="space-y-2">
                                <x-input-label for="last_name" :value="__('Family Name')"
                                    class="text-lg font-medium" />
                                <x-text-input id="last_name" class="block w-full shadow-sm" type="text"
                                    name="last_name" :value="old('last_name', $patient->last_name)" required />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-1" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2">
                                <x-input-label for="date_of_birth" :value="__('Date of Birth')"
                                    class="text-lg font-medium" />
                                <x-text-input id="date_of_birth" class="block w-full shadow-sm" type="date"
                                    name="date_of_birth" :value="old('date_of_birth', $patient->date_of_birth)" required />
                                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-1" />
                            </div>

                            <div class="space-y-2">
                                <x-input-label for="gender" :value="__('Gender')" class="text-lg font-medium" />
                                <select id="gender" name="gender"
                                    class="block w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required>
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender', $patient->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-1" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2">
                                <x-input-label for="email" :value="__('Email')" class="text-lg font-medium" />
                                <x-text-input id="email" class="block w-full shadow-sm" type="email"
                                    name="email" :value="old('email', $patient->email)" placeholder="patient@example.com" />
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>

                            <div class="space-y-2">
                                <x-input-label for="phone" :value="__('Phone Number')"
                                    class="text-lg font-medium" />
                                <x-text-input id="phone" class="block w-full shadow-sm" type="text" name="phone"
                                    :value="old('phone', $patient->phone)" placeholder="e.g. 09123456789" required />
                                <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                            </div>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="address" :value="__('Address')" class="text-lg font-medium" />
                            <textarea id="address" name="address" rows="2"
                                class="block mt-1 w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Enter complete address">{{ old('address', $patient->address) }}</textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-1" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="service_id" :value="__('Service')"
                                class="text-lg font-medium" />
                            <select id="service_id" name="service_id"
                                class="block w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                                <option value="">Select Service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id', $patient->service_id) == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }} - ₱{{ number_format($service->price, 2) }}
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
                                placeholder="Any additional information">{{ old('notes', $patient->notes) }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-1" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ml-4">
                                {{ __('Update Patient') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-tenant-app-layout> 