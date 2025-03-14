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
    //menu top
    let navbar = document.getElementById("navbar");
    let stickyOffset = navbar.offsetTop;
    window.addEventListener("scroll", function () {
        if (window.pageYOffset >= stickyOffset) {
            navbar.classList.add("sticky");
        } else {
            navbar.classList.remove("sticky");
        }
    });
    //menu screen
    let menu = document.querySelector(".menu-toggle");
    let block = document.querySelector(".screen");
    if (menu && block) {
        menu.addEventListener("click",function (even){
            event.preventDefault();
            block.classList.toggle("active");
        });
    }
    //slider
    let index = 0;
    const slides = document.querySelector(".slides");

    function showSlide(n) {
        index = (n + 3) % 3; 
        slides.style.transform = `translateX(${-index * 100}%)`;
    }
    let next=document.querySelector(".next");
    let prev=document.querySelector(".prev");

    next.addEventListener("click",function () {
        nextSlide();
    });
    prev.addEventListener("click",function () {
        prevSlide();
    });
    function nextSlide() { showSlide(index + 1); }
    function prevSlide() { showSlide(index - 1); }

    dotsContainer=document.querySelector(".dots-container");
    list_slide=Array.from(document.getElementsByClassName("slide"));
    function createDots() {
        list_slide.forEach((_, index) => {
            const dot = document.createElement("div");
            dot.classList.add("dot");
            dotsContainer.appendChild(dot);
        });
    }
    createDots();
    


    setInterval(nextSlide, 5000);
});
