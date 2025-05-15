<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-success">
                <h5 class="modal-title text-white" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-12 text-center">
                        <div class="position-relative mb-3">
                            <img class="avatar avatar-xxl rounded-circle border border-2 border-info" 
                                 src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'User') }}&background=random&size=150" 
                                 alt="{{ $user->name ?? 'User' }}">
                        </div>
                        <h4 class="mt-3 mb-0 user-name">{{ $user->name ?? '' }}</h4>
                        <p class="text-muted mb-1 user-email">{{ $user->email ?? '' }}</p>
                        <div class="d-flex justify-content-center mb-2 user-roles-container">
                            @if(isset($user) && $user->roles)
                                @foreach ($user->roles as $userRole)
                                    <span class="badge bg-gradient-info me-1 px-3">{{ $userRole->name }}</span>
                                @endforeach
                            @endif
                        </div>
                        <p class="text-sm user-joined">
                            @if(isset($user) && $user->created_at)
                                <i class="material-symbols-rounded opacity-5 me-1 text-dark">event</i>
                                Member since {{ $user->created_at->format('M d, Y') }}
                            @endif
                        </p>
                    </div>
                </div>
                
                <form method="POST" action="{{ isset($user) ? route('users.update', $user->id) : '' }}" id="editUserForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text"><i class="material-symbols-rounded opacity-6">person</i></span>
                                <div class="form-floating ps-0">
                                    <input type="text" class="form-control" id="edit_name" name="name" value="{{ old('name', $user->name ?? '') }}" placeholder="Full Name" required>
                                    <label for="edit_name">Full Name</label>
                                </div>
                            </div>
                            @error('name')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text"><i class="material-symbols-rounded opacity-6">email</i></span>
                                <div class="form-floating ps-0">
                                    <input type="email" class="form-control" id="edit_email" name="email" value="{{ old('email', $user->email ?? '') }}" placeholder="Email Address" required>
                                    <label for="edit_email">Email Address</label>
                                </div>
                            </div>
                            @error('email')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-12 mb-4">
                            <label for="roles" class="form-label ms-0 mb-2 d-flex align-items-center">
                                <i class="material-symbols-rounded opacity-6 me-2">badge</i>
                                User Roles
                            </label>
                            <div class="form-check form-check-inline">
                                @foreach ($roles as $role)
                                    <div class="form-check mb-3 me-4">
                                        <input class="form-check-input edit-role-checkbox" type="checkbox" name="roles[]" value="{{ $role->id }}" 
                                            id="edit_role_{{ $role->id }}" 
                                            @if(isset($user) && $user->roles && in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif>
                                        <label class="custom-control-label" for="edit_role_{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('roles')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="material-symbols-rounded opacity-5 me-1">close</i>
                    Cancel
                </button>
                <button type="button" class="btn bg-gradient-warning" onclick="document.getElementById('editUserForm').submit();">
                    <i class="material-symbols-rounded opacity-5 me-1">save</i>
                    Update User
                </button>
            </div>
        </div>
    </div>
</div> 