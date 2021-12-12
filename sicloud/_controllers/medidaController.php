<?php
class medidaController extends Controller{
   //  $this obj  = 1 - return array response
   //  obj de api = 2 - return bool
   private $tipo;
   //
   public function __construct($tipo = 1){
      $this->tipo = $tipo;
      parent::__construct();
      $this->db = $this->loadModel('consultas.sql', 'sql');
      $this->_view->setCss(array('font-Montserrat', 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
    //  $this->_view->setJs(array('jquery-1.9.0', 'bootstrap.min', 'popper.min', 'fontawasome-ico', 'tablesorter-master/jquery.tablesorter'));
   }
//VISTAS
   public function index(){
      $this->issetSession();
      $this->getSeguridad('S1CM');
      if(isset($_POST['accion'])){
         switch ($_POST['accion']) {
            case 'insertMedida':
               $this->m_store();
            break;
            case 'UdateMedia':
               $this->m_update();
            break;
         }
      }
      if( isset($_GET['d'])){ // si existe eliminar medida
         $this->m_destroy();
      }
      //
      $r  = $this->db->verMedida();
      if( count($r) != 0 ){
         $this->_view->datos = ['response_status' => 'ok', 'response_msg' => $r];
      }else{
         $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay registro de empresa' ];
      }
      $this->_view->renderizar('index');
      $this->_view->setTable('medidas', 0, 2 );
   }
   //
   public function edit(){
      $this->issetSession();
      $this->getSeguridad('S1CM');
      $r = $this->db->verMedidaPorId($_POST['id']);
      if( count($r) != 0 ){
         $this->_view->datos = ['response_status' => 'ok', 'response_msg' => $r];
      }else{
         $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay registro de empresa' ];
      }
      $this->_view->renderizar('editar');
   }
   //
   //CRUD
   public function m_destroy(){
      switch ($this->tipo) {
         case 1:
            $a = [
               $_GET['id'],
            ];
            //
            $bA = $this->db->eliminarDatosMedia($a);
            if($bA){
              $bB = $this->registraLog($this->getSql('id'),10);
            }
            //
            if($bB){
              $_SESSION['message'] = 'Elimino medida';
              $_SESSION['color']   = 'success';
            }else{
               $_SESSION['message'] = "Error, no creo unidad de medida";
               $_SESSION['color']   = 'danger';
            }
            $this->redireccionar('medida');
         break;
         case 2:
            $a = [
               $_GET['id'],
            ];
            //
            $bA = $this->db->eliminarDatosMedia($a);
            if($bA){
              return $this->registraLog($this->getSql('id'),10);
            }else{
               return false;
            }
            //
            $this->redireccionar('medida');       
         break;
      }
   }
   //
   public function m_update(){
      switch ($this->tipo) {
         case 1:
            $a = [
               $this->getSql('id'),
               $this->getSql('nom'),
               $this->getSql('acron')
            ];
             $bA = $this->db->actualizarDatosMedida($a);
             if($bA){
                $bB = $this->registraLog($this->getSql('id'),11);
             }
             if($bB){
               $_SESSION['message'] = 'Actualizar medida';
               $_SESSION['color']      = 'success';
            }else{
               $_SESSION['message'] = 'Error, Al actualizar medida no debe tener "" por seguridad';
               $_SESSION['color']      = 'danger';
            }
         break;
         case 2:
            $a = [
               $this->getSql('id'),
               $this->getSql('nom'),
               $this->getSql('acron')
            ];
             $bA = $this->db->actualizarDatosMedida($a);
             if($bA){
                return $bB = $this->registraLog($this->getSql('id'),11);
             }
         break;
      }
   }

   public function m_store(){
      switch ($this->tipo) {
         case 1:
            $a = [
               $this->getSql('nom_medida'),
               $this->getSql('acron_medida')
            ];
             $b = $this->db->insertMedia($a);
             if($b){
               $_SESSION['message']  = 'Creo unidad medida';
               $_SESSION['color']    = 'success';
            }else{
               $_SESSION['message']  = "Error, no creo unidad de medida";
               $_SESSION['color']    = 'danger';
            }         
         break;
         case 2:
            $a = [
               $this->getSql('nom_medida'),
               $this->getSql('acron_medida')
            ];
            return $this->db->insertMedia($a);        
         break;
      }
   }

}
