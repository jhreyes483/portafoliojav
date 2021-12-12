<?php
class clienteController extends Controller{
    //
    public function __construct(){
        parent::__construct(1);
        $this->db       = $this->loadModel('consultas.sql', 'sql');
        $this->_view->c = $this->db->verCategorias();
        $this->generaMenu();
        $this->_view->setCss(array( 'font-Montserrat' , 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
        //$this->_view->setJs(array('jquery-3.5.1.min','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery'));
    }
    //
    public function busqueda(){
        switch ($_POST['accion']) {    
            case 'unitaria':   
            $this->_view->datos = $this->db->buscarPorNombreProducto( $this->getTexto('producto'));
            $_SESSION['message'] = 'filtro por producto';
            $_SESSION['color']   = 'info';
            $this->_view->renderizar('catalogo');    
            break;
            case 'categoria':
               ///$this->getInt('cat'), 1,1);
            $this->_view->datos = $this->db->verPorCategoria($this->getInt('cat'));
            $this->_view->renderizar('catalogo');
            $_SESSION['message'] = 'filtro por categoria';
            $_SESSION['color']   = 'info';
            break;
        }
    }
    //
    public function index(){
        $this->_view->setCss([ 'fontawasome-ico', 'font-awesome' ]);
        $this->_view->setJs([ 'fontawasome-ico'  ]);
        $this->_view->renderizar('index');
    }
    //
    public function catalogo(){
        $this->_view->setCss([ 'fontawasome-ico', 'font-awesome' ]);
        $this->_view->setJs([ 'fontawasome-ico'  ]);
        if(isset($_GET['t'])) $this->_view->datos = $this->db->verProductos();
        if( !isset($_POST['accion']) ){
    
            $this->_view->datos = $this->db->verProductos();
           
            if( isset($_SESSION['usuario'])){
                $this->_view->renderizar('catalogo');
            }else{
                $this->_view->renderizar('catalogo', 1);
            }
        }else{
            $this->busqueda();
        }
    }
    //
    public function compras(){
        $this->_view->setCss([ 'fontawasome-ico', 'font-awesome' ]);
        $this->_view->setJs([ 'fontawasome-ico'  ]);
        $this->_view->renderizar('compras-online');
    }
    //
    public function detalle(){
        $this->_view->datos = $this->db->verProductosIdCarrito(openssl_decrypt($_POST['ID'], COD, KEY));
        $this->_view->renderizar('detalleProducto');
    }
}
?>
