/**
 * Variables
 */


   var signupButton = $("#signup-button");
   var loginButton = $("#login-button");
   var userForms = $("#user_options-forms");

/**
 * Add event listener to the "Sign Up" button
 */
$("#signup-button").click( function(){
  alert("hola");
});

/**
 * Add event listener to the "Login" button
 */


function registrar(){
 $("#user_options-forms").removeClass('bounceRight')
 $("#user_options-forms").addClass('bounceLeft')
}

function ingreso(){
$("#user_options-forms").removeClass('bounceLeft')
$("#user_options-forms").addClass('bounceRight')
}