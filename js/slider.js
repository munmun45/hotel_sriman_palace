let slider_img = document.getElementsByClassName("slider_img");

start();

let _value = 3;
let zindex = 1;
// slider_img[_value].style.height = "100%";
slider_img[_value].style.opacity = "100";


let act = true;
function start() {
    setTimeout(myFunction, 5000);
}

function myFunction() {





    if (act == true) {
        // slider_img[_value].setAttribute('style','width: 100%; z-index : '+zindex+'');
        // slider_img[_value].style.height = "100%";
        slider_img[_value].style.opacity = "100";

        zindex++;
        _value--;
    } else {
        // slider_img[_value].setAttribute('style','width: 0% ;z-index : '+zindex+'');
        // slider_img[_value].style.height = "0%";
        slider_img[_value].style.opacity = "0";


        _value++;
        zindex++;
    }

    if (_value == -1) {
        act = false;
        _value = 0;
        zindex = 1;
    } else if (_value == 3) {
        _value = 2;
        zindex = 4;
        act = true;
    }





    // if(_value == 3)
    // {
    //     _value_0 = 0;
    // }else{

    //     slider_img[_value_0].setAttribute('style','display: none');
    //     _value_0 = 2 + _value;
    // }


    // console.log(_value);

    start();
}