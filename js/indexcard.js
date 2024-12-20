function openModal(card) {
    const eventData = JSON.parse(card.dataset.event);
    const modal = document.getElementById('eventModal');
    
    // Update modal content
    document.getElementById('modalImage').src = eventData.image;
    document.getElementById('modalVenue').textContent = eventData.venue;
    document.getElementById('modalRating').textContent = eventData.rating ? `★ ${eventData.rating}` : '';
    document.getElementById('modalDistance').textContent = `${eventData.distance} kilometers away`;
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
window.onclick = function(event) {
    const modal = document.getElementById('eventModal');
    if (event.target === modal) {
        closeModal();
    }
}

// Handle favorite button clicks
document.querySelectorAll('.favorite-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const icon = this.querySelector('i');
        icon.classList.toggle('far');
        icon.classList.toggle('fas');
    });
});