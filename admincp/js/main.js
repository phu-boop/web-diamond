document.addEventListener('DOMContentLoaded', function() {
    let add_category = document.querySelector('.add_category');
    let overlay = document.querySelector('.overlay');
    let body = document.body;

    add_category.addEventListener("click", function() {
        overlay.style.display = 'block';
        body.classList.add('active');
    });

    overlay.addEventListener("click", function() {
        overlay.style.display = 'none';
        body.classList.remove('active');
    });
});
