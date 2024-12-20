document.addEventListener('DOMContentLoaded', function() {
    // Handle favorite button clicks
    const favoriteBtns = document.querySelectorAll('.favorite-btn');
    
    favoriteBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
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

    // Format accommodation numbers
    const accommodationCounts = document.querySelectorAll('.accommodation-count');
    accommodationCounts.forEach(count => {
        const number = parseInt(count.textContent.replace(/[^0-9]/g, ''));
        count.innerHTML = `<i class="fas fa-building"></i> ${number.toLocaleString()} akomodasi`;
    });
});