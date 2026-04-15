import './bootstrap';
document.addEventListener("DOMContentLoaded", () => {
    console.log("🚀 App Loaded");

    // Auto hide alerts after 3 sec
    setTimeout(() => {
        document.querySelectorAll('.alert-success').forEach(el => {
            el.style.display = 'none';
        });
    }, 3000);
});
