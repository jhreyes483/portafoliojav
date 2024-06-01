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
        if (isset($_SESSION['usuario'])) {
            $aV['usuario']['ID_us']         =  openssl_decrypt($_SESSION['usuario']['ID_us'], COD, KEY);
            $aV['usuario']['nom1']          =  openssl_decrypt($_SESSION['usuario']['nom1'], COD, KEY);
            $aV['usuario']['nom2']          =  openssl_decrypt($_SESSION['usuario']['nom2'], COD, KEY);
            $aV['usuario']['ape1']          =  openssl_decrypt($_SESSION['usuario']['ape1'], COD, KEY);
            $aV['usuario']['ape2']          =  openssl_decrypt($_SESSION['usuario']['ape2'], COD, KEY);
            $aV['usuario']['fecha']         =  openssl_decrypt($_SESSION['usuario']['fecha'], COD, KEY);
            $aV['usuario']['pass']          =  openssl_decrypt($_SESSION['usuario']['pass'], COD, KEY);
            $aV['usuario']['foto']          =  openssl_decrypt($_SESSION['usuario']['foto'], COD, KEY);
            $aV['usuario']['correo']        =  openssl_decrypt($_SESSION['usuario']['correo'], COD, KEY);
            $aV['usuario']['FK_tipo_doc']   =  openssl_decrypt($_SESSION['usuario']['FK_tipo_doc'], COD, KEY);
            $aV['usuario']['ID_acronimo']   =  openssl_decrypt($_SESSION['usuario']['ID_acronimo'], COD, KEY);
            $aV['usuario']['estado']        =  openssl_decrypt($_SESSION['usuario']['estado'], COD, KEY);
            $aV['usuario']['ID_rol_n']      =  openssl_decrypt($_SESSION['usuario']['ID_rol_n'], COD, KEY);
            $aV['usuario']['nom_rol']       =  openssl_decrypt($_SESSION['usuario']['nom_rol'], COD, KEY);
            if (isset($_SESSION['usuario']['puntos'])) {
                $aV['usuario']['puntos']      =  openssl_encrypt($_SESSION['usuario']['puntos'], COD, KEY);
            }
            return $aV;
        }
    }


    public function encriptaSesion($USER)
    {
        $_SESSION['usuario']['ID_us']         =  openssl_encrypt($USER['ID_us'], COD, KEY);
        $_SESSION['usuario']['nom1']          =  openssl_encrypt($USER['nom1'], COD, KEY);
        $_SESSION['usuario']['nom2']          =  openssl_encrypt($USER['nom2'], COD, KEY);
        $_SESSION['usuario']['ape1']          =  openssl_encrypt($USER['ape1'], COD, KEY);
        $_SESSION['usuario']['ape2']          =  openssl_encrypt($USER['ape2'], COD, KEY);
        $_SESSION['usuario']['fecha']         =  openssl_encrypt($USER['fecha'], COD, KEY);
        $_SESSION['usuario']['pass']          =  openssl_encrypt($USER['pass'], COD, KEY);
        $_SESSION['usuario']['foto']          =  openssl_encrypt($USER['foto'], COD, KEY);
        $_SESSION['usuario']['correo']        =  openssl_encrypt($USER['correo'], COD, KEY);
        $_SESSION['usuario']['FK_tipo_doc']   =  openssl_encrypt($USER['FK_tipo_doc'], COD, KEY);
        $_SESSION['usuario']['ID_acronimo']   =  openssl_encrypt($USER['ID_acronimo'], COD, KEY);
        $_SESSION['usuario']['estado']        =  openssl_encrypt($USER['estado'], COD, KEY);
        $_SESSION['usuario']['ID_rol_n']      =  openssl_encrypt($USER['ID_rol_n'], COD, KEY);
        $_SESSION['usuario']['nom_rol']       =  openssl_encrypt($USER['nom_rol'], COD, KEY);
        if (isset($USER['usuario']['puntos'])) {
            $_SESSION['usuario']['puntos']     =  openssl_encrypt($USER['puntos'], COD, KEY);
        }
        return $_SESSION['usuario'];
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
