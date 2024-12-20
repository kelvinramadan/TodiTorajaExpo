// Handle favorite button clicks
document.querySelectorAll('.favorite-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.toggle('active');
        const icon = this.querySelector('i');
        if (icon.classList.contains('far')) {
            icon.classList.remove('far');
            icon.classList.add('fas');
        } else {
            icon.classList.remove('fas');
            icon.classList.add('far');
        }
    });
});

// Modal functionality
function openModal(card) {
    const eventData = JSON.parse(card.dataset.event);
    const modal = document.getElementById('eventModal');
    
    // Update modal content
    document.getElementById('modalImage').src = eventData.image;
    document.getElementById('modalVenue').textContent = eventData.venue;
    
    if (eventData.rating) {
        document.getElementById('modalRating').textContent = `★ ${eventData.rating}`;
    } else {
        document.getElementById('modalRating').textContent = '';
    }
    
    if (eventData.distance) {
        document.getElementById('modalDistance').textContent = `${eventData.distance} kilometers away`;
    }
    
    document.getElementById('modalSchedule').textContent = `${eventData.date} – ${eventData.time}`;
    document.getElementById('modalTopic').textContent = eventData.event_topic;
    
    // Show modal
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('eventModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
window.addEventListener('click', function(event) {
    const modal = document.getElementById('eventModal');
    if (event.target === modal) {
        closeModal();
    }
});

// Close modal with escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});

// Optional: Lazy loading for images
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.card-img-top');
    const imageOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }
                observer.unobserve(img);
            }
        });
    }, imageOptions);

    images.forEach(img => {
        if (img.dataset.src) {
            imageObserver.observe(img);
        }
    });
});