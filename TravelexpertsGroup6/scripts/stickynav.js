/*
Author: Cecilia(Wenxi) Zhang 
Course: CPRG210
*/
var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function stickynav() {
  if (window.pageYOffset >= sticky) {
    navbar.style.visibility = "visible";
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
    navbar.style.visibility = "hidden";
  }
}
