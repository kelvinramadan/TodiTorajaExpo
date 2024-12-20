document.addEventListener('DOMContentLoaded', function() {
    // Add animation class to elements
    const animateElements = document.querySelectorAll('.page-header, .photo-container, .facility-container, .info-box, .booking-form');
    animateElements.forEach((element, index) => {
        setTimeout(() => {
            element.classList.add('animate-fade-in');
        }, index * 100);
    });

    // Gallery functionality
    const lightbox = document.createElement('div');
    lightbox.classList.add('lightbox');
    lightbox.innerHTML = `
        <div class="lightbox-content">
        <img src="" alt="">
    </div>
    `;
    document.body.appendChild(lightbox);

    // Get all gallery images
    const allImages = [...document.querySelectorAll('.photo, .facility')];
    let currentImageIndex = 0;

    // Add click handlers to images
    allImages.forEach((img, index) => {
        img.addEventListener('click', () => {
            currentImageIndex = index;
            showImage(currentImageIndex);
            lightbox.classList.add('active');
        });
    });

    // Handle keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!lightbox.classList.contains('active')) return;
        
        if (e.key === 'Escape') {
            lightbox.classList.remove('active');
        } else if (e.key === 'ArrowLeft') {
            currentImageIndex = (currentImageIndex - 1 + allImages.length) % allImages.length;
            showImage(currentImageIndex);
        } else if (e.key === 'ArrowRight') {
            currentImageIndex = (currentImageIndex + 1) % allImages.length;
            showImage(currentImageIndex);
        }
    });

    function showImage(index) {
        const imgSrc = allImages[index].src;
        lightboxImage.src = imgSrc;
    }

    // Cart button interaction
    const cartBtn = document.querySelector('.cart-btn');
    let alertTimeout;

    function showAlert(message) {
        // Hapus alert lama jika ada
        const existingAlert = document.querySelector('.cart-alert');
        if (existingAlert) {
            existingAlert.remove();
        }

        // Buat alert baru
        const alert = document.createElement('div');
        alert.className = 'cart-alert';
        alert.innerHTML = `
            <i class="fas fa-check-circle"></i>
            <span>${message}</span>
        `;
        document.body.appendChild(alert);

        // Efek smooth
        setTimeout(() => {
            alert.classList.add('show');
        }, 10);

        // Clear timeout yang ada
        if (alertTimeout) {
            clearTimeout(alertTimeout);
        }

        // Set timeout baru
        alertTimeout = setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 3000);
    }

    if (cartBtn) {
        cartBtn.addEventListener('click', function() {
            this.classList.toggle('active');
            if (this.classList.contains('active')) {
                showAlert('Berhasil ditambahkan ke keranjang');
            } else {
                showAlert('Berhasil dihapus dari keranjang');
            }
        });
    }

    // Form Validation
    function validateForm() {
        const inputs = document.querySelectorAll('form input[required]');
        let isValid = true;
        
        inputs.forEach(input => {
            if (!input.value) {
                isValid = false;
                input.style.borderColor = '#e74c3c';
            } else {
                input.style.borderColor = '#2ecc71';
            }
        });
        
        if (!isValid) {
            alert('Mohon isi semua field yang diperlukan');
            return false;
        }
        
        return true;
    }

    // Form handling
    const form = document.querySelector('form');
    const inDateInput = document.querySelector('input[name="in_date"]');
    const outDateInput = document.querySelector('input[name="out_date"]');
    
    // Set minimum date for check-in to today
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    // Format dates for input fields
    const formatDate = (date) => {
        return date.toISOString().split('T')[0];
    };
    
    // Set minimum dates for inputs
    if (inDateInput && outDateInput) {
        inDateInput.min = formatDate(today);
        outDateInput.min = formatDate(tomorrow);
        
        // Update check-out minimum date when check-in date changes
        inDateInput.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const minCheckOut = new Date(selectedDate);
            minCheckOut.setDate(selectedDate.getDate() + 1);
            
            outDateInput.min = formatDate(minCheckOut);
            
            if (new Date(outDateInput.value) <= selectedDate) {
                outDateInput.value = formatDate(minCheckOut);
            }
            
            updateTotalPrice();
        });
        
        outDateInput.addEventListener('change', updateTotalPrice);
    }

    // Price calculation
    function updateTotalPrice() {
        const priceElement = document.querySelector('.info-box p');
        if (!priceElement || !inDateInput.value || !outDateInput.value) return;
        
        const basePrice = parseInt(priceElement.textContent.replace(/[^0-9]/g, ''));
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

    // Form submission
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (validateForm()) {
                const formData = new FormData(this);
                
                // Here you would typically send the data to the server
                // For now, we'll just submit the form
                this.submit();
            }
        });
    }

    // Animation for property features
    const propertyFeatures = document.querySelectorAll('.info-box.feature');
    propertyFeatures.forEach((feature, index) => {
        setTimeout(() => {
            feature.style.opacity = '0';
            feature.style.transform = 'translateY(20px)';
            feature.style.transition = 'all 0.5s ease';
            
            requestAnimationFrame(() => {
                feature.style.opacity = '1';
                feature.style.transform = 'translateY(0)';
            });
        }, index * 100);
    });

    // Success alert auto-hide
    const alertSuccess = document.querySelector('.alert-success');
    if (alertSuccess && alertSuccess.classList.contains('show')) {
        setTimeout(() => {
            alertSuccess.classList.remove('show');
        }, 5000);
    }
});