document.addEventListener('DOMContentLoaded', function() {
    // Add fade-in animation to elements
    const elements = document.querySelectorAll('.gallery-img, .tour-details, .booking-form');
    elements.forEach(el => el.classList.add('fade-in'));

    // Form validation
    const bookingForm = document.querySelector('form');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            const inputs = bookingForm.querySelectorAll('input');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                showAlert('Please fill in all fields', 'error');
            }
        });
    }

    // People count validation
    const peopleInput = document.querySelector('input[name="people"]');
    if (peopleInput) {
        peopleInput.addEventListener('change', function() {
            const max = parseInt(document.querySelector('p b:last-child').textContent);
            if (this.value > max) {
                this.value = max;
                showAlert('Maximum number of reservations exceeded', 'warning');
            }
        });
    }

    // Success message handling
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        showAlert('Booking successful!', 'success');
    }
});

// Alert function
function showAlert(message, type) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.role = 'alert';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    `;
    
    document.querySelector('.container').insertBefore(alertDiv, document.querySelector('.page-header'));
    
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}

// Image gallery lightbox
const galleryImages = document.querySelectorAll('.gallery-img');
galleryImages.forEach(img => {
    img.addEventListener('click', function() {
        const lightbox = document.createElement('div');
        lightbox.className = 'lightbox';
        lightbox.innerHTML = `
            <div class="lightbox-content">
                <img src="${this.src}" alt="Gallery Image">
                <span class="close-lightbox">&times;</span>
            </div>
        `;
        
        document.body.appendChild(lightbox);
        
        lightbox.querySelector('.close-lightbox').onclick = function() {
            lightbox.remove();
        };
    });
});