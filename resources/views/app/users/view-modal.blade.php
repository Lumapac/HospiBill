<!-- View User Details Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-warning">
                <h5 class="modal-title text-white" id="viewUserModalLabel">User Details</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card card-profile border">
                            <div class="position-relative">
                                <div class="bg-gradient-warning shadow-warning border-radius-lg text-center p-3 mt-n4 mx-3">
                                    <img id="view-user-avatar" class="avatar avatar-xxl rounded-circle border border-2 border-white shadow" 
                                         src="" alt="User">
                                </div>
                            </div>
                            <div class="card-body text-center mt-3 pb-0">
                                <h4 id="view-user-name" class="mb-0"></h4>
                                <p id="view-user-email" class="text-muted mb-2"></p>
                                <hr class="horizontal dark my-3">
                                <div class="d-flex justify-content-center">
                                    <div id="view-user-roles" class="d-flex flex-wrap justify-content-center gap-1 mb-2">
                                        <!-- Roles badges will be added here dynamically -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card h-100">
                            <div class="card-header pb-0 p-3">
                                <h6 class="mb-0">User Information</h6>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                        <strong class="text-dark">Full Name:</strong> &nbsp; 
                                        <span id="view-detail-name"></span>
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Email:</strong> &nbsp; 
                                        <span id="view-detail-email"></span>
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">ID:</strong> &nbsp; 
                                        <span id="view-detail-id"></span>
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Account Created:</strong> &nbsp; 
                                        <span id="view-detail-created"></span>
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Last Updated:</strong> &nbsp; 
                                        <span id="view-detail-updated"></span>
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Roles:</strong> &nbsp; 
                                        <span id="view-detail-roles"></span>
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Status:</strong> &nbsp; 
                                        <span id="view-detail-status" class="badge bg-gradient-success">Active</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="material-symbols-rounded opacity-5 me-1">close</i>
                    Close
                </button>
                <button type="button" class="btn bg-gradient-info view-edit-btn">
                    <i class="material-symbols-rounded opacity-5 me-1">edit</i>
                    Edit User
                </button>
            </div>
        </div>
    </div>
</div> 