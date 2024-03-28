const header = document.querySelector('header');
function fixedNavbar(){
    header.classList.toggle('scroll',window.scrollY > 0)
}
fixedNavbar();
window.addEventListener('scroll',fixedNavbar);

let menu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn');
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