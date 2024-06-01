<?php

// use Mpdf\Tag\Section;

class userController extends Controller
{
    private $db;
    private $param;
    //
    public function __construct()
    {
        $this->objM = $this->loadModel('userModel', 'userModel');
        $this->db = new c_MySQLi();
        parent::__construct();
        $this->_view->setCss(array( 'bootstrap.min', 'fontawesome-all'));
        //   $this->_view->setJs(array('jquery-1.9.0', 'bootstrap.min', 'popper.min', 'fontawasome-ico', 'cUsuariosJquery', 'tablesorter-master/jquery.tablesorter'))
        $this->param = $this->getParam();
        $this->statusCita = [
            'S' => 'Solicitud de asignacion',
            'A' => 'Cita asignada',
            'R' => 'Cita rechazada'
        ];
    }
    //
    public function index()
    {

        $sql = $this->objM->m_consulta(2);
        $r = $this->m_trae_array($sql, 2);
        $this->_view->setCss(['style']);
        $this->_view->renderizar('index');
    }
}
// class Conexion extends mysqli{
//
//
//     private $DB_HOST = 'localhost';
//     private $DB_USER = 'root';
//     private $DB_PASS = '';
//     private $DB_NAME = 'sicloud';
//
//     public function __construct(){
//         parent:: __construct($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
//
//         $this->set_charset('utf-8');
//         $this->connect_errno ? die('Error en la conexion'. mysqli_connect_errno()): $m = 'conectado ;D';
//
//
//     }
// }
//
