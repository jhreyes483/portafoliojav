<?php
/*  *********************************************************************
*   Desarrollado: Javier Reyes Neira           fecha: 2021-01-20
*   Descripci�n: Controlador principal de nuestro framework
*   $tipo 0 = controlador que requere validacion de session activa para renderizar 
*   $tipo 1 = controlador de vista publica
+   **********************************************************************/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

abstract class Controller
{
protected $_view;
protected $_request;
protected $_tipo;

  public function __construct($public =null){
      date_default_timezone_set("America/Bogota");
      $this->_view                = new View(new Request);
      $this->_request             = new Request;
      $this->est_com	            =[1=>'Promocion', 2=>'Disponible', 3=>'Agotado'];
      $this->est_sis	            =[1=>'Inactivo', 2=>'Activo'];
      $this->status_credit	      =[1=>'Pago', 2=>'Pendiente',3=>'Mora'];
      $this->status_invoices      =[1=>'Facturado', 2=>'Peticion de Renbolso',3=>'Peticion de Renbolso rechasada',4=>'Anulado'];
      $this->genero               =['m'=>'Masculino','f'=>'Fememino'];
      if(!isset($public)){
        $this->issetSession();
      }
      $this->_view->setCss(array('ind'));
      // $this->_view->setJs(array( 'ind'));
      $this->_view->titulo = APP_COMPANY . ':: Sistema inteligente de Gestion Empresarial';
      if (isset($_SESSION['usuario']) && count($_SESSION['usuario'])  != 0) {
      }
  }


  public function cerrar(){
    if(isset( $_GET['dest'])){
      session_destroy();
    }
  }

  abstract public function index();

  protected function verificaResul( $r){
    if( isset($r) && count($r) >0 ){
      $this->_view->datos = ['response_status' => 'ok', 'response_msg' => $r];
  }else{
      $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay datos'];
  }

  }

  protected function loadModel($file, $clase = false, $param = ''){
    $clase = $clase !== false ? $clase : $file;
    $rutaModelo = ROOT . '_models/' . $file . '.php';
    //echo 'ruta modelo  -> ' . ROOT;

    if (is_readable($rutaModelo)) {
      //  die('Funcion modelo controller');
      require_once $rutaModelo;
      $modelo = new $clase($param);
      return $modelo;
    } else {
      throw new Exception('Error de modelo');
    }
  }

    
  public static function ver($dato, $sale = 0, $bg = 0, $tit = '', $float = false, $email = ''){
    switch ($bg) {
      case 1:
        $bgColor = 'b0ffff';
        break;
      case 2:
        $bgColor = 'd0ffb9';
        break;
      default:
        $bgColor = 'ffcfcd';
        break;
    }



    echo '<div style="background-color:#' . $bgColor . '; border:1px solid maroon;  margin:auto 5px; text-align:left;' . ($float ? ' float:left;' : '') . ' padding: 0 7px 7px 7px; border-radius:7px; margin-top:10px; ">';
    echo '<h2 style="padding: 5px 5px 5px 10px;	margin: 0 -7px; color: #FFF; background-color: #FF6F00; border-radius: 6px 6px 0 0; display:flex"><img src="/public/layout1/ico/debugging.png">&nbsp;Debugging for:&nbsp;&nbsp;<span style="color:black">' . $tit . '</span></h2>';
    if (is_array($dato) || is_object($dato)) {
      echo '<pre>';
      print_r($dato);
      echo '</pre>';
    } else {
      if (isset($dato)) {
        echo '<b>&raquo;&raquo;&raquo; DEBUG &laquo;&laquo;&laquo;</b><br><br>' . nl2br($dato);
      } else {
        echo 'LA VARIABLE NO EXISTE';
      }
    }
    echo '</div>';
    if ($sale == 1) die();
    if ($email != '') mail('soporte@itt.com.co', 'SQL', $dato, '');
  }


  
  protected function verficaParametros($params){
    $avaible = true;
    $missingparams = '';
 
    foreach($params as $param){
       if(!isset($_POST[$param]) || strlen($_POST[$param]) <=0 ){
          $avaible = false;
          $missingparams = $missingparams.','.$param;
       }
    }
    // Si faltan parametros
    if(!$avaible){       
       die('Parametros:'.substr($missingparams, 1, strlen($missingparams)).'vacion');
    }
  }

