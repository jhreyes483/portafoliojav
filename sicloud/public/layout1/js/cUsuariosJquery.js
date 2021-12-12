



formFiltro = false;

$(document).ready(function() {

  //$(".form").hide(300);
  var ocultar = $("#ocultar");
  var mostrar = $("#mostrar");
  var toggle = $(".toggle");
  var elemento = $(".form");
  var letras = $("#letras");


  ocultar.click(function() {
    //elemento.hide(1000);
    //letras.toggle(1200);
  });

  mostrar.click(function() {
   // elemento.show(1000);
    //letras.toggle(1200);
  });

  toggle.click(function() {
    t = $(".toggle");
    
   
    if( formFiltro == false  ){
      // letras.toggle(1200);
      
      
      t.text("Por letra")
      formFiltro = true;
    }else{
     // letras.toggle(1200);
     // elemento.toggle(1000);
      t.text("Fitros")
      formFiltro =false;
     // filtro = true;
    }
    letras.toggle(1000);
    elemento.toggle(1000);
  });



});