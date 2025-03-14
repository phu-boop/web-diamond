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
    const list_slide = Array.from(document.getElementsByClassName("slide"));
    const numSlides = list_slide.length;
    const dotsContainer = document.querySelector(".dots-container");

    function showSlide(n) {
        index = (n + numSlides) % numSlides;
        slides.style.transform = `translateX(${-index * 100}%)`;
        updateDots();
    }

    function nextSlide() { showSlide(index + 1); }
    function prevSlide() { showSlide(index - 1); }

    document.querySelector(".next").addEventListener("click", nextSlide);
    document.querySelector(".prev").addEventListener("click", prevSlide);

    function createDots() {
        dotsContainer.innerHTML = ""; 
        list_slide.forEach((_, i) => {
            const dot = document.createElement("div");
            dot.classList.add("dot");
            if (i === index) dot.classList.add("active");
            dot.addEventListener("click", () => showSlide(i));
            dotsContainer.appendChild(dot);
        });
    }

    function updateDots() {
        document.querySelectorAll(".dot").forEach((dot, i) => {
            dot.classList.toggle("active", i === index);
        });
    }

    createDots();
    setInterval(nextSlide, 5000);

});
