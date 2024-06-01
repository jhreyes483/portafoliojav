<?php

/*
 *   Clase sesion para autenticar, adminsitrar seguridad, y niveles de acceso
 *
 *
 */

class Session
{
    public static function init()
    {
        //  @session_set_cookie_params(SESSION_TIME);
        if (!session_status() == PHP_SESSION_ACTIVE) {
            @session_start();
        }
    }



    /*
    public function cerrarSesion(){
        $_SESSION['message']= "Cerro sesion"; $_SESSION['color'] = "primary";
      session_unset();
       session_destroy();
     echo '<script>alert("cerro sesion")</script>';
  }
     */


    protected function redireccionar($ruta = false)
    {
        if ($ruta) {
            header('location:' . BASE_URL . $ruta);
            exit;
        } else {
            header('location:' . BASE_URL);
            exit;
        }
    }

    // jav
    public function desencriptaSesion()
    {
    }


    public function verificarAcceso()
    {
        $aV = $this->desencriptaSesion();
        if ($aV['usuario']['estado'] == 1) {
            $_SESSION['message'] = "Bienvenido";
            switch ($aV['usuario']['ID_rol_n']) {
                case 1:
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   header('location:' . BASE_URL . 'admin');
                    $_SESSION['color']   = 'success';


                    break;
                case 2:
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   header('location:' . BASE_URL . 'bodega');
                    $_SESSION['color']   = 'success';

                    break;
                case 3:
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   echo '<h1> Esta en el caso 3 de session </h1>';
                    header('location:' . BASE_URL . 'supervisor');
                    $_SESSION['color']   = 'success';

                    break;
                case 4:
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   header('location:' . BASE_URL . 'comercial');
                    $_SESSION['color']   = 'success';

                    break;
                case 5:
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   header('location:' . BASE_URL . 'proveedor');
                    $_SESSION['color']   = 'success';

                    break;
                case 6:
                    /*
                        $id = openssl_decrypt( $_SESSION['usuario']['ID_us'], COD, KEY);
                         include_once './controladorrutas.php';
                         rutConCliente();
                       $objCon     =  new  Controller();
                      $datos =  $objCon->verPuntosYusuario( $id );

                         $_SESSION['usuario'] =  $this->encriptaSesion($datos);
                         $_SESSION['color']   = 'success';
                      header("location: ../vista/rol/cliente/iniCliente.php");
                    break;
                    default:
                      $_SESSION['message'] = 'Usuario no registrado';
                        $_SESSION['color']   = 'danger';
                       header("location: ../vista/index.php");
                        echo '<script>alert("Usuario no registrado")</script>';
                     break;
                      */

                    die('configurar en session metodo verificarAcceso el index de usuario');
            }
        } else {
            header("location: ../vista/cuentaInactiva.php");
        }
    }










    public static function destroy($clave = false, $tipo = 0)
    {
        // tipo dos []

        switch ($tipo) {
            case 0:
                if ($clave) {
                    if (is_array($clave)) {
                        for ($i = 0; $i < count($clave); $i++) {
                            if (isset($_SESSION[$clave[$i]])) {
                                            unset($_SESSION[$clave[$i]]);
                            }
                        }
                    } else {
                        if (isset($_SESSION[$clave])) {
                            unset($_SESSION[$clave]);
                        }
                    }
                } else {
                    session_destroy();
                }

                break;
            default:
                # code...


                break;
        }
    }

    public static function set($clave, $valor)
    {
        if (!empty($clave)) {
            $_SESSION[$clave] = $valor;
        }
    }

    public static function get($clave)
    {
        if (isset($_SESSION[$clave])) {
            return $_SESSION[$clave];
        }
    }

    public static function acceso($level)
    {
        if (!Session::get('autenticado')) {
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }
        Session::tiempo();
        if (!Session::getLevel($level) > Session::getLevel(Session::get('level'))) {
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }
    }

    public static function accesoView($level)
    {
        if (!Session::get('autenticado')) {
            return false;
        }
        if (Session::getLevel($level) > Session::getLevel(Session::get('level'))) {
            return false;
        }
        return true;
    }

    public static function accesoEstricto(array $level, $noAdmin = false)
    {
        if (!Session::get('autenticado')) {
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }
        if ($noAdmin == false) {
            if (Session::get('level') == 'administrador') {
                return;
            }
        }
        if (count($level)) {
            if (in_array(Session::get($level), $level)) {
                return;
            }
        }
        header('location:' . BASE_URL . 'error/access/5050');
    }

    public static function accesoViewEstricto($level, $noAdmin = false)
    {
        if (!Session::get('autenticado')) {
            return false;
        }
        Session::tiempo();
        if ($noAdmin == false) {
            if (Session::get('level') == 'administrador') {
                return true;
            }
        }
        if (count($level)) {
            if (in_array(Session::get($level), $level)) {
                return true;
            }
        }
        return false;
    }

    /*
  public static function tiempo(){
   if(!Session::get('tiempo') || !define('SESSION_TIME')){
        throw new Exception('No se ha definido el tiempo de sesion');
    }
    if(SESSION_TIME==0){
       return;
    }
    if(time()- Session::get('tiempo') > (SESSION_TIME*60)){
      Session::destroy();
      header('location:'.BASE_URL.'error/access/8080');
    }else{
     Session::set('tiempo', time());
    }
  }

 public static function permisoInvalido(array $level, $d){
      if(Session::get('level')){
         return true;
       }
      header('location:'.BASE_URL.'error/access/3030');
  }
    */
}
