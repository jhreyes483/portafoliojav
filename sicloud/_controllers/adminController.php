<?php

// use Mpdf\Tag\Section;

class adminController extends Controller{
    private $db;
    private $param;
    //
    public function __construct(){
        $this->db = $this->loadModel('consultas.sql', 'sql');
        parent::__construct();
        $this->_view->setCss(array('font-Montserrat', 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
     //   $this->_view->setJs(array('jquery-1.9.0', 'bootstrap.min', 'popper.min', 'fontawasome-ico', 'cUsuariosJquery', 'tablesorter-master/jquery.tablesorter'));
        $this->_view->setJs(['cUsuariosJquery']);
        $this->param = $this->getParam();
    }
    //
    public function index(){
        $this->getSeguridad('S1S');
        $this->_view->setCss(array('google', 'bootstrap.min', 'jav', 'animate', 'font-awesome'));
        $this->datosFijos();
        $this->_view->renderizar('index');
    }

    public function controlSistema(){
        $this->getSeguridad('S1S');
        $this->_view->setCss(array('google', 'bootstrap.min', 'jav', 'animate', 'font-awesome'));
        $this->datosFijos();
        $this->_view->renderizar('controlSistema');
    }
    //
    public function a(){
        // activar cuenta de usuario
        $this->db->activarCuenta($_GET['x']);
        $this->datosFijos();
        $this->registraLog($_GET['x'], 3);
        $this->redireccionar('admin/controlUsuarios');
    }
    //
    public function d(){
        // desactiva cuenta de usuario
        $this->db->desactivarCuenta($_GET['x']);
        $this->datosFijos();
        $this->registraLog($_GET['x'], 15);
        $this->redireccionar('admin/controlUsuarios');
    }

    public function verificaTabla($r){
        if( count($r) != 0){
            $this->_view->tabla = ['response_status' => 'ok', 'response_msg' => $r];
        }else{
            $this->_view->tabla = ['response_status' => 'error', 'response_msg' => 'No hay registro de usuarios'];
        }
    }

    //
    public function consulta(){ 
        //
        $this->datosFijos();
        if(isset($_POST['rol'])){
            $roles=[
                '1'=>'Administrador',
                '2'=>'Bodega',
                '3'=>'Supervisor',
                '4'=>'Ventas',
                '5'=>'Provedor',
                '6'=>'Cliente'
            ];    
            if(isset($roles[$_POST['rol']])) $this->_view->rol = $roles[$_POST['rol']];
        }
        if(( isset( $_POST['parametro'])) &&  $_POST['parametro'] != '*'){
            $r  = $this->db->usuarioLetra( $this->getsql('parametro'), ((implode( ',',$_POST['estado']) )??'')  );
            $this->verificaTabla($r);
            
        }else{
            $estado= ( isset($_POST['estado']) )? implode( ',', $_POST['estado'] ) : '';
            $r  = $this->db->UserAll($estado);
            $this->verificaTabla($r);
        }

        if (isset($_POST['accion'])) {
            switch ($_POST['accion']) {
                case 'bId':
                    // filtro por id usuario
                    if (isset($_POST['documento'])) {
                        $r  = $this->db->selectIdUsuario($this->getsql('documento'));
                        if (count($r) != 0) {
                            $this->_view->tabla  = ['response_status' => 'ok', 'response_msg' => $r];
                            $_SESSION['color']   = 'info';
                            $_SESSION['message'] = 'Filtro por usuario';
                        } else {
                            $this->_view->tabla = ['response_status' => 'error', 'response_msg' => 'Usuario no existe'];
                            $_SESSION['color'] = 'danger';
                        }
                    } else {
                        $this->_view->tabla = ['response_status' => 'error', 'response_msg' => 'Error al leer el id'];
                        $_SESSION['color'] = 'danger';
                    }
                    break;
                case 'estado':
                    // filtro por estado
                    $r = $this->db->selectUsuariosPendientes($this->getInt('estado'));
                    if (count($r) != 0) {
                        $this->_view->tabla = ['response_status' => 'ok', 'response_msg' => $r];
                        $_SESSION['color'] = 'info';
                        $_SESSION['message'] = 'filtro por estado';
                    } else {
                        $this->_view->tabla = ['response_status' => 'error', 'response_msg ' => 'No hay usuarios'];
                        $_SESSION['color'] = 'danger';
                    }
                    break;
                case 'consRol':
                    // filtro por rol
                    if( !isset($_POST['parametro'] )){
                        $estado= ( isset($_POST['estado'])? implode(',', $_POST['estado']) : '');
                        $r = $this->db->selectUsuarioRol($this->getSql('rol'), 1 , $estado);
                    }
                    if (count($r) != 0) {
                        $this->_view->tabla = ['response_status' => 'ok', 'response_msg' => $r];
                        $_SESSION['color'] = 'info';
                        $_SESSION['message'] = 'filtro por rol';
                    } else {
                        $this->_view->tabla = ['response_status' => 'error', 'response_msg' => 'No hay usuarios'];
                        $_SESSION['color'] = 'danger';
                    }
                break;
                case 'updateUsuario':
                    $array =
                    [  
                       $this->getSql('ID_us'), 
                       $this->getSql('nom1'),
                       $this->getSql('nom2'),
                       $this->getSql('ape1'),
                       $this->getSql('ape2'),
                       $this->getSql('fecha'),    
                       '',
                       $this->getSql('foto'),    
                       $this->getSql('correo'),
                       $this->getSql('FK_tipo_doc'),
                       $this->getSql('FK_rol')
                    ];
                  // Controller::ver($array, 1);
                    $bA =   $this->db->actualizarDatosUsuario($this->getSql('ID_us'), $array );
                    if($bA){
                        $bB = $this->registraLog($this->getSql('ID_us'),2);
                    }

                    if( $bB ){
                        $_SESSION['message']  = "Actualizo usuario";
                        $_SESSION['color']    = "success";
                    }else{
                        $_SESSION['message']  = "Error no actualizo usuario"; 
                        $_SESSION['color']    = "danger";
                    }
                    $this->redireccionar('admin/controlUsuarios');
                break; 
            }
        } 
    }
    //
    public function controlUsuarios(){
        $this->getSeguridad('S1S');
        $this->datosFijos();
        if( isset($_POST) && count($_POST) != 0){
            $this->consulta();
        }
        // vista
        $this->_view->setCss(array('google', 'bootstrap.min', 'jav', 'animate', 'font-awesome'));
        $this->_view->renderizar('controlUsuarios');
    }
    //
    public function datosFijos(){
        $this->db                = $this->loadModel('consultas.sql', 'sql');
        $rols                    = $this->db->verRol();
        foreach( $rols as $d ) $rl[$d[0]] = $d[1] ; 
        $est                     = [ 'Pendiente', 'Aprobados' ];
        $c1                      = $this->db->conteoUsuariosActivos();
        $c2                      = $this->db->conteoUsuariosInactivos();
        $t                       = ($c1 + $c2);
        $this->_view->datosFijos        = [
            $rl, // Rol de usuario para el select
            $c1 ?? 0,
            $c2 ?? 0,
            $t ?? 0,
            $est??0
        ];
    }
    //
    public function directorioTelefonico(){
        $this->getSeguridad('S1S');
        if(!isset($_POST['usuario'])){
            $s = new Session(); $p = $s->desencriptaSesion();
            $this->_view->elimina = ( $p['usuario']['ID_rol_n'] == 1 ) ? 1 : 0; 
            $r = $this->db->verTelefonosUsuario();
            $this->verificaResul($r);
        }   
        $this->_view->renderizar('directorioTelefonico');
    }

    public function directorioDirecciones(){
        $this->getSeguridad('S1S');
        $this->verificaResul( $this->db->verDirecciones());
        $this->_view->renderizar('directorioDirecciones');
    }

    public function logError(){
        // vista
        // pendinte crear metodo eliminar log
        $this->getSeguridad('S1LE');
        $r =  $this->db->verError();
        if (count($r) != 0) {
            $this->_view->datos = ['response_status' => 'ok', 'response_msg' => $r];
        } else {
            $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay log de errores'];
        }
        $this->_view->renderizar('logError');
        $this->_view->setTable('log', 2);
    }
    //
    public function logActividad(){
        //vista
        $this->getSeguridad('S1LA');
        $r = $this->db->verJoinModificacionesDB();
        if (count($r) != 0) {
            $this->_view->datos = ['response_status' => 'ok', 'response_msg' => $r];
        } else {
            $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay log de actividad'];
        }
        //
        if (isset($_POST['accion']) && $_POST['accion'] == 'deleteLog') {
            $b = $this->db->deleteLog($_POST['id']);
            if ($b) {
                $_SESSION['message'] = 'Elimino registro ';
                $_SESSION['color'] = 'success';
            } else {
                $_SESSION['message'] = 'Error al eliminar registro';
                $_SESSION['color'] = 'danger';
            }
        }
        //
        $this->_view->renderizar('logActividad');
        $this->_view->setTable('actividad', 2, 4);
    }
    //
    public function logNotificacion(){
        $this->getSeguridad('S1LN');
        //
        if (isset($_POST['accion'])) {
            switch ($_POST['accion']) {
                case 'deleteNotific':
                $r = $this->db->delteNotificacion($_POST['id']);
                if ($r) {
                    $_SESSION['message'] = 'Elimino log';            $_SESSION['color']  = 'success';
                } else {
                    $_SESSION['message'] = 'Error al eliminar log';  $_SESSION['color'] = 'danger';
                }
                break;
                case 'notificLeida':
                    $r = $this->db->notificacionLeida($_POST['id']);
                    if($r){
                        $_SESSION['message'] = 'Update exitoso exitosa'; $_SESSION['color']  = 'success';
                   }else{
                        $_SESSION['message'] = 'Error, aupdate'; $_SESSION['color']  = 'danger';
                      
                   }
                break;
            }
        }
        $r = $this->db->consNotificacionesT();
        if (count($r) == 0) {
            $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay notificaciones'];
        } else {
            foreach($r as $d ){
                switch ($d[5]) {// evalua la llave foranea de notificacion
                    case 1:
                        $a[] = [$d[0], $d[1], '<strong>Id de usuario: </strong>'.$d[2], $d[3], $d[4] ]; 
                        break;
                        //
                    case 11: // pedido de producto
                        $tmp = explode('@@@', $d[2]  );
                        //
                        $descipt = 'Datos de usuario que solicta producto<br>'
                        .'<strong>Nombre de usuario: </strong>'. ($tmp[1]??'')
                        .'<br><strong>Apellido: </strong>'.($tmp[2]??'')
                        .'<br><strong>Documento: </strong>'.($tmp[0]??'')
                        .'<hr>'
                        .'<strong>Id producto: </strong>'.($tmp[3]??'').' <strong>Producto:</strong> '
                        .'<br><strong>Fecha: </strong>'.($tmp[13]??'').'<strong> Hora: </strong>'.($tmp[14]??'' );
                        //
                        $a[] = [ $d[0], $d[1], $descipt, $d[3] , $d[4]   ]; 
                        break;
                    case 12: 
                        $tmp = explode( '@@@', $d[2]  );
                        $descipt = '<strong>Nombre de usuario :</strong>'.($tmp[0]??'')
                        .'<br>'.'<strong>Correo: </strong>'
                        .($tmp[1]??'').'<br>'.'<strong>Cel: </strong>'
                        .($tmp[2]??'').'<br>'
                        .(( isset($tmp[4]))?'<strong>Fecha:</strong> '.$tmp[4] : '') .'<br>'
                        .(( isset($tmp[5]))?'<strong>Hora:</strong> '.$tmp[5]:'').'<br>'
                        .'<hr><strong>Solicilicitud: </strong><br>'
                        .($tmp[3]??'');
                        //
                         $a[] = [ $d[0], $d[1], $descipt, $d[3] , $d[4]]; 
                        break;
                    default:
                    $descript = ( $d[2] == '' )?'No aplica': $d[2];
                        $a[] = [$d[0], $d[1], $descript, $d[3], $d[4] ]; 
                        break;
                }
            }
            //
            $this->_view->datos = ['response_status' => 'ok', 'response_msg' => $a];
        }
        $this->_view->renderizar('logNotificacion');
        $this->_view->setTable('notificacion', 4, 5);
    }
    //
    public function edit(){
        if(isset($_POST['pass'])){
            $id     = $this->getSql('id');
            $pass   = $this->getSql('pass');
            $token  = $this->getSql('token');
            $pToken = 'S1cl0ud*';
            
            if( !isset($token) ) {                                       $error = 'Token necesario, solicite su token con soporte Sicloud '; }
            if($token != $pToken)                                        $error =  'Token incorrecto, solicite su token con soporte sicloud';
            if( !isset($error) && !isset($pass) )                       { $error = ' El campo contraseña es requerido'; }  
            if( !isset($error) &&  isset($id)  && empty($id))           { $error = 'No seleciono usuario para el cambio de contraseña'; } 
            if(!isset($error)){
                $b = $this->db->cambioPass($id,  $pass );
                if($b){
                    $this->registraLog($id, 16);
                    $_SESSION['message']  = "Actualizo Contraseña";
                    $_SESSION['color']    = "success";
                }else{
                    $_SESSION['message']  = "Error al cambiar Contraseña"; 
                    $_SESSION['color']    = "danger";
                }
            }else{
                $_SESSION['message']  = $error; 
                $_SESSION['color']    = "danger";
            }
        }


        $this->getSeguridad('S1CCSM');
        $r      = $this->db->verRol();
        $d      = $this->db->verDocumeto();
        $this->_view->datosF = [ $r, $d ];
        //
        if( $_POST['id'] ){
            $u      = $this->db->selectUsuarios($_POST['id']);
            $this->verificaResul($u);
        }else{
            $this->_view->datos = ['response_status' => 'error' , 'No ha ingresado usuario a editar'];
        }
        $this->_view->renderizar('editUsuario');
    }
}
