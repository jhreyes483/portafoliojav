//alert("hola");


// una vez carga el Dom crea tres elementos y los almacena en varibles
// Despues captura por medio del id "en este caso son botones y el objeto que es de la clase .noticia"
// toma el objeto creado y capta el evento click, y con  hide oculta show muestra y toggle las dos
$(document).ready(function () {
  var textoVideo = $(".texto-video");
  //--------------------------------------------------------------
  // Añade clase de animacion a texto antes de cargar el DOM
  textoVideo.addClass("animate__backInUp", 20000);

  //--------------------------------------------------------------------- 
  // reformar css nav apenas carga el DOM
  $("#menu").css({ 'border-bottom': '1px rgba(255, 249, 249, 0.411) solid' });
  $("#menu").css({ 'border-top': '1px rgba(255, 249, 249, 0.411)  solid' });
  $("#menu").addClass("e");
  //-------------------------------------------------------------------

  //-----------------------------------------------
  // texto imagen animacion
  $(".container-text-img").hover(function () {
    ti = $(".text-img");
    ti.addClass("animate__pulse");
  })

  ti = document.querySelector('.text-img');
  ti.addEventListener('mouseout', function () {
  ti.removeClass("animate__pulse");
  })






  // captura el evento hover sobre el video
  $(".bk-rgb-video").hover(function () {
    //alert("HOVER");

    //-----------------------------------------------------------------------
    // Crea funciones de animamaciones y cambio de tecto
    function actualzarTexto1() {
      textoVideo.removeClass("animate__backInUp");
      textoVideo.addClass("animate__backInLeft");
      textoVideo.text("Lo mejor para tu hogar en herramientas e insumos");
    }
    function actualzarTexto2() {
      textoVideo.removeClass("animate__backInLeft");
      textoVideo.addClass("animate__backInRight");
      textoVideo.text("La mejor calidad, con la mejor economia");
    }
    function actualzarTexto3() {
      textoVideo.removeClass("animate__backInRight");
      textoVideo.addClass("animate__backInUp");
      textoVideo.text("Conoce nuestro productos y servicios");
    }
    //------------------------------------------------------------------------

    //--------------------------------------------------------------------
    // ejecuta las animaciones con un intervalo de tiempo
    setTimeout(actualzarTexto1, (10000 / 3));
    setTimeout(actualzarTexto2, (20000 / 3));
    setTimeout(actualzarTexto3, (30000 / 3));
    //-----------------------------------------------------------------
  });




  //------------------------------------------------
  //Captura en varibles los botones de noticias
  var ocultar = $("#ocultar");
  var mostrar = $("#mostrar");
  var toggle = $(".toggle");
  var elemento = $(".noticia");
  //-----------------------------------------------

  // escucha la funcion click y oculta o muestra 

  ocultar.click(function () {
    elemento.hide(1000);
  });

  mostrar.click(function () {
    elemento.show(1000);
  });


  noticias = true;
  toggle.click(function () {
    t = $(".toggle");

    if (noticias == true) {
      elemento.toggle(1000);
      t.text("Mostrar noticia");
      noticias = false;
    } else {
      elemento.toggle(1000);
      t.text("Ocultar noticia");
      noticias = true;
    }
  });
});

//--------------------------------------------------------------------------



//-----------------------------------------------
//Captura el movimiento del scroll "evento", despues con offset determina la posicon, si la posicion es mayor a 56 
// con addClass realiza el cambio de la clase, de lo contrario remuevela clase "css" 
$(window).scroll(function () {
  if ($("#menu").offset().top > 56) {
    // Reforma de nav segun el movimeinto del scroll
    $("#menu").addClass("bg-inverse");
    $("#menu").removeClass("e");
    $("#menu").css({ 'border-bottom': '2px #FADB0C  solid' });
    $("#menu").css({ 'border-top': '2px #FADB0C  solid' });
  } else {
    $("#menu").removeClass("bg-inverse");
    $("#menu").css({ 'border-bottom': '2px #Fff solid' });
    $("#menu").css({ 'border-top': '2px #Ffff  solid' });
    $("#menu").css({ 'border-bottom': '1px rgba(255, 249, 249, 0.411) solid' });
    $("#menu").css({ 'border-top': '1px rgba(255, 249, 249, 0.411)  solid' });
    $("#menu").addClass("e");


  }

});

