<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; carset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


class apiController extends Controller{
   protected $db;
   //
   public function __construct(){
      parent::__construct(1);
      $this->db       = $this->loadModel('consultas.sql', 'sql');;
      $this->getApi();
   }
   //
   public function index(){
    //  die('Error, metodo index en api no definido');
    die();
   }
   //      
   public function isTheseParametersAvailable($params){
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
         $response =[];
         $response['error'] = true;
         $response['message'] = 'Parametros:'.substr($missingparams, 1, strlen($missingparams)).'vacion'; 
         // Error de visualizacion
         echo json_encode($response);
         // detener la ejecucion adicional
         die();
      }
   }
   //
   public function getApi(){

      require_once APP_CLASS.'logC/PeticionHandler.php';// Registra en caso de que la peticion no retorne datos peticion
      require_once APP_CLASS.'logC/c_log.php';
      require_once APP_CLASS.'logC/ErrorHandler.php';

      // Capturar datos
      $log = new Log( APP_LOGS,'logApi.log');
      $gC  = file_get_contents("php://input");

      if( isset($gC) &&  is_object(json_decode($gC))  ){
         $_DATA = get_object_vars(json_decode($gC));
         $log->m_salto_linea();
         $log->m_escribeLineaParams("P. Object", $_DATA);
         extract($_DATA);
      }
      
      if( isset($_POST) && count($_POST) > 0  ){
         $log->m_salto_linea();
         $log->m_escribeLineaParams("P. POST", $_POST);
         extract($_POST);
      }

      if(isset($_GET) && count($_GET) > 1 ){
         $log->m_salto_linea();
         $log->m_escribeLineaParams("P. GET", $_GET);
         extract($_GET);
      }

            //Una matriz que muestra la respuesta de la api
         $response = [];
         if(isset($method)){
              
            switch($method){
               case 'users':
                  $r = $this->db->selectUsuarioFac(6, 1);
                  if(count($r) > 0){
                     $status   = 'OK';
                     $msg      = 'Encontro usuarios';
                     $msgData  = $r;
                  }else{
                     $status   = 'error';
                     $msg      = 'No hay datos';
                  }
                  break;

               case 'userDt':
                  $r = $this->db->selectIdUsuario($idUs, 1);
                  if(count($r) > 0){
                     $status   = 'OK';
                     $msg      = 'Encontro usuario';
                     $msgData  = $r;
                  }else{
                     $status   = 'error';
                     $msg      = 'No existe usuario registrado';
                  }
                  break;

               case 'userUpdate':
                  $b = $this->db->actualizarDatosUsuario($ID_us, [$ID_us,$nom1,$nom2,$ape1,$ape2,$fecha,'','',$correo,$FK_tipo_doc, $ID_us]);
                  if($b){
                     $status   = 'OK';
                     $msg      = 'Actualizo usuario';
                  }else{
                     $status   = 'error';
                     $msg      = 'No actualizo el usuario';
                  }
                  break;

               case 'login':
                  $b = $this->db->loginCorreo([$correo,$pass]);
                  if($b){
                     $status   = 'OK';
                     $msg      = 'Igresnso al sistema, Bienvenido';
                     $msgData  = $b;
                  }else{
                     $status   = 'error';
                     $msg      = 'Credenciales incorrectas';
                  }
                  break;

               case 'insertUser':
                  $status   = 'OK';
                  $msg      = 'metodo inserUser exitoso';
                  break;
               

               case 'movRead':
                  extract($_POST);
                  if(isset($f1) && isset($f2) ){
                   $cond[0] = " WHERE P.fecha BETWEEN  '$f1' AND  '$f2 23:59:59'";
                  }else{
                     $f1      = date('Y-m-01');
                     $f2      = date('Y-m-29');
                     $cond[0] = " WHERE P.fecha BETWEEN  '$f1' AND  '$f2 23:59:59'";
                  }
                   $cond[1] = 'AND P.naturaleza = "C"';
             
                   if(isset($tipo_pago) && $tipo_pago !=''){
                      $cond[1] = 'AND P.naturaleza = "'.$tipo_pago.'"';
                   }
                   $cond[5] = 'ORDER BY P.fecha DESC';
                  $r     = $this->db->verPagos($cond);
                  if(count($r) > 0){
                     $status   = 'OK';
                     $msg      = 'Tiene movimientos';
                     $msgData  = $r;
                  }else{
                     $status   = 'error';
                     $msg      = 'No hay movimientos';
                  }
                  
                  break;

               case 'movCreate':
                  $b = $this->db->insertMov([
                     $actor,
                     $estado,
                     $valor,
                     $idUs,
                     1,
                     $fk_motivo,
                     $natura
                  ]); 

                  if(isset($b) && $b){
                     $status   = 'OK';
                     $msg      = 'Guardo movimiento';
                     $msgData  = $b;
                  }else{
                     $status   = 'error';
                     $msg      = 'No guardo movimiento';
                  }
                  break;

                  default:
                  $status   = 'error';
                  $msg      = 'No existe metodo '.$method;
                  break;
            }
            

            if(isset($msgData)){
               $arrResult = [
                  'response_status' =>$status,
                  'response_msg'    =>$msg,
                  'response_data'   =>$msgData
               ];
            }else{
               $arrResult = [
                  'response_status' =>$status,
                  'response_msg'    =>$msg,
               ];
            }


            if(isset($arrResult) && count($arrResult) > 0 ){$st ='| Retorno datos |';}else{$st ='| No retorno datos |'; }

            $jSon =  json_encode($arrResult, JSON_UNESCAPED_UNICODE);
            $log->m_escribeLinea('R. Api', $jSon);
            $log->m_separa();
            echo ($jSon);
            $log->m_cerrar();
            die();
         }




         if(isset($_GET['apicall']) ){
            // Aqui van todos los llamados de la api
            switch ($_GET['apicall']) {
               // Opcion crear usuarios
            case 'selectUsuarioFactura':
            $r = $this->db->selectUsuarioFac(6, 1);
            echo json_encode($r, JSON_UNESCAPED_UNICODE);
            die();
            break;
               default:
               $response['error']      = true;
               $response['message']    = 'ingreso a api "no esta en ningun metodo"'; 
               break;
               
               case 'autenticacion':
                  if(isset($_POST['email'] ) && isset($_POST['password']) ){
                     if(!isset($_POST['acron']) ) $_POST['acron'] = 'CC';
                     $r = $this->db->loginUsuarioModel([$_POST['email'], $_POST['password'], $_POST['acron'] ]);
                     if($r){
                        echo json_encode($r, JSON_UNESCAPED_UNICODE);
                        die();
                     }else{
                        $response['error']      = true;
                        $response['message']    = 'Credenciales incorrectas'; 
                     }

                  }else{
                     $response['error']      = true;
                     $response['message']    = 'Campo vacioooo'; 
                  }
               break;

               case 'users':

                  $r = $this->db->selectUsuarioFac(6, 1);
             //     $user =  json_encode($r, JSON_UNESCAPED_UNICODE);

                  if(count($r) > 0){
                     $status   = 'OK';
                     $msg      = 'Encontro user';
                     $msgData  = $r;
                  }else{
                     $status   = 'error';
                     $msg      = 'No hay datos';
                     $msgData  = '';
                  }

                  $arrResult = [
                     'response_status' =>$status,
                     'response_msg'    =>$msg,
                     'response_data'   =>$msgData
                  ];
                  echo  json_encode($arrResult, JSON_UNESCAPED_UNICODE);





                  die();

                  break;
            }
         }else{
            // Si no es un api el que se estaq invocando
            // Empujar los valores apropiados en la consulta json
            if( !isset($_POST['apicalp'])){
            $response['message'] = 'Llamado invalido del api';
         }
      }
      if(isset($_POST['apicalp'])){
         switch ($_POST['apicalp']) {
         case 'insertUdateCategoria':
            $a = [
               $this->getSql('id'), 
               $this->getSql('categoria')
            ];
             $r = $this->db->actualizarDatosCategoria($a);
             if(!$r){
               $response['error']      = true;
               $response['menssage']   = $_SESSION['message'] = 'Error, no Actualizo Actegoria'.$_POST['categoria'];
               $response['contenido']  = $r;
               $_SESSION['color']      = "danger";
            }else{
               $response['error']      = false;
               $response['message']    = $_SESSION['message'] = 'Actualizo Categoria '.$_POST['categoria'];
               $response['contenido']  = $r;
               $_SESSION['color']      = "success";
            }
         header( 'location:  ../vista/formCategoria.php');
         break;
         case 'insertcategoria':
            $a = [
               $this->getSql('nom_categoria')
            ];
             $r = $this->db->insertCategoria($a);
             if(!$r){
               $response['error']      = true;
               $response['menssage']   =  $_SESSION['message'] = "Error no creo categoria";
               $response['contenido']  = $r;    
            }else{
               $response['error']      = false;
               $response['message']    = $_SESSION['message'] = 'Inserto categoria'; 
               $response['contenido']  = $r;
               $_SESSION['message']    = "Inserto categoria";
               $_SESSION['color']      = "success";
            }
         header( 'location:  ../vista/formCategoria.php');
         break;
         case 'insertUdateEmpresa':
            $a = [
               $this->getSql('ID_rut'),
               $this->getSql('nom_empresa')
            ];
             $r = $this->db->actualizarDatosEmpresa($a);
             if(!$r){
               $response['error']      = true;
               $response['menssage']   = $_SESSION['message'] = "Error, no actualizo empresa";
               $response['contenido']  = $r;
               $_SESSION['color']      = "danger";
            }else{
               $response['error']      = false;
               $response['message']    = $_SESSION['message']    = "Actualizo empresa";
               $response['contenido']  = $r;
               $_SESSION['color']      = "success";
            }
         header( 'location:  ../vista/formEmpresa.php');
         break;
         case 'insertEmpresa':
            $a = [
               $this->getSql('ID_rut'),
               $this->getSql('nom_empresa')
            ];
             $r = $this->db->insertEmpresa($a);
             if($r){
               $response['error']      = false;
               $response['message']    = $_SESSION['message']  = "Creo empresa";
               $response['contenido']  = $r;
               $_SESSION['color']      = "success";
            }else{
               $response['error']      = true;
               $response['menssage']   = $_SESSION['message'] = 'Error, no creo empresa';
               $response['contenido']  = $r;
               $_SESSION['color']      = "danger";
            }
         header( 'location:  ../vista/formEmpresa.php');
         break;
         case 'insertMedida':
            $a = [
               $this->getSql('nom_medida'),
               $this->getSql('acron_medida')
            ];
             $r = $this->db->insertMedia($a);
             if($r){
               $response['error']      = false;
               $response['menssage']   = $_SESSION['message']  = 'Creo unidad medida';
               $response['contenido']  = $r;
               $_SESSION['color']      = 'success';
            }else{
               $response['error']      =  true;
               $response['message']    = $_SESSION['message']  = "Error, no creo unidad de medida";
               $response['contenido']  = $r;
               
               $_SESSION['color']      = 'danger';
            }
         header( 'location:  ../vista/formMedida.php');
         break;
         case 'venta':
            $a = $_SESSION['CARRITO'];
            require_once 'controllerFacturacion.php';
            $objFac->facturar($a, 1);
            header( 'location:  ../vista/mostrarCarrito.php');
         break;
         case 'EliminarProducto':
            $r= $this->db->EliminarProducto($this->getSql('id'));
            if(!$r){
               $response['error']      = true;
               $response['menssage']   = $_SESSION['message'] = 'No elimino producto';
               $response['contenido']  = $r;
               $_SESSION['color']      = 'danger';
            }else{
               $response['error']      = false;
               $response['message']    = $_SESSION['message'] = 'Elimino producto'; 
               $response['contenido']  = $r;
               $_SESSION['color']      = 'success';
            }
            header( 'location:  ../vista/edicionProductoTabla.php');
         break;
         case'updateProducto':
         //  extract($_POST);
            $a = [
                  $this->getSql('ID_prod'), // 0
                  $this->getSql('nom_prod'), // 1
                  $this->getSql('val_prod'), // 2
                  $this->getSql('stok_prod'), // 3
                  $this->getSql('estado_prod'), // 4
                  $this->getSql('CF_categoria'), // 5
                  $this->getSql('CF_tipo_medida') // 6
               ];     
            $r = $this->db->editarProducto($a);
            if($r){
               $response['error']      = false;
               $response['menssage']   = $_SESSION['message'] = 'Edito producto '.$nom_prod.' de manera exitoza';
               $_SESSION['color']      = 'success';
            }else{
               $response['error']      =  true;
               $response['message']    = $_SESSION['message'] = 'Error al editar producto '.$nom_prod; 
               $_SESSION['color']      = 'danger';
            }
            header( "location:  ../vista/edicionProductoTabla.php");
            break;
            case 'insertUdateMedia':
               $a = [
                  $this->getSql('id'),
                  $this->getSql('nom'),
                  $this->getSql('acron')
               ];
            
               $r = $this->db->actualizarDatosMedida($a);
               if($r){
                  $response['error']      = false;
                  $response['menssage']   = $_SESSION['message'] = 'Actualizar medida';
                  $response['contenido']  = $r;
                  $_SESSION['color']      = 'success';
               }else{
                  $response['error']      =  true;
                  $response['message']    = $_SESSION['message'] = 'Error, Al actualizar medida no debe tener "" por seguridad';
                  $response['contenido']  = $r;
                  $_SESSION['color']      = 'danger';
               }
            header( 'location:  ../vista/formMedida.php');
            break;
            
         default:
           echo 'no esta en metodo';
            break;
         }
      }
      echo json_encode($response);
   }
}
$obj = new apiController();
 