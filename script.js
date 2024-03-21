const header = document.querySelector('header');
function fixedNavbar(){
    header.classList.toggle('scroll',window.scrollY > 0)
}
fixedNavbar();
window.addEventListener('scroll',fixedNavbar);

let menu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn');

