document.addEventListener('DOMContentLoaded', function() {
    // Add animation class to elements
    const animateElements = document.querySelectorAll('.page-header, .photo-container, .facility-container, .info-box, .booking-form');
    animateElements.forEach((element, index) => {
        setTimeout(() => {
            element.classList.add('animate-fade-in');
        }, index * 100);
    });

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

    // Di dalam event listener DOMContentLoaded yang sudah ada
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

// Animasi untuk deskripsi
const description = document.querySelector('.property-description');
if (description) {
    setTimeout(() => {
        description.style.opacity = '0';
        description.style.transform = 'translateY(20px)';
        description.style.transition = 'all 0.5s ease';
        
        requestAnimationFrame(() => {
            description.style.opacity = '1';
            description.style.transform = 'translateY(0)';
        });
    }, 300);
}

// Tutup pesan sukses setelah 5 detik
if (document.querySelector('.alert-success')) {
    setTimeout(function() {
        document.querySelector('.alert-success').classList.remove('show');
    }, 5000);
}

// Handle action buttons
const cartButton = document.querySelector('.cart-button');
const bookButton = document.querySelector('.book-button');

if (cartButton) {
    cartButton.addEventListener('click', function() {
        // Add to cart functionality
        console.log('Added to cart');
    });
}

if (bookButton) {
    bookButton.addEventListener('click', function() {
        // Book now functionality
        console.log('Booking now');
    });
}

// Di dalam event listener DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const modalContainer = document.createElement('div');
    modalContainer.id = 'reservationModal';
    document.body.appendChild(modalContainer);

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateForm()) return;
        
        const formData = new FormData(this);
        
        fetch(window.location.href, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Render modal menggunakan React
                const root = ReactDOM.createRoot(modalContainer);
                root.render(
                    <ReservationSummary 
                        isOpen={true}
                        reservationData={data.reservation}
                        onClose={() => {
                            root.unmount();
                            window.location.reload();
                        }}
                    />
                );
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memproses reservasi');
        });
    });
});

// Tambahkan di dalam event listener DOMContentLoaded di details.js
const alertSuccess = document.querySelector('.alert-success');
if (alertSuccess && alertSuccess.classList.contains('show')) {
    setTimeout(() => {
        alertSuccess.classList.remove('show');
    }, 5000); // Alert akan hilang setelah 5 detik
}

document.addEventListener('DOMContentLoaded', function() {
    // Share button interaction
    const shareBtn = document.querySelector('.share-btn');
    shareBtn.addEventListener('click', function() {
        this.classList.toggle('clicked');
        
        if (this.classList.contains('clicked')) {
            navigator.clipboard.writeText(window.location.href);
            // Notifikasi saat diklik pertama kali
            const notification = document.createElement('div');
            notification.className = 'share-notification';
            notification.textContent = 'Link copied to clipboard!';
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 2000);
        }
    });

    // Favorite button interaction
    const favoriteBtn = document.querySelector('.favorite-btn');
    favoriteBtn.addEventListener('click', function() {
        const icon = this.querySelector('i');
        if (icon.classList.contains('far')) {
            icon.classList.replace('far', 'fas');
            this.classList.add('active');
        } else {
            icon.classList.replace('fas', 'far');
            this.classList.remove('active');
        }
    });

    // Info button interaction
    const infoBtn = document.querySelector('.info-btn');
    infoBtn.addEventListener('click', function() {
        this.classList.add('active');
        // Add your info modal/popup logic here
        setTimeout(() => this.classList.remove('active'), 300);
    });

 // Hover animation
 const actionBtns = document.querySelectorAll('.action-icon');
 actionBtns.forEach(btn => {
     btn.addEventListener('mouseenter', function() {
         if (!this.classList.contains('clicked')) {
             this.style.color = '#c5f82a';
         }
     });
     
     btn.addEventListener('mouseleave', function() {
         if (!this.classList.contains('clicked')) {
             this.style.color = '#a0a4a8';
         }
     });
 });
});

// CSS untuk notifikasi
const style = document.createElement('style');
style.textContent = `
    .share-notification,
    .cart-notification {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(197, 248, 42, 0.9);
        color: #1a1e23;
        padding: 10px 20px;
        border-radius: 4px;
        font-weight: 500;
        animation: fadeInOut 2s ease;
        z-index: 1000;
    }

    @keyframes fadeInOut {
        0% { opacity: 0; transform: translate(-50%, 20px); }
        15% { opacity: 1; transform: translate(-50%, 0); }
        85% { opacity: 1; transform: translate(-50%, 0); }
        100% { opacity: 0; transform: translate(-50%, -20px); }
    }
`;
document.head.appendChild(style);
document.head.appendChild(style);
});

document.addEventListener('DOMContentLoaded', function() {
    const cartBtn = document.querySelector('.cart-btn');
    let alertTimeout;

    function showCartAlert(message) {
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

        // Tunda sebentar sebelum menampilkan alert (untuk efek smooth)
        setTimeout(() => {
            alert.classList.add('show');
        }, 10);

        // Clear timeout yang ada
        if (alertTimeout) {
            clearTimeout(alertTimeout);
        }

        // Set timeout baru untuk menghilangkan alert
        alertTimeout = setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 3000);
    }

    cartBtn.addEventListener('click', function() {
        if (this.classList.contains('active')) {
            // Jika sudah aktif, hapus dari keranjang
            this.classList.remove('active');
            showCartAlert('Item removed from cart');
        } else {
            // Jika belum aktif, tambahkan ke keranjang
            this.classList.add('active');
            showCartAlert('Item added to cart');
        }
    });

    // Share button interaction (tetap sama seperti sebelumnya)
    const shareBtn = document.querySelector('.share-btn');
    shareBtn.addEventListener('click', function() {
        navigator.clipboard.writeText(window.location.href);
        showCartAlert('Link copied to clipboard!');
    });
});