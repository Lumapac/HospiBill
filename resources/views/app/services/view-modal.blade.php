<!-- View Service Details Modal -->
<div class="modal fade" id="viewServiceModal" tabindex="-1" role="dialog" aria-labelledby="viewServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info">
                <h5 class="modal-title text-white" id="viewServiceModalLabel">Service Details</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card card-profile border h-100">
                            <div class="position-relative">
                                <div class="bg-gradient-info shadow-info border-radius-lg text-center p-3 mt-n4 mx-3">
                                    <i class="material-symbols-rounded text-white" style="font-size: 60px;">medical_services</i>
                                </div>
                            </div>
                            <div class="card-body text-center mt-3 pb-0">
                                <h4 id="view-service-name" class="mb-0"></h4>
                                <span id="view-service-category" class="badge bg-gradient-info mt-2"></span>
                                <h6 id="view-service-price" class="mt-3 mb-2 text-success font-weight-bold"></h6>
                                <hr class="horizontal dark my-3">
                                <p id="view-service-description" class="text-sm text-muted mb-3 text-start"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card h-100">
                            <div class="card-header pb-0 p-3">
                                <h6 class="mb-0">Service Information</h6>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                        <strong class="text-dark">Duration:</strong> &nbsp; 
                                        <span id="view-detail-duration" class="d-flex align-items-center">
                                            <i class="material-symbols-rounded me-1 text-sm">schedule</i>
                                            <span class="duration-text"></span>
                                        </span>
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Availability:</strong> &nbsp; 
                                        <span id="view-detail-availability" class="d-flex align-items-center">
                                            <i class="material-symbols-rounded me-1 text-sm">event_available</i>
                                            <span class="availability-text"></span>
                                        </span>
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Requirements:</strong> &nbsp; 
                                        <div id="view-detail-requirements" class="mt-2 text-sm"></div>
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Category:</strong> &nbsp; 
                                        <span id="view-detail-category"></span>
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">ID:</strong> &nbsp; 
                                        <span id="view-detail-id"></span>
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
                <button type="button" class="btn bg-gradient-success view-edit-btn">
                    <i class="material-symbols-rounded opacity-5 me-1">edit</i>
                    Edit Service
                </button>
            </div>
        </div>
    </div>
</div> 