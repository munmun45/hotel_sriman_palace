
let Gallery_pop = document.getElementById("Gallery_pop");
let pop_images = document.getElementById("Pop_img");



function show(img) {
    Gallery_pop.style.display ="block";
    pop_images.src = img ;
}
function close_pop() {
    Gallery_pop.style.display ="none";
    pop_images.src = "" ;
}



