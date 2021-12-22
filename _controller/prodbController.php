<?php
namespace _controller;

require_once('../autoload.php');
use _model\c_SQL;
use _model\c_model;

class prodbController extends Controller{ 
   private $db;
   public function __construct(){
      date_default_timezone_set("America/Bogota");
      $this->db      = new c_SQL;
      $this->model   = new c_model;
   }

   public function tipoReunion(){
      $sql  = $this->model->m_consulta(8); // Tipos de reunion
      return  $this->db->m_trae_array($sql)->rows;
   }


   public function tareas(){
      $sql     =  $this->model->m_consulta(11); // consulta tareas
      $tareas  =  $this->verificaResul(  $this->db->m_trae_array($sql)->rows );
      $status  =  $this->objetos(1); // status
      $sql     =  $this->model->m_consulta(10); // select user
      $user    =  $this->db->m_trae_array($sql,2);
      $sql     =  $this->model->m_consulta(12); // consulta proyectos
      $proyec  =  $this->db->m_trae_array($sql,2);
      return ['tareas'=>$tareas, 'status'=>$status, 'users'=>$user, 'proyect'=>$proyec];
   }



   public function m_insert(){
      @session_start();
     
      $p[0] =' tareas ';
      $p[1] = [
         $this->getSql('tarea'), 
         date('Y-m-d H:i:s'),
         $this->getSql('status'),
         $this->getSql('user_asg'),
         $this->getSql('descript'),
         $this->getSql('esPlanificado'),
         $this->getSql('esPoint'),
         $this->getSql('proyecto_asg'),
         date('Y-m-d H:i:s'),
         $_SESSION['usuario']['id'] 
      ];
      $sql = $this->model->m_insert($p);
      $b   = $this->db->m_ejecuta($sql);
      if($b){
         echo '<script>alert("Agrego tarea");</script>';
      }else{
         echo '<script>alert("Error al agregar tarea");</script>';
      }  


   }
   public function m_update(){
      // `id_tarea`, `nom`, `fecha_asig`, `status`, `fk_us`, `descript`, `tiempo_plan_h`, `esfuerzo_estimado`, `fk_proyecto`, `fecha_update`, `user_update`
      $p[0] = ' tareas ';
      $p[1] = 'nom = "'.$this->getSql('tarea').'", 
         status = "'.$this->getSql('status').'",
         fk_us = '.$this->getSql('user_asg').' ,
         descript = "'.$this->getSql('descript').'",
         tiempo_plan_h = '.$this->getSql('esPlanificado').', 
         esfuerzo_estimado = '.$this->getSql('esPoint').', 
         fk_proyecto = '.$this->getSql('proyecto_asg').',
         fecha_update = "'.date('Y-m-d H:i:s').'",
         user_update = '.$_SESSION['usuario']['id'].'
         WHERE id_tarea = '.$this->getSql('id_tarea');
      $sql = $this->model->m_update($p);
      $b   = $this->db->m_ejecuta($sql);
      if($b){
         $p[0] = ' log_avances ';
         $p[1] = [
            date('Y-m-d H:i:s'),
            $this->getSql('status'),
            $this->getSql('id_tarea')
         ];
         unset($b);
         $sql= $this->model->m_insert($p);
         $b1 = $this->db->m_ejecuta($sql);  
      }
      if($b1){
         echo '<script>alert("Actualizo registro");</script>';
      }else{
         echo '<script>alert("Error al actualizar registro");</script>';
      }         
   }
 

   public function peticion(){
      if( isset($_POST['a'] )){
         switch ($this->getSql('a')) {
            case 'insert':
               $this->m_insert();
               break;
           
            case 'update':
               $this->m_update();
               break;

            
            case 'ocultar':


               break;
            
            default:
               # code...
               break;
         }

      }else{

      }
      return $this->tareas();
   }

   public function peticionGrafico(){
      $sql     =  $this->model->m_consulta(12); // select proyectos
      $proyec  =  $this->db->m_trae_array($sql,2);
      $sql     =  $this->model->m_consulta(10); // select users
      $users   =  $this->db->m_trae_array($sql,2); 
      $p[0] = 'WHERE P.status = "A"';
      if( isset($_POST['us']) && !empty($_POST['us']) ){
         $p[1] = ' AND U.id_us = '.$this->getSql('us');
      }
      if( isset($_REQUEST['id_proyecto']) && !empty($_REQUEST['id_proyecto']) ){
         $p[2] = ' AND P.id_proyecto = '.$this->getSql('id_proyecto');
      }
      $sql     =   $this->model->m_consulta(13, $p); // consulta tareas
      $r       =   $this->db->m_trae_array($sql);
      if($r->num_rows != 0){
         foreach($r->rows as  $d)  $c1[$d[0]] = $c2[$d[0]] = $c3[$d[0]] = 0;
            foreach ($r->rows as $d) {
               $p1 = $p2 = $p3 = '';
               switch ($d[3]) {
                  case 'P':
                     $c1[$d[0]] ++;
                     $p1 = $d[1].'||'.$d[2];
                     $p2 = '';
                     $p3 = '';
                     break;
                  case 'I':
                     $c2[$d[0]] ++;
                     $p1 = '';
                     $p2 = $d[1].'||'.$d[2];
                     $p3 = '';
                     break;
                  case 'T':  // p -i-t
                     $c3[$d[0]] ++;
                     $p1 = '';
                     $p2 = '';
                     $p3 = $d[1].'||'.$d[2];
                     break;
               }
               $count[$d[0]] = [  1=> $c1[$d[0]],2=> $c2[$d[0]],3=> $c3[$d[0]] ]; 
            $a[$d[0]][] = [ $d[0], $p1, $p2,$p3 ];      
            }
        return  [ 't'=> $this->verificaResul($a)  , 'c'=>$count, 'u'=>$users, 'p'=>$proyec ];
      }
      else{
         return  [ 't'=> ['response_status'=>'error' , 'response_msg'=>'No hay datos'] , 'u'=>$users, 'p'=>$proyec ];
      }
   }





   

}


?>