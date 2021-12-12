<?php
class facturaController extends Controller{
    public function __construct(){
        parent::__construct();
        $this->objSession     = new Session;
        $this->session        = $this->objSession->desencriptaSesion();
        $this->o_numeroLetras = new c_numerosLetras;
        $this->db             = $this->loadModel('consultas.sql', 'sql');
        $this->_view->setCss(array( 'font-Montserrat' , 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
        // $this->_view->setJs(array('jquery-1.9.0','tablesorter-master/jquery.tablesorter','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery'));
    }
    //
    public function index(){
    //    $this->db->updateCantidadProducto([($d[2] - $d[3] ) ,$aP[3]]);  
           if( isset($_POST)){
        if( isset($_REQUEST['accion'])){
            switch ($_REQUEST['accion']) {
                case 'anular':
                    // Anula factura
                 //   $ID= ( isset($_POST[]) )? $ID: $this->session['usuario']['ID_us'] ;
                    $_SESSION['venta']   =  null;
                    $_SESSION['message'] = 'anulo factura';
                    $_SESSION['color']   = 'danger'; 
                    $this->redireccionar('factura');
                break;
                case 'agregar':
                    $this->m_addProductoPreventa();
                break;
                case 'eliminar':
                    $this->m_deleteProductoPreventa();
                break;
                case 'facturarInterno':
                   $this->m_facturar($_SESSION['venta'] , 0);   
                break;  
                case 'facturarWeb':
                    $this->m_facturar($_SESSION['CARRITO'], 1);
                    $this->redireccionar('cliente/catalogo');
                break;
                    
              }
           }
        }
       //
        $this->getSeguridad('S1F');
        $this->_view->setCss(array('datatables.min'));
        $this->_view->setJs(array('popper.min','datatables.min'));
         //
        if( isset($_POST['ID'] ) ){
            $_SESSION['s_cliente'] =  $_POST['ID'] ;
        }
        //
        if(isset($_SESSION['s_cliente'])){
            $datosU = $this->db->selectUsuarios( $_SESSION['s_cliente'] );
        }
        $aProd  = $this->db->verProductos();
        $aPago  = $this->db->verPago();
        $TipoV  = $this->db->verTipoV();
            $this->_view->datos  = [ 'response_status' =>'ok', 'response_msg' => [
                        $datosU??[],
                        $aProd,
                        $aPago,
                        $TipoV
                        ]
                    ];  
        $this->_view->renderizar('index');
    }
    // Preventa interna 
    public function m_deleteProductoPreventa(){
       unset($_SESSION['venta'][$_REQUEST['id'] ]);
       $_SESSION['message'] ='Elimino producto de Pre venta';
       $_SESSION['color'] = 'success';
       $this->redireccionar('factura');
    }
    //
    public function  m_addProductoPreventa(){
        // Agraga producto a factura
        if (! isset($_SESSION['venta'])){ $_SESSION['venta'] = [];}
        if(  !in_array(  $this->getSql('ID_prod')   ,   array_column($_SESSION['venta'] , 0 ) )  ){ 
           $subTotal = ($this->getSql('cantidad')  *  $this->getSql('val_prod') );
           $_SESSION['venta'][] = [
               $this->getSql('ID_prod') ,
               $this->getSql('nom_prod') ,
               $this->getSql('stok_prod') ,
               $this->getSql('cantidad'),
               $this->getSql('val_prod'),
               $this->getSql('Cat'),
               $subTotal
           ];  
           $_SESSION['message'] = 'Agrego producto';
           $_SESSION['color']   = 'success'; 
           $total =  array_sum(  array_column($_SESSION['venta'] , 6 ) ) ;
           $letras =  $this->o_numeroLetras->convertirEurosEnLetras($total );
           //
           if( $total > 0 ){
               $this->_view->total = ['response_status' => 'ok' , 'response_msg' => [ $total, $letras ] ];
           }else{
               $this->_view->total = ['response_status' => 'error', 'response_msg' => 'No hay datos'];
           }
           //
           $this->redireccionar('factura');
        }else{
           $_SESSION['message'] = 'Error, Producto ya existe';
           $_SESSION['color']   = 'danger'; 
           $this->redireccionar('factura');
        }
    }
    //
    // Preventa web
    public function generaPreVenta(){
        //rutFromIni();
        $mensaje = "";
        // captura los datos que vienen por pos, desemcrita y almacena en varibles
        if (isset($_POST['btnCatalogo'])) {
            switch ($_POST['btnCatalogo']) {
                case 'Agregar':
                    if (openssl_decrypt($_POST['id'], COD, KEY)) {
                        $ID = openssl_decrypt($_POST['id'], COD, KEY);
                        $mensajeId = "OK ID" . $ID;
                    } else {
                        $mensaje = "Upss.. Id incorrecto";
                    }
                    if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                        $NOMBRE = openssl_decrypt($_POST['nombre'], COD, KEY);
                        $mensajeNombre = "OK ID" . $NOMBRE;
                    } else {
                        $mensaje = "Upss.. Id incorrecto";
                    }
                    $CANTIDAD = $_POST['cantidad1'];
                    $mensajeCantidad = "OK ID" . $CANTIDAD;
                    //
                    if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                        $PRECIO = openssl_decrypt($_POST['precio'], COD, KEY);
                        $mensajePrecio = "OK ID" . $PRECIO;
                    } else {
                        $mensajePrecio = "Upss.. Id incorrecto";
                    }
                    //
                    if (is_string(openssl_decrypt($_POST['img'], COD, KEY))) {
                        $IMG = openssl_decrypt($_POST['img'], COD, KEY);
                        $mensajeImg = "OK ID" . $IMG;
                    } else {
                        $mensajePrecio = "Upss.. Id incorrecto";
                    }
                    //
                    if (!isset($_SESSION['CARRITO'])) {
                        // ALMACENAR EL VALOR DE LA VARIBLE EN EL ARREGLO $porductos
                        $producto = [
                            'ID' => $ID,
                            'NOMBRE' => $NOMBRE,
                            'CANTIDAD' => $CANTIDAD,
                            'PRECIO' => $PRECIO,
                            'IMG' => $IMG
                        ];
                        //
                        // Almacena los datos en session
                        $_SESSION['CARRITO'][0] = $producto; // almacena en la pocion 0 "en el primer elemento del carrito"
                        $_SESSION['message']    =  'Agrego el prodicto ' . $producto['NOMBRE'] . " al carrito de compras";
                        $_SESSION['color']      = 'success';
                    } // fin de isset carrito "primer producto"
                    else {
                        //--------------------------------------------------------------------------
                        //Valida si el producto ya existe en el carrito
                        $idProducto = array_column($_SESSION['CARRITO'], "ID"); // captura todos los id del arreglo
                        if (in_array($ID, $idProducto)) { // verifica si en exiten duplicados
                            $p =  (isset($producto['NOMBRE'])) ? $producto['NOMBRE'] : '';
                            $_SESSION['message'] =  'Error El producto ' . $p . " ya ha sido seleccionado";
                            $_SESSION['color']   = 'danger';
                            break;
                        }
                        //-------------------------------------------------------------------------
                        $numeroProductos = count($_SESSION['CARRITO']);
                        //Recupera los datos que llegaron por post y que se desencriptaron "si ya existe el carrito"
                        $producto = array(
                            'ID' => $ID,
                            'NOMBRE' => $NOMBRE,
                            'CANTIDAD' => $CANTIDAD,
                            'PRECIO' => $PRECIO,
                            'IMG' => $IMG
                        );
                        //
                        $_SESSION['CARRITO'][$numeroProductos] = $producto;
                        $_SESSION['message'] =  'Agrego el producto ' . $producto['NOMBRE'] . " al carrito de compras";
                        $_SESSION['color'] = 'success';
                    }
                    $mensaje = print_r($_SESSION, true);
                    break;
                case 'Eliminar':
                    // EVALUACION SI LA ACCION ES ELIMINAR EL PRODUCTO DEL CARRITO
                    openssl_decrypt($_POST['id'], COD, KEY);
                    $ID = openssl_decrypt($_POST['id'], COD, KEY);
                    //
                    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                        if ($producto['ID'] == $ID) :
                            // borra el producto
                            unset($_SESSION['CARRITO'][$indice]);
                            $_SESSION['message'] =  'Elimino el producto ' . $producto['NOMBRE'] . ' del carrito de compras';
                            $_SESSION['color'] = 'danger';
                        endif;
                    }
                    $this->redireccionar('cliente/compras');
                    break;
            } // Fin de switch
        }
        $this->redireccionar('cliente/catalogo');
    }
    // Factucion
    public function m_facturar($a , $tipo = 1){
        $ID = $this->session['usuario']['ID_us'];
        switch ($tipo) {
        // Facturacion interna
       
            case 0:
               $total = array_sum(array_column($a, 6));
               $iva = ($total * 0.19);
               $fecha = date('Y-m-d');
                $aF =[
                    $total,
                    $fecha,
                    'N/A',
                    $iva,
                    $_POST['pago'],
                    $_POST['tipo']
                ];
                //
               $id_factura = $this->db->facturar($aF);
                foreach( $a as $i => $d ){
                    $aP= [
                        $id_factura,
                        $d[0],
                        $d[6],
                        $d[3],
                        $_POST['ID'],
                        $_POST['FK_tipo_doc']
                    ];
                    // 14-03-2012 se implementa descuento de porducto en innventario // by J.R.N

                   $r1= $this->db->updateCantidadProducto([($d[2] - $d[3] ) ,$aP[1]]);  
                   if($r1){
                    
                    $r2 =   $this->db->insertaProductosFactura($aP);
                   }
                 //   Controller::ver($r1, 1,1,'result');
                
                
                 if($r2){
                     $_SESSION['venta']  = null;
                     $_SESSION['message']= "Facturo de manera exitosa, factura numero  $id_factura";
                     $_SESSION['color']  = "success";
                 }else{
                    $_SESSION['message'] = "Error al facturar";
                    $_SESSION['color']   = "danger";
                 }
                }
               
                $this->redireccionar('factura');
             //   header("Location: ../vista/CU005-facturacion.php?ID=$ID");
            break;  
        // Facturacion de carrito de compras
            case 1:
                $total = 0;
                foreach( $a as $i => $d){
                    $SubTot = ($d['CANTIDAD'] *  $d['PRECIO']);
                    $total += $SubTot;
                }
                $iva = ($total * 0.19);
                $fecha = date('Y-m-d');
                $aF =[
                    $total,
                    $fecha,
                    'En proceso',
                    $iva,
                    5,
                    1
                ];
              //
               $id_factura = $this->db->facturar($aF);
                foreach( $a as $i => $d ){
                    $aP= [
                        $id_factura,
                        $d['ID'],
                        $d['PRECIO'],
                        $d['CANTIDAD'],
                        $this->session['usuario']['ID_us'],
                        $this->session['usuario']['FK_tipo_doc']
                    ];
                    $r =   $this->db->insertaProductosFactura($aP);
                    if($r){
                       $_SESSION['message']= "Facturo de manera exitosa, factura numero  $id_factura";
                       $_SESSION['color'] = "success";
                    }else{
                       $_SESSION['message']= "Error al facturar";
                       $_SESSION['color'] = "danger";
                    }
                }
            break;
        }
    }















}

?>