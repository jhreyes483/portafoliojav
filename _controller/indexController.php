<?php

namespace _controller;

require_once '../autoload.php';

use _model\c_SQL;
use _model\c_model;
use _controller\Controller;

class indexController extends Controller
{
    private $db;
    public function __construct()
    {
        date_default_timezone_set("America/Bogota");
        $this->db      = new c_SQL();
        $this->model   = new c_model();
    }

    public function createLogView()
    {
        return $this->createLog(1, $this->model, $this->db);
    }

    public function acces()
    {
        if (isset($_REQUEST) &&  !empty($_REQUEST)) {
            if (isset($_REQUEST['a'])) {
                switch ($_REQUEST['a']) {
                    case 'login':
                        break;
                    case 'requer':
                        return $this->requerimietos();
                    break;
                    case 'insertReq':
                        $this->m_createReq();
                        return $this->requerimietos();
                    break;
                    case 'updateReq';
                        $this->m_updateReq();
                    return $this->requerimietos();
                    break;


                    case 'createUser';
                          $this->m_createUser();
                    break;


                    default:
                        break;
                }
            }
        }
    }

   // Cons
    public function data()
    {
       //if( isset($_POST['id_proyecto'])){
       //   $dato[0] = ' WHERE = '.$this->getSql('id_proyecto');
       //}else{
       //   $dato =[];
       //}
       //$sql               = $this->model->m_consulta( 1 ,$dato );
       //$requerimientos    = $this->db->m_trae_array($sql)->rows;
       //unset($sql,$dato);
       // proyectos
        $sql               = $this->model->m_consulta(15);
        $rol               = $this->db->m_trae_array($sql, 2);

        $sql               = $this->model->m_consulta(2);
        $proyectos         = $this->db->m_trae_array($sql)->rows;
        $r = ['proyectos' => $proyectos, 'roles' => $rol];
        return $r;
    }

    public function login()
    {
        session_destroy();
        $dato[0] = ' WHERE correo = "' . $this->getSql('email') . '"';
        $dato[1] = ' AND password = "' . $this->getSql('password') . '"';
        $sql     = $this->model->m_consulta(4, $dato);
        $u       = $this->db->m_trae_array($sql);

        if ($u->num_rows == 1) {
            @session_start();
            $_SESSION['usuario']['id']        = $u->row[0];
            $_SESSION['usuario']['documento'] = $u->row[1];
            $_SESSION['usuario']['nombres']   = $u->row[2] . ' ' . $u->row[3];
            $_SESSION['usuario']['apellidos'] = $u->row[4] . ' ' . $u->row[5];
            $_SESSION['usuario']['correo']    = $u->row[11];
            $_SESSION['usuario']['rol']       = $u->row[14];
            //header('Location: ./home.php');
            echo BASE_URL;
            echo "<script>window.location.href='" .BASE_URL. './home.php'. "'</script>";
            Controller::ver('home');
            return $_SESSION['usuario'];
        } else {
            echo '<script>alert("error de credenciales");</script>';
        }
    }





   // Cons
    public function requerimietos()
    {
        $param[0] = ' WHERE R.fk_proyecto = ' . $_REQUEST['id_proyecto'];

        if (isset($_POST['search']) && !empty($_POST['search'])) {
            $param[1] = ' AND R.obs LIKE "%' . $this->getSql('search') . '%"';
        }
        if (isset($_POST['todos'])) {
            $param[1] = '';
        }
        if (isset($_POST['status']) && !empty($_POST['status'])) {
            $param[1] = ' AND R.status = "' . $this->getSql('status') . '"';
        }
        if (isset($_POST['fIA'])  && isset($_POST['fFA']) &&  !empty($_POST['fFA']) && !empty($_POST['fFA'])) {
            $param[2] = ' AND  R.fecha_update BETWEEN  "' . $this->getSql('fIA') . '" AND  "' . $this->getSql('fFA') . ' 23:59:59" ';
        }
        if (isset($_POST['fIC'])  && isset($_POST['fFC']) &&  !empty($_POST['fFC']) && !empty($_POST['fFC'])) {
            $param[3] = ' AND  R.fecha_crea BETWEEN  "' . $this->getSql('fIC') . '" AND  "' . $this->getSql('fFC') . ' 23:59:59" ';
        }

        $sql =  $this->model->m_consulta(1, $param);
        $req =  $this->db->m_trae_array($sql);

        if ($req->num_rows != 0) {
            $r['p']  = [$req->row[10],  $req->row[11], $req->row[4]];
            $r['r']  =  $req->rows;
        } else {
            $p[0]    = ' WHERE id_proyecto = ' . $_REQUEST['id_proyecto'];
            $sql     = $this->model->m_consulta(2, $p);
            $tmp     = $this->db->m_trae_array($sql)->row;
           // si no hay datos consulta y devuelve solo los datos del proyecto
            $r['p']  = [$tmp[0], $tmp[8], $tmp[4]];
        }
        return $r;
    }

