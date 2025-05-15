@extends('app.layouts.sidebar')
@section('title', 'User Management')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('layouts.navbar', ['title' => 'User Management'])
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div
                            class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3 mb-0">Users List</h6>
                            <button type="button" class="btn bg-gradient-dark mb-0 me-3" data-bs-toggle="modal"
                                data-bs-target="#createUserModal">
                                <i class="material-symbols-rounded opacity-5 text-white me-1">add</i>
                                Add New User
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible text-white mx-3" role="alert">
                                <span class="text-sm">{{ session('success') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                    @endif
                    
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Email</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Role</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Status</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                            Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                                                            class="avatar avatar-sm me-3 border-radius-lg"
                                                            alt="{{ $user->name }}">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">Joined
                                                            {{ $user->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                        </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                            @foreach ($user->roles as $role)
                                                        <span class="badge bg-gradient-info me-1">{{ $role->name }}</span>
                                            @endforeach
                                                </div>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <span class="badge badge-sm bg-gradient-success">Active</span>
                                        </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-center action-buttons">

                                                    <button type="button"
                                                        class="btn btn-link text-info mb-0 me-2 viewUserBtn"
                                                        data-bs-toggle="modal" data-bs-target="#viewUserModal"
                                                        data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}"
                                                        data-user-email="{{ $user->email }}"
                                                        data-user-roles="{{ json_encode($user->roles->pluck('id')) }}"
                                                        data-user-roles-names="{{ json_encode($user->roles->pluck('name')) }}"
                                                        data-user-created="{{ $user->created_at->format('M d, Y') }}"
                                                        data-user-updated="{{ $user->updated_at->format('M d, Y g:i A') }}"
                                                        data-toggle="tooltip" data-placement="top" title="View Details">
                                                        <i
                                                            class="material-symbols-rounded text-lg position-relative">visibility</i>
                                                        <span class="sr-only">View</span>
                                                    </button>

                                                    <button type="button" class="btn btn-link text-warning mb-0 me-2 editUserBtn"
                                                        data-bs-toggle="modal" data-bs-target="#editUserModal"
                                                        data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}"
                                                        data-user-email="{{ $user->email }}"
                                                        data-user-roles="{{ json_encode($user->roles->pluck('id')) }}"
                                                        data-user-roles-names="{{ json_encode($user->roles->pluck('name')) }}"
                                                        data-user-created="{{ $user->created_at->format('M d, Y') }}"
                                                        data-toggle="tooltip" data-placement="top" title="Edit User">
                                                        <i class="material-symbols-rounded text-lg position-relative">edit</i>
                                                        <span class="sr-only">Edit</span>
                                                    </button>

                                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                        class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-danger mb-0"
                                                            data-toggle="tooltip" data-placement="top" title="Delete User"
                                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                                            <i
                                                                class="material-symbols-rounded text-lg position-relative">delete</i>
                                                            <span class="sr-only">Delete</span>
                                                        </button>
                                            </form>
                                                </div>
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
        </div>

        <!-- Include Create User Modal -->
        @include('app.users.create-modal')

        <!-- Include Edit User Modal -->
        @include('app.users.edit-modal', ['user' => null])

        <!-- Include View User Modal -->
        @include('app.users.view-modal')
    </main>

    <style>
        .action-buttons .btn-link {
            padding: 5px;
            margin: 0 2px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .action-buttons .btn-link:hover {
            background-color: rgba(233, 236, 239, 0.8);
            transform: translateY(-3px);
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
        }

        .action-buttons .text-info:hover {
            color: #11cdef !important;
        }

        .action-buttons .text-dark:hover {
            color: #344767 !important;
        }

        .action-buttons .text-warning:hover {
            color: #fb6340 !important;
        }

        .action-buttons .text-danger:hover {
            color: #f5365c !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
            if (typeof bootstrap !== 'undefined') {
                tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                });
            }

            // Show create modal on error
            @if($errors->any() && session('editing') !== true)
                var createUserModal = new bootstrap.Modal(document.getElementById('createUserModal'));
                createUserModal.show();
            @elseif($errors->any() && session('editing') === true)
                var editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
                editUserModal.show();
            @endif

                // Setup edit buttons
                const editButtons = document.querySelectorAll('.editUserBtn');
            const editModal = document.getElementById('editUserModal');
            const editForm = document.getElementById('editUserForm');

            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.dataset.userId;
                    const userName = this.dataset.userName;
                    const userEmail = this.dataset.userEmail;
                    const userRoles = JSON.parse(this.dataset.userRoles);
                    const userRolesNames = JSON.parse(this.dataset.userRolesNames);
                    const userCreated = this.dataset.userCreated;

                    // Update form action
                    editForm.action = "{{ url('users') }}/" + userId;

                    // Update user info in modal header
                    const modalTitle = document.querySelector('#editUserModal .modal-title');
                    modalTitle.textContent = "Edit User: " + userName;

                    // Update user avatar
                    const avatarSrc = `https://ui-avatars.com/api/?name=${encodeURIComponent(userName)}&background=random&size=150`;
                    document.querySelector('#editUserModal .avatar').src = avatarSrc;

                    // Update profile info
                    document.querySelector('#editUserModal h4').textContent = userName;
                    document.querySelector('#editUserModal .text-muted').textContent = userEmail;

                    // Clear existing role badges
                    const badgeContainer = document.querySelector('#editUserModal .d-flex.justify-content-center');
                    badgeContainer.innerHTML = '';

                    // Add role badges
                    userRolesNames.forEach(roleName => {
                        const badge = document.createElement('span');
                        badge.className = 'badge bg-gradient-info me-1 px-3';
                        badge.textContent = roleName;
                        badgeContainer.appendChild(badge);
                    });

                    // Update joined date
                    document.querySelector('#editUserModal .text-sm').innerHTML =
                        `<i class="material-symbols-rounded opacity-5 me-1 text-dark">event</i> Member since ${userCreated}`;

                    // Update form fields
                    document.getElementById('edit_name').value = userName;
                    document.getElementById('edit_email').value = userEmail;

                    // Reset all checkboxes
                    document.querySelectorAll('.edit-role-checkbox').forEach(checkbox => {
                        checkbox.checked = false;
                    });

                    // Check appropriate roles
                    userRoles.forEach(roleId => {
                        const checkbox = document.getElementById(`edit_role_${roleId}`);
                        if (checkbox) checkbox.checked = true;
                    });
                });
            });

            // Setup view buttons
            const viewButtons = document.querySelectorAll('.viewUserBtn');

            viewButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.dataset.userId;
                    const userName = this.dataset.userName;
                    const userEmail = this.dataset.userEmail;
                    const userRolesNames = JSON.parse(this.dataset.userRolesNames);
                    const userCreated = this.dataset.userCreated;
                    const userUpdated = this.dataset.userUpdated;

                    // Update modal title
                    document.querySelector('#viewUserModal .modal-title').textContent = "User Details: " + userName;

                    // Update avatar
                    const avatarSrc = `https://ui-avatars.com/api/?name=${encodeURIComponent(userName)}&background=random&size=150`;
                    document.getElementById('view-user-avatar').src = avatarSrc;

                    // Update user info in left card
                    document.getElementById('view-user-name').textContent = userName;
                    document.getElementById('view-user-email').textContent = userEmail;

                    // Clear existing role badges
                    const rolesContainer = document.getElementById('view-user-roles');
                    rolesContainer.innerHTML = '';

                    // Add role badges
                    userRolesNames.forEach(roleName => {
                        const badge = document.createElement('span');
                        badge.className = 'badge bg-gradient-info me-1 px-3 mb-1';
                        badge.textContent = roleName;
                        rolesContainer.appendChild(badge);
                    });

                    // Update details in right card
                    document.getElementById('view-detail-name').textContent = userName;
                    document.getElementById('view-detail-email').textContent = userEmail;
                    document.getElementById('view-detail-id').textContent = userId;
                    document.getElementById('view-detail-created').textContent = userCreated;
                    document.getElementById('view-detail-updated').textContent = userUpdated;
                    document.getElementById('view-detail-roles').textContent = userRolesNames.join(", ");

                    // Setup the edit button in the view modal
                    const viewEditBtn = document.querySelector('.view-edit-btn');
                    viewEditBtn.addEventListener('click', function () {
                        // Hide the view modal
                        const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewUserModal'));
                        viewModal.hide();

                        // Find and click the corresponding edit button
                        const editBtn = document.querySelector(`.editUserBtn[data-user-id="${userId}"]`);
                        setTimeout(() => {
                            editBtn.click();
                        }, 500); // Small delay to allow the first modal to close
                    });
                });
            });

            // Initialize Bootstrap modals
            var editModalElement = document.getElementById('editUserModal');
            if (editModalElement) {
                editModalElement.addEventListener('shown.bs.modal', function () {
                    document.getElementById('edit_name').focus();
                });
            }

            var createModalElement = document.getElementById('createUserModal');
            if (createModalElement) {
                createModalElement.addEventListener('shown.bs.modal', function () {
                    document.getElementById('name').focus();
                });
            }
        });
    </script>
@endsection