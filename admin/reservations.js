// assets/js/reservations.js

document.addEventListener('DOMContentLoaded', function() {
    // Initialize elements
    const searchInput = document.getElementById('searchInput');
    const modal = document.getElementById('deleteModal');
    const deleteButtons = document.querySelectorAll('.btn-delete');
    const deleteForm = document.getElementById('deleteForm');
    const deleteIdInput = document.getElementById('deleteId');

    // Validate required elements
    if (!modal || !deleteForm || !deleteIdInput) {
        console.error('Required modal elements are missing');
        return;
    }

    // Search Functionality
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const searchTerm = this.value.trim();
                window.location.href = `reservations.php${searchTerm ? `?search=${encodeURIComponent(searchTerm)}` : ''}`;
            }, 500);
        });
    }

    // Delete Functionality
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const reservationId = this.getAttribute('data-id');
            if (reservationId) {
                deleteIdInput.value = reservationId;
                openDeleteModal();
            }
        });
    });

    // Modal Functions
    // Add modal click handler once during initialization
    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeDeleteModal();
        }
    });

    window.openDeleteModal = function() {
        modal.style.display = 'block';
        // Enable escape key when modal is open
        document.addEventListener('keydown', handleEscapeKey);
    }

    window.closeDeleteModal = function() {
        modal.style.display = 'none';
        // Remove escape key handler when modal is closed
        document.removeEventListener('keydown', handleEscapeKey);
    }

    // Separate function for handling escape key
    function handleEscapeKey(event) {
        if (event.key === 'Escape') {
            closeDeleteModal();
        }
    }

    // Add smooth fade-in animation for table rows
    const tableRows = document.querySelectorAll('.reservations-table tbody tr');
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.animation = `fadeIn 0.3s ease forwards ${index * 0.1}s`;
    });

    // Add CSS animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);
});

// Format currency (if needed for dynamic content)
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 2
    }).format(amount);
}

// Error handling
window.addEventListener('error', function(e) {
    console.error('An error occurred:', e.error);
    // You could implement a toast notification here
    // Example:
    // showToast('An error occurred. Please try again.');
});