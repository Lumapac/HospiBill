<!-- Create Bill Modal -->
<div class="modal fade" id="createBillModal" tabindex="-1" role="dialog" aria-labelledby="createBillModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="createBillModalLabel">Create New Bill</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createBillForm" action="{{ route('patient.bill.create') }}" method="POST">
                    @csrf
                    <div class="input-group input-group-static mb-4">
                        <label for="patient_id">Patient</label>
                        <select id="patient_id" name="patient_id" class="form-control" required>
                            <option value="">Select a patient</option>
                            @foreach($recentPatients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group input-group-static mb-4">
                        <label for="service_id">Service</label>
                        <select id="service_id" name="service_id" class="form-control" required>
                            <option value="">Select a service</option>
                            @foreach($services ?? [] as $service)
                                <option value="{{ $service->id }}" data-price="{{ $service->price }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group input-group-static mb-4">
                        <label for="amount">Amount</label>
                        <input type="number" step="0.01" id="amount" name="amount" class="form-control" required>
                    </div>
                    <div class="input-group input-group-static mb-4">
                        <label for="due_date">Due Date</label>
                        <input type="date" id="due_date" name="due_date" class="form-control" required>
                    </div>
                    <div class="input-group input-group-static mb-4">
                        <label for="notes">Notes</label>
                        <textarea id="notes" name="notes" class="form-control" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="createBillForm" class="btn bg-gradient-primary">Create Bill</button>
            </div>
        </div>
    </div>
</div> 