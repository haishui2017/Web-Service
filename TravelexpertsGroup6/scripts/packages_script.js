/*
|   Author:  Nour Srouji
|   Assignment:  ASSIGNMENT 1 - workshop 1
|   Languages:  Html - css - Javascript - php
|   Instructor: Harvey Peters
*/

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}

//<!-- script for the counter -->

// Set the date we're counting down to
var countDownDate = new Date("MAY 28, 2018 00:00:00").getTime();
//alert(countDownDate);
// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();

    // Find the distance between now an the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("salecountdown").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    document.getElementById("sale").innerHTML = "Sale Ends In: ";


    // If the count down is over, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("salecountdown").innerHTML = "EXPIRED";
    }
}, 1000);