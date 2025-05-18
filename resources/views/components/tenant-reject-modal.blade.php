<!-- Reject Tenant Application Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Reject Tenant Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="material-symbols-rounded">warning</i>
                    <span>Rejecting an application will prevent database creation for this tenant and notify the applicant via email.</span>
                </div>
                
                <p>Please provide a reason for rejecting <span id="tenantName" class="font-weight-bold"></span>'s application:</p>
        
                <form id="rejectForm" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="input-group input-group-static mb-4">
                        <label for="admin_notes">Rejection Reason (will be shared with the applicant)</label>
                        <textarea id="admin_notes" name="admin_notes" class="form-control" rows="4" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn bg-gradient-danger" id="confirmReject">Reject Application</button>
            </div>
        </div>
    </div>
</div> 