// Captura el movimiento del mouse "evento hover" una vez detecta el hover lanza la funcion donde por medio de addClass
// cambia la clase
$("#menu").hover(function () {
  $("#menu").addClass("bg-inverse");
  $("#menu").css({ 'border-bottom': '2px #FADB0C  solid' });
  $("#menu").css({ 'border-top': '2px #FADB0C  solid' });
  $("#menu").removeClass("e");

});


//-----------------------------------------------


$("video").hover(function () {
  $("#menu").removeClass("bg-inverse");
  $("#menu").css({ 'border-bottom': '1px rgba(255, 249, 249, 0.411) solid' });
  $("#menu").css({ 'border-top': '1px rgba(255, 249, 249, 0.411)  solid' });
  $("#menu").addClass("e");
}

)






$("#login").hover(function () {
  // alert("eveento hover");
  $(".in").addClass("animate__pulse");
  $("#text").addClass("animate__tada");
  t = $("#text");
  t.text("Ingresa tus datos");

});



formLogin = document.querySelector('#login');
// captura del evento fuera de hover "formulario login" con javaScript
formLogin.addEventListener('mouseout', function () {
  $(".in").removeClass("animate__pulse");
  $("#text").removeClass("animate__tada");
  t = $("#text");
  t.text("Inicio sesion");
});



//------------------------------------------------------------------
// 3 slider arriba del footer
window.addEventListener('load', function() {
  var imagenes = [];
  imagenes[0] = 'fonts/slider-1/img1.jpg';
  imagenes[1] = 'fonts/slider-1/img2.jpg';
  imagenes[2] = 'fonts/slider-1/img3.jpg';

var indiceImagenes = 1;
function cambiarImagenes(){
nexImg =  imagenes[ indiceImagenes ];
$(".sliderjav").attr("src", nexImg );

if(indiceImagenes < 2 ){
  indiceImagenes++;
}else{
  indiceImagenes = 0;
}
}

setInterval(cambiarImagenes, 3000);      
})
//--------------------------------------------------------------------------




//alert("Hola mundo");

//-------------------------------------------------------------------------
// Reproduccion automatica de video

var strDebug = '' ;
var debug = document.getElementById('debug');
//Saber el tamaño del viewport
var altoBrowser = window.innerHeight;

strDebug += "Alto del browser : "+altoBrowser + "px<br>";
debug.innerHTML = strDebug


//3. obtener los videos
var videos = document.querySelectorAll('video source');
console.log(videos);
//3.1  detectar su ubicacion actual (top) con respecto al body
videos.forEach(
    
function( v ){
    var vidMax = v.offsetTop;
    var vidMin = v.offsetTop - altoBrowser;
   
    strDebug += "Video encontrado "+ v.src +" - "+ vidMax + "video termina en"+ vidMin + " <br/>";
}

);


//2. detectar el scroll
document.body.onscroll = function(){
    //obtener el eje y
var y = window.pageYOffset;
debug.innerHTML = strDebug + "Posicion actual " + y + "px<br>"
}

//-------------------------------------------------------------------------


//------------------------------------------------------------------
// 3 slider arriba del footer
window.addEventListener('load', function() {
  var imagenes = [];
  imagenes[0] = 'fonts/slider-1/img1.jpg';
  imagenes[1] = 'fonts/slider-1/img2.jpg';
  imagenes[2] = 'fonts/slider-1/img3.jpg';

var indiceImagenes = 1;
function cambiarImagenes(){
nexImg =  imagenes[ indiceImagenes ];
$(".sliderjav").attr("src", nexImg );

if(indiceImagenes < 2 ){
  indiceImagenes++;
}else{
  indiceImagenes = 0;
}
}

setInterval(cambiarImagenes, 3000);      
})
//--------------------------------------------------------------------------