<?php

// use Mpdf\Tag\Section;

class nutricionController extends Controller
{
    private $db;
    private $param;
   //
    public function __construct()
    {
        $this->objM = $this->loadModel('userModel', 'userModel');
        $this->db = new c_MySQLi();
        parent::__construct();
        $this->_view->setCss(['animate', 'bootstrap', 'bootstrap.min', 'style']);
        $this->_view->setJs(['bootstrap', 'bootstrap.min', 'jquery.min', 'main', 'parallax', 'wow']);
        $this->param = $this->getParam();
    }
   //
    public function index()
    {
        $this->_view->setCss(['style']);
        $this->_view->renderizar('index');
    }


    public function asignaPlan()
    {
       // peticion de update plan asignado
        if (isset($_POST['idUs'])  && isset($_POST['obs'])) {
            $id = explode('||', $_POST['idUs']);
           /*
          $sql = 'UPDATE plans P
          LEFT JOIN foods F ON P.id_plan = F.fk_plan
          LEFT JOIN ejes  E ON P.id_plan = E.fk_plan
          LEFT JOIN users U ON P.fk_us   = U.id_us
          SET F.obs = "500 dp"
          WHERE U.id_us = '.$id[0].'
          AND U.fk_doc  = '.$id[1];

           */
            $up[0] = $id[0];
            $up[1] = $id[1];
            $up[3] = $this->getSql('obs');

            $sql = $this->objM->m_update($up, 1);
            $b = $this->db->m_ejecuta($sql);
            if ($b) {
           ///     echo '<script>alert("Actualizo plan");</script>';
            } else {
            //   echo '<script>alert("Error al actualizar plan");</script>';
            }
        }
        $p[0] = '';
        if (isset($_POST['informe'])) {
            if (isset($_POST['id_us']) &&  !empty($_POST['id_us'])) {
                $p[0] = ' WHERE U.id_us = ' . $this->getSql('id_us');
            }
        }
        $sql  = $this->objM->m_consulta(8, $p);
        $r = $this->db->m_trae_array($sql)->rows;
        $this->verificaResul($r);
        $this->_view->renderizar('asignaPlan');
    }


    public function creaPlan()
    {

        if (isset($_POST['a']) && !empty($_POST['a'])) {
            switch ($_POST['a']) {
                case 'insertPlan':
                    $id_us = explode('|||', $_POST['user']);
                    $p[0] = 'plans';
                    $p[1] = [
                    $this->getSql('nombre_plan'),
                    date('Y-m-d H:i:s'),
                    $id_us[1],
                    $id_us[0]
                    ];
                    $sql = $this->objM->m_insert($p);
                    $b =  $this->db->m_ejecuta($sql);
                    if ($b) {
                        $param[0] = 'id_plan';
                        $param[1] = 'plans';
                        $idPlan = $this->objM->m_ultimo_id($param);
                    } else {
                            echo '<script>alert("Error al insertar plan");</script>';
                            unset($sql, $p, $b);
                    }

                    if ($_POST['tabla'] == 'F') {
                            // inserta en tabla comidas
                            $p[0] = 'foods';
                            $p[1] = [
                               $this->getSql('nombre'),
                               $this->getSql('porciones'),
                               $this->getSql('obs'),
                               $idPlan
                            ];
                            $sql = $this->objM->m_insert($p);
                            $b =  $this->db->m_ejecuta($sql);
                            if ($b) {
                                echo '<script>alert("Asigno plan");</script>';
                            } else {
                                echo '<script>alert("Error al asignar plan");</script>';
                            }
                            unset($sql, $p, $b);
                    } else {
                      // es ejercicios
                        $p[0] = 'ejes';
                        $p[1] = [
                         $this->getSql('obs'),
                         $this->getSql('porciones'),
                         $idPlan,
                         $this->getSql('nombre'),
                        ];
                        $sql = $this->objM->m_insert($p);
                        $b =  $this->db->m_ejecuta($sql);
                        if ($b) {
                            echo '<script>alert("Asigno plan");</script>';
                        } else {
                            echo '<script>alert("Error al asignar plan");</script>';
                        }
                        unset($sql, $p);
                    }
                    break;
            }
        }
        $p[0]             = ' WHERE U.fk_rol = "C"';
        $sql              = $this->objM->m_consulta(0, $p);
        $this->_view->clientes   = $this->db->m_trae_array($sql, 2);
        $this->_view->renderizar('creaPlan');
    }


