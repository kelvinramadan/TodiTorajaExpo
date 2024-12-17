// Add animations on page load
document.addEventListener("DOMContentLoaded", function () {
    const headers = document.querySelectorAll(".page-header h2");
    headers.forEach((header) => {
        header.style.opacity = 0;
        header.style.transform = "translateY(-20px)";
        setTimeout(() => {
            header.style.transition = "all 0.5s ease";
            header.style.opacity = 1;
            header.style.transform = "translateY(0)";
        }, 300);
    });
});

// Form validation
const form = document.querySelector("form");
form.addEventListener("submit", function (e) {
    const inputs = form.querySelectorAll(".form-control");
    let isValid = true;

    inputs.forEach((input) => {
        if (input.value.trim() === "" && !input.hasAttribute("readonly")) {
            isValid = false;
            input.style.border = "1px solid red";
            input.style.boxShadow = "0 0 5px rgba(255, 0, 0, 0.5)";
        } else {
            input.style.border = "1px solid #ced4da";
            input.style.boxShadow = "none";
        }
    });

    if (!isValid) {
        e.preventDefault();
        alert("Please fill out all required fields!");
    }
});

// Button animation on hover
const btn = document.querySelector(".btn-primary");
btn.addEventListener("mouseover", function () {
    btn.style.transform = "scale(1.05)";
    btn.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.2)";
});
btn.addEventListener("mouseout", function () {
    btn.style.transform = "scale(1)";
    btn.style.boxShadow = "none";
});
