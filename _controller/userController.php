<?php
namespace _controller;

require_once('../autoload.php');
use _model\c_SQL;
use _model\c_model;


class userController {

    private $db;
    public function __construct(){
       date_default_timezone_set("America/Bogota");
       $this->db      = new c_SQL;
       $this->model   = new c_model;
    }

public function getLogIp(){
    $limit   = $_GET['limit']??10;
    $p[0]    = 'WHERE longitud is not null';
    $p[1]    = 'order by ev.id desc'; 
    $p[2]    = 'limit '.$limit;

    $sql     =  $this->model->m_consulta(22,$p); // consulta proyectos
    $logs    =  $this->db->m_trae_array($sql,1)->rows;

    return ['logs'=> $logs];

}

}




?>