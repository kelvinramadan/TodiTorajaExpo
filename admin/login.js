// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize form validation
    initFormValidation();
    
    // Add input animations
    initInputAnimations();
    
    // Initialize scroll to top
    initScrollToTop();
});

function initFormValidation() {
    const form = document.querySelector('form');
    const emailInput = form.querySelector('input[type="email"]');
    const passwordInput = form.querySelector('input[type="password"]');
    const submitButton = form.querySelector('input[type="submit"]');

    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Reset previous error states
        hideAllErrors();
        
        // Validate email
        if (!emailInput.value) {
            showError(emailInput, 'Email is required');
            isValid = false;
        } else if (!isValidEmail(emailInput.value)) {
            showError(emailInput, 'Please enter a valid email address');
            isValid = false;
        }
        
        // Validate password
        if (!passwordInput.value) {
            showError(passwordInput, 'Password is required');
            isValid = false;
        } else if (passwordInput.value.length < 6) {
            showError(passwordInput, 'Password must be at least 6 characters');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
        } else {
            // Show loading state
            submitButton.value = 'Logging in...';
            submitButton.classList.add('loading');
            submitButton.disabled = true;
        }
    });
}

function initInputAnimations() {
    const inputs = document.querySelectorAll('.form-control');
    
    inputs.forEach(input => {
        // Add focus effect
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        // Remove focus effect if empty
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
        
        // Check initial state
        if (input.value) {
            input.parentElement.classList.add('focused');
        }
    });
}

function initScrollToTop() {
    const scrollButton = document.querySelector('a[href="#Home"]');
    
    if (scrollButton) {
        scrollButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Show/hide scroll button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 100) {
                scrollButton.style.opacity = '1';
            } else {
                scrollButton.style.opacity = '0';
            }
        });
    }
}

function showError(input, message) {
    const formGroup = input.closest('.form-group');
    const error = document.createElement('div');
    error.className = 'w3-text-red';
    error.textContent = message;
    formGroup.appendChild(error);
    formGroup.classList.add('has-error');
}

function hideAllErrors() {
    document.querySelectorAll('.w3-text-red').forEach(error => {
        if (error.parentElement.classList.contains('form-group')) {
            error.remove();
        }
    });
    document.querySelectorAll('.has-error').forEach(elem => {
        elem.classList.remove('has-error');
    });
}

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

// Add smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});