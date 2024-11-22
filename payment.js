document.addEventListener("DOMContentLoaded", function () {
    // Highlight rows on hover
    const rows = document.querySelectorAll('.table tr');
    rows.forEach(row => {
        row.addEventListener('mouseover', () => {
            row.style.backgroundColor = '#ffe4d5';
        });

        row.addEventListener('mouseout', () => {
            row.style.backgroundColor = '';
        });
    });

    // Scroll animation (if the page is long)
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
