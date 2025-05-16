<!-- View Bill Modal -->
<div class="modal fade" id="viewBillModal" tabindex="-1" role="dialog" aria-labelledby="viewBillModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="viewBillModalLabel">Bill Details</h5>
                <div class="ms-auto">
                    <a href="#" id="downloadPdfLink" class="btn btn-sm bg-gradient-info me-2">
                        <i class="material-symbols-rounded text-sm me-1">download</i>Download PDF
                    </a>
                    <button id="processPaymentBtn" class="btn btn-sm bg-gradient-success me-2">
                        <i class="material-symbols-rounded text-sm me-1">payments</i>Process Payment
                    </button>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body p-0">
                <!-- Bill Information -->
                <div class="row mx-0">
                    <div class="col-md-6 p-4 border-end">
                        <h6 class="text-uppercase text-body text-sm font-weight-bolder mb-3">Bill Information</h6>
                        <div class="mb-2">
                            <p class="mb-1"><span class="text-dark font-weight-bold">Bill Number:</span> <span
                                    id="billNumber">-</span></p>
                            <p class="mb-1"><span class="text-dark font-weight-bold">Created Date:</span> <span
                                    id="createdDate">-</span></p>
                            <p class="mb-1"><span class="text-dark font-weight-bold">Due Date:</span> <span
                                    id="dueDate">-</span></p>
                            <p class="mb-1">
                                <span class="text-dark font-weight-bold">Status:</span>
                                <span id="billStatus" class="badge badge-sm">-</span>
                            </p>
                            <p class="mb-1"><span class="text-dark font-weight-bold">Notes:</span> <span
                                    id="billNotes">-</span></p>
                        </div>
                    </div>
                    <div class="col-md-6 p-4">
                        <h6 class="text-uppercase text-body text-sm font-weight-bolder mb-3">Patient Information</h6>
                        <div class="mb-2">
                            <p class="mb-1"><span class="text-dark font-weight-bold">Patient Name:</span> <span
                                    id="patientName">-</span></p>
                            <p class="mb-1"><span class="text-dark font-weight-bold">Email:</span> <span
                                    id="patientEmail">-</span></p>
                            <p class="mb-1"><span class="text-dark font-weight-bold">Phone:</span> <span
                                    id="patientPhone">-</span></p>
                            <p class="mb-1"><span class="text-dark font-weight-bold">Service:</span> <span
                                    id="serviceName">-</span></p>
                        </div>
                    </div>
                </div>

                <!-- Financial Summary -->
                <div class="row mx-0 bg-gray-100">
                    <div class="col-12 p-4">
                        <h6 class="text-uppercase text-body text-sm font-weight-bolder mb-3">Financial Summary</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card card-body mb-0 py-3">
                                    <p class="text-sm text-secondary mb-0">Total Amount</p>
                                    <h5 class="font-weight-bolder mb-0 text-dark" id="totalAmount">₱0.00</h5>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card card-body mb-0 py-3">
                                    <p class="text-sm text-secondary mb-0">Amount Paid</p>
                                    <h5 class="font-weight-bolder mb-0 text-success" id="amountPaid">₱0.00</h5>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card card-body mb-0 py-3">
                                    <p class="text-sm text-secondary mb-0">Remaining Balance</p>
                                    <h5 class="font-weight-bolder mb-0 text-danger" id="remainingBalance">₱0.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment History -->
                <div class="p-4">
                    <h6 class="text-uppercase text-body text-sm font-weight-bolder mb-3">Payment History</h6>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Amount</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Payment Method</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Reference #</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Processed By</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Notes</th>
                                </tr>
                            </thead>
                            <tbody id="paymentHistoryBody">
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-secondary">Loading payment history...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Process Payment Modal -->
<div class="modal fade" id="processPaymentModal" tabindex="-1" role="dialog" aria-labelledby="processPaymentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="processPaymentModalLabel">Process Payment</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <p class="mb-1 text-sm"><span class="text-dark">Patient:</span> <span id="paymentPatientName"
                            class="font-weight-bold">-</span></p>
                    <p class="mb-1 text-sm"><span class="text-dark">Bill #:</span> <span id="paymentBillNumber"
                            class="font-weight-bold">-</span></p>
                    <p class="mb-1 text-sm"><span class="text-dark">Amount Due:</span> <span id="paymentAmountDue"
                            class="font-weight-bold text-danger">₱0.00</span></p>
                </div>
                <form id="processPaymentForm" action="" method="POST">
                    @csrf
                    <div class="input-group input-group-static mb-4">
                        <label for="payment_amount">Payment Amount</label>
                        <input type="number" step="0.01" id="payment_amount" name="amount" class="form-control"
                            required>
                    </div>
                    <div class="input-group input-group-static mb-4">
                        <label for="payment_method">Payment Method</label>
                        <select id="payment_method" name="payment_method" class="form-control" required>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="input-group input-group-static mb-4">
                        <label for="reference_number">Reference Number</label>
                        <input type="text" id="reference_number" name="reference_number" class="form-control">
                    </div>
                    <div class="input-group input-group-static mb-4">
                        <label for="payment_notes">Notes</label>
                        <textarea id="payment_notes" name="notes" rows="2" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="processPaymentForm" class="btn bg-gradient-success">Complete
                    Payment</button>
            </div>
        </div>
    </div>
</div>