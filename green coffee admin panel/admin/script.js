const header = document.querySelector('header');
var navbar = document.querySelector('.navbar');
var userBox = document.querySelector('.profile_detail');

function fixedNavbar() {
    header.classList.toggle('scrolled', window.scrollY > 0);
}

fixedNavbar();
window.addEventListener('scroll', fixedNavbar);

const menu = document.querySelector('#menu-btn');
const userBtn = document.querySelector('#user-btn');

menu.addEventListener('click', function() {
    navbar.classList.toggle("active");
});

userBtn.addEventListener('click', function() {
    userBox.classList.toggle("active");
});
