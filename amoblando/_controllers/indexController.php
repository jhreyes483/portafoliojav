<?php

class indexController extends Controller
{
// Guarda notificaicones en varible $this->_view->notificacion
   //
    public function __construct()
    {
        parent::__construct(1);
        $this->db            = $this->loadModel('consultas.sql', 'sql');
      //$this->objSession    = new Session();
     // $this->_view->setJs( ['bootstrap.min', 'popper.min', 'cUsuariosJquery',  'login'] );
    }
   //
    public function index()
    {
        if (isset($_POST['password'])) {
            $this->login();
        }
        $this->_view->setCss([ 'sign', 'styles' ]);
        $this->_view->setJs(['jquery.min','jquery.easing.min','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation','scripts']);
        $this->_view->renderizar('index', 1);
    }

    public function carrito()
    {
        $tmp                               = $this->db->verCreditos();
        foreach ($tmp as $c) {
            $this->_view->credits[$c[0]] = $c[3];
        }
        $tmp                               = $this->db->verPagos();
        foreach ($tmp as $c) {
            $this->_view->payment[$c[0]] = $c[1];
        }

        if (isset($_POST['accion'])) {
            switch ($_POST['accion']) {
                case 'eliminar':
                    $this->m_deleteProductoPreventa();
                    break;
                case 'facturarWeb':
                    $this->m_facturar($_SESSION['CARRITO'], 1);
                    $this->redireccionar('cliente/carrito');
                    break;
                case 'facturarInterno':
                    $this->m_facturar($_SESSION['venta'], 0);
                    break;
            }
        }
        $this->_view->setCss([ 'sign', 'styles','detcompra' ]);
        $this->_view->setJs(['jquery.min','jquery.easing.min','detcompra','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation']);
        $this->_view->renderizar('detCompra', 1);
    }

    public function login()
    {
        $USER =  $this->db->loginUsuarioModel([ $this->getSql('username')  , $this->getSql('password')]);
        if (isset($USER) && !empty($USER)) {
            ;
            $_SESSION['usuario']  =  $USER;
                                 $this->verificarAcceso();
        // $this->_view->renderizar('index');
        } else {
            echo'<script>alert("Contraseña incorrecta");</script>';
        }
    }
    public function registrar()
    {
        $tmp =  $this->db->verDocumeto();
        foreach ($tmp as $d) {
            $this->_view->doc[$d[0]] = $d[1];
        }
        $tmp = $this->db->verRol();
        foreach ($tmp as $d) {
            $this->_view->tem[$d[0]] = $d[1];
        }

        if (isset($_POST) && !empty($_POST)) {
            $this->verificaExisteUs();
        }
       //Controller::ver($this->_view->doc );
        $this->_view->setCss([ 'sign', 'styles' ]);
        $this->_view->setJs(['jquery.min','jquery.easing.min','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation','scripts']);
        $this->_view->renderizar('register', 1);
    }

    public function store()
    {
        $b = $this->db->store([
         $this->getSql('id_doc'),
         $this->getSql('name1'),
         $this->getSql('name2'),
         $this->getSql('last_name1'),
         $this->getSql('last_name2'),
         $this->getSql('email'),
         date('Y-m-d'),
         $this->getSql('gender'),
         $_FILES['img']['name'],
         $this->getSql('password'),
         $this->getSql('fk_rol'),
         $this->getSql('fk_doc_acron'),
         '0'
        ]);
         //Copia foto de producto
         $destino = 'public/layout1/img/user/' . $_FILES['img']['name']; // verificar si copio
         copy($_FILES['img']['tmp_name'], $destino);


        if ($b) {
            $_SESSION['message'] = 'registro de manera exitosa';
            $_SESSION['color'] = 'success';
        } else {
            $_SESSION['message'] = 'Error no regitro usuario';
            $_SESSION['color'] = 'danger';
        }
    }

    public function cerrar()
    {
        session_destroy();
        $this->redireccionar('index');
    }

    public function verificaExisteUs()
    {
        $r = $this->db->verificaExisteUs($this->getSql('id_doc'));
        if (isset($r)   && !empty($r)) {
            echo'<script>alert("Ya existe usario");</script>';
        } else {
            $this->store();
        }
    }

