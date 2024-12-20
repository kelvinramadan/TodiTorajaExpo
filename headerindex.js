function animateCounter(element, target) {
    let current = 0;
    const increment = target / 50; // Adjust speed
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        element.textContent = Math.round(current);
    }, 40);
}

// Initialize counters when in viewport
function initCounters() {
    const stats = document.querySelectorAll('.stat-number');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.getAttribute('data-target'));
                animateCounter(entry.target, target);
                observer.unobserve(entry.target);
            }
        });
    });

    stats.forEach(stat => observer.observe(stat));
}

// Parallax effect for hero section
function parallaxScroll() {
    const hero = document.querySelector('.hero-slider');
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    });
}

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    initCounters();
    parallaxScroll();
});

// Smooth scroll for the scroll indicator
document.querySelector('.scroll-indicator').addEventListener('click', () => {
    window.scrollTo({
        top: window.innerHeight,
        behavior: 'smooth'
    });
});

// Add active class to search inputs on focus
const searchInputs = document.querySelectorAll('.search-item input');
searchInputs.forEach(input => {
    input.addEventListener('focus', () => {
        input.parentElement.classList.add('active');
    });
    input.addEventListener('blur', () => {
        input.parentElement.classList.remove('active');
    });
});