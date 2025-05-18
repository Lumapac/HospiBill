<!-- Edit Tenant Modal -->
<div class="modal fade" id="editTenantModal" tabindex="-1" role="dialog" aria-labelledby="editTenantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTenantModalLabel">Edit Tenant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editTenantForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <!-- Validation Errors -->
                    <div class="alert alert-danger d-none" id="edit-validation-errors">
                        <ul class="mb-0" id="edit-errors-list"></ul>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-sm font-weight-bolder mb-3">Tenant Information</h6>
                            
                            <!-- Name -->
                            <div class="input-group input-group-static mb-4">
                                <label for="edit-name">Company Name</label>
                                <input type="text" class="form-control" id="edit-name" name="name" required>
                            </div>
                            
                            <!-- Email -->
                            <div class="input-group input-group-static mb-4">
                                <label for="edit-email">Email</label>
                                <input type="email" class="form-control" id="edit-email" name="email" required>
                            </div>
                            
                            <!-- Contact Person -->
                            <div class="input-group input-group-static mb-4">
                                <label for="edit-contact">Contact Person</label>
                                <input type="text" class="form-control" id="edit-contact" name="contact_person" required>
                            </div>
                            
                            <!-- Phone Number -->
                            <div class="input-group input-group-static mb-4">
                                <label for="edit-phone">Phone Number</label>
                                <input type="tel" class="form-control" id="edit-phone" name="phone_number" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <!-- Status -->
                            <div class="input-group input-group-static mb-4">
                                <label for="edit-status" class="ms-0">Status</label>
                                <select class="form-control" id="edit-status" name="status" required>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="disabled">Disabled</option>
                                </select>
                                <p class="text-sm text-secondary mt-1">
                                    Changing status to "Approved" will generate and send new credentials to the tenant.
                                </p>
                            </div>
                            
                            <!-- Subscription -->
                            <div class="input-group input-group-static mb-4">
                                <label for="edit-subscription" class="ms-0">Subscription</label>
                                <select class="form-control" id="edit-subscription" name="subscription" required>
                                    <option value="free">Free</option>
                                    <option value="standard">Standard</option>
                                    <option value="premium">Premium</option>
                                </select>
                                <p class="text-sm text-secondary mt-1">
                                    Select the subscription plan for this tenant.
                                </p>
                            </div>
                            
                            <!-- Admin Notes -->
                            <div class="input-group input-group-static mb-4">
                                <label for="edit-notes">Admin Notes</label>
                                <textarea class="form-control" id="edit-notes" name="admin_notes" rows="5"></textarea>
                                <p class="text-sm text-secondary mt-1">
                                    Internal notes about this tenant (not visible to the tenant).
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn bg-gradient-primary" id="save-edit-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div> 