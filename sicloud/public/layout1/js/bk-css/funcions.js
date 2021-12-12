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
    imagenes[0] = './vista/fonts/slider-1/img1.jpg';
    imagenes[1] = './vista/fonts/slider-1/img2.jpg';
    imagenes[2] = './vista/fonts/slider-1/img3.jpg';
  
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