    public function perfil()
    {
        if (isset($_POST) && !empty($_POST)) {
            $sql =  'UPDATE users SET firt_name ="' . $this->getSql('firt_name') . '", last_name ="' . $this->getSql('last_name') .
            '", email = "' . $this->getSql('email') . '", date_of_birth = "' . $this->getSql('rol') . '", password = "' . $this->getSql('password') . '"    WHERE id_us = ' . $_SESSION['usuario']['id_us'];
            $b = $this->db->m_ejecuta($sql);
            if ($b) {
                echo '<script>alert("Actualizo usuario");</script>';
            } else {
                echo '<script>alert("Error al actualizar");</script>';
            }
        }

        $dato[0] = ' WHERE U.id_us = ' . $_SESSION['usuario']['id_us'];
        $sql = $this->objM->m_consulta(6, $dato);
        $this->_view->user = $this->db->m_trae_array($sql)->row;
        $this->_view->renderizar('perfil');
    }


    public function paciente()
    {
        $relN = [ 0 => 23, 1 => 26, 2 => 13, 3 => 27, 4 => 28, 5 => 29, 6 => 11, 7 => 25, 8 => 31 ]; // Nomenclatura, peso
        $relM = [ 0 => 1, 1 => 3, 2 => 2, 3 => 2, 4 => 2, 5 => 2, 6 => 2,7 => 1, 8 => 1]; // tipo de medita "cm, a�os, kilo"
       //
        $dato[0] = ' WHERE id_us = ' . $this->getSql('id_us');
        $dato[1] = ' LIMIT 1';
        $sql = $this->objM->m_consulta(4, $dato);
        $doc =  $this->db->m_trae_array($sql)->row;
        if (isset($_POST['a'])) {
            foreach ($_POST['a'] as $i => $d) {
                $dato[0] = 'measures';
                $dato[1] = [date('Y-m-d'),'' . $d . '', $relM[$i], $relN[$i] , $this->getSql('id_us'),$doc[1] ];
                $sql =  $this->objM->m_insert($dato);
                $this->db->m_ejecuta($sql);
                unset($sql, $dato);
            }
        }
        $this->_view->renderizar('datosPaciente');
    }


