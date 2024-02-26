 // Get the button
 let topbutton = document.getElementById("topbtn");
 let navbar = document.getElementById("nav");

 // When the user scrolls down 20px from the top of the document, show the button
 window.onscroll = function() {
     scrollFunction()
 }

 function scrollFunction() {
 if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
     topbutton.style.display = "block";
     navbar.style.backgroundColor = "#9cda71";
 } else {
     topbutton.style.display = "none";
     navbar.style.backgroundColor = "";
 }
 }

 // When the user clicks on the button, scroll to the top of the document
 function toTheTop() {
 document.body.scrollTop = 0;
 document.documentElement.scrollTop = 0;
 }