
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

// APARECE LOGO
// $(document).ready(function(){
//  $("#menu-toggle").click(function(){
//  $("#social").fadeToggle("show");
//  });
// });
// APARECE LOGO
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

// MENU
// jQuery( document ).ready( function() {
//     jQuery( '#style-selector .style-toggle' ).click( function( e ) {
//         e.preventDefault();

//         if ( jQuery( 'body' ).hasClass( 'ss-close' ) ) {
//             jQuery( 'body' ).removeClass( 'ss-close' );
//             jQuery( 'body' ).addClass( 'ss-open' );

//             jQuery( '#style-selector' ).animate( {'left': '-' + jQuery( '#style-selector' ).width() + 'px' }, 'slow' );

//         } else {
//             jQuery( 'body' ).removeClass( 'ss-open' );
//             jQuery( 'body' ).addClass( 'ss-close' );

//             jQuery( '#style-selector' ).animate( {'left': '0px'}, 'slow' );

//         }
//     });
// });
// jQuery( document ).ready( function() {
//     jQuery( '#style-selector .style-toggle' ).click( function( e ) {
//         e.preventDefault();

//         if ( jQuery( 'body' ).hasClass( 'ss-close' ) ) {
//             jQuery( 'body' ).removeClass( 'ss-close' );
//             jQuery( 'body' ).addClass( 'ss-open' );

//             jQuery( '#style-selector' ).animate( {'left': '-' + jQuery( '#style-selector' ).width() + 'px' }, 'slow' );

//         } else {
//             jQuery( 'body' ).removeClass( 'ss-open' );
//             jQuery( 'body' ).addClass( 'ss-close' );

//             jQuery( '#style-selector' ).animate( {'left': '0'}, 'slow' );

//         }
//     });
// });


$(document).ready(function() {
   
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

/*---------------------------------------------- 
                    R E L O G
------------------------------------------------*/
function currentTime() {
    var date = new Date(); /* creating object of Date class */
    var hour = date.getHours();
    var min = date.getMinutes();
    var sec = date.getSeconds();
    var midday = "AM";
    midday = (hour >= 12) ? "PM" : "AM"; /* assigning AM/PM */
    hour = (hour == 0) ? 12 : ((hour > 12) ? (hour - 12): hour); /* assigning hour in 12-hour format */
    hour = updateTime(hour);
    min = updateTime(min);
    sec = updateTime(sec);
    document.getElementById("clock").innerText = hour + " : " + min + " : " + sec + " " + midday; /* adding time to the div */
      var t = setTimeout(currentTime, 1000); /* setting timer */
  }
  
  function updateTime(k) { /* appending 0 before time elements if less than 10 */
    if (k < 10) {
      return "0" + k;
    }
    else {
      return k;
    }
  }
  
  currentTime();
  /*---------------------------------------------- 
                    R E L O G
------------------------------------------------*/

