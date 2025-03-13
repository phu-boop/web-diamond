document.addEventListener("DOMContentLoaded", function () {
    //search
    let button = document.querySelector(".search"); 
    let input = document.querySelector(".input_search"); 

    if (button && input) {
        button.addEventListener("click", function () {
            input.classList.add("show"); 
            input.type = "text"; 
            input.focus(); 
        });
    }
    //menu
    let navbar = document.getElementById("navbar");
    let stickyOffset = navbar.offsetTop;
    window.addEventListener("scroll", function () {
        if (window.pageYOffset >= stickyOffset) {
            navbar.classList.add("sticky");
        } else {
            navbar.classList.remove("sticky");
        }
    });
});
