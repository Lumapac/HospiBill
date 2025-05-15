<!-- Edit Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" role="dialog" aria-labelledby="editServiceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-warning">
                <h5 class="modal-title text-white" id="editServiceModalLabel">Edit Service</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editServiceForm" method="POST" action="">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text"><i
                                        class="material-symbols-rounded opacity-6">medical_services</i></span>
                                <div class="form-floating ps-0">
                                    <input type="text" class="form-control" id="edit-name" name="name"
                                        placeholder="Service Name" required autofocus />
                                    <label for="edit-name">Service Name</label>
                                </div>
                            </div>
                            @error('name')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text">₱</span>
                                <div class="form-floating ps-0">
                                    <input type="number" class="form-control" id="edit-price" min="0" step="0.01"
                                        name="price" placeholder="0.00" required />
                                    <label for="edit-price">Price</label>
                                </div>
                            </div>
                            @error('price')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-category" class="form-label ms-0 mb-2 d-flex align-items-center">
                                <i class="material-symbols-rounded opacity-6 me-2">category</i>
                                Category
                            </label>
                            <select id="edit-category" name="category" class="form-select" required>
                                <option value="">Select Category</option>
                                <option value="Consultation">Consultation</option>
                                <option value="Laboratory">Laboratory</option>
                                <option value="Surgery">Surgery</option>
                                <option value="Therapy">Therapy</option>
                                <option value="Diagnostic">Diagnostic</option>
                                <option value="Wellness">Wellness</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('category')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text"><i
                                        class="material-symbols-rounded opacity-6">schedule</i></span>
                                <div class="form-floating ps-0">
                                    <input type="text" class="form-control" id="edit-duration" name="duration"
                                        placeholder="e.g. 30 minutes, 1 hour" />
                                    <label for="edit-duration">Duration</label>
                                </div>
                            </div>
                            @error('duration')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit-description" class="form-label ms-0 mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-6 me-2">description</i>
                            Description
                        </label>
                        <textarea id="edit-description" name="description" rows="3" class="form-control"
                            placeholder="Provide detailed information about this service"></textarea>
                        @error('description')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit-requirements" class="form-label ms-0 mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-6 me-2">checklist</i>
                            Requirements
                        </label>
                        <textarea id="edit-requirements" name="requirements" rows="2" class="form-control"
                            placeholder="List any prerequisites or requirements"></textarea>
                        @error('requirements')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="input-group input-group-dynamic mb-4">
                            <span class="input-group-text"><i
                                    class="material-symbols-rounded opacity-6">event_available</i></span>
                            <div class="form-floating ps-0">
                                <input type="text" class="form-control" id="edit-availability" name="availability"
                                    placeholder="e.g. Mon-Fri, 9am-5pm" />
                                <label for="edit-availability">Availability</label>
                            </div>
                        </div>
                        @error('availability')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" id="closeEditModal" data-bs-dismiss="modal">
                    <i class="material-symbols-rounded opacity-5 me-1">close</i>
                    Cancel
                </button>
                <button type="button" id="submitEditForm" class="btn bg-gradient-warning">
                    <i class="material-symbols-rounded opacity-5 me-1">save</i>
                    Update Service
                </button>
            </div>
        </div>
    </div>
</div>