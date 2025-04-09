<x-tenant-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tenants') }}

            <x-btn-link class="ml-4 float-right" href="{{ route('tenants.create') }}">Add Tenant</x-btn-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Domain Name</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenants as $tenant)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $tenant->name }}
                                        </td>
                                        <td class="px-6 py-4">{{ $tenant->email }}</td>
                                        <td class="px-6 py-4">
                                            @foreach ($tenant->domains as $domain)
                                                {{ $domain->domain }}{{ $loop->last ? '' : ', ' }}
                                            @endforeach
                                        </td>

                                        <td class="px-6 py-4">
                                            <x-btn-link href="{{ route('tenants.edit', $tenant) }}">Edit</x-btn-link>
                                            <form action="{{ route('tenants.destroy', $tenant) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button type="submit"
                                                    onclick="return confirm('Are you sure?')">Delete</x-danger-button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</x-tenant-app-layout>