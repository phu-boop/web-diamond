
document.addEventListener("DOMContentLoaded", function () {
    let form_container = document.querySelector(".form_container");
    let remove_create= document.querySelector(".remove_create");
    document.querySelectorAll(".add_category").forEach(function (element) {
        element.addEventListener("click", function () {
            form_container.classList.add("active");
        });
    });
    document.querySelectorAll(".remove_create").forEach(function (element) {
        element.addEventListener("click", function () {
            form_container.classList.remove("active");
        });
    });
    tinymce.init({
        selector: '.mytextarea',
        plugins: 'link image',
        toolbar: 'bold italic underline | link image',
        height: 300
    });
    
});
