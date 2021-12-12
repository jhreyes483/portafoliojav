<?php

class indexController extends Controller{
   //
   public function __construct(){
      parent::__construct();
      $this->objM = $this->loadModel('userModel', 'userModel');
      $this->db = new c_MySQLi;
   }
   //
   public function index(){
      if (!session_status() == PHP_SESSION_ACTIVE) {
         @session_start();
         session_destroy();
      }


      $this->_view->setCss(['animate', 'bootstrap', 'bootstrap.min', 'style']);
      $this->_view->setJs(['bootstrap', 'bootstrap.min', 'jquery.min', 'main', 'parallax', 'wow']);
      $this->_view->renderizar('index');
   }

   public function formulario(){
      if (isset($_POST['a']) && !empty($_POST['a'])) {
         switch ($_POST['a']) {
            case 'solicitud':
               $dato[0] = 'quotes'; // tabla del inse
               $dato[1] = [ date('Y-m-d H:I') . '0:00', '0000-00-00 00:00:00', null, 'S']; // datos a inertar
              
               $sql  = $this->objM->m_insert($dato);
               $b    = $this->db->m_ejecuta($sql);
               if ($b) {
                  $dato[0] = 'id';
                  $dato[1] = 'quotes';
                  // una vez inserta valida el id a insertar 
                  $id_insert =  $this->objM->m_ultimo_id($dato);
                  unset($dato ,$sql);
               
                  // captura documento de usuario 
                  if( isset($_POST['id_us']) && $_POST['id_us'] != ''  ){

                     $dato[0] = ' WHERE id_us = ' . $this->getSql('id_us');
                     $dato[1] = ' LIMIT 1';
                     @@$sql = $this->objM->m_consulta(4, $dato);
                     $u = $this->db->m_ejecuta($sql);
                     $doc = $this->m_trae_array($u, 2);
   
                     $dato[0] = 'quote_users';
                     $dato[1] = [$doc[1], $this->getSql('id_us'), $id_insert];
                     $sql = $this->objM->m_insert($dato,1);
                     $insert =  $this->db->m_ejecuta($sql);
                  }else{
                     echo '<script>alert("Documento de usaurio requerido");</script>';
                  }
 
                  if ($insert) {
                     echo '<script>alert("Solicito cita con numero ' . $id_insert . '");</script>';
                  } else {
                     echo '<script>alert("No inserto cita");</script>';
                  }
               } else {
               }
               break;
            case 'registro':
               $dato[0] = ' WHERE id_us = ' . $this->getSql('id_us');
               $sql = $this->objM->m_consulta(4, $dato); // Consulta si el usuario existe
               $u = $this->db->m_trae_array($sql);
               if ($u->num_rows == 0) {
                  // inserta usuario
                  $p = [
                     $this->getSql('id_us'),
                     $this->getSql('fk_doc'),
                     $this->getSql('firt_name'),
                     $this->getSql('second_name'),
                     $this->getSql('last_name'),
                     $this->getSql('email'),
                     null,
                     null,
                     $this->getSql('date_of_birth'),
                     $this->getSql('gender'),
                     'C'
                  ];
                  $dato[0] = ' users ';
                  $dato[1] = $p;
                  $sql = $this->objM->m_insert($dato,1);
                  $b = $this->db->m_ejecuta($sql);
                  if ($b) {
                     echo '<script>alert("Se registro correctamente");</script>';
                  } else {
                     echo '<script>alert("error al registrar");</script>';
                  }
               } else {
                  $this->_view->user = $u->rows;
                  echo '<script>alert("usted ya exite  en el sistema")</script>';
                  // usuario ya existe extrae los tados los envia a la vista y vista los llena en el formulario
                  // alert usted ya exite  en el sistema 
               }
               break;
            default:
               # code...
               break;
         }
      }


      $sql = $this->objM->m_consulta(2, '');
      $this->_view->doc =  $this->db->m_trae_array($sql,2);
      $this->_view->setCss(array('font-Montserrat', 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
      //   $this->_view->setJs(array('jquery-1.9.0', 'bootstrap.min', 'popper.min', 'fontawasome-ico', 'cUsuariosJquery', 'tablesorter-master/jquery.tablesorter'));
      $this->_view->setJs(['cUsuariosJquery']);
      $this->_view->setCss(['style']);
      $this->_view->renderizar('formulario');
   }


   public function login(){
      if (isset($_POST) && !empty($_POST)) {
         $dato[0] = ' WHERE id_us ="' . $this->getSql('id_us').'"';
         $dato[1] = ' AND password = "' . $this->getSql('password') . '"';
         $sql =  $this->objM->m_consulta(4, $dato);
         unset($dato);
         $r = $this->db->m_trae_array($sql);
 
         if ($r->num_rows != 0) {
            if (!session_status() == PHP_SESSION_ACTIVE) {
               @session_start();
            }
            $r->row;
            $_SESSION['usuario'] = [];
            $_SESSION['usuario']['id_us']           = $r->row[0];
            $_SESSION['usuario']['fk_doc']          = $r->row[1];
            $_SESSION['usuario']['firt_name']       = $r->row[2];
            $_SESSION['usuario']['second_name']     = $r->row[3];
            $_SESSION['usuario']['last_name']       = $r->row[4];
            $_SESSION['usuario']['email']           = $r->row[5];
            $_SESSION['usuario']['img']             = $r->row[7];
            $_SESSION['usuario']['date_of_birth']   = $r->row[8];
            $_SESSION['usuario']['gender']          = $r->row[9];
            $_SESSION['usuario']['fk_rol']          = $r->row[10];
            $this->verificarAcceso();
         } else {
            //die('paila');
            echo '<script>alert("Credenciales incorrectas")</script>';
         }
         $_POST = null;
      }
      $this->_view->setCss(['login']);
      $this->_view->renderizar('login', 1);
   }


   public function cerrar(){
      session_destroy();
      $this->redireccionar('index');
   }
}
