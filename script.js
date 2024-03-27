const header = document.querySelector('header');
var navbar = document.querySelector('.navbar');
var userBox = document.querySelector('.user-box');
function fixedNavbar(){
    header.classList.toggle('scroll',window.scrollY > 0)
}
fixedNavbar();
window.addEventListener('scroll',fixedNavbar);

let menu = document.getElementById('menu-btn');
let userBtn = document.getElementById('user-btn');

menu.addEventListener('click' , function(){
    navbar.classList.toggle("active");
})

userBtn.addEventListener('click',function(){  
    userBox.classList.toggle("active");   
})
/*--------------home page slider--------------------- */
//"use strict"
    const leftArrow = document.querySelector('.left-arrow .bxs-left-arrow'),
     rightArrow = document.querySelector('.right-arrow .bxs-right-arrow'),
     slider = document.querySelector('.slider');
       // console.log(rightArrow);
    /*--------------scroll to right--------------------- */
function scrollRight(){
    if(slider.scrollWidth - slider.clientWidth === slider.scrollLeft){
        slider.scrollTo({
            left:0,
            behavior:"smooth"
        });
    }
    else{
        slider.scrollBy({
            left: window.innerWidth,
            behavior:"smooth"
        })
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
slider.addEventListener('click', function(ev){
    if(ev.target === leftArrow){
        scrollLeft();
        resetTimer();
    }
})

slider.addEventListener('click', function(ev){
    if(ev.target === rightArrow){
        scrollRight();
        resetTimer();
    }
})