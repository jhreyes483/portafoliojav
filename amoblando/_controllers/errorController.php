<?php

class errorController extends Controller {
// Guarda notificaicones en varible $this->_view->notificacion 
      //
	   public function __construct(){
         parent::__construct(1);
         $this->db            = $this->loadModel('consultas.sql', 'sql');
         $this->objSession    = new Session();
         $this->_view->setCss( ['jav','bootstrap.min', 'fontawesome-all.css'] );
        // $this->_view->setJs( ['jquery-1.9.0', 'bootstrap.min', 'popper.min', 'fontawasome-ico', 'cUsuariosJquery', 'tablesorter-master/jquery.tablesorter'] );
      }
      //
	   public function index(){
         if(isset($_SESSION['usuario'])){
            session_destroy();
            $this->redireccionar('index');
         }
      }	   
      //
      public function inicieSesion(){
         $this->_view->setJs( ['login']  );
         $this->_view->renderizar('inicieSesion', 1); 
      } //sesioninactiva
      //
      public function cuenta(){
         $this->_view->setJs( ['login']  );
         $this->_view->renderizar('sesioninactiva', 1); 
      } //sesioninactiva
      //
      public function permiso(){
         $this->_view->setJs( ['login']  );
         $this->_view->renderizar('permiso', 1); 
      }
      //
      public function pagina(){
         $this->_view->setJs( ['login']  );
         $this->_view->renderizar('404', 1); 
      }// 
   }
   
?>