    public function asignar()
    {
        if (isset($_POST['update'])) {
           // Asigna fecha hora y cambia de estado la cita
            if (isset($_POST['fecha_asig'])  && isset($_POST['status'])  && isset($_POST['id_cita'])) {
                if (!isset($_POST['obs'])) {
                    $sql =
                    'UPDATE quotes SET date_quote ="' . $this->getSql('fecha_asig') . '",  status ="' . $this->getSql('status') . '" WHERE id = ' . $this->getSql('id_cita');
                } else {
                    $sql =
                    'UPDATE quotes SET date_quote ="' . $this->getSql('fecha_asig') . '",  status ="' . $this->getSql('status') . '", obs="' . $_POST['obs'] . '"  WHERE id = ' . $this->getSql('id_cita');
                }
                $b = $this->db->m_ejecuta($sql);
            } else {
               // solo actualiza el estado
                if (isset($_POST['id_cita']) && isset($_POST['status'])) {
                    $sql =
                    'UPDATE quotes SET  status ="' . $this->getSql('status') . '" WHERE id = ' . $this->getSql('id_cita');
                } else {
                    echo '<script>alert("Error al asignar cita");</script>';
                }
            }
            $b = $this->db->m_ejecuta($sql);

            if ($b  && isset($_POST['doctor'])) {
               // Inserta el id del doctor a la cita
                $id_doctor = explode('|||', $this->getSql('doctor'));
                $dato[0]   = 'quote_users';
                $dato[1]   = [$id_doctor[1], $id_doctor[0], $this->getSql('id_cita')];
                $sql       = $this->objM->m_insert($dato, 1); // no default id autoincremntal
                $b         = $this->db->m_ejecuta($sql);
                unset($dato, $sql);
                if ($b) {
                    echo '<script>alert("Asigno cita");</script>';
                } else {
                    echo '<script>alert("Error al asignar cita");</script>';
                }
            } else {
                echo '<script>alert("Error al asignar hora de la cita");</script>';
            }
        }
        if (isset($_POST['rol'])) {
            $dato[0] = ' WHERE Q.status = "' . $this->getSql('rol') . '"';
        }
        if (isset($_POST['informe'])) {
            $dato[0] = ' WHERE U.id_us = ' . $this->getSql('id_us');
        }


        $dato[1] = ' ORDER BY id ';
       // Trae las citas de los usuarios
        $sql = $this->objM->m_consulta(5, $dato);
        $r   = $this->db->m_trae_array($sql)->rows;
        $r   = $this->verificaResul($r);
        unset($dato, $sql);
        $this->_view->status =  $this->statusCita;

       // Select de usuario
        $dato[0] = ' WHERE R.id_ac_rol = "D"';
        $sql = $this->objM->m_consulta(0, $dato);
        $this->_view->doctor   = $this->db->m_trae_array($sql, 2);
        $this->_view->renderizar('asignarCita');
        unset($sql, $dato);
    }


    public function reportes()
    {
        $this->_view->setCss(['datatables/datatables.min','datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min']);
        $this->_view->setJs([  'jquery/jquery-3.3.1.min','loaderChart','popper/popper.min','bootstrap.min','datatables/datatables.min','datatables/Buttons-1.5.6/js/dataTables.buttons.min','datatables/JSZip-2.5.0/jszip.min','datatables/pdfmake-0.1.36/pdfmake.min','datatables/pdfmake-0.1.36/vfs_fonts','datatables/Buttons-1.5.6/js/buttons.html5.min','mainDatable', 'all']);
        $dato[0] = ' ORDER BY date_create';
        $sql =  $this->objM->m_consulta(1, $dato);
        $r   = $this->db->m_trae_array($sql)->rows;
        $this->verificaResul($r);
        $this->_view->renderizar('reportes');
        unset($sql, $dato);
    }


    public function informe()
    {
        $dato[0] = ' WHERE U.id_us = ' . $_POST['id_us'];
        $dato[1] = ' AND MT.id_m = 23';
        $dato[2] = ' ORDER BY date_create';
        $sql =  $this->objM->m_consulta(1, $dato);
        $r   = $this->db->m_trae_array($sql)->rows;
        unset($sql, $dato);
        $meses = [
         1 => 'Enero',
         2 => 'Febrero',
         3 => 'Marzo',
         4 => 'Abril',
         5 => 'Mayo',
         6 => 'Junio',
         7 => 'Julio',
         8 => 'Agosto',
         9 => 'Septiembre',
         10 => 'Octubre',
         11 => 'Noviembre',
         12 => 'Diciembre'
        ];

        foreach ($r as $k => $v) {
            $mes =  date('m', strtotime($v[5]));
            $ar[$meses[abs($mes)]][] = $v;
        }

        if (isset($ar) && count($ar) > 0) {
            foreach ($ar as $grupo => $d) {
                foreach ($d as $reg => $v) {
                    $t[$grupo] = (array_sum(array_column($d, 6)) / count($d));
                }
                $this->_view->peso = $t;
            }
        }

        $this->_view->renderizar('informe');
    }
}

//
