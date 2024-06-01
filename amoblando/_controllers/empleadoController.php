<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

class empleadoController extends Controller
{
   // Guarda notificaicones en varible $this->_view->notificacion
      //
    public function __construct()
    {
        parent::__construct(1);
        $this->db            = $this->loadModel('consultas.sql', 'sql');
    }
      //
    public function index()
    {
        $this->_view->setCss([ 'sign', 'styles' ]);
        $this->_view->setJs(['jquery.min','jquery.easing.min','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation','scripts']);
        $this->_view->renderizar('index', 1);
    }

    public function createp()
    {
       //Controller::ver($_POST,0,1);
        if (isset($_POST) && !empty($_POST)) {
            $this->store();
        }
          $r = $this->db->verCategoria();
        foreach ($r as $d) {
            $this->_view->categorias[$d[0]] = $d[1];
        }
          $this->_view->est_com = $this->est_com ;
        $this->_view->est_sis = $this->est_sis;
          $this->_view->setCss([ 'sign', 'styles' ]);
        $this->_view->setJs(['jquery.min','jquery.easing.min','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation','scripts']);
        $this->_view->renderizar('createProduct', 1);
    }

    public function inffactura()
    {

        $this->_view->setCss([ 'sign', 'styles' ]);
        $this->_view->setJs(['jquery.min','jquery.easing.min','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation','scripts','ventana']);
        $this->_view->estado = $this->status_invoices;
        if (isset($_POST)) {
            $v = new c_numerosLetras();
            $r = $this->db->verVentasFechaEstado([ $this->getSql('f1'), $this->getSql('f2')  ], $this->getSql('estatus'));
            $t   =  (array_sum(array_column($r, 3)));
            $letra = ($v->convertirEurosEnLetras($t));
            $this->_view->total = [ 'letras' => $letra ,'numeros' => $t ];
            $this->verificaResul($r);
        }
          $this->_view->renderizar('infVentas', 1);
    }

    public function solicitud()
    {
        $this->_view->setCss([ 'sign', 'styles' ]);
        $this->_view->setJs(['jquery.min','jquery.easing.min','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation','scripts','ventana']);
        $this->_view->estado = $this->status_invoices;
        if (isset($_POST)) {
            switch ($this->getSql('accion')) {
                case 'rech':
                    if (isset($_POST['anular']) && !empty($_POST['anular'])) {
                        $b = $this->db->anulaFactura($this->getSql('anular'), 3);
                        if ($b) {
                            if ($b) {
                                $_SESSION['message'] = 'Rechazo la solicitud de la factura de manera exitosa';
                                $_SESSION['color']   = 'info';
                            } else {
                                $_SESSION['message'] = 'Error no anulo factura';
                                $_SESSION['color']   = 'danger';
                            }
                        }
                    }

                    break;
                case 'apro':
                    if (isset($_POST['anular']) && !empty($_POST['anular'])) {
                        $b = $this->db->anulaFactura($this->getSql('anular'), 4);
                        if ($b) {
                            $p = $this->db->verProductosFacturaId($_POST['anular'], $this->getSql('respuesta'));
                            foreach ($p as $d) {
                                $b2 =  $this->db->updateCantidadProducto([ ($d[5] - $d[0]), $d[4]  ]);
                                if ($b2) {
                                            $b3 = $this->db->updateObsFactura([$_POST['obs'], $_POST['anular']]);
                                }
                                if ($b3) {
                                    $_SESSION['message'] = 'Anulo factura correctamente';
                                    $_SESSION['color'] = 'danger';
                                } else {
                                    $_SESSION['message'] = 'Error no anulo factura';
                                    $_SESSION['color'] = 'danger';
                                }
                            }
                        }
                    }

                    break;
            }





            $v = new c_numerosLetras();
            $r = $this->db->verVentasFechaEstado([ $this->getSql('f1'), $this->getSql('f2')  ], $this->getSql('estatus'));
            $t   =  (array_sum(array_column($r, 3)));
            $letra = ($v->convertirEurosEnLetras($t));
            $this->_view->total = [ 'letras' => $letra ,'numeros' => $t ];
            $this->verificaResul($r);
        }
          $this->_view->renderizar('solicitud', 1);
    }

    public function unifactura()
    {

        $r  = $this->db->verFacturaId($_GET['f']);
        $p  = $this->db->verProductosFacturaId($_GET['f']);
        if (($r) != 0) {
            $this->_view->datos = ['response_status' => 'ok' ,'response_msg' => ['thead' => $r[0],'productos' => $p] ];
        } else {
            $this->_view->datos = ['response_status' => 'error','response_msg' => 'no Hay datos'];
        }
          $this->_view->setCss([ 'sign', 'styles','factura' ]);
        $this->_view->setJs(['jquery.min','jquery.easing.min','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation','scripts','ventana']);
        $this->_view->renderizar('unifactura');
    }

    public function cerrar()
    {
        $this->cerrar();
    }

    public function stok()
    {
        $r = $this->db->verProducts();
        $this->verificaResul($r);
        $this->_view->setCss(['bootstrap.min']);
//  $this->_view->setCss(['sign', 'styles','main', 'datatables/datatables.min','datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min', 'fontawesome-all']);
        $this->_view->setJs(['jquery.min','jquery.easing.min','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation','scripts']);
        $this->_view->setJs([ 'datatables/datatables.min','datatables/JSZip-2.5.0/jszip.min','datatables/pdfmake-0.1.36/pdfmake.min','datatables/pdfmake-0.1.36/vfs_fonts','datatables/Buttons-1.5.6/js/buttons.html5.min','mainDatable']);
        $this->_view->renderizar('controlproductos', 1);
    }

    public function delete()
    {
        if (isset($_POST) && !empty($_POST)) {
            $this->destroy();
        }
          $this->_view->estado = $this->est_sis;
        $this->_view->gender = $this->genero;
        $r = $this->db->verUsuarios();
        $this->verificaResul($r);
        $this->_view->setCss(['sign', 'styles','main', 'datatables/datatables.min','datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min', 'fontawesome-all']);
        $this->_view->setJs(['jquery.min','jquery.easing.min','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation','scripts']);
        $this->_view->setJs([  'datatables/datatables.min','datatables/JSZip-2.5.0/jszip.min','datatables/pdfmake-0.1.36/pdfmake.min','datatables/pdfmake-0.1.36/vfs_fonts','datatables/Buttons-1.5.6/js/buttons.html5.min','mainDatable']);
        $this->_view->renderizar('user', 1);
    }

    public function store()
    {
        $this->db->insertarProducto([
        $this->getSql('name_prod'), //0
        $this->getSql('prices'), // 1
        $this->getSql('stok'), //2
        $this->getSql('est_com'), // ddd
        $this->getSql('est_sis'),
        $this->getSql('descript'),
        date('Y-m-d'),
        $this->getSql('fk_cate'),
        $_FILES['img']['name']
          ]);
//Copia foto de producto
        $destino = 'public/layout1/img/prod/' . $_FILES['img']['name'];
// verificar si copio
        copy($_FILES['img']['tmp_name'], $destino);
    }

    public function destroy()
    {
        $b =  $this->db->deleteUser($this->getSql('id'));
        if ($b) {
            $_SESSION['mesagge'] = 'Elimino cuenta de cliente';
            $_SESSION['color'] = 'danger';
        }
    }
}
