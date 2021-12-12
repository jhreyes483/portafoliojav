<?php

class empresaController extends Controller{
      //  $this obj =  1 - return array response
      //  obj de api = 2 - return bool
   private $tipo;
   public function __construct($tipo = 1){
      $this->tipo = $tipo;
      $this->issetSession();
      parent::__construct();
      $this->db = $this->loadModel('consultas.sql', 'sql');
     $this->_view->setCss(array('font-Montserrat', 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
     // $this->_view->setJs(array('jquery-1.9.0', 'bootstrap.min', 'popper.min', 'fontawasome-ico', 'tablesorter-master/jquery.tablesorter'));
   }
// VISTA
   public function index(){
      $this->getSeguridad('S1CE');
      if(isset($_POST['accion'])){
         //
         switch ($_POST['accion']) {
            case 'insertEmpresa':
               $this->m_store();
            break;
            case 'udateEmpresa':
               $this->m_update();
            break;
         }
      }
      if(isset($_GET['d'])){
        $this->m_destroy();
      }
      //
      $r = $this->db->verEmpresa();
      if( count($r) != 0 ){
         $this->_view->datos = ['response_status' => 'ok', 'response_msg' => $r];
      }else{
         $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay registro de empresa' ];
      }
      $this->_view->renderizar('index');
      $this->_view->setTable('empresa', 0, 2 );
   }
   //
   public function edit(){
      $this->getSeguridad('S1CE');
      $this->_view->datos = $this->db->verDatoEmpresaPorId($_POST['id']);
      $this->_view->renderizar('editar');
   }
// CRUD
   public function m_store(){
      switch ($this->tipo) {
         case 1:
            $a = [
               $this->getSql('ID_rut'),
               $this->getSql('nom_empresa')
            ];
             $b = $this->db->insertEmpresa($a);
             if($b){
               $_SESSION['message']  = "Creo empresa";
               $_SESSION['color']    = "success";
            }else{
               $_SESSION['message'] = 'Error, no creo empresa';
               $_SESSION['color']  = "danger";
            }
         break;
         case 2:
            $a = [
               $this->getSql('ID_rut'),
               $this->getSql('nom_empresa')
            ];
            return $this->db->insertEmpresa($a);
         break;            
         default:
            die('no definio el tipo de objeto');
         break;
      }
   }
   //
   public function m_destroy(){
      switch ($this->tipo) {
         case 1:
            $a = [
               $_GET['id']
            ];
             $bA = $this->db->eliminarEmpresa($a);
             if($bA){
               $bB = $this->registraLog($_GET['id'], 8);
             }
             if($bB){
               $_SESSION['message'] = "Elimino empresa";
               $_SESSION['color']      = "success";
               $this->redireccionar('empresa');
            }else{
               $response['message']    = $_SESSION['message'] = "Error no elimino empresa";  
               $_SESSION['color']      = "danger";
            }
         break;
         case 2:
            $a = [
               $_GET['id']
            ];
            $bA = $this->db->eliminarEmpresa($a);  
            if($bA){
               return $this->registraLog($_GET['id'], 8);
            }else{
               return false;
            }  
         break;
         default:
         die('no definio el tipo de objeto');
         break;
      }
   }
   //
   public function m_update(){
      switch ($this->tipo) {
         case 1:
            $a = [
               $this->getSql('ID_rut'),
               $this->getSql('nom_empresa')
            ];
         
            $bA = $this->db->actualizarDatosEmpresa($a);
            if($bA){
               $bB = $this->registraLog($this->getSql('id'), 9);
            }
            if($bB){

               $_SESSION['message']    = "Actualizo empresa";
               $_SESSION['color']      = "success";
            }else{
               $_SESSION['message']    = "Error, no actualizo empresa";
               $_SESSION['color']      = "danger";
            }
            $this->redireccionar('empresa');
         break;
         case 2:
            $a = [
               $this->getSql('ID_rut'),
               $this->getSql('nom_empresa')
            ];
            return $this->db->actualizarDatosEmpresa($a);
         break;
         default:
         die('no definio el tipo de objeto');
         break;
      }
   }
}

?>