   // SQL
    public function m_createReq()
    {
        date_default_timezone_set("America/Bogota");
       // inserta requerimiento
        $p[0] = 'historias_requerimientos';
        $p[1] = [
         $this->getSql('priori'),
         date('Y-m-d') . ' ' . date('H:i:s'),
         $this->getSql('criterio_acept'),
         $this->getSql('obs'),
         $this->getSql('id_proyecto'),
         $this->getSql('status'),
         date('Y-m-d') . ' ' . date('H:i:s')
        ];
        $sql = $this->model->m_insert($p);
        $b   = $this->db->m_ejecuta($sql);
        if ($b) {
            echo '<script>alert("Registro requerimiento");</script>';
        } else {
            echo '<script>alert("Error registrar requerimiento");</script>';
        }
    }

    public function getIp()
    {
        $ip = !isset($_REQUEST['ip']) ? $this->getPublicIp() : $_REQUEST['ip'];
        $location  = $this->getLocationUser($ip);
        Controller::ver($location);
    }



   // SQL
    public function m_createUser()
    {
        $rel = ['C' => 2, 'I' => 3]; // relacion de equipo con el rol
        $p[0] = 'users';
        $p[1] = [
         null,
         $this->getSql('nom1'),
         $this->getSql('nom2'),
         $this->getSql('ape1'),
         $this->getSql('ape2'),
         date('Y-m-d', strtotime($this->getSql('fecha_n'))),
         date('Y-m-d H:i:s'),
         $this->getSql('telefono'),
         $this->getSql('direccion'),
         null, // implementar metodo foto
         $this->getSql('correo'),
         $this->getSql('password'),
         'A',
         $this->getSql('rol'),
         $rel[$this->getSql('rol')],
        ];
        $sql =  $this->model->m_insert($p);
        $b =  $this->db->m_ejecuta($sql);
        if ($b) {
            echo '<script>alert("Se registro correctamente");</script>';
            header('Location: ./login.php');
        } else {
            echo '<script>alert("Error a registrar usuario");</script>';
        }
    }

   // SQL
    public function m_updateReq()
    {
        date_default_timezone_set("America/Bogota");
       // Actualiza requerimiento
       // UPDATE quotes SET date_quote ='2021-03-18',  status ="A" ;
        $p[0] = 'historias_requerimientos';
        $p[1] = ' prioridad = "' . $this->getSql('priori') .
         '", criterio_aceptacion = "' . $this->getSql('criterio_acept') .
         '", obs = "' . $this->getSql('obs') .
         '", status = "' . $this->getSql('status') .
         '", fecha_update = "' . (date('Y-m-d H:i:s')) . '"
            WHERE id_h = "' . $this->getSql('id_requ') . '"';
        $sql  = $this->model->m_update($p);
        $b    = $this->db->m_ejecuta($sql);
        if ($b) {
            echo '<script>alert("Actualizo el requerimientos");</script>';
        } else {
            echo '<script>alert("Error al actualizar el requerimientos");</script>';
        }
    }


    protected function getSql($clave)
    {
        if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
            $_POST[$clave] = strip_tags($_POST[$clave]);
            return trim($_POST[$clave]);
        }
    }


    public function verificarAcceso()
    {
        $_SESSION['message'] = "Bienvenido";
        $_SESSION['color']   = 'success';
        switch ($_SESSION['usuario']['rol']) {
            case 'SM':
                break;
            case 'PO':
                break;
            case 'TM':
                break;
            case 4:
               //$this->redireccionar('comercial');
                break;
            case 5:
               //   $this->redireccionar('proveedor');
                break;
            case 6:
               // $this->redireccionar('cliente');
        }
       // }else{
       // $this->redireccionar('error/cuenta');
       // }
    }
}
