$(document).ready(function() {

   $('#pass2').keyup(function() {
   
     var pass1 = $('#pass1').val();
     var pass2 = $('#pass2').val();
   
     if ( pass1 == pass2 ) {
        
         $('#check').removeClass('fas fa-exclamation').addClass('fas fa-check')
     } else {
         
         $('#check').removeClass('fas fa-check').addClass('fas fa-exclamation')
     }
     if( pass1 ==='' || pass2 === ''){
       $('#check').removeClass('fas fa-check').removeClass('fas fa-exclamation')
     }
   
   });
   
   });