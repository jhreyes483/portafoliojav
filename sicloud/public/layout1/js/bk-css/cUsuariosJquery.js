


$(".form").hide(300);
formFiltro = false;

$(document).ready(function() {
  var ocultar = $("#ocultar");
  var mostrar = $("#mostrar");
  var toggle = $(".toggle");
  var elemento = $(".form");

  ocultar.click(function() {
    elemento.hide(1000);
  });

  mostrar.click(function() {
    elemento.show(1000);
  });

  toggle.click(function() {
    t = $(".toggle");
    
   
    if( formFiltro == false  ){
      elemento.toggle(1000);
      t.text("Ocultar filtro")
      formFiltro = true;
    }else{
    
      elemento.toggle(1000);
      t.text("Buscar Usuario")
      formFiltro =false;
     // filtro = true;
    }
  });



});