<?php

//Funcion que me permite exportar codigo HTML si repetir 


function cardAviso(){echo'
    <div class="row">
        <div class="card mb-5 p-4 col-sm-12 col-lg-6 mx-auto border-abajo ">
            <div class="col-md-10 col-12 mx-auto mt-6 ">
                <div class="row">
                    <div class="col-md-12  mx-auto text-center text-white ">
                        <div class="card text-white bg-dark shadow">

                            <div class="card-body">
                                <h4 class="card-title text-warning">IMCO<spaim class=" whi">ABHER <style>
                                            .whi {
                                                color: white !important;
                                            }
                                        </style>
                                    </spaim>
                                </h4>
                                <p class="card-text">Los mejores productos, con calidad y economia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
}

function cardtitulo($titulo){
    echo '
   <div class="container-pt-4 my-4">
       <div class="card card-body col-md-4 text-center mx-auto bk-rgb shadow p-3 mb-5 bg-white ">
           <h4 class="ee">'.$titulo.' </h4>
       </div>
   </div><br><br>';
}

function cardtituloS($titulo){echo '
   <div class="my-4">
       <div class="col-md-8 mx-auto card card-body text-center bk-rgb">
           <h5>'. $titulo .'.</h5>
       </div>
   </div><br><br> ';
} 

function form1(){ echo'
    <!-- Plantilla formulario -->
    <form action="par_inpar.php" method="POST">
        <div class="form-group"><input class="form-control" name="num1" placeholder="Primer numero" type="number" step="0.01"></div>
        <div class="form-group"><button class="form-control btn btn-primary" type="submit">Ingrese decimales</button></div>
    </form>';
}

function human_time($input_seconds, $rs = 1, $normal = 0, $mostrarD = 0){
   //$rs = muestra segundos // normal=1 deja h m s  como abreviaturas // mostrarD=1 muestra d�as
   $days         = floor($input_seconds / 86400);
   $remainder   = floor($input_seconds % 86400);
   $hours      = floor($remainder / 3600);
   $remainder   = floor($remainder % 3600);
   $minutes      = floor($remainder / 60);
   $seconds      = floor($remainder % 60);

   if ($mostrarD > 0) {
      $hours   += $days * 24;
      $days   = '';
   } else {
      $days   = ($days > 0) ?          $days . ($normal == 0 ? ' d�as' : 'd') : '';
   }
   $hours   = ($hours > 0) ?          $hours . ($normal == 0 ? ' horas' : 'h') : '';
   $minutes   = ($minutes > 0) ?         $minutes . ($normal == 0 ? ' min' : 'm') : '';
   $seconds   = ($seconds > 0 && $rs == 1) ? $seconds . ($normal == 0 ? ' seg' : 's') : '';
   return "$days $hours $minutes $seconds";
}

function setMessage(){
    $_SESSION['message'] = null;
    $_SESSION['color'] = null;
}

function truncateFloat($number, $digitos){
    $multiplicador = 100000;
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos);
}



?>

