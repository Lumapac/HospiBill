<!-- Create Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-success">
                <h5 class="modal-title text-white" id="serviceModalLabel">Create New Service</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info text-white">
                    <i class="material-symbols-rounded opacity-5 text-white me-2">info</i>
                    Create a new medical service that can be assigned to patients.
                </div>
                
                <form id="serviceForm" method="POST" action="{{ route('services.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text"><i class="material-symbols-rounded opacity-6">medical_services</i></span>
                                <div class="form-floating ps-0">
                                    <input type="text" class="form-control" id="name" name="name" :value="old('name')" placeholder="Service Name" required autofocus />
                                    <label for="name">Service Name</label>
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
                                    <input type="number" class="form-control" id="price" min="0" step="0.01" name="price" :value="old('price')" placeholder="0.00" required />
                                    <label for="price">Price</label>
                                </div>
                            </div>
                            @error('price')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label ms-0 mb-2 d-flex align-items-center">
                                <i class="material-symbols-rounded opacity-6 me-2">category</i>
                                Category
                            </label>
                            <select id="category" name="category" class="form-select" required>
                                <option value="">Select Category</option>
                                <option value="Consultation" {{ old('category') == 'Consultation' ? 'selected' : '' }}>Consultation</option>
                                <option value="Laboratory" {{ old('category') == 'Laboratory' ? 'selected' : '' }}>Laboratory</option>
                                <option value="Surgery" {{ old('category') == 'Surgery' ? 'selected' : '' }}>Surgery</option>
                                <option value="Therapy" {{ old('category') == 'Therapy' ? 'selected' : '' }}>Therapy</option>
                                <option value="Diagnostic" {{ old('category') == 'Diagnostic' ? 'selected' : '' }}>Diagnostic</option>
                                <option value="Wellness" {{ old('category') == 'Wellness' ? 'selected' : '' }}>Wellness</option>
                                <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('category')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text"><i class="material-symbols-rounded opacity-6">schedule</i></span>
                                <div class="form-floating ps-0">
                                    <input type="text" class="form-control" id="duration" name="duration" :value="old('duration')" placeholder="e.g. 30 minutes, 1 hour" />
                                    <label for="duration">Duration</label>
                                </div>
                            </div>
                            @error('duration')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label ms-0 mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-6 me-2">description</i>
                            Description
                        </label>
                        <textarea id="description" name="description" rows="3" class="form-control" placeholder="Provide detailed information about this service">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="requirements" class="form-label ms-0 mb-2 d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-6 me-2">checklist</i>
                            Requirements
                        </label>
                        <textarea id="requirements" name="requirements" rows="2" class="form-control" placeholder="List any prerequisites or requirements">{{ old('requirements') }}</textarea>
                        @error('requirements')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="input-group input-group-dynamic mb-4">
                            <span class="input-group-text"><i class="material-symbols-rounded opacity-6">event_available</i></span>
                            <div class="form-floating ps-0">
                                <input type="text" class="form-control" id="availability" name="availability" :value="old('availability')" placeholder="e.g. Mon-Fri, 9am-5pm" />
                                <label for="availability">Availability</label>
                            </div>
                        </div>
                        @error('availability')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" id="closeModal" data-bs-dismiss="modal">
                    <i class="material-symbols-rounded opacity-5 me-1">close</i>
                    Cancel
                </button>
                <button type="button" id="submitForm" class="btn bg-gradient-success">
                    <i class="material-symbols-rounded opacity-5 me-1">save</i>
                    Create Service
                </button>
            </div>
        </div>
    </div>
</div>