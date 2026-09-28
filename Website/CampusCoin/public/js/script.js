const body = document.body;
const menuButton = document.getElementById("menuButton");
const sidebar = document.getElementById("sidebar");

// Theme toggling ab nav.blade.php ke shared script (cc-theme key) se handle hota hai.
// Yahan se purana theme code hata diya gaya hai taake conflict na ho.

if (menuButton && sidebar) {
    menuButton.addEventListener("click", () => {
        sidebar.classList.toggle("open");
    });
}

document.querySelectorAll(".nav-link").forEach(link => {
    link.addEventListener("click", () => {
        if (window.innerWidth <= 850 && sidebar) {
            sidebar.classList.remove("open");
        }
    });
});

const currentPage = window.location.pathname.split("/").pop();

document.querySelectorAll(".nav-link").forEach(link => {
    const linkPage = link.getAttribute("href");

    if (linkPage === currentPage) {
        link.classList.add("active");
    }
});