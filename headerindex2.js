document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    const progress = document.querySelector('.progress');
    const currentNum = document.querySelector('.current');
    let currentSlide = 0;
    let progressWidth = 0;
    let progressInterval;

    function updateSlide(index) {
        // Remove active class from current slide
        slides[currentSlide].classList.remove('active');
        
        // Update current slide index
        currentSlide = (index + slides.length) % slides.length;
        
        // Reset animations by removing and re-adding active class
        slides[currentSlide].classList.remove('active');
        void slides[currentSlide].offsetWidth; // Force reflow
        slides[currentSlide].classList.add('active');
        
        // Update slide number
        currentNum.textContent = `0${currentSlide + 1}`;
        
        // Reset and start progress bar
        resetProgress();
    }

    function resetProgress() {
        clearInterval(progressInterval);
        progressWidth = 0;
        progress.style.width = '0%';
        startProgress();
    }

    function startProgress() {
        progressInterval = setInterval(() => {
            progressWidth += 0.1;
            progress.style.width = `${progressWidth}%`;
            
            if (progressWidth >= 100) {
                updateSlide(currentSlide + 1);
            }
        }, 15);
    }

    // Navigation button event listeners
    prevButton.addEventListener('click', () => {
        updateSlide(currentSlide - 1);
    });

    nextButton.addEventListener('click', () => {
        updateSlide(currentSlide + 1);
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            updateSlide(currentSlide - 1);
        } else if (e.key === 'ArrowRight') {
            updateSlide(currentSlide + 1);
        }
    });

    // Initialize progress
    startProgress();
});