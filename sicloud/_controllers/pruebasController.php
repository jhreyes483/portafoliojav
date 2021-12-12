<?php
class pruebasController extends Controller{

   private $db;
   private $param;
   public function __construct(){
       $this->db = $this->loadModel('consultas.sql', 'sql');
       parent::__construct();
       $this->_view->setCss(array('bootstrap.min', 'jav', 'animate', 'fontawesome-all', 'ind' ));
       $this->_view->setJs(array('jquery-1.9.0', 'bootstrap.min',  'fontawasome-ico', 'fontawesome-all'));
       $this->param = $this->getParam();
   }
   //
   public function index(){
      $this->_view->renderizar('index');
   }
}
?>