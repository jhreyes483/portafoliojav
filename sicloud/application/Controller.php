<?php
/*  *********************************************************************
*   Desarrollado: Javier Reyes Neira           fecha: 2021-01-20
*   Descripci�n: Controlador principal de nuestro framework
*   $tipo 0 = controlador que requere validacion de session activa para renderizar 
*   $tipo 1 = controlador de vista publica
+   **********************************************************************/
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

abstract class Controller
{
protected $_view;
protected $_request;
protected $_tipo;

  public function __construct($public =null){
      date_default_timezone_set("America/Bogota");
      $this->_view          = new View(new Request);
      $this->_request       = new Request;
      $this->_view->setCss(['datatables/datatables.min','datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min']);
      $this->_view->setJs([  'jquery/jquery-3.3.1.min','loaderChart','popper/popper.min','bootstrap.min','datatables/datatables.min','datatables/Buttons-1.5.6/js/dataTables.buttons.min','datatables/JSZip-2.5.0/jszip.min','datatables/pdfmake-0.1.36/pdfmake.min','datatables/pdfmake-0.1.36/vfs_fonts','datatables/Buttons-1.5.6/js/buttons.html5.min','mainDatable', 'all'] );
      if(!isset($public)){
        $this->_view->setCss(['fontawasome-ico']);
        $this->_view->setJs(['fontawasome-ico']);
        $this->issetSession();
      }
      $this->_view->setCss(array('ind'));
      // $this->_view->setJs(array( 'ind'));
      $this->_view->titulo = APP_COMPANY . ':: Sistema inteligente de Gestion Empresarial';
      if (isset($_SESSION['usuario']) && count($_SESSION['usuario'])  != 0) {
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
    //
    $aV['usuario']['ID_rol_n'] =  openssl_decrypt($_SESSION['usuario']['ID_rol_n'], COD, KEY);
    $aV['usuario']['estado']   =  openssl_decrypt($_SESSION['usuario']['estado'], COD, KEY);
    //
    if ($aV['usuario']['estado'] == 1) {
      $_SESSION['message'] = "Bienvenido";
      $_SESSION['color']   = 'success';
      switch ($aV['usuario']['ID_rol_n']) {
        case 1:
          $this->redireccionar('admin');
          $_SESSION['color']   = 'success';
          break;
        case 2:
          $this->redireccionar('logistica');     
          break;
        case 3:
          $this->redireccionar('supervisor');
          break;
        case 4:
          $this->redireccionar('comercial');
          break;
        case 5:
          $this->redireccionar('proveedor');
          break;
        case 6:
          $this->redireccionar('cliente');
      }
    }else{
      $this->redireccionar('error/cuenta');
    }
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

  public static function verLogApi($alert , $paramVer){
    require_once APP_CLASS.'logC/c_log.php';
    $log = new Log( APP_LOGS,'logApi.log');
    if(is_array($paramVer)){
      $log->m_escribeLineaParams($alert.'|Array|', $paramVer);
    }else{
      $log->m_escribeLinea($alert.'|String|', $paramVer);
    }
    $log->m_cerrar();
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
 //   if ($email != '') mail('soporte@itt.com.co', 'SQL', $dato, '');
  }

  protected function getJson($r){
    echo json_encode($r, JSON_UNESCAPED_UNICODE);
  }

  protected function generaMenu(){
    if (isset($_SESSION['usuario'])) {
      $db                 = $this->loadModel('consultas.sql', 'sql');  // Carga modelo
      $id_rol             = openssl_decrypt($_SESSION['usuario']['ID_rol_n'], COD, KEY);
      $aUserDB            = $db->rolMenu($id_rol);
      $this->notificacion = $db->verNotificaciones($id_rol);
      $sPdb               = $aUserDB[0][2];
      $m                  = $aUserDB[0][0];
      $aPdb               = explode(',', $sPdb); // permisos de usuario desde DB
      $aP                 = [];
    } else {
      // si no hay sesion crea valores por defecto del array nav
      $m    = 'C';
      $sPdb = '01,0101,0102,02,03,04,05';
      $aPdb         = explode(',', $sPdb); // permisos de usuario desde DB
      $aP           = [];
    }

    $rutaLibreria = $this->getLibrary('menu');     // ruta de libreria MVC
    require_once "$rutaLibreria";                 // llama a menu general
    // Crea array del menu de usario acurde a los permisos que tiene segun DB

    foreach ($aPdb as $d) {
      $c = strlen($d);
      switch ($c) {
        case 2:
          $v1 = abs($d);
          $aP[$v1] = [$aMenu[$m][$v1][0], $aMenu[$m][$v1][1]];

          break;
        case 4:
          $sP =  str_split($d, 2);
          $v1 =  abs($sP[0]);
          $v2 =  abs($sP[1]);
          if (isset($aMenu[$m][$v1][$v2][2])) {
            $token[] = $aMenu[$m][$v1][$v2][2];
          }
          $aP[$v1][$v2] = [$aMenu[$m][$v1][$v2][0], $aMenu[$m][$v1][$v2][1]];

          break;
        case 6:
          $sP =  str_split($d, 2);
          $v1 =  abs($sP[0]);
          $v2 =  abs($sP[1]);
          $v3 =  abs($sP[2]);
          $aP[$v1][$v2][$v3] = [$aMenu[$m][$v1][$v2][$v3][0], $aMenu[$m][$v1][$v2][$v3][1]];
          break;
      }
    }
    if(isset($token))$_SESSION['t'] = $token;
    
    
    //  Controller::ver($_SESSION['t'],1);


    return $this->pintaMenu($aP);
  }

  protected function issetSession(){
    if( !isset($_SESSION['usuario']) ){
      $this->redireccionar('error/iniciesesion');
    }
  }

  public function getSeguridad($token){
    if (  !isset($_SESSION['t']) ||  !in_array($token, $_SESSION['t'])) {
      $this->redireccionar('error/permiso');
    }
  }

  protected function pintaMenu($aP){
    $objSession = new Session;
    $uN = $objSession->desencriptaSesion();

    $txt = '
    <script src="'. RUTAS_APP['ruta_js'] .'reloj01.js"></script>
    <nav class="navbar-fixed-top navbar navbar-expand-lg navbar-dark bg-dark navbar navbar-expand-lg  sticky-top">
    <a class="navbar-brand ml-4" href="#">
      <img src="' . RUTAS_APP['ruta_img'] . 'logoportal.png" width="250" height="65" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" style="position: absolute; top: 0; right: 0; margin: 25px;" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>';

    $txt .= '
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto mx-auto">';

    foreach ($aP as $i0 =>  $d) {

      if (!is_array($d[0])) {
        $url = (!is_array($d[1])) ? $d[1] : '';
        if (is_array($aP[$i0][1])) {
          $iniN2 = '<li class="nav-item dropdown active">';
          $txt .= $iniN2;
          $iniN2 = '';
          $url = (!is_array($aP[$i0][1])) ? $aP[$i0][1] : '';
          $txt .= '<a class="nav-link dropdown-toggle lead px-4 my-3" href="' . $url . '" id="navbarDropdown"
            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $aP[$i0][0] . '</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
          // echo $subMenu;
          foreach ($d as  $i1 => $d1) {
            if ($i1 != 0) {
              $url = (!is_array($d1[1])) ? $d1[1] : '';
              $txt .= '<a class="dropdown-item" href="' . $url . '">' . $d1[0] . '</a>';
            }
          }
          if ($iniN2 == '') {
            $txt .= '</li>';
          }
        }
        if (!is_array($d[1])) {
          $txt .= '<li class="nav-item active">';
          $txt .= ' <a class="nav-link lead px-4 my-3 " href="' . $url . '">' . $d[0] . '<span class="sr-only">(current)</span></a>';
          $txt .= '</li>';
        }
      }
    }

    $txt .= '
            <li class="nav-item dropdown active">
            <!-- icono de notificacion mensaje -->
            <a class="nav-link mx-3" href="#" id="messagesDropdown" role="button" aria-expanded="false">
              <!-- Counter - Messages -->';

    if (isset($_SESSION['usuario'])) {

      $txt .= '
            <span class="sr-only">(current)</span>
            </a>
      <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">';
      if (isset($_SESSION['usuario'])) {
        $txt .= '<strong>' . $uN['usuario']['nom1'] . '</strong>';
      }


      $txt .=  '<strong>';
      if (isset($_SESSION['usuario'])) {
        $txt .= '
    <img class="img-profile ml-3 rounded-circle" src="' . RUTAS_APP['ruta_img'] . 'us/' . $uN['usuario']['foto'] . ' " height="65" width="70">';
      }
      $txt .= '
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
      <div class="text-dark ml-4">'. date("Y-m-d").'
     
        <div  id="reloj"></div></div>

          <a class="dropdown-item" href="#">
              Hola ';
      if (isset($_SESSION['usuario'])) {
        $txt .=   $uN['usuario']['nom1'] . ' ' . $uN['usuario']['ape1'];


        $txt .= '
              <div class="dropdown-divider"></div>
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              <em><strong>' . $uN['usuario']['nom_rol'] . '</strong></em>';
      }
      $txt .= '
          </a>
          <a class="dropdown-item" href="'.BASE_URL.'user/misdatos">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 "></i>
              Mis datos
          </a>
          <a class="dropdown-item" href="'.BASE_URL.'cliente/compras">
              <i class="fas fa-list fa-sm fa-fw mr-2 "></i>
              Compras
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="' . BASE_URL . 'index/logOut"
              data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 "></i>
              Salir
          </a>
      </div>';
    }
    $txt .= '
    
    </li>';


    //     href="#" 
    //onclick="abre()"

    if (!isset($_SESSION['usuario'])) {
      $txt .= '<div class="ml-5 my-4">
       <a href="' . BASE_URL . '/index/login" 
  
       
       class="text-white lead" style="position: absolute; top: 0; right: 0; margin: 24px;">Sign In
      <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-person-circle text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"></path>
            <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
            <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"></path>
      </svg><br>
    
      </a>
    </div>';
    }

    $txt .= '
    </ul>';

    $txt .= '
    </div>
    </nav>
    </strong>';

    return $txt;
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
    // Cambio contrase�a 16


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
        $session         = $objSession->desencriptaSesion();
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
        case 16:
          $entidad         = 'Usuario';
          $FK_modific      = 7;
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
