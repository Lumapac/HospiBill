<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-success">
                <h5 class="modal-title text-white" id="createUserModalLabel">Create New User</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info text-white">
                    <i class="material-symbols-rounded opacity-5 text-white me-2">info</i>
                    New users will receive an email with their login credentials.
                </div>
                
                <form method="POST" action="{{ route('users.store') }}" id="createUserForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text"><i class="material-symbols-rounded opacity-6">person</i></span>
                                <div class="form-floating ps-0">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Full Name" required>
                                    <label for="name">Full Name</label>
                                </div>
                            </div>
                            @error('name')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                            <p class="text-xs text-muted mt-1">Enter the user's full name as it will appear in the system.</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text"><i class="material-symbols-rounded opacity-6">email</i></span>
                                <div class="form-floating ps-0">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                                    <label for="email">Email Address</label>
                                </div>
                            </div>
                            @error('email')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                            <p class="text-xs text-muted mt-1">This email will be used for login and notifications.</p>
                        </div>
                        
                        <div class="col-md-12 mb-4">
                            <label for="roles" class="form-label ms-0 mb-2 d-flex align-items-center">
                                <i class="material-symbols-rounded opacity-6 me-2">badge</i>
                                User Roles
                            </label>
                            <div class="form-check form-check-inline">
                                @foreach ($roles as $role)
                                    <div class="form-check mb-3 me-4">
                                        <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}" 
                                            @if (in_array($role->id, old('roles', []))) checked @endif>
                                        <label class="custom-control-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('roles')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                            <p class="text-xs text-muted">Select at least one role for this user. Roles define what permissions they will have.</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="material-symbols-rounded opacity-5 me-1">close</i>
                    Cancel
                </button>
                <button type="button" class="btn bg-gradient-success" onclick="document.getElementById('createUserForm').submit();">
                    <i class="material-symbols-rounded opacity-5 me-1">save</i>
                    Create User
                </button>
            </div>
        </div>
    </div>
</div> 