  //limpia los string de codigo sql sanitizar la contrasena por post
  protected function getSqlSinEspacios($clave){
    if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
      $_POST[$clave] = strip_tags($_POST[$clave]);
      return   str_replace(' ', '',  trim($_POST[$clave]));
    }
  }

  protected function redireccionar($ruta = false){
    if ($ruta) {
      header('location:' . BASE_URL . $ruta);
      exit;
    } else {
      header('location:' . BASE_URL);
      exit;
    }
  }

  protected function getLibrary($libreria){
    $rutaLibreria = ROOT . 'libs/' . $libreria . '.php';
    if (is_readable($rutaLibreria)) {
      return  $rutaLibreria;
    } else {
      throw new Exception('Error en la libreria');
    }
  }

  protected function getTexto($clave){
    if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
      $_POST[$clave] = htmlspecialchars($_POST[$clave], ENT_QUOTES);
      return $_POST[$clave];
    }
    return '';
  }

  protected function getDate($clave){
    if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
      return $_POST[$clave];
    }
    return '';
  }

  protected function getParam(){

    if(   count($this->_request->_parametros) != 0){
    return  explode(',', $this->_request->_parametros);
    }
  }

  //filtro para enteros enviados por url
  protected function filtrarInt($int){
    $int = (int) $int;
    if (is_int($int)) {
      return $int;
    } else {
      return 0;
    }
  }

  protected function verificarAcceso(){
      $_SESSION['message'] = "Bienvenido";
      $_SESSION['color']   = 'success';
      switch ($_SESSION['usuario']['id_rol']) {
        case 1:
          $this->redireccionar('admin');
          $_SESSION['color']   = 'success';
          break;
        case 2:
          $this->redireccionar('cliente');
        //  $this->redireccionar('logistica');     
          break;
        case 3:
          $this->redireccionar('empleado');
          break;
        case 4:
          $this->redireccionar('comercial');
          break;
        case 5:
          $this->redireccionar('proveedor');
          break;
        case 6:
         // $this->redireccionar('cliente');
      }
   // }else{
     // $this->redireccionar('error/cuenta');
   // }
  }

  //filtra un entero enviado por post
  protected function getInt($clave){
    if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
      $_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);
      return $_POST[$clave];
    }
    return 0;
  }

  //limpia los string de codigo sql sanitizar la contrasena por post
  protected function getSql($clave){
    if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
      $_POST[$clave] = strip_tags($_POST[$clave]);
      return trim($_POST[$clave]);
    }
  }

  //Sanitizar el nombre de usuario por el metodo post
  protected function getAlphaNum($clave){
    if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
      $_POST[$clave] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]);
      return trim($_POST[$clave]);
    }
  }

  // agrega slashes por si envian comillas dobles
  protected function agregaSlashes($texto){
    return addslashes($texto);
  }

  /******************************************************************************
   *	Visualizacion de datos modo local
   *******************************************************************************/
  

  protected function getJson($r){
    echo json_encode($r, JSON_UNESCAPED_UNICODE);
  }

  protected function issetSession(){
    if( !isset($_SESSION['usuario']) ){
      $this->redireccionar('error/iniciesesion');
    }
  }

  public function getSeguridad($token){
    if (!in_array($token, $_SESSION['t'])) {
      $this->redireccionar('error/permiso');
    }
  }


  //*******************************************
  //    Registro a log actividad
  //********************************************
  public function registraLog($id_modificado, $tipo){
    $objSession  = new Session;
    $db          = $this->loadModel('consultas.sql', 'sql');
    // Controller::ver($session);

    // Elimina usuario = $tipo 1
    // Actualizo usuario = $tipo 2
    // Activo cuenta = $tipo 3
    // Elimina producto  $tipo 4
    // Actualiza producto $tipo 5
    // Elimina categoria $tipo 6
    // Actualiza categoria $tipo 7
    // Elimina empresa $tipo 8
    // Actualiza empresa 9
    //Elimina Unidad de medida $tipo 10
    // Actualiza Unidad de medida 11
    //Borro log  de actividad 12
    //Borro Log de errores 13
    //Borro Log de notificacion 14
    // Desaciva cuenta usaurio 15


    $hora            = date("h:i:sa");
    $hora            = substr($hora, 0, 8);
    $fecha           = date('Y-m-d');
    switch ($tipo) {
      case 1:
        $entidad         = 'Usuario';
        $FK_modific      = 2;
        $descrip         = "$entidad modificado ID " . $id_modificado;
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
        break;
      case 2:
        $entidad         = 'Usuario';
        $FK_modific      = 1;
        $descrip         = "$entidad modificado ID $id_modificado";
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
        break;
      case 3:
        $entidad         = 'Usuario';
        $FK_modific      = 5;
        $descrip         = "$entidad modificado ID $id_modificado";
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
        break;
      case 4:
        $entidad         = 'Producto';
        $FK_modific      = 2;
        $descrip         = "$entidad modificado ID $id_modificado";
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
      case 5:
        $entidad         = 'Producto';
        $FK_modific      = 1;
        $descrip         = "$entidad modificado ID $id_modificado";
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
        break;
      case 6:
        $entidad         = 'Categoria';
        $FK_modific      = 2;
        $descrip         = "$entidad modificada ID $id_modificado";
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
        break;
      case 7:
        $entidad         = 'Categoria';
        $FK_modific      = 1;
        $descrip         = "$entidad modificada ID $id_modificado";
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
        break;
      case 8:
        $entidad         = 'Empresa';
        $FK_modific      = 2;
        $descrip         = "$entidad modificada ID $id_modificado";
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
      case 9:
        $entidad         = 'Empresa';
        $FK_modific      = 1;
        $descrip         = "$entidad modificada ID $id_modificado";
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
        break;
      case 10:
        $entidad         = 'Unidad de medida';
        $FK_modific      = 2;
        $descrip         = "$entidad modificada ID $id_modificado";
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
      case 11:
        $entidad         = 'Unidad de medidad';
        $FK_modific      = 1;
        $descrip         = "$entidad modificada ID $id_modificado";
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
        break;
      case 12:
        $entidad         = 'Borro Log de actividad';
        $FK_modific      = 2;
        $descrip         = "$entidad";
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
      case 13:
        $entidad         = 'Borro Log de errores';
        $FK_modific      = 2;
        $descrip         = "$entidad";
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
      case 14:
        $entidad         = 'Borro Log de notificacion';
        $FK_modific      = 2;
        $descrip         = "$entidad";
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
        break;
      case 15:
        $entidad         = 'Usuario';
        $FK_modific      = 6;
        $descrip         = "$entidad modificado ID $id_modificado";
        $session   = $objSession->desencriptaSesion();
        $tDoc_us_session = $session['usuario']['ID_acronimo'];
        $ID_us_session   = $session['usuario']['ID_us'];
        $arm = [
          $descrip,
          $fecha,
          $hora,
          $ID_us_session,
          $tDoc_us_session,
          $FK_modific
        ];
        return $db->insertModificacion($arm);
        break;

      default:
        die('no inserto modificacion');
        break;
    }
  }


}
