document.addEventListener("DOMContentLoaded", function() {
    let product_image = document.querySelector(".product-image");

    if (product_image) {
        product_image.addEventListener("click", function() {
            toggle_active("product-image");
        });
    }

    function toggle_active(className) {
        let class_element = document.querySelector(`.${className}`);
        if (class_element) {
            class_element.classList.toggle("active");
        } 
    }
    // size
    let add=document.querySelector(".right");
    let element=document.querySelector(".img_size");
    let remove=document.querySelector(".remove");
    if(size){
        add.addEventListener("click",function (){
            element.classList.add("active");
        });
    }
    if(remove){
        remove.addEventListener("click",function (){
            element.classList.remove("active");
        });
    }
    //img
    let image_detail=document.querySelector(".image_detail");
    let wrapper=document.querySelector(".wrapper");
    if(image_detail){
        image_detail.addEventListener("click",function (){
            wrapper.classList.add("active");
        });
    }
    let remove_img=document.querySelector(".container_fullscreen");
    if(remove_img){
        remove_img.addEventListener("click",function(){
            wrapper.classList.remove("active");
        });
    }
    //detail
    let menu_detail = document.getElementsByClassName("menu_detail");
    let menu_detail_bottom=document.getElementsByClassName("menu_detail_bottom");
    let index;
    for (let element of menu_detail) {
        element.addEventListener("click", function () {
            Array.from(menu_detail).forEach(el => el.classList.remove('active'));
            element.classList.add("active");
            index=element.getAttribute("index");
            for(let element of menu_detail_bottom){
                if(element.getAttribute("index")==index){ 
                    Array.from(menu_detail_bottom).forEach(el => el.classList.remove('active'));
                    element.classList.add("active");
                }
            }
        });
    }
    //câu hỏi thường gặp
    document.querySelectorAll(".faq-question").forEach(question => {
        question.addEventListener("click", function () {
            this.classList.toggle("active");
        });
    });
    
    
});


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
    //gallery
    const galleryContainer = document.querySelector('.gallery-container');
    const galleryControlsContainer = document.querySelector('.gallery-controls');
    const galleryControls = ['previous', 'next'];
    const galleryItems = document.querySelectorAll('.gallery-item');

    class Carousel {
    constructor(container, items, controls) {
        this.carouselContainer = container;
        this.carouselControls = controls;
        this.carouselArray = [...items];
    }

    updateGallery() {
        this.carouselArray.forEach(el => {
        el.classList.remove('gallery-item-1');
        el.classList.remove('gallery-item-2');
        el.classList.remove('gallery-item-3');
        el.classList.remove('gallery-item-4');
        el.classList.remove('gallery-item-5');
        });

        this.carouselArray.slice(0, 5).forEach((el, i) => {
        el.classList.add(`gallery-item-${i + 1}`);
        });
        this.addActive_1();

    }
    setListProduct() {
        for (let el of this.carouselArray) {
            if (el.classList.contains('gallery-item-3')) {
                var dataIndex = el.dataset.index;
                return dataIndex;
            }
        }
    }  
    addActive_1(){
        var valueToCompare = this.setListProduct();
        var previousActive = document.querySelector('.active_1');
        if (previousActive) {
            previousActive.classList.remove('active_1');
        }
        var listProduct = document.querySelector('[index="' + valueToCompare + '"]');
        if (listProduct) {
            listProduct.classList.add('active_1');
        }
    }  
    setCurrentState(direction) {
        if (direction.className == 'gallery-controls-previous') {
          this.carouselArray.unshift(this.carouselArray.pop());
        } else {
          this.carouselArray.push(this.carouselArray.shift());
        }
        this.updateGallery();
      }
    setControls() {
        this.carouselControls.forEach(control => {
            let btn = document.createElement('button'); // Tạo button
            btn.className = `gallery-controls-${control}`; // Gán class
            galleryControlsContainer.appendChild(btn); // Thêm vào container
        });
    }
    useControls() {
        const triggers = [...galleryControlsContainer.childNodes];
      
        triggers.forEach(control => {
          control.addEventListener('click', e => {
            e.preventDefault();
            this.setCurrentState(control);
          });
        });
      }     
    }

    const exampleCarousel = new Carousel(galleryContainer, galleryItems, galleryControls);

    exampleCarousel.setControls();
    exampleCarousel.useControls();

});

document.addEventListener("DOMContentLoaded", function () {
    const params = new URLSearchParams(window.location.search);
    let currentPage = parseInt(params.get("trang")) || 0;
    const indexPages = document.querySelectorAll(".index_page");
    if (indexPages[currentPage]) {
        indexPages.forEach(el => el.classList.remove("active")); 
        indexPages[currentPage].classList.add("active"); 
    }
});



document.addEventListener("DOMContentLoaded", function () {
    let menu=document.querySelector(".account_menu");
    let fa_user = document.querySelector(".fa-user");
    fa_user.addEventListener("click", function () {
        menu.classList.toggle("active");
    });
});


