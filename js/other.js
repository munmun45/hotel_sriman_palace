let header_background_img = document.getElementsByClassName("header_background_img");
let header_front_content = document.getElementsByClassName("header_front_content");



window.addEventListener("scroll", function () {
    let offset = window.pageYOffset;

    header_background_img[0].style.transform = "translateY(" + offset * 0.7 + "px)";
    header_front_content[0].style.transform = "translateY(" + offset * 0.5 + "px)";

    
})

let nav_icon = document.getElementsByClassName("nav_icon");
let sidemenu = document.getElementsByClassName("sidemenu");

let _click_sideMenu = 0;

function click_sideMenu() {

    if (_click_sideMenu == 0) {
        nav_icon[0].src = "images/icon/delete.png";
        sidemenu[0].setAttribute("style", "width: 100%;")
        _click_sideMenu = 1;
    } else {
        nav_icon[0].src = "images/icon/menu-icon.png";
        sidemenu[0].setAttribute("style", "width: 0%;")
        _click_sideMenu = 0;

    }

}



// slider service .........................




// let slideIndex = 1;
// showSlides(slideIndex);

// function plusSlides(n) {
//     showSlides(slideIndex += n);
// }

// function currentSlide(n) {
//     showSlides(slideIndex = n);
// }

// function showSlides(n) {
//     let i;
//     let slides = document.getElementsByClassName("service_sub_con_2");
//     let dots = document.getElementsByClassName("service_slider_btn");
//     if (n > slides.length) { slideIndex = 1 }
//     if (n < 1) { slideIndex = slides.length }
//     for (i = 0; i < slides.length; i++) {
//         slides[i].style.display = "none";
//     }
//     for (i = 0; i < dots.length; i++) {
//         dots[i].className = dots[i].className.replace(" service_slider_btn_active", "");
//     }

//     // slides[slideIndex - 1].style.display = "flex";
//     // dots[slideIndex - 1].className += " service_slider_btn_active";

    
// }

// start();



// function emjg() {

//     console,console.log("ok");
//     // plusSlides(1);
//     start();
// }

// function start() {
//     setTimeout(emjg, 100);
    
// }

