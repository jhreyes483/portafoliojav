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
        die('Implementar este perfil no está en los requerimientos, <br>Se encuentra deshabilitado, ingrese con 2 0 3 atte. Javier Reyes N');
    }

   
}
