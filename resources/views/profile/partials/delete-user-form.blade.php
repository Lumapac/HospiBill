<section>
    <p class="text-sm">
        Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
    </p>
    
    <button type="button" class="btn bg-gradient-danger mt-3" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
        Delete Account
    </button>
    
    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    
                    <div class="modal-body">
                        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                        <p>All data associated with this account will be permanently removed from the system.</p>
                        
                        <div class="input-group input-group-static mb-0">
                            <label for="delete-account-password">Password</label>
                            <input type="password" class="form-control" id="delete-account-password" name="password" required>
                            @error('password', 'userDeletion')
                                <div class="text-danger text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn bg-gradient-danger">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
