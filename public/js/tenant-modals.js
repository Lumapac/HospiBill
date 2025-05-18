/**
 * Tenant modals functionality
 */
document.addEventListener('DOMContentLoaded', function () {
    // View tenant functionality
    const viewTenantModal = new bootstrap.Modal(document.getElementById('viewTenantModal'));
    const viewTenantButtons = document.querySelectorAll('.view-tenant-btn');
    const editTenantBtn = document.getElementById('edit-tenant-btn');

    viewTenantButtons.forEach(button => {
        button.addEventListener('click', function () {
            const tenantId = this.getAttribute('data-tenant-id');
            const tenantName = this.getAttribute('data-tenant-name');
            const tenantEmail = this.getAttribute('data-tenant-email');
            const tenantStatus = this.getAttribute('data-tenant-status');
            const tenantContact = this.getAttribute('data-tenant-contact');
            const tenantPhone = this.getAttribute('data-tenant-phone');
            const tenantDomains = this.getAttribute('data-tenant-domains');
            const tenantCreated = this.getAttribute('data-tenant-created');
            const tenantNotes = this.getAttribute('data-tenant-notes');
            const tenantRejected = this.getAttribute('data-tenant-rejected');
            const tenantRejectedBy = this.getAttribute('data-tenant-rejected-by');
            const tenantSubscription = this.getAttribute('data-tenant-subscription') || 'free';

            // Set modal content
            document.getElementById('tenant-name-title').textContent = tenantName;
            document.getElementById('tenant-email-title').textContent = tenantEmail;
            document.getElementById('tenant-contact').textContent = tenantContact || 'N/A';
            document.getElementById('tenant-phone').textContent = tenantPhone || 'N/A';
            document.getElementById('tenant-domains').textContent = tenantDomains || 'N/A';
            document.getElementById('tenant-status').textContent = tenantStatus.charAt(0).toUpperCase() + tenantStatus.slice(1);

            // Handle subscription based on tenant status
            const subscriptionElement = document.getElementById('tenant-subscription');
            if (tenantStatus === 'rejected') {
                subscriptionElement.textContent = 'N/A';
            } else {
                subscriptionElement.textContent = (tenantSubscription ? tenantSubscription.charAt(0).toUpperCase() + tenantSubscription.slice(1) : 'Free');
            }

            document.getElementById('tenant-created').textContent = tenantCreated;

            // Set status badge
            let badgeHtml = '';
            switch (tenantStatus) {
                case 'pending':
                    badgeHtml = '<span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">Pending</span>';
                    break;
                case 'approved':
                    badgeHtml = '<span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Approved</span>';
                    break;
                case 'disabled':
                    badgeHtml = '<span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Disabled</span>';
                    break;
                case 'rejected':
                    badgeHtml = '<span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Rejected</span>';
                    break;
                default:
                    badgeHtml = '<span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-full">Unknown</span>';
            }
            document.getElementById('tenant-status-badge').innerHTML = badgeHtml;

            // Handle admin notes
            const notesSection = document.getElementById('admin-notes-section');
            const notes = document.getElementById('tenant-notes');

            if (tenantNotes && tenantNotes.trim() !== '') {
                notesSection.classList.remove('d-none');
                notes.textContent = tenantNotes;
            } else {
                notesSection.classList.add('d-none');
            }

            // Handle rejection details
            const rejectionSection = document.getElementById('rejection-details-section');
            if (rejectionSection) {
                if (tenantStatus === 'rejected') {
                    rejectionSection.style.display = 'block';
                    document.getElementById('tenant-rejected').textContent = tenantRejected || 'N/A';
                    document.getElementById('tenant-rejected-by').textContent = tenantRejectedBy || 'N/A';
                } else {
                    rejectionSection.style.display = 'none';
                }
            }

            // Set edit button link
            editTenantBtn.setAttribute('data-tenant-id', tenantId);
            // Store additional data for edit functionality
            editTenantBtn.setAttribute('data-tenant-name', tenantName);
            editTenantBtn.setAttribute('data-tenant-email', tenantEmail);
            editTenantBtn.setAttribute('data-tenant-status', tenantStatus);
            editTenantBtn.setAttribute('data-tenant-contact', tenantContact || '');
            editTenantBtn.setAttribute('data-tenant-phone', tenantPhone || '');
            editTenantBtn.setAttribute('data-tenant-notes', tenantNotes || '');
            editTenantBtn.setAttribute('data-tenant-subscription', tenantSubscription || 'free');

            viewTenantModal.show();
        });
    });

    // Edit tenant functionality
    const editTenantModal = new bootstrap.Modal(document.getElementById('editTenantModal'));
    const editTenantButtons = document.querySelectorAll('.edit-tenant-btn');
    const editTenantForm = document.getElementById('editTenantForm');
    const editValidationErrors = document.getElementById('edit-validation-errors');
    const editErrorsList = document.getElementById('edit-errors-list');

    // Handle edit button clicks
    editTenantButtons.forEach(button => {
        button.addEventListener('click', function () {
            const tenantId = this.getAttribute('data-tenant-id');
            const tenantName = this.getAttribute('data-tenant-name');
            const tenantEmail = this.getAttribute('data-tenant-email');
            const tenantStatus = this.getAttribute('data-tenant-status');
            const tenantContact = this.getAttribute('data-tenant-contact');
            const tenantPhone = this.getAttribute('data-tenant-phone');
            const tenantNotes = this.getAttribute('data-tenant-notes');
            const tenantSubscription = this.getAttribute('data-tenant-subscription') || 'free';

            // Reset form validation state
            editValidationErrors.classList.add('d-none');
            editErrorsList.innerHTML = '';

            // Set form action URL
            editTenantForm.action = `/tenants/${tenantId}`;

            // Populate form fields
            document.getElementById('edit-name').value = tenantName;
            document.getElementById('edit-email').value = tenantEmail;
            document.getElementById('edit-contact').value = tenantContact || '';
            document.getElementById('edit-phone').value = tenantPhone || '';
            document.getElementById('edit-status').value = tenantStatus;
            document.getElementById('edit-subscription').value = tenantSubscription;
            document.getElementById('edit-notes').value = tenantNotes || '';

            // Update modal title
            document.getElementById('editTenantModalLabel').textContent = `Edit Tenant: ${tenantName}`;

            editTenantModal.show();
        });
    });

    // Handle "Edit" button from view modal
    if (editTenantBtn) {
        editTenantBtn.addEventListener('click', function (e) {
            e.preventDefault();

            // Close view modal
            viewTenantModal.hide();

            // Find the edit button for the same tenant and trigger its click event
            const tenantId = this.getAttribute('data-tenant-id');
            const editButton = document.querySelector(`.edit-tenant-btn[data-tenant-id="${tenantId}"]`);

            if (editButton) {
                setTimeout(() => {
                    editButton.click();
                }, 500); // Small delay to allow the first modal to close
            } else {
                // If no edit button exists, open the edit modal directly with the data from the view modal
                setTimeout(() => {
                    // Get tenant data from the edit button attributes
                    const tenantName = this.getAttribute('data-tenant-name');
                    const tenantEmail = this.getAttribute('data-tenant-email');
                    const tenantStatus = this.getAttribute('data-tenant-status');
                    const tenantContact = this.getAttribute('data-tenant-contact');
                    const tenantPhone = this.getAttribute('data-tenant-phone');
                    const tenantNotes = this.getAttribute('data-tenant-notes');
                    const tenantSubscription = this.getAttribute('data-tenant-subscription') || 'free';

                    // Reset form validation state
                    editValidationErrors.classList.add('d-none');
                    editErrorsList.innerHTML = '';

                    // Set form action URL
                    editTenantForm.action = `/tenants/${tenantId}`;

                    // Populate form fields
                    document.getElementById('edit-name').value = tenantName;
                    document.getElementById('edit-email').value = tenantEmail;
                    document.getElementById('edit-contact').value = tenantContact || '';
                    document.getElementById('edit-phone').value = tenantPhone || '';
                    document.getElementById('edit-status').value = tenantStatus;
                    document.getElementById('edit-subscription').value = tenantSubscription;
                    document.getElementById('edit-notes').value = tenantNotes || '';

                    // Update modal title
                    document.getElementById('editTenantModalLabel').textContent = `Edit Tenant: ${tenantName}`;

                    // Show the edit modal
                    editTenantModal.show();
                }, 500); // Small delay to allow the first modal to close
            }
        });
    }

    // Handle form submission
    if (editTenantForm) {
        editTenantForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Clear previous validation errors
            editValidationErrors.classList.add('d-none');
            editErrorsList.innerHTML = '';

            // Create form data
            const formData = new FormData(editTenantForm);

            // Submit form using fetch
            fetch(editTenantForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Success - reload page to show changes
                        window.location.reload();
                    } else if (data.errors) {
                        // Show validation errors
                        editValidationErrors.classList.remove('d-none');

                        Object.keys(data.errors).forEach(key => {
                            data.errors[key].forEach(error => {
                                const li = document.createElement('li');
                                li.textContent = error;
                                editErrorsList.appendChild(li);
                            });
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    editValidationErrors.classList.remove('d-none');
                    const li = document.createElement('li');
                    li.textContent = 'An error occurred. Please try again.';
                    editErrorsList.appendChild(li);
                });
        });
    }
}); 