    public function catalogo()
    {
        if (isset($_REQUEST['c'])) {
            $subC = [ 6 => 1, 7 => 1, 8 => 1, 9 => 3, 10 => 2, 11 => 2, 12 => 2, 13 => 2];
            $r = $this->db->verProductsId($_REQUEST['c']);
            $c = $this->db->verCategoriasId($subC[$_REQUEST['c']]);
            foreach ($c as $d) {
                $this->_view->categorias[$d[0]] = $d[1];
            }
            $_SESSION['message'] = 'FILTRO POR ' . ( $this->_view->categorias[$_GET['c']] )  ;
            $_SESSION['color'] = 'info';
        } else {
            $r = $this->db->verProducts();
        }

        if (isset($_POST) && !empty($_POST)) {
            if (isset($_REQUEST['accion'])) {
                switch ($_REQUEST['accion']) {
                    case 'articulo':
                        $r = $this->db->buscarPorNombreProducto($this->getSql('busqueda'));
                        break;
                    case 'anular':
                        $_SESSION['venta']   =  null;
                        $_SESSION['message'] = 'anulo factura';
                        $_SESSION['color']   = 'danger';
                        $this->redireccionar('index/catalogo');
                        break;
                    case 'agregar':
                        $this->m_addProductoPreventa();
                        break;
                }
            }
        }
        if (isset($r) && !empty($r)) {
            $this->_view->datos = ['response_status' => 'ok','response_msg' => $r];
        }

        $this->_view->setCss([ 'sign', 'styles', 'catalogo' ]);
        $this->_view->setJs(['jquery.min','jquery.easing.min','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation','scripts']);
        $this->_view->renderizar('catalogo', 1);
    }

    public function m_deleteProductoPreventa()
    {
        unset($_SESSION['venta'][$_REQUEST['id'] ]);
        $_SESSION['message'] = 'Elimino producto de Pre venta';
        $_SESSION['color'] = 'success';
        $this->redireccionar('index/carrito');
    }
   //
    public function m_addProductoPreventa()
    {
        // Agraga producto a factura
        if (! isset($_SESSION['venta'])) {
            $_SESSION['venta'] = [];
        }
        if (!in_array($this->getSql('ID_prod'), array_column($_SESSION['venta'], 0))) {
            $subTotal = ($this->getSql('cantidad')  *  $this->getSql('val_prod') );
            $_SESSION['venta'][] = [
              $this->getSql('ID_prod') ,
              $this->getSql('nom_prod') ,
              $this->getSql('stok_prod') ,
              $this->getSql('cantidad'),
              $this->getSql('val_prod'),
              $this->getSql('Cat'),
              $subTotal,
              $this->getSql('img')
            ];
            $_SESSION['message'] = 'Agrego producto';
            $_SESSION['color']   = 'success';
            $total =  array_sum(array_column($_SESSION['venta'], 6)) ;
          // $letras =  $this->o_numeroLetras->convertirEurosEnLetras($total );
           //
            if ($total > 0) {
                $this->_view->total = ['response_status' => 'ok' , 'response_msg' => [ $total, $letras ] ];
            } else {
                $this->_view->total = ['response_status' => 'error', 'response_msg' => 'No hay datos'];
            }
           //
            $this->redireccionar('index/catalogo');
        } else {
            $_SESSION['message'] = 'Error, Producto ya existe';
            $_SESSION['color']   = 'danger';
            $this->redireccionar('index/catalogo');
        }
    }
   //
   // Preventa web
    public function m_facturar($a, $tipo = 1)
    {
        switch ($tipo) {
        // Facturacion interna
            case 0:
                $total = array_sum(array_column($a, 6));
                $iva = ($total * 0.19);
                $fecha = date('Y-m-d');
                $aF = [ // favtura
                $total,
                $fecha,
                $iva,
                $this->getSql('fk_payment'),
                $this->getSql('fk_credits'),
                $_SESSION['usuario']['id_doc'],
                $_SESSION['usuario']['fk_doc_acron'],
                1
                ];
               //
                $id_factura = $this->db->facturar($aF);
               //
                foreach ($a as $i => $d) {
                    $aP = [
                     $d[6],
                     $d[3],
                     $id_factura,
                     $d[0],
                    ];
                    $this->db->updateCantidadProducto([($d[2] - $d[3] ) ,$aP[3]]);
                    // $ID = $this->session['usuario']['id_doc'];
                    $r =   $this->db->insertaProductosFactura($aP);
                    if ($r) {
                         $_SESSION['venta']  = null;
                         $_SESSION['message'] = "Facturo de manera exitosa, factura numero  $id_factura";
                         $_SESSION['color']  = "success";
                    } else {
                        $_SESSION['message'] = "Error al facturar";
                        $_SESSION['color']   = "danger";
                    }
                }
                $this->redireccionar('index/catalogo');
                break;
        }
    }
}
