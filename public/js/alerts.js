
document.addEventListener("DOMContentLoaded", function() {
 $('.alertw').addClass("show");
 $('.alertw').removeClass("hide");
 $('.alertw').addClass("showAlert");
  setTimeout(function(){
    $('.alertw').removeClass("show");
    $('.alertw').addClass("hide");
    $('.alertw').removeClass("showAlert");
  },5000);
});
$('.close-btn').click(function(){
  $('.alertw').removeClass("show");
  $('.alertw').addClass("hide");
  $('.alertw').removeClass("showAlert");
});
document.addEventListener("DOMContentLoaded", function() {
    $('.alertr').addClass("show");
    $('.alertr').removeClass("hide");
    $('.alertr').addClass("showAlert");
     setTimeout(function(){
       $('.alertr').removeClass("show");
       $('.alertr').addClass("hide");
       $('.alertr').removeClass("showAlert");
     },5000);
   });
   $('.close-btn').click(function(){
     $('.alertr').removeClass("show");
     $('.alertr').addClass("hide");
     $('.alertr').removeClass("showAlert");
   });
   document.addEventListener("DOMContentLoaded", function() {
    $('.alertg').addClass("show");
    $('.alertg').removeClass("hide");
    $('.alertg').addClass("showAlert");
     setTimeout(function(){
       $('.alertg').removeClass("show");
       $('.alertg').addClass("hide");
       $('.alertg').removeClass("showAlert");
     },5000);
   });
   $('.close-btn').click(function(){
     $('.alertg').removeClass("show");
     $('.alertg').addClass("hide");
     $('.alertg').removeClass("showAlert");
   });
