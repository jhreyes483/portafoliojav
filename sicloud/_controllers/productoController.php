<?php

class productoController extends Controller{
   private $tipo;
   public function __construct($tipo=1){
      $this->tipo = $tipo;
      parent::__construct();
      $this->db = $this->loadModel('consultas.sql', 'sql');
      $this->_view->setCss(array('font-Montserrat', 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
     // $this->_view->setJs(array('jquery-1.9.0', 'bootstrap.min', 'popper.min', 'fontawasome-ico', 'tablesorter-master/jquery.tablesorter'));
   }
   //
   public function index(){
      if( isset($_GET['edit']) && $_GET['edit'] == 1  ){
        $this->getSeguridad('S1PLE');
      }
      $this->getSeguridad('S1SDF');
      if( isset($_POST['accion']) ){
         $this->getSeguridad('S1PLE');
         switch ($_POST['accion']) {
            case 'EliminarProducto':
               $this->m_destroy();
            break;
            case 'inserProducto':
               $this->m_store();
            break;
            case'updateProducto':
               $this->m_update();
            break;            
         }
         $_GET['edit'] =1;
         $r = $this->db->verProductos();
         
      }
      //$r = $this->db->verProductos();

      if( ! isset ($_POST['accion'] ) ){
         $r = $this->db->verProductos();
      }

       $tmp =  $this->db->verCategorias();
       foreach($tmp as $d ) $c[$d[0] ] = $d[1];
       $this->_view->categoria = $c;


      foreach( $r as $d ) $this->_view->datosF[ $d[0] ] = $d[1];
      if(isset($_POST['accion'])){
      switch ($_POST['accion']) {
         case 'filtroCategoria':
            $r  = $this->db->verPorCategoria($_POST['p']);
            break;
         case 'todos':
            $r  = $this->db->verProductos();
            break;
      }
         if( count($r)!= 0  ){
           if(isset(($_POST['p'])))  $this->_view->datos  = [ 'response_status' => 'ok', 'response_msg' => $r, 'response_alert' => 'filtro por ' .$this->_view->datosF[ ($_POST['p']) ] ];
         }else{
            $this->_view->datos  = [ 'response_status' => 'error', 'response_msg' => 'No hay productos' ];
         }
      }


      if(isset($r)  && count($r) != 0){
         $this->_view->datos = ['response_status'=>'ok', 'response_msg'=>$r];
      }else{
         $this->_view->datos = ['response_status'=>'error', 'response_msg'=>'No hay datos'];
      }

      $this->_view->renderizar('index');
      $this->_view->setTable('stock', 2, 0);
   }
// VISTA
   //
   public function ingreso(){
      $this->issetSession();
      $this->getSeguridad('S1PL');

      if(isset($_POST['accion']) ){
         switch ($_POST['accion']) {            
            case 'busquedaProducto':
               $r = $this->db->verJoin($_POST['p']??'1557972591');
            break;
            case 'IngresarCantidad':
               $this->m_add();
            break;
            
            default:
            $r = $this->db->verJoin($_POST['p']??'1557972591');
            break;
         }
      }else{
         $r = $this->db->verJoin($_POST['p']??'1557972591');
      }
      //
      $p =  $this->db->verProductos();
      $this->_view->datosF = [ $p  ];

      if( isset($r) &&  count($r) != 0){
         $this->_view->datos =['response_status' => 'ok', 'response_msg' => $r];
      }else{
         $this->_view->datos =['response_status' => 'error', 'response_msg' => 'No hay datos'];
      }  
      $this->_view->renderizar('ingresoProducto');
   }
   //
   public function create(){
     $this->getSeguridad('S1PCL');
      $c =  $this->db->verCategorias();
      $m =  $this->db->verMedida();
      $e =  $this->db->verProveedor();
      $p =  $this->db->verProductos();
      $this->_view->datos = [$c, $m, $e, $p];
      $this->_view->renderizar('create');
   }
   //
   public function edit(){
      $producto   =  $this->db->verProductosId($_POST['id']);
      $categorias =  $this->db->verCategorias();
      $medida     =  $this->db->verMedida();
      $provedor   =  $this->db->verProveedor();
      $estado     =[ 'estandar'  , 'promocion' ]; 
      if( count($categorias) == 0)  $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay datos de categoria' ];
      if( count($categorias) == 0)  $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay datos de categoria' ];
      if( count($medida    ) == 0)  $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay datos de medida' ];
      if( count($producto  ) == 0)  $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'El producto no existe' ];
      $this->_view->datos =  [ 'response_status' => 'ok', 'response_msg' =>  [$categorias , $medida, $provedor, $producto , $estado] ];
      $this->_view->renderizar('edit');
   }
   // Agrega camtidad de un producto existente
   public function m_add(){
      $a =[
         ($this->getSql('cantidad')  + $this->getSql('stok')),
         $_POST['id'],
      ];
      $b = $this->db->inserCantidadProducto( $a );
      if($b == 1){
         $_SESSION['message'] = 'Registro entrega'; $_SESSION['color'] = 'success';
      } 
      $this->redireccionar('producto/ingreso');
   }
// CRUD   
   public function m_destroy(){
      switch ($this->tipo) {
         case 1:
            $bA= $this->db->EliminarProducto($this->getSql('id'));
            if($bA){
               $bB = $this->registraLog( $this->getSql('id'), 4 );
            }
            if($bB){
               $response['message']    = $_SESSION['message'] = 'Elimino producto'; 
               $_SESSION['color']      = 'success';
            }else{
               $response['menssage']   = $_SESSION['message'] = 'No elimino producto';
               $_SESSION['color']      = 'danger';
               $this->redireccionar("productos?edit");
            }
         break;
         case 2:
            $bA= $this->db->EliminarProducto($this->getSql('id'));
            if($bA){
               return $this->registraLog( $this->getSql('id'), 4 );
            }else{
               return false;
            } 
         break;
      }
   }
   //
   public function m_store(){
      switch ($this->tipo) {
         case 1:
            $a = [
               $this->getSql('ID_prod'),
               $this->getSql('nom_prod'),
               $this->getSql('val_prod'),
               $this->getSql('stok_prod'),
               $this->getSql('estado_prod'),
               $this->getSql('CF_categoria'),
               $this->getSql('CF_tipo_medida'),
               $_FILES['foto']['name'],
               $_FILES['foto']['tmp_name'],
               $this->getSql('descripcion')
            ];
            //Copia foto de producto
            $destino = 'public/layout1/img/prod/'.$_FILES['foto']['name']; // verificar si copio
            copy($_FILES['foto']['tmp_name'] , $destino); 
            $result = $this->db->insertarProducto($a);
            if (!$result) {
               $response['error']      = true;
               $response['menssage']   = $_SESSION['message'] = 'No inserto producto';
               $response['contenido']  = $result;
               $_SESSION['color']      = 'Danger';
            } else {
               $response['error']      = false;
               $response['message']    = $_SESSION['message'] = 'Inserto producto';
               $response['contenido']  = $result;
               $_SESSION['color']      = 'success';
            }
            $this->redireccionar('producto?edit');
         break;
         case 2:
            $a = [
               $this->getSql('ID_prod'),
               $this->getSql('nom_prod'),
               $this->getSql('val_prod'),
               $this->getSql('stok_prod'),
               $this->getSql('estado_prod'),
               $this->getSql('CF_categoria'),
               $this->getSql('CF_tipo_medida'),
               $_FILES['foto']['name'],
               $_FILES['foto']['tmp_name'],
               $this->getSql('descripcion')
            ];
            //Copia foto de producto
            $destino = 'public/layout1/img/prod/'.$_FILES['foto']['name']; // verificar si copio
            copy($_FILES['foto']['tmp_name'] , $destino); 
            return $this->db->insertarProducto($a);
         break;
      }
   }
   //
   public function m_update(){
      switch ($this->tipo) {
         case 1:
            $a = [
               $this->getSql('ID_prod'), // 0
               $this->getSql('nom_prod'), // 1
               $this->getSql('val_prod'), // 2
               $this->getSql('stok_prod'), // 3
               $this->getSql('estado_prod'), // 4
               $this->getSql('CF_categoria'), // 5
               $this->getSql('CF_tipo_medida') // 6
               ];
            
            $bA = $this->db->editarProducto($a);
            if($bA){
                 $bB = $this->registraLog($this->getSql('ID_prod'), 5);
            }
            if($bB){
               $_SESSION['message'] = 'Edito producto '.$this->getSql('nom_prod').' de manera exitoza';
               $_SESSION['color']      = 'success';
            }else{
               $_SESSION['message'] = 'Error al editar producto '.$this->getSql('nom_prod'); 
               $_SESSION['color']      = 'danger';
            }
         break;
         case 2:
            $a = [
               $this->getSql('ID_prod'), // 0
               $this->getSql('nom_prod'), // 1
               $this->getSql('val_prod'), // 2
               $this->getSql('stok_prod'), // 3
               $this->getSql('estado_prod'), // 4
               $this->getSql('CF_categoria'), // 5
               $this->getSql('CF_tipo_medida') // 6
               ];
            
            $bA = $this->db->editarProducto($a);
            if($bA){
                 return $this->registraLog($this->getSql('ID_prod'), 5);
            }else{
               return false;
            }       
         break;
      }
   }
}

?>
