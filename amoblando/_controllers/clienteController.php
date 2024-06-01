<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

class clienteController extends Controller
{
      //
    public function __construct()
    {
        parent::__construct(1);
        $this->db            = $this->loadModel('consultas.sql', 'sql');
        if ($_SESSION['usuario']['permits'] != 'AF345F') {
            echo '<script>alert("No tiene permiso para ingresar a este modulo");</script>';
            $this->redireccionar('index');
        }
    }
      //
    public function index()
    {
        $this->_view->setCss([ 'sign', 'styles' ]);
        $this->_view->setJs(['jquery.min','jquery.easing.min','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation','scripts']);
        $this->_view->renderizar('index', 1);
    }

    public function infcompras()
    {
        $this->_view->setCss([ 'sign', 'styles' ]);
        $this->_view->setJs(['jquery.min','jquery.easing.min','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation','scripts','ventana']);
        $this->_view->estado = $this->status_invoices;
        if (isset($_POST)) {
            $v = new c_numerosLetras();
            $r = $this->db->verVentasFechaEstadoClietne([ $this->getSql('f1'), $this->getSql('f2')  ], $this->getSql('estatus'), $_SESSION['usuario']['id_doc']);
            $t   =  (array_sum(array_column($r, 3)));
            $letra = ($v->convertirEurosEnLetras($t));
            $this->_view->total = [ 'letras' => $letra ,'numeros' => $t ];
            $this->verificaResul($r);
        }
          $this->_view->renderizar('infCompras', 1);
    }

    public function perfil()
    {
        if (isset($_POST) && !empty($_POST)) {
            $this->db->insertUpdateUsuarioCliente([
            $_SESSION['usuario']['id_doc'],
            $this->getSql('name1'),
            $this->getSql('name2'),
            $this->getSql('last_name1'),
            $this->getSql('last_name2'),
            $_SESSION['usuario']['estatus'],
            $this->getSql('email'),
            $_SESSION['usuario']['create_date'],
            $this->getSql('gender'),
            ($_FILES['img']['name'] ?? $_SESSION['usuario']['img']),
            $this->getSql('password'),
            $this->getSql('fk_rol'),
            $this->getSql('fk_doc_acron')
            ]);
            $destino = 'public/layout1/img/user/' . $_FILES['img']['name'];
 // verificar si copio
             copy($_FILES['img']['tmp_name'], $destino);
        }

          $tmp =  $this->db->verDocumeto();
        foreach ($tmp as $d) {
            $this->_view->doc[$d[0]] = $d[1];
        }
          $tmp = $this->db->verRol();
        foreach ($tmp as $d) {
            $this->_view->tem[$d[0]] = $d[1];
        }
          $r = $this->db->verUsuarioId($_SESSION['usuario']['id_doc']);
        $this->_view->datos = $r[0];
        $this->_view->setCss([ 'sign', 'styles' ]);
        $this->_view->setJs(['jquery.min','jquery.easing.min','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation','scripts','ventana','pass']);
        $this->_view->renderizar('perfil', 1);
    }

    public function reembolso()
    {
        $this->issetSession();
        $r =  $this->db->verFacturaIdF($_POST['id']);
        date_default_timezone_set('America/Bogota');
        $date = new DateTime(date("Y-m-d"));
        $date2 = new DateTime($r[0][0]);
        $diff = $date->diff($date2);
        if (intval($diff->days)  > 15) {
            $this->_view->anular = false;
            echo '<script>alert("El perido estableciodo para  solicitud de reemboso a caducado -15 dias-")</script>';
        } else {
        //  Controller::ver(  date("d-m-Y",$mod_date)   )))   );
                   $this->_view->anular = true;
            if (isset($_POST['anular']) && !empty($_POST['anular'])) {
                $b = $this->db->anulaFactura($_POST['anular'], 2);
                if ($b) {
                    $b1 = $this->db->updateObsFactura([$_POST['obs'], $_POST['anular']]);
                }
                if ($b1) {
                    $_SESSION['message'] = 'Su peticion de reembolos sera evaluada por por nuestro personal';
                    $_SESSION['color'] = 'success';
                } else {
                    $_SESSION['message'] = 'Error al solicitar';
                    $_SESSION['color'] = 'danger';
                }
            }
        }
          $r = $this->db->verProductosFacturaId($_POST['id']);
        foreach ($r as $d) {
            $this->_view->productos[$d[4]] = $d[2];
        }
        if (isset($_POST) && !empty($_POST)) {
            switch (isset($_POST['accion']) && $_POST['accion']) {
                case 'preAnular':
                    break;
            }
        }
          $r = $this->db->verProducts();
        $tmp =  $this->db->verDocumeto();
        foreach ($tmp as $d) {
            $this->_view->doc[$d[0]] = $d[1];
        }
          $tmp = $this->db->verRol();
        foreach ($tmp as $d) {
            $this->_view->tem[$d[0]] = $d[1];
        }
          $this->_view->setCss([ 'sign', 'styles','styleamoblado' ]);
        $this->_view->setJs(['jquery.min','jquery.easing.min','all','bootstrap.bundle.min','contact_me','jqBootstrapValidation','scripts','ventana','pass']);
        $this->_view->renderizar('reembolso');
    }
}
