function openModal(cardElement) {
    const modal = document.getElementById('eventModal');
    const eventData = JSON.parse(cardElement.dataset.event);
    
    // Populate modal with event data
    document.getElementById('modalImage').src = eventData.image;
    document.getElementById('modalVenue').textContent = eventData.venue;
    document.getElementById('modalRating').innerHTML = eventData.rating ? `★ ${eventData.rating}` : '';
    document.getElementById('modalDistance').textContent = eventData.distance ? `${eventData.distance} kilometers away` : '';
    document.getElementById('modalSchedule').textContent = `${eventData.date} – ${eventData.time}`;
    document.getElementById('modalTopic').textContent = eventData.event_topic;
    
    // Show modal
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
}

function closeModal() {
    const modal = document.getElementById('eventModal');
    modal.style.display = 'none';
    document.body.style.overflow = ''; // Restore scrolling
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