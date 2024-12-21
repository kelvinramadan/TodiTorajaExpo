// Updated add_event.js
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const mobileNav = document.querySelector('.mobile-nav');
    const overlay = document.querySelector('.overlay');
    const mainContent = document.querySelector('.w3-main');

    function toggleSidebar() {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
        
        if (sidebar.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
            overlay.style.display = 'block';
        } else {
            document.body.style.overflow = '';
            setTimeout(() => {
                overlay.style.display = 'none';
            }, 300); // Match transition time
        }
    }

    // Mobile nav click handler
    mobileNav?.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleSidebar();
    });

    // Overlay click handler
    overlay?.addEventListener('click', toggleSidebar);

    // Close sidebar when clicking links (mobile only)
    const sidebarLinks = document.querySelectorAll('.nav-links a');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                toggleSidebar();
            }
        });
    });

    // Handle resize events
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            }
        }, 250);
    });

    // Handle escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && sidebar.classList.contains('active')) {
            toggleSidebar();
        }
    });
});