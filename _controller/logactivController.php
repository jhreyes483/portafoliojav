<?php

namespace _controller;

require_once('../autoload.php');
use _model\c_SQL;
use _model\c_model;

class logactivController extends Controller
{
    private $db;
    public function __construct()
    {
        date_default_timezone_set("America/Bogota");
        $this->db      = new c_SQL();
        $this->model   = new c_model();
    }


    public function dataAvance()
    {
        $p[0] = 'WHERE P.status = "A"';
        if (isset($_POST['us']) && !empty($_POST['us'])) {
            $p[1] = ' AND U.id_us = ' . $this->getSql('us');
        }
        if (isset($_REQUEST['id_proyecto']) && !empty($_REQUEST['id_proyecto'])) {
            $p[2] = ' AND P.id_proyecto = ' . $this->getSql('id_proyecto');
        }
        if (isset($_POST['fIA'])  &&  !empty($_POST['fIA'])   && isset($_POST['fFA'])  && !empty($_POST['fFA'])) {
            $p[3] = ' AND A.fecha BETWEEN  "' . $this->getSql('fIA') . '" AND  "' . $this->getSql('fFA') . ' 23:59:59" ';
        }
        $sql = $this->model->m_consulta(14, $p);
        $r   = $this->db->m_trae_array($sql);
        if ($r->num_rows != 0) {
            foreach ($r->rows as $i => $d) {
                $this->user[]       = $d[3]; // cartura id
                $this->proyectos[]  = $d[6];
                $bloques[$d[4]][]   = [ $d[0], $d[1], $d[2], $d[3], 'db', 30 => 'p',  40 => $d[6], 41 => $d[5] ];
            }// captura ID
            $this->user       = array_unique($this->user);
            $this->proyectos  = array_unique($this->proyectos);
           // completa registros incompletos
            foreach ($bloques as $i => $d) {
                $totItems = count($d);
                $impar    = (($totItems % 2 == 1  && $totItems == 1 ) ? true : false); // capta registros incompletos
                if ($impar) {
                    $f = $this->capturaFin($d[0][3], $d[0][0]);
                  // Agrega registro den fin item
                    $bloques[$i][] = [ $f , 'T', $d[0][2], $d[0][3], '*Insertado*', 30 => $d[0][30] , 40 => $d[0][40], 41 => $d[0][41] ];
                }
            }
           // contruye array con fechas
            foreach ($bloques as $i => $d) {
                $ini      = $fin = null;
                $item     = $d[0][2];
               // user $d[0][3]
                if ($d[0][1] == 'I') {
                    $ini =  $d[0][0];
                }
                if ($d[1][1] == 'T') {
                    $fin =  $d[1][0];
                }
                if (isset($ini) && isset($fin)) {
                    $nuevoBloque[] = [ $ini, $fin,  $item,  $d[0][3], $i, 30 => $d[0][30], 40 => $d[0][40], 41 => $d[0][41] ];
                }
            }
        } else {
            $nuevoBloque = [];
        }
        return $this->operaTiempos($nuevoBloque);
    }


    public function operaTiempos(array $a)
    {
        $sql     =  $this->model->m_consulta(12); // select proyectos
        $proyec  =  $this->db->m_trae_array($sql, 2);
        $sql     =  $this->model->m_consulta(10); // select users
        $users   =  $this->db->m_trae_array($sql, 2);
        if (!empty($a)) {
        // resta tiempos
            foreach ($a as $i => $d) {
                  $r[] = $d;
                  $r[$i][21] = (strtotime($d[1]) - strtotime($d[0]) );  // diferencia en segundos
                  $r[$i][22] = $this->human_time($r[$i][21]);
            }
        //--------------------------------------------
        // agrupa
            foreach ($r as $d) {
                $g[$d[3]][$d[40]][$d[30]][] = $d; // agrupa por usuario y por tipo de actividad
            }
        // suma por tipo de actividad
            foreach ($g as $user => $d) {
                foreach ($d as $proyect => $p) {
                    foreach ($p as $grupo => $e) {
                        $total[$user][$proyect][$grupo] = ( $this->human_time(array_sum(array_column($e, 21)), 1, 1, 1) );
                    }
                }
            }
            $r =  [
            'total' => $total,
            'data' => $this->verificaResul($r),
            'tipo' => $this->objetos(2) ,
            'user' => $users,
            'userAc' => $this->user,
            'proyect' =>  $this->proyectos,
            'proyectDb' => $proyec
            ];
        } else {
            $r = [
            'data' => ['response_status' => 'error','response_msg' => 'No hay datos'],
            'tipo' => $this->objetos(2),
            'user' => $users,
            'userAc' => ($this->user ?? []),
            'proyect' =>  ($this->proyectos ?? [] ),
            'proyectDb' => $proyec
            ];
        }
        return $r;
    }


    public function capturaFin($id_us, $ini)
    {
        if (date('Y-m-d', strtotime($ini)) == date('Y-m-d')) {
            return date('Y-m-d H:i:s');
        } else {
           //return date('Y-m-d', strtotime($ini)).' 18:00:00';
            return $ini;
        }
    }


    public function human_time($input_seconds, $rs = 1, $normal = 0, $mostrarD = 0)
    {
 //$rs = muestra segundos // normal=1 deja h m s  como abreviaturas // mostrarD=1 muestra d�as
        $days        = floor($input_seconds / 86400);
        $remainder    = floor($input_seconds % 86400);
        $hours        = floor($remainder / 3600);
        $remainder    = floor($remainder % 3600);
        $minutes     = floor($remainder / 60);
        $seconds     = floor($remainder % 60);

        if ($mostrarD > 0) {
            $hours += $days * 24;
            $days  = '';
        } else {
            $days  = ($days > 0) ?          $days . ($normal == 0 ? ' d�as' : 'd') : '';
        }
        $hours    = ($hours > 0) ?             $hours . ($normal == 0 ? ' horas' : 'h') : '';
        $minutes  = ($minutes > 0) ?           $minutes . ($normal == 0 ? ' min' : 'm') : '';
        $seconds  = ($seconds > 0 && $rs == 1) ? $seconds . ($normal == 0 ? ' seg' : 's') : '';
        return "$days $hours $minutes $seconds";
    }
}
