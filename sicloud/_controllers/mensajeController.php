<?php

class mensajeController extends Controller{
   //
   public function __construct(){
      parent::__construct();
      $this->db = $this->loadModel('consultas.sql', 'sql');
      $this->_view->setCss(array('font-Montserrat', 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
      $this->_view->setJs(array('jquery-1.9.0', 'bootstrap.min', 'popper.min', 'fontawasome-ico', 'tablesorter-master/jquery.tablesorter'));
   }
   //
   public function index(){
      $datos = $this->db->verMensaje1();
      echo'<table bg-primary class=" mx-auto col-lg-10 col-md-10 table table-bordered  table-striped bg-white table-sm mx-auto text-center  text-center">';
      echo '<thead>';
      echo '<tr><th>Id</th>';
      echo '<th class = "col-md-6">Mensajes</th><tr>';
      echo '</thead>';
      echo '<tbody>';   
      foreach(  $datos as $d ){
          echo '<tr>';
          echo "<td>".$d['ID_not']."</td>";
          echo "<td>".$d['descript']."</td>";
          echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
   }
   //
   public function nuevoMensaje(){
      $db      = $this->loadModel('consultas.sql', 'sql');  // Carga modelo
      $estado = 0;
      $FK_rol = 1;
      $FK_ms =  1;
      $descrip = $_GET['mensaje'];
      $a = [ $estado, $descrip, $FK_rol , $FK_ms ];
      $db->insertMensaje($a);
      include_once APP_LIBS.'chat2/index.php';
     // echo '<meta http-equiv="REFRESH" content="0;url="mensaje">';
   }
}
