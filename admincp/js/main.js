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
    function customizeContentIfNeeded() {
        const expectedUrl = 'http://localhost/web_trang_suc/admincp/index.php?action=quanlythongke&query=xem';
        const currentUrl = window.location.href;

        if (currentUrl === expectedUrl) {
            const contentEl = document.getElementById('content');
            if (contentEl) {
                contentEl.style.padding = '0'; // Xóa padding
                contentEl.style.background = '#f4f4f4'; // Thêm màu nền
            }
        }
    }

    // Gọi hàm khi trang đã load xong
    window.addEventListener('DOMContentLoaded', customizeContentIfNeeded);
