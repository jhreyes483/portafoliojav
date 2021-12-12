
// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});
// BOTON ARRIBA

$(document).ready(function(){
 $(".style-toggle, .social").click(function(){
 $("#social").fadeToggle("hide");
 });
});
// APARECE LOGO INDEX
$(document).ready(function(){
    $("#logo-toggle, .social-home").click(function(){
    $("#social-home").fadeToggle("show");
    });
   });
// APARECE DIV
$(document).ready(function(){
   $("#mostrar").click(function(){
       $('#target').toggle(250);
       });
   });
// TOOLTIS
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
  // TOOLTIS

//   TOAST
 
    $(document).ready(function(){
        $('.toast').toast('show');
    });


$(document).ready(function() {
   $('body').addClass('ss-close');
    $('#style-selector .style-toggle').click(function(e) {
         e.preventDefault();
         if ($('body').hasClass('ss-close')) {
             $('body').removeClass('ss-close').addClass('ss-open');
             $('#style-selector').animate( {'left': '-' + jQuery('#style-selector').width() + 'px' });
         } else {
             $('body').removeClass('ss-open').addClass('ss-close');
             $('#style-selector').animate( {'left': '0px'});
         }
     });
     $('body').removeClass('ss-open');
     $('#style-selector .style-toggle').trigger('click');});

// -------------------------------


