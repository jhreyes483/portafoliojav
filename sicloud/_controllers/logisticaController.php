<?php

class logisticaController extends Controller
{

   public function __construct(){
      parent::__construct();
      $this->db            = $this->loadModel('consultas.sql', 'sql');
      $this->_view->setCss(array( 'font-Montserrat','google','bootstrap.min','jav','animate','fontawesome-all'));
     // $this->_view->setJs(array('jquery-1.9.0','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery', 'tablesorter-master/jquery.tablesorter'));
   }
   //
   public function alertas(){
      $this->_view->renderizar('alertas');
   }
   //
   public function cantidad(){
      $this->getSeguridad('S1CT');
      $tmp =  $this->db->verCategorias();
      foreach($tmp as $d ) $c[$d[0] ] = $d[1];
      $this->_view->categoria = $c;
      //$r = $this->db->verProductosGrafica();
      if(isset($_POST['accion'])){
         switch ($_POST['accion']) {
            case 'filtroCategoria':
               $r  = $this->db->verPorCategoria($_POST['p']);
               break;
            case 'todos':
               $r  = $this->db->verProductos();
               break;
         }
      }else{
         $r  = $this->db->verProductos();
      }



      $this->_view->datos = [
         $r,
         (array_sum( array_column( $r, 1  ) ))
      ];
      //
      $this->_view->renderizar('cantidadProductos');
      $this->_view->setTable('cantidad', 1);
   }
   //
   public function categoria(){
      $this->getSeguridad('S1CG');
      $r  = $this->db->verCategorias();
      foreach( $r as $d ) $this->_view->datosF[ $d[0] ] = $d[1];
      if(isset($_POST['accion'])  && $_POST['accion'] == 'filtroCategoria'){
         $r  = $this->db->verPorCategoria($_POST['p']);
         if( count($r)!= 0  ){
            $this->_view->datos  = [ 'response_status' => 'ok', 'response_msg' => $r, 'response_alert' => 'filtro por ' .$this->_view->datosF[ $_POST['p']  ] ];
         }else{
            $this->_view->datos  = [ 'response_status' => 'error', 'response_msg' => 'No hay productos' ];
         }
      }
      $this->_view->renderizar('categorias');
      $this->_view->setTable('productos', 1);
   }
   //
   public function index(){
      $this->issetSession();
      $this->_view->renderizar('index');
      if(isset($_GET['edit'])){
         echo "hola";
      }
   }
   //
   // vista
   public function solicitud(){
      $this->getSeguridad('DFERA');
      $this->_view->renderizar('logistica-solicitud');
   }   
}
