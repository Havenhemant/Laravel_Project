import './bootstrap';
document.addEventListener("DOMContentLoaded", () => {
    console.log(" App Loaded");

    
    setTimeout(() => {
        document.querySelectorAll('.alert-success').forEach(el => {
            el.style.display = 'none';
        });
    }, 3000);
});
