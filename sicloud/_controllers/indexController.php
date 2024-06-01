<?php

class indexController extends Controller
{
// Guarda notificaicones en varible $this->_view->notificacion
   //

    public $session;
    public $objSession;
    public $db;
    public function __construct()
    {
        parent::__construct(1);
        $this->db            = $this->loadModel('consultas.sql', 'sql');
        $this->objSession    = new Session();

        $this->_view->setJs(['bootstrap.min', 'popper.min', 'cUsuariosJquery',  'login']);
    }

    public function terminos()
    {
        $this->_view->setCss(['jav','bootstrap.min', 'fontawesome-all.css']);
        $this->_view->setJs(['login']);
       //
         $this->_view->renderizar('terminos', 0, 0, 1); // 1 con js de ur - 2 sin js url
    }

   //
    public function index()
    {
        $this->_view->setJs(['icon-index']);
        $this->_view->setCss(['fuenteIndexMonstserrat', 'fuenteIndexDroid','fuenteIndexRobot']);
        if (isset($_SESSION['usuario'])) {
        }
        $this->_view->setCSS([ 'stylesindex','animate' ]);
        $this->_view->setJs(['scriptsindex']);
     //$r = $this->db->verAnuciosIndex( 1 );
      //$ico1 = ['fa-shopping-cart', 'fa-laptop', 'fa-lock'];

        $this->_view->datos1 = [
         ['1',
         'Herramientas Manuales',
         'Alicates Universales, Alicates de Corte, Alicates de Puntas, Atornilladores, Picotas Chuzos, Escaleras y Carretillas, Espitulas, Espítulas, Formones, Juegos de Llaves, Llaves Ajustables, Llaves Francesas, Llaves Punta Corona, Martillos, Mazos',
         'fa-shopping-cart'
         ],
         [
         '2',
         'Herramientas Electricas.',
         'Taladros sin cable, Taladros con cable, Sierras, Herramientas elétricas . Destornilladores eléctricos Martillos perforadores Amoladoras eléctrica, Lijadoras eléctricas, Sierras circulares Cepillos eléctricos, Fresadoras eléctricas, Pistolas para pintar.',
         'fa-laptop'
         ],
         [
         '3',
         'Materiales construccion.',
         'Productos manufacturados que son necesarios en las labores de construcción de edificaciones o en las obras de ingeniería civi',
         'fa-lock'
         ]
         ];
      //
        if (isset($_POST['accion'])) {
            switch ($_POST['accion']) {
                case 'createusuario':
                     $this->verficaParametros(['ID_us','nom1','nom2', 'ape1', 'ape2','fecha', 'pass', 'correo','FK_tipo_doc']);

                     $u = [
                     $this->getSql('ID_us'),  //0
                     $this->getSql('nom1'),   //1
                     $this->getSql('nom2'),   //2
                     $this->getSql('ape1'),   //3
                     $this->getSql('ape2'),   //4
                     $this->getSql('fecha'),  //5
                     $this->getSql('pass'),   //6
                     $_FILES['foto']['name'], //7
                     $this->getSql('correo'), //8
                     $this->getSql('FK_tipo_doc'), //9
                     $this->getSql('FK_rol'), //10
                     date('Y-m-d'),           //11
                     0,                       //12
                     $_FILES['foto']['tmp_name'],//13
                     $this->getSql('tel')     //14
                     ];
                     //  Controller::ver( $u,1);
                      // Insert usario
                      $bU = $this->db->InsertUsuario($u);
                     if ($bU) {
                   // Insert rol
                         $bR = $this->db->insertrRolUs($u);
                     } else {
                         die('error al insertar usuario');
                     }
                  //
                  //$destino = RUTAS_APP['ruta_img'].'us/'.$_FILES['foto']['name']; // verificar si copio
                     $destino = 'public/layout1/img/us/' . $_FILES['foto']['name']; // verificar si copio
                     copy($_FILES['foto']['tmp_name'], $destino);
                  // Copia foto
                     if ($bR) {
                         $bF = $this->db->inserTfotoUs($_FILES['foto']['name'], $this->getSql('ID_us')); // update foto de base datos
                     } else {
                         die('error al insertar rol de usuario');
                     }
                  //
                     if ($bF) {
                        // Inserta puntos
                         $aP = [
                           2, // Puntos
                           (date('Y-m-d')),
                           $this->getSql('ID_us'),
                           $this->getSql('FK_tipo_doc')
                            ];
                            $bP = $this->db->insertPuntos($aP);
                     } else {
                         die('error al insertar foto de usario');
                     }
                  //
                     if ($bP) {
                     // Inserta foto
                         $aT = [
                         $this->getSql('tel'),
                         $this->getSql('ID_us')
                         ];
                         $bT = $this->db->insertTelefonoUsuario($aT);
                     } else {
                         die('error al insertar puntos');
                     }
                  //
                     if ($bT) {
                     // Inserta notificiacion
                         $aN = [
                           0, // estado
                           $this->getSql('ID_us'), // descripcion
                           1, // llave foranea de usuario notificacion "al que llega notificacion"
                           1, // tipo de notificacion
                         ];
                         $bT = $this->db->notInsertUsuario($aN);
                     } else {
                         'error al insertar telefono de usario';
                     }
                  //
                     if ($bT) {
                         $response['message'] = 'Usuario agregado correctamente';
                         $_SESSION['color']    = "success";
                     } else {
                         $_SESSION['message']  = 'ocurrio un error, intenta nuevamente';
                         $_SESSION['color']    = "danger";
                     }
                     $this->redireccionar('index');
                    break;
                case 'mensajeUsuario':
                    $error = false;
             // añadi estas lineas
                    if (!isset($_POST['name']) || isset($_POST['name']) && $_POST['name'] == '') {
                            $error = true;
                            $this->_view->datos = ['color' => 'danger', 'response_msg' =>  'No envio mensaje, campo nombre es nesesario'];
                    }
                    if (!isset($_POST['email']) || isset($_POST['email']) && $_POST['email'] == '') {
                        $error = true;
                        $this->_view->datos = ['color' => 'danger', 'response_msg' =>  'No envio mensaje, campo correo es nesesario'];
                    }
                    if (!isset($_POST['phone']) || isset($_POST['phone']) && $_POST['phone'] == '') {
                            $error = true;
                            $this->_view->datos = ['color' => 'danger', 'response_msg' =>  'No envio mensaje,  campo telefono es nesesario'];
                    }
                    if (!isset($_POST['message']) || isset($_POST['message']) && $_POST['message'] == '') {
                         $error = true;
                         $this->_view->datos = ['color' => 'danger', 'response_msg' =>  'No envio mensaje,  campo telefono es nesesario'];
                    }

                    $aN = [
                    0, // estado
                    $this->getSql('name') . '@@@' . $this->getSql('email') . '@@@' . $this->getSql('phone') . '@@@' . $this->getSql('message') . '@@@' . date('Y-m-d') . '@@@' . date('h:i'),
                    4, // llave foranea de usuario notificacion "rol de usario al que llega"
                    12, // tipo de notificacion
                    ];
                    if ($error == false) {
                        $b = $this->db->notInsertUsuario($aN);
                        if ($b) {
                            $this->_view->datos = ['color' => 'success', 'response_msg' =>  'Su mensaje se envio con exito'];
                        } else {
                            $this->_view->datos = ['color' => 'danger', 'response_msg' => 'Error al emviar el mensaje' ];
                        }
                    }


                    break;
            }
        }
      //
        $this->_view->renderizar('index', 3, 0, 1); // 1 con js de ur - 2 sin js url
    }
   //
    public function entidad()
    {
        $this->_view->setCss([ 'fontawasome-ico', 'font-awesome','jav','bootstrap.min' ]);
        $this->_view->setJs([ 'fontawasome-ico'  ]);
        if (isset($_SESSION['usuario'])) {
            $this->_view->renderizar('entidad');
        } else {
            $this->_view->renderizar('entidad', 1);
        }
    }
   //
    public function inicieSesion()
    {
        $this->_view->setCss(['jav','bootstrap.min', 'fontawesome-all.css']);
        $this->_view->setJs(['login']);
        $this->_view->renderizar('inicieSesion', 1);
    }
   //
    public function datos()
    {
        $this->_view->setCss(['jav','bootstrap.min', 'fontawesome-all.css']);
        $this->_view->setJs(['login']);
        $this->_view->renderizar('datos', 1);
    }
   //
    public function mision()
    {
        $this->_view->setCss(['jav','bootstrap.min','fontawasome-ico' ]);

        if (isset($_SESSION['usuario'])) {
            $this->_view->setJs(['fontawasome-ico']);
            $this->_view->renderizar('mision');
        } else {
            $this->_view->setJs(['login','fontawasome-ico']);
            $this->_view->renderizar('mision', 1);
        }
    }
   //
    public function promocion()
    {
        $this->_view->setCss(['jav','bootstrap.min', 'fontawasome-ico']);
        $this->_view->setJs(['login','fontawasome-ico']);
        $this->_view->datos  =  $this->db->verPromociones();
        if (isset($_SESSION['usuario'])) {
            $this->_view->renderizar('promocion');
        } else {
            $this->_view->renderizar('promocion', 1);
        }
    }
   //
    public function login()
    {
        $this->_view->setCss(['jav','bootstrap.min']);
        $this->_view->setCss(['font-Montserrat', 'google', 'animate', 'fontawasome-icon','reset.min','login']);
        $this->_view->setJs(['registrar']);
        $this->_view->renderizar('login', 0);
    }
   //
    public function informes()
    {
        $this->_view->setCss(['jav','bootstrap.min', 'fontawasome-ico']);
        $this->_view->setCss(['font-Montserrat', 'google', 'animate']);
        $this->_view->setJs(['fontawasome-ico']);
        if (isset($_SESSION['usuario'])) {
            $this->_view->renderizar('contact');
        } else {
            $this->_view->renderizar('contact', 1);
        }
    }
   //
    public function logOut()
    {
        $this->_view->setCss(['jav','bootstrap.min', 'fontawesome-all.css']);
        $s = new Session();
        $s->destroy();
        $this->redireccionar('index');
    }
   //
    public function ingreso()
    {
            $this->_view->datos1 = [
         ['1',
         'Herramientas Manuales',
         'Alicates Universales, Alicates de Corte, Alicates de Puntas, Atornilladores, Picotas Chuzos, Escaleras y Carretillas, Espitulas, Espítulas, Formones, Juegos de Llaves, Llaves Ajustables, Llaves Francesas, Llaves Punta Corona, Martillos, Mazos',
         'fa-shopping-cart'
         ],
         [
         '2',
         'Herramientas Electricas.',
         'Taladros sin cable, Taladros con cable, Sierras, Herramientas elétricas . Destornilladores eléctricos Martillos perforadores Amoladoras eléctrica, Lijadoras eléctricas, Sierras circulares Cepillos eléctricos, Fresadoras eléctricas, Pistolas para pintar.',
         'fa-laptop'
         ],
         [
         '3',
         'Materiales construccion.',
         'Productos manufacturados que son necesarios en las labores de construcción de edificaciones o en las obras de ingeniería civi',
         'fa-lock'
         ]
            ];
            $b = $this->validaCredenciales();
            if (!$b) {
                   $this->_view->login = ['response_status' => 'error', 'response_msg' => 'Credenciales no validas'];
                   $this->_view->setCSS([ 'stylesindex','animate' ]);
                   $this->_view->setJs(['scriptsindex']);
                   $this->_view->renderizar('index', 3, 0, 1); // 1 con js de ur - 2 sin js url
            }
    }
   //
    public function registro()
    {
       //Controller::ver($_POST,1,1);
        $this->_view->setCss(['jav','bootstrap.min', 'fontawesome-all.css']);
        $this->_view->setJs(['jquery-1.9.0','login']);
        $d =  $this->db->verDocumeto();
        $r =  $this->db->verRol();
        $this->_view->datos = [ $d, $r ];
        $this->_view->renderizar('registro', 5);
    }
   //
    private function validaCredenciales()
    {
       //if(isset($_POST['empresa']) && isset($_POST['usuario']) && isset($_POST['clave'])){
         //extract($_POST);
         //$empresa   = filter_var($empresa, FILTER_SANITIZE_EMAIL);
         //Se codifican las credenciales para guardar en cookies
         //$empresaENC = base64_encode($empresa);
         //$userENC    = base64_encode($usuario);
         //if(!isset($_POST['desde'])){
            //if(isset($_POST['recEmp']) && $_POST['recEmp']=='1')    setcookie("C_RE", $empresaENC, strtotime('+7 days'), '/; samesite=strict');
            //else setcookie ("C_RE", "", time() - 3600); //borro
            //if(isset($_POST['recUser']) && $_POST['recUser']=='1') setcookie("C_RU", $userENC, strtotime('+7 days'), '/; samesite=strict');
            //else setcookie ("C_RU", "", time() - 3600); //borro
            //}
        if ($_POST['nDoc'] != '') {
            $USER = $this->db->loginUsuarioModel([
            $this->getSql('nDoc'),
            $this->getSql('pass'),
            $this->getSql('tDoc')
            ]);
            if (isset($USER) && ($USER)) {
                 $_SESSION['usuario']  =  $this->objSession->encriptaSesion($USER);
                 $this->session        =  $this->objSession->desencriptaSesion();
                 // GENERA VARIBLE DE SESSION CON EL CODIGO DEL MENU
                 $_SESSION['s_menu']    = $this->generaMenu();
                                    $this->verificarAcceso();
            } else {
                //$response['menssage']  = $_SESSION['message'] = 'Credenciales no validas';
                //$_SESSION['color']     = "danger";
                return false;
            }
        }
        $con  = $this->loadModel('consultas.sql', 'sql');
        $r = $con->verCategoria();
        $this->_view->categoria = ['response_status' => 'ok','response_msg' => $r];
         ///EMPRESA VALIDADA, PUEDE SEGUIR
         //Validacion de zona horaria
         /*
         if($r->row[4] != 'co'){
            $partes = explode('.', $_SERVER['HTTP_HOST']);
            if($r[4]!=$partes[0])
               return ['response_status'=>'error','response_msg'=>'El acceso de esta Empresa no puede ser por esta URL'];
         }
         */
         //OOOOJJJJOOOO registrar intentos de ingreso fallidos
    }
     // return $this->validaUser([$r->row[0], $usuario, $clave]);
}
