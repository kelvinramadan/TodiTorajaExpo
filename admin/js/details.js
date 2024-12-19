document.addEventListener('DOMContentLoaded', function() {
    // Add animation class to elements
    const animateElements = document.querySelectorAll('.page-header, .photo-container, .facility-container, .info-box, .booking-form');
    animateElements.forEach((element, index) => {
        setTimeout(() => {
            element.classList.add('animate-fade-in');
        }, index * 100);
    });

    // Get form elements
    const form = document.querySelector('form');
    const inDateInput = document.querySelector('input[name="in_date"]');
    const outDateInput = document.querySelector('input[name="out_date"]');
    const submitBtn = document.querySelector('input[type="submit"]');
    
    // Set minimum date for check-in to today
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    // Format dates for input fields
    const formatDate = (date) => {
        return date.toISOString().split('T')[0];
    };
    
    // Set minimum dates for inputs
    inDateInput.min = formatDate(today);
    outDateInput.min = formatDate(tomorrow);
    
    // Update check-out minimum date when check-in date changes
    inDateInput.addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const minCheckOut = new Date(selectedDate);
        minCheckOut.setDate(selectedDate.getDate() + 1);
        
        outDateInput.min = formatDate(minCheckOut);
        
        // If current check-out date is before new minimum, update it
        if(new Date(outDateInput.value) <= selectedDate) {
            outDateInput.value = formatDate(minCheckOut);
        }
        
        updateTotalPrice();
    });
    
    outDateInput.addEventListener('change', updateTotalPrice);
    
    // Form validation with real-time feedback
    const inputs = form.querySelectorAll('input[type="text"], input[type="email"]');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            validateInput(this);
        });
    });
    
    function validateInput(input) {
        const value = input.value.trim();
        let isValid = true;
        
        switch(input.name) {
            case 'fullname':
                isValid = value.length >= 3;
                break;
            case 'phone':
                isValid = /^[0-9]{10,15}$/.test(value.replace(/[\s-]/g, ''));
                break;
            case 'email':
                isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
                break;
        }
        
        if (isValid) {
            input.style.borderColor = '#2ecc71';
        } else {
            input.style.borderColor = '#e74c3c';
        }
        
        return isValid;
    }
    
    // Price calculation with animation
    function updateTotalPrice() {
        const priceElement = document.querySelector('.info-box p');
        if (!priceElement) return;
        
        const basePrice = parseInt(priceElement.textContent.replace(/[^0-9]/g, ''));
        
        if (inDateInput.value && outDateInput.value) {
            const inDate = new Date(inDateInput.value);
            const outDate = new Date(outDateInput.value);
            const days = Math.ceil((outDate - inDate) / (1000 * 60 * 60 * 24));
            
            if (days > 0) {
                const totalPrice = basePrice * days;
                const formattedTotal = new Intl.NumberFormat('id-ID').format(totalPrice);
                const formattedBase = new Intl.NumberFormat('id-ID').format(basePrice);
                
                priceElement.innerHTML = `
                    <div class="price-info">
                        <div class="base-price">Rp ${formattedBase}/malam</div>
                        <div class="total-price">Total: Rp ${formattedTotal}</div>
                        <div class="stay-duration">${days} malam</div>
                    </div>
                `;
            }
        }
    }
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        inputs.forEach(input => {
            if (!validateInput(input)) {
                isValid = false;
            }
        });
        
        // Validate dates
        const inDate = new Date(inDateInput.value);
        const outDate = new Date(outDateInput.value);
        
        if (outDate <= inDate) {
            showError('Tanggal check-out harus setelah tanggal check-in');
            isValid = false;
        }
        
        if (isValid) {
            submitBtn.value = 'Memproses...';
            submitBtn.disabled = true;
            // Submit the form
            this.submit();
        }
    });
    
    function showError(message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message animate-fade-in';
        errorDiv.textContent = message;
        
        const existingError = form.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }
        
        form.insertBefore(errorDiv, form.firstChild);
        
        setTimeout(() => {
            errorDiv.remove();
        }, 5000);
    }
});