<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('View Tenant') }}: {{ $tenant->name }}
            </h2>
            <a href="{{ route('tenants.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium mb-4">Tenant Information</h3>
                            
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</p>
                                <p class="mt-1">{{ $tenant->name }}</p>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                                <p class="mt-1">{{ $tenant->email }}</p>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Contact Person</p>
                                <p class="mt-1">{{ $tenant->contact_person }}</p>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone Number</p>
                                <p class="mt-1">{{ $tenant->phone_number }}</p>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Domain</p>
                                <p class="mt-1">
                                    @foreach ($tenant->domains as $domain)
                                        {{ $domain->domain }}{{ $loop->last ? '' : ', ' }}
                                    @endforeach
                                </p>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                                <div class="mt-1">{!! $tenant->status_badge !!}</div>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</p>
                                <p class="mt-1">{{ $tenant->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-medium mb-4">Admin Notes</h3>
                            <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-md min-h-[200px]">
                                @if($tenant->admin_notes)
                                    {{ $tenant->admin_notes }}
                                @else
                                    <p class="text-gray-500 dark:text-gray-400 italic">No notes available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex space-x-4">
                        <a href="{{ route('tenants.edit', $tenant) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Edit Tenant
                        </a>
                        
                        @if($tenant->status === 'pending')
                            <form action="{{ route('tenants.approve', $tenant) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                    Approve Application
                                </button>
                            </form>
                            
                            <button 
                                type="button" 
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 reject-btn"
                                data-tenant-id="{{ $tenant->id }}"
                                data-tenant-name="{{ $tenant->name }}"
                            >
                                Reject Application
                            </button>
                        @endif
                        
                        <form action="{{ route('tenants.destroy', $tenant) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this tenant? This action cannot be undone.')">
                                Delete Tenant
                            </button>
                        </form>
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