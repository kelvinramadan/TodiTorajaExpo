function openTourModal(element) {
    const tourData = JSON.parse(element.getAttribute('data-tour'));
    const modal = document.getElementById('tourModal');
    
    // Set modal content
    document.getElementById('modalTourImage').src = tourData.photo;
    document.getElementById('modalTourTitle').textContent = tourData.title;
    if (tourData.rating) {
        document.getElementById('modalTourRating').textContent = '★ ' + tourData.rating;
    }
    document.getElementById('modalAccommodation').innerHTML = `<i class="fas fa-building"></i> ${number_format(tourData.total_accommodation)} akomodasi`;
    document.getElementById('modalTourDetails').textContent = tourData.details;
    document.getElementById('modalTourLink').href = `tour.php?tour=${tourData.id}`;
    
    modal.style.display = 'block';
}

function closeTourModal() {
    document.getElementById('tourModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('tourModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

function number_format(number) {
    return new Intl.NumberFormat().format(number);
}