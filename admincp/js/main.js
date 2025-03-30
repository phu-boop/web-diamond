
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
        selector: '.mytextarea',  // Chọn ô textarea bạn muốn sử dụng
        plugins: 'bold italic underline | link image',  // Các plugin để hỗ trợ tính năng in đậm, in nghiêng, v.v.
        toolbar: 'bold italic underline | link image',  // Thanh công cụ với các tính năng
        apiKey: 'your-api-key'  // Thêm API key ở đây
    });
});
