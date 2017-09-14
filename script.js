// JavaScript Document
$(document).ready(function() {
   $('.deus').mouseenter(function() {
       $(this).animate({
           height: '+=100px'
       });
   });
   $('.deus').mouseleave(function() {
       $(this).animate({
           height: '-=100px'
       }); 
   });
});