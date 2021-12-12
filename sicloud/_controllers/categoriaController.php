<?php

class categoriaController extends Controller{
   private $tipo;
   //
   public function __construct($tipo = 1 ){
      //  $this obj =  1 - return array response
      //  obj de api = 2 - return bool
      //
      $this->tipo = $tipo;
      parent::__construct();
      $this->db = $this->loadModel('consultas.sql', 'sql');
      $this->_view->setCss(array('font-Montserrat', 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
   }
//VISTA
   //
   public function index(){
      $this->issetSession();
      $this->getSeguridad('S1CC');
      // Eliminar
      if(isset($_GET['d'])){
         $this->m_destroy();
      }
      if(isset($_POST['accion'])){ 
         switch ($_POST['accion']) {
            // Insertar
            case 'insertcategoria':
               $this->m_store();
            break; 
            // Actualiza
            case 'updatecategoria';
               $this->m_update();
            break;
         }
      }
      $r = $this->db->verCategoria();
      if( count($r) != 0){
         $this->_view->datos = ['response_status' => 'ok','response_msg'=> $r];
      }else{
         $this->_view->datos = ['response_stutas' => 'error', 'response_msg' => 'No hay registro de categorias'];
      }
      $this->_view->renderizar('index');
      $this->_view->setTable( 'categorias', 1  );
   }
   //
   public function editar(){
      $this->issetSession();
      $this->getSeguridad('S1CC');
      $this->_view->datos =  $this->db->verCategoriaId($_POST['id']);
      $this->_view->renderizar('editar');
   }
// CRUD
   public function m_store(){
      switch ($this->tipo) {
         case 1:
            $a = [
               $this->getSql('nom_categoria')
            ];
             $r = $this->db->insertCategoria($a);
             if($r){
               $_SESSION['message']    = "Registro categoria";
               $_SESSION['color']      = "success";
               $this->redireccionar('categoria');    
            }else{
               $_SESSION['message'] = "Error no creo categoria";
               $response['contenido']  = $r;
               $this->redireccionar('categoria');       
            }
         break;
         case 2:
            $a = [
               $this->getSql('nom_categoria')
            ];
            return $this->db->insertCategoria($a);
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
             $bA = $this->db->eliminarCategoria($a);
             if($bA){
                $bB = $this->registraLog($_GET['id']  , 6 );
             }
             if($bB){
               $_SESSION['message']    = "Elimino categoria"; 
               $_SESSION['color']      = "success";
               $this->redireccionar('categoria');
            }else{
               $_SESSION['message']    = "Error no elimino";
               $_SESSION['color']      = "danger";  
               $this->redireccionar('categoria');
            }   
         break;
         case 2:
            $a = [
               $_GET['id']
            ];
            $bA = $this->db->eliminarCategoria($a);
            if($bA){
               return $this->registraLog($_GET['id']  , 6 );
            }else{ 
               return false;
            }
         break;
      }     
   }
   //
   public function m_update(){
      switch ($this->tipo) {
         case 1:
            $a = [
               $this->getSql('id'), 
               $this->getSql('categoria')
            ];
             $bA = $this->db->actualizarDatosCategoria($a);
             if($bA){
               $bB = $this->registraLog($this->getSql('id'), 7 );
            }
             if($bB){
               $_SESSION['message']    = 'Actualizo Categoria '.$_POST['categoria'];
               $_SESSION['color']      = "success";
            }else{
               $_SESSION['message'] = 'Error, no Actualizo Actegoria'.$_POST['categoria'];
               $_SESSION['color']   = "danger";
            }
         break;
         case 2:
            $a = [
               $this->getSql('id'), 
               $this->getSql('categoria')
            ];
            $b = $this->db->actualizarDatosCategoria($a);
            if($b){
               $this->registraLog($this->getSql('id'), 7 );
            }else{
               return false;
            }
         break;
      }
   }
}


