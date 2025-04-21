<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tenants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Session Status -->
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    
                    @if (session('info'))
                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
                            <p>{{ session('info') }}</p>
                        </div>
                    @endif
                    
                    <div class="mb-6 flex justify-end">
                        <a href="{{ route('tenants.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Create New Tenant
                        </a>
                    </div>
                    
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Domain Name</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
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
                                            {!! $tenant->status_badge !!}
                                        </td>
                                        <td class="px-6 py-4 flex space-x-2">
                                            <a href="{{ route('tenants.show', $tenant) }}" class="px-3 py-1 text-xs text-blue-600 hover:text-blue-900">View</a>
                                            <a href="{{ route('tenants.edit', $tenant) }}" class="px-3 py-1 text-xs text-gray-600 hover:text-gray-900">Edit</a>
                                            
                                            @if($tenant->status === 'pending')
                                                <form action="{{ route('tenants.approve', $tenant) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="px-3 py-1 text-xs text-green-600 hover:text-green-900">Approve</button>
                                                </form>
                                                
                                                <button 
                                                    type="button" 
                                                    class="px-3 py-1 text-xs text-red-600 hover:text-red-900 reject-btn"
                                                    data-tenant-id="{{ $tenant->id }}"
                                                    data-tenant-name="{{ $tenant->name }}"
                                                >
                                                    Reject
                                                </button>
                                            @endif
                                            
                                            <form action="{{ route('tenants.destroy', $tenant) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 text-xs text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this tenant?')">Delete</button>
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
    </div>
    
    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-xl font-bold mb-4">Reject Tenant Application</h3>
            <p class="mb-4">Please provide a reason for rejecting <span id="tenantName" class="font-semibold"></span>'s application:</p>
            
            <form id="rejectForm" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="mb-4">
                    <label for="admin_notes" class="block text-sm font-medium text-gray-700">Notes/Reason</label>
                    <textarea 
                        id="admin_notes" 
                        name="admin_notes" 
                        rows="4" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required
                    ></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button 
                        type="button" 
                        id="cancelReject"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit" 
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                    >
                        Reject Application
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rejectButtons = document.querySelectorAll('.reject-btn');
            const rejectModal = document.getElementById('rejectModal');
            const cancelButton = document.getElementById('cancelReject');
            const tenantNameSpan = document.getElementById('tenantName');
            const rejectForm = document.getElementById('rejectForm');
            
            rejectButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tenantId = this.getAttribute('data-tenant-id');
                    const tenantName = this.getAttribute('data-tenant-name');
                    
                    tenantNameSpan.textContent = tenantName;
                    rejectForm.action = `/tenants/${tenantId}/reject`;
                    rejectModal.classList.remove('hidden');
                });
            });
            
            cancelButton.addEventListener('click', function() {
                rejectModal.classList.add('hidden');
                rejectForm.reset();
            });
        });
    </script>
</x-app-layout>