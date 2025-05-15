<!-- View Tenant Modal -->
<div class="modal fade" id="viewTenantModal" tabindex="-1" role="dialog" aria-labelledby="viewTenantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewTenantModalLabel">Tenant Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-header p-3 pb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0" id="tenant-name-title"></h6>
                                        <p class="text-sm mb-0" id="tenant-email-title"></p>
                                    </div>
                                    <div id="tenant-status-badge" class="ms-auto"></div>
                                </div>
                            </div>
                            <div class="card-body p-3 pt-1">
                                <hr class="horizontal dark mt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h6 class="text-uppercase text-xs font-weight-bolder opacity-6">Contact Information</h6>
                                            <p class="mb-1">
                                                <span class="text-dark font-weight-bold text-sm">Contact Person:</span>
                                                <span class="text-sm" id="tenant-contact"></span>
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark font-weight-bold text-sm">Phone Number:</span>
                                                <span class="text-sm" id="tenant-phone"></span>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <h6 class="text-uppercase text-xs font-weight-bolder opacity-6">Domain Information</h6>
                                            <p class="mb-1">
                                                <span class="text-dark font-weight-bold text-sm">Domains:</span>
                                                <span class="text-sm" id="tenant-domains"></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h6 class="text-uppercase text-xs font-weight-bolder opacity-6">Account Information</h6>
                                            <p class="mb-1">
                                                <span class="text-dark font-weight-bold text-sm">Status:</span>
                                                <span class="text-sm" id="tenant-status"></span>
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark font-weight-bold text-sm">Created:</span>
                                                <span class="text-sm" id="tenant-created"></span>
                                            </p>
                                        </div>
                                        <div class="mb-3" id="admin-notes-section">
                                            <h6 class="text-uppercase text-xs font-weight-bolder opacity-6">Admin Notes</h6>
                                            <p class="text-sm mb-1" id="tenant-notes"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" id="edit-tenant-btn" class="btn bg-gradient-primary">Edit Tenant</a>
            </div>
        </div>
    </div>
</div> 