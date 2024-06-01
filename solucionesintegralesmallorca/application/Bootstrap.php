<?php

/*  *********************************************************************
 *   Descripci�n: Esta clase llama los controladores, metodos
 *  y abre la plantilla en el editor.
 *        *********************************************************************/

class c_navegacion
{
    public static function run(Request $peticion)
    {

        $fullUrl = 'http' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $isExtern =    (strpos($fullUrl, '/portafoliojav') !== false);
        if (!$isExtern) {
            $controller = $peticion->getControlador() . 'Controller';
        // echo $controller.'   bootstrap <br>';
                  $rutaControlador = ROOT . '_controllers/' . $controller . '.php';
        //die($rutaControlador);
                  $metodo = $peticion->getMetodo();
            $params = $peticion->getParam();
            $args   = $peticion->getArgs();
            if (is_readable($rutaControlador)) {
        // si el fichero es leguible
                  //die("$controller $metodo");
                  require_once $rutaControlador;
                $controller = new $controller();
                if (is_callable(array($controller, $metodo))) {
                    // si es leguible
                             $metodo = $peticion->getMetodo();
                } else {
                    $metodo = 'index';
                }
                if (isset($args)) {
                    call_user_func_array(array($controller, $metodo), $args);
                } else {
                    call_user_func(array($controller, $metodo));
                }
            } else {
                echo '
         <link href="' . BASE_URL . 'public/layout1/css/new/bootstrap.min.css" rel="stylesheet" type="text/css" />
         <link href="' . BASE_URL . 'public/layout1/css/new/jav.css" rel="stylesheet" type="text/css" />
         <br><br><br><br><br>
               <div class="col-md-12 ">
               <div class="col-lg-4 col-md-6 col-12 col-sm-6 shadow-lg mx-auto text-center my-4 card-body  fade show alert-danger alert-dismissible" role="alert">
               <h1 class="alert-100" >404</h1> 
               <p>No encuentra la ruta que resuelve</p>
               ' . $controller . '/' . $metodo . '<br>
            </div>
            <div class="col-md-3"></div>
         </div>


</div>';
    // throw new Exception( '<center><h1>404 No encontrada la ruta que resuelve<h1>' );
            }
        } else {
            echo 'negacion';
            exit();
        }
    }
}
