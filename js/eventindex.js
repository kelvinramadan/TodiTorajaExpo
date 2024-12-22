// Event modal functionality
function openModal(cardElement) {
    const modal = document.getElementById('eventModal');
    const eventData = JSON.parse(cardElement.dataset.event);
    
    // Populate modal with event data
    document.getElementById('modalImage').src = eventData.image;
    document.getElementById('modalTopic').textContent = eventData.event_topic;
    document.getElementById('modalVenue').textContent = eventData.venue;
    document.getElementById('modalRating').innerHTML = eventData.rating ? `★ ${eventData.rating}` : '';
    document.getElementById('modalSchedule').textContent = `${eventData.date} – ${eventData.time}`;
    document.getElementById('modalShortDetails').innerHTML = eventData.short_details;
    document.getElementById('modalFullDetails').innerHTML = eventData.full_details;
    
    // Show modal
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
}

function closeModal() {
    const modal = document.getElementById('eventModal');
    modal.style.display = 'none';
    document.body.style.overflow = ''; // Restore scrolling
}

// Handle favorite toggle
async function toggleFavorite(event, eventId) {
    event.stopPropagation(); // Prevent modal from opening
    
    try {
        const response = await fetch('api/toggle_event_like.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ event_id: eventId })
        });
        
        const data = await response.json();
        
        if (data.success) {
            const heartIcon = event.target.closest('.favorite-btn').querySelector('i');
            heartIcon.classList.toggle('far');
            heartIcon.classList.toggle('fas');
        }
    } catch (error) {
        console.error('Error toggling favorite:', error);
    }
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('eventModal');
    if (event.target === modal) {
        closeModal();
    }
}

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});

// Image error handling
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.card-img-top');
    images.forEach(img => {
        img.addEventListener('error', function() {
            this.src = 'images/default-event.jpg';
        });
    });
});