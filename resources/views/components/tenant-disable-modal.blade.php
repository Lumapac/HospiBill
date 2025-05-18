<!-- Disable Tenant Modal -->
<div class="modal fade" id="disableModal" tabindex="-1" role="dialog" aria-labelledby="disableModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disableModalLabel">Disable Tenant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Please provide a reason for disabling <span id="disableTenantName" class="font-weight-bold"></span>:</p>
        
                <form id="disableForm" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="input-group input-group-static mb-4">
                        <label for="disable_notes">Notes/Reason</label>
                        <textarea id="disable_notes" name="admin_notes" class="form-control" rows="4" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn bg-gradient-danger" id="confirmDisable">Disable Tenant</button>
            </div>
        </div>
    </div>
</div> 