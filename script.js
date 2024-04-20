const header = document.querySelector('header');
var navbar = document.querySelector('.navbar');
var userBox = document.querySelector('.user-box');

function fixedNavbar(){
    header.classList.toggle('scroll',window.pageYOffset > 0)
}
fixedNavbar();
window.addEventListener('scroll',fixedNavbar);

/*-----------------menu and user button------------------*/
let menu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn');

menu.addEventListener('click' , function(){
    let nav = document.querySelector('.navbar');
    nav.classList.toggle("active");
})

userBtn.addEventListener('click',function(){  
    let userBox = document.querySelector('.user-box');
    userBox.classList.toggle("active");   
})

/*--------------home page slider--------------------- */
"use strict"
const leftArrow = document.querySelector('.left-arrow .bxs-left-arrow'),
    rightArrow = document.querySelector('.right-arrow .bxs-right-arrow'),
    slider = document.querySelector('.slider');
  console.log(rightArrow);
/*--------------scroll to right--------------------- */
// function scrollRight(){
//     if(slider.scrollWidth - slider.clientWidth === slider.scrollLeft){
//     slider.scrollTo({
//         left:0,
//         behavior:"smooth"
//     });
//     }
//     else{
//     slider.scrollBy({
//         left: window.innerWidth,
//         behavior:"smooth"
//     })
//     }
// }
function scrollRight() {
    if (slider && slider.scrollWidth && slider.clientWidth && slider.scrollLeft !== null) {
        if (slider.scrollWidth - slider.clientWidth === slider.scrollLeft) {
            slider.scrollTo({
                left: 0,
                behavior: "smooth"
            });
        } else {
            slider.scrollBy({
                left: window.innerWidth,
                behavior: "smooth"
            });
        }
    }
}

/*--------------scroll to left--------------------- */
function scrollLeft(){
    slider.scrollBy({
        left: -window.innerWidth,
        behavior:"smooth"
    })
}
let timerID = setInterval(scrollRight, 7000);
/*--------------reset timer to scroll right--------------------- */
function resetTimer(){
    clearInterval(timerID);
    timerID = setInterval(scrollRight, 7000);
}
/*--------------scroll event--------------------- */
if(slider){
    slider.addEventListener('scroll', function(){
        if(slider.scrollWidth - slider.clientWidth === slider.scrollLeft){
            slider.scrollTo({
                left:0,
                behavior:"smooth"
            });
        }
    })
}

slider.addEventListener('click', function(ev){
if(ev.target === rightArrow){
   scrollRight();
   resetTimer();
}
})

/*-----------------testimonial slider------------------*/
let slides = document.querySelectorAll('testimonial-item');
index = 0;
function nextSlide(){
    slides[index].classList.remove('active');
    index = (index + 1) % slides.length;
    slide[index].classList.add('active');
}
function prevSlide(){
    slides[index].classList.remove('active');
    index = (index - 1 +  slides.length) % slides.length;
    slide[index].classList.add('active'); 
}

menu = document.getElementById('menu-btn');
userBtn = document.getElementById('user-btn');

