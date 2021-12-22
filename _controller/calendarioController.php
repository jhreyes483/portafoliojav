<?php
namespace _controller;

require_once '../autoload.php';
use _controller\Controller;
use _model\c_SQL;
use _model\Model;

class calendarioController extends Controller{ 
   private $db;
   public function __construct(){
      date_default_timezone_set("America/Bogota");
      $this->db      = new c_SQL;
      $this->model   = new Model;
   }

   public function tipoReunion(){
      $sql  = $this->model->m_consulta(8); // Tipos de reunion
      return  $this->db->m_trae_array($sql)->rows;
   }


   public function eventos(){
      @session_start();
      $sql     = $this->model->m_consulta(8); // select tipo
      $tipo    = $this->db->m_trae_array($sql,2);
      $sql     = $this->model->m_consulta(10); // select users
      $users   = $this->db->m_trae_array($sql,2); 
      $sql     = $this->model->m_consulta(9); // select equipo
      $equipos = $this->db->m_trae_array($sql,2);
      $user    = ((isset($_POST['busqUserCal']))? $this->getSql('busqUserCal') : $_SESSION['usuario']['id']  );
      $p[0]    = ' WHERE fk_us = '.$user;
      $sql     =  $this->model->m_consulta(7, $p);  // consulta eventos
      $e       =  $this->db->m_trae_array($sql)->rows;
      return ['eventos'=> $e , 'tipo' => $tipo , 'equipos' => $equipos, 'users'=>$users ];
   }


   public function m_insert(){
      if(!isset($_POST['equipo'])  || $_POST['equipo'] == '')       $this->error  ='No selecciono equipo';
      if(!isset($_POST['tipo'])    || $_POST['tipo']   == '')       $this->error  ='No selecciono tipo de reunion';
      if(!isset($_POST['txtFecha'])|| $_POST['txtFecha'] == '')     $this->error  ='No selecciono fecha';
      if(!isset($_POST['txtHora'])|| $_POST['txtHora'] == '')       $this->error  ='No digito hora';
      if(!isset($_POST['txtTitulo'])|| $_POST['txtTitulo'] == '')   $this->error  ='No digito titulo';
      @session_start();
      $p[0] =' reuniones ';
      $p[1] = [
         $this->getSql('txtTitulo'), 
         $this->getSql('txtDescipcion'),
         $this->getSql('color'),  
         '#FFFFFF',
         date('Y-m-d H:i:s'),
         $this->getSql('txtFecha').' '.$this->getSql('txtHora'),  
         'P',
         $this->getSql('equipo'),  
         $this->getSql('tipo'),
         (($this->getSql('user'))??$_SESSION['usuario']['id'] ),
      ];
      if(!isset($this->error)){
         $sql = $this->model->m_insert($p);
         $b   = $this->db->m_ejecuta($sql); 
         if($b){
            echo '<script>alert("Agendo correctamente");</script>';
         }else{
            echo '<script>alert("Error al agendar");</script>';
         }
      }else{
         echo '<script>alert("'.$this->error.'");</script>';
      }
     


   }

   public function accesEventos(){
      if( isset($_POST['a'] )){
         switch ($this->getSql('a')) {
            case 'insert':
               $this->m_insert();
               return $this->eventos();


               break;
            
            default:
               # code...
               break;
         }

      }else{

      }
      return $this->eventos();
   }





   

}


?>