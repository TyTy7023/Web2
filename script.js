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