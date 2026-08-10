/**
 * Admin Dashboard UI Interactions (#0F62FE / #F2F4F8 Palette + Lucide Icons)
 */

document.addEventListener('DOMContentLoaded', function () {
    // Refresh Lucide Icons on initialization
    if (window.lucide) {
        lucide.createIcons();
    }

    // 1. Sidebar Toggle Mobile Behavior
    const sidebarToggle = document.getElementById('sidebarToggle');
    const adminSidebar = document.querySelector('.admin-sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    if (sidebarToggle && adminSidebar) {
        sidebarToggle.addEventListener('click', function () {
            adminSidebar.classList.toggle('show');
            if (sidebarOverlay) {
                sidebarOverlay.classList.toggle('show');
            }
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function () {
            adminSidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });
    }

    // 2. Client-side Table Search Filter
    const searchInputs = document.querySelectorAll('[data-table-search]');
    searchInputs.forEach(input => {
        input.addEventListener('keyup', function () {
            const targetTableId = this.getAttribute('data-table-search');
            const table = document.getElementById(targetTableId);
            if (!table) return;

            const query = this.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    // 3. Client-side Status Filter Dropdown
    const statusFilters = document.querySelectorAll('[data-table-filter="status"]');
    statusFilters.forEach(filter => {
        filter.addEventListener('change', function () {
            const targetTableId = this.getAttribute('data-table-target');
            const table = document.getElementById(targetTableId);
            if (!table) return;

            const filterValue = this.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const statusCell = row.querySelector('[data-status]');
                if (!statusCell) return;

                const status = statusCell.getAttribute('data-status').toLowerCase();
                if (filterValue === 'all' || filterValue === '' || status === filterValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    // 4. Booking Interactive Actions (Accept, Reject, Check-in, Check-out)
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('[data-booking-action]');
        if (!btn) return;

        const action = btn.getAttribute('data-booking-action');
        const bookingId = btn.getAttribute('data-booking-id') || '#BK-1001';
        const row = btn.closest('tr');
        if (!row) return;

        const badgeContainer = row.querySelector('[data-status]');
        if (!badgeContainer) return;

        if (action === 'accept' || action === 'confirm') {
            badgeContainer.setAttribute('data-status', 'confirmed');
            badgeContainer.className = 'badge-pill-custom badge-confirmed';
            badgeContainer.innerHTML = '<i data-lucide="check-circle-2" style="width:14px; height:14px;"></i> Confirmed';
            showToast('Booking Confirmed', `Booking ${bookingId} has been confirmed.`, 'success');
        } else if (action === 'reject') {
            badgeContainer.setAttribute('data-status', 'rejected');
            badgeContainer.className = 'badge-pill-custom badge-rejected';
            badgeContainer.innerHTML = '<i data-lucide="x-circle" style="width:14px; height:14px;"></i> Rejected';
            showToast('Booking Rejected', `Booking ${bookingId} has been rejected.`, 'danger');
        } else if (action === 'check-in') {
            badgeContainer.setAttribute('data-status', 'checked-in');
            badgeContainer.className = 'badge-pill-custom badge-checked-in';
            badgeContainer.innerHTML = '<i data-lucide="door-open" style="width:14px; height:14px;"></i> Checked In';
            showToast('Guest Checked In', `Guest for ${bookingId} checked in.`, 'info');
        } else if (action === 'check-out') {
            badgeContainer.setAttribute('data-status', 'checked-out');
            badgeContainer.className = 'badge-pill-custom badge-checked-out';
            badgeContainer.innerHTML = '<i data-lucide="log-out" style="width:14px; height:14px;"></i> Checked Out';
            showToast('Guest Checked Out', `Booking ${bookingId} checked out.`, 'secondary');
        }

        if (window.lucide) {
            lucide.createIcons();
        }
    });

    // 5. Delete Action Handler with Modal Confirmation
    let pendingDeleteRow = null;
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    
    document.addEventListener('click', function (e) {
        const deleteBtn = e.target.closest('[data-action="delete"]');
        if (!deleteBtn) return;

        const row = deleteBtn.closest('tr');
        const itemName = deleteBtn.getAttribute('data-item-name') || 'this item';
        
        pendingDeleteRow = row;
        
        const deleteItemSpan = document.getElementById('deleteItemName');
        if (deleteItemSpan) {
            deleteItemSpan.textContent = itemName;
        }

        const deleteModalEl = document.getElementById('deleteConfirmModal');
        if (deleteModalEl && window.bootstrap) {
            const modal = bootstrap.Modal.getOrCreateInstance(deleteModalEl);
            modal.show();
        }
    });

    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function () {
            if (pendingDeleteRow) {
                pendingDeleteRow.style.transition = 'opacity 0.2s ease';
                pendingDeleteRow.style.opacity = '0';
                setTimeout(() => {
                    pendingDeleteRow.remove();
                    showToast('Item Deleted', 'The item was removed.', 'warning');
                }, 200);
            }
            const deleteModalEl = document.getElementById('deleteConfirmModal');
            if (deleteModalEl && window.bootstrap) {
                const modal = bootstrap.Modal.getInstance(deleteModalEl);
                if (modal) modal.hide();
            }
        });
    }

    // 6. Generic Form Submission simulation
    const forms = document.querySelectorAll('.js-dummy-form');
    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const modalEl = this.closest('.modal');
            if (modalEl && window.bootstrap) {
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();
            }
            showToast('Saved', 'Changes successfully saved.', 'success');
        });
    });
});

/**
 * Toast Notification Helper
 */
function showToast(title, message, type = 'primary') {
    const container = document.getElementById('toastContainer');
    if (!container) return;

    const toastId = 'toast-' + Date.now();
    const bgHeaderClass = type === 'success' ? 'bg-primary text-white' :
                          type === 'danger' ? 'bg-danger text-white' :
                          type === 'warning' ? 'bg-warning text-dark' : 'bg-dark text-white';

    const toastHtml = `
        <div id="${toastId}" class="toast shadow-lg border-0 mb-2 overflow-hidden" style="border-radius: 12px;" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header ${bgHeaderClass} py-2 px-3">
                <i data-lucide="bell" class="me-2" style="width:16px; height:16px;"></i>
                <strong class="me-auto" style="font-size: 0.85rem;">${title}</strong>
                <small class="opacity-75">Just now</small>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body bg-white py-2 px-3 text-dark" style="font-size: 0.85rem;">
                ${message}
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', toastHtml);
    if (window.lucide) {
        lucide.createIcons();
    }
    const toastEl = document.getElementById(toastId);
    if (toastEl && window.bootstrap) {
        const toast = new bootstrap.Toast(toastEl, { delay: 3500 });
        toast.show();
        toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
    }
}
