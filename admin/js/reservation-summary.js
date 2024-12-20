document.addEventListener('DOMContentLoaded', function() {
    // Animasi untuk card saat halaman dimuat
    const card = document.querySelector('.summary-card');
    card.style.animation = 'scaleIn 0.5s ease forwards';

    // Efek hover untuk card
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.02)';
    });

    card.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });

    // Tombol close
    const closeBtn = document.querySelector('.close-btn');
    closeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        card.style.animation = 'fadeOut 0.5s ease forwards';
        setTimeout(() => {
            window.location.href = this.href;
        }, 500);
    });

    // Tombol Check In
    const checkInBtn = document.querySelector('.btn.check-in');
    checkInBtn.addEventListener('click', function() {
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 100);
        
        // Tambahkan efek loading
        const originalText = this.textContent;
        this.textContent = 'Processing...';
        this.disabled = true;
        
        // Simulasi proses (bisa diganti dengan actual AJAX call)
        setTimeout(() => {
            this.textContent = 'Checked In!';
            this.style.background = '#28a745';
            
            // Reset button setelah 2 detik
            setTimeout(() => {
                this.textContent = originalText;
                this.style.background = '#007bff';
                this.disabled = false;
            }, 2000);
        }, 1500);
    });

    // Animate price elements
    const priceElements = document.querySelectorAll('.price, .total');
    priceElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
    });

    setTimeout(() => {
        priceElements.forEach((el, index) => {
            setTimeout(() => {
                el.style.transition = 'all 0.5s ease';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, index * 200);
        });
    }, 500);
});