<?php
namespace _model ;

class c_model{

public function m_consulta($tipo, $param = []){
 
   switch ($tipo) {

      case 0: // trae select de todo los usuarios
         $cond = implode(' ', $param);
         return 'SELECT  CONCAT(U.id_us,"|||",U.fk_doc), CONCAT (U.firt_name, " ", U.last_name , " " ,U.second_name)
         FROM users U 
         JOIN roles R ON R.id_ac_rol = U.fk_rol'.$cond;
         break;
      
      case 1: // consulta requerimientos
         $cond = implode( ' ', $param );
         return 'SELECT P.id_proyecto, P.status, P.fecha_crea, P.coste, P.descripcion, P.fecha_termina, 
         R.id_h, R.prioridad, R.criterio_aceptacion, R.obs, R.id_h, P.nom, R.status, R.fecha_crea, R.fecha_update
         FROM historias_requerimientos R
         JOIN proyectos P ON R.fk_proyecto = P.id_proyecto'
         .$cond;

      case 2: //  proyectos
         $cond = implode( ' ', $param );
         return 'SELECT * FROM proyectos'
         .$cond;

      case 3: // peso de un usuario
         'SELECT * FROM `measures`'.$param;
         break;

      case 4: // login de usario
         $cond= implode(' ', $param);
        return 'SELECT * FROM users
         '.$cond;

      case 5://consulta La solicitudes de consulta
         if(!isset($param)) $param=[];
         $cond = implode(' ',$param);
         return 'SELECT QU.fk_doc, QU.fk_us,
            Q.id, Q.date_request, Q.date_quote, Q.obs, Q.status,
            CONCAT(U.firt_name," ", U.second_name," ", U.last_name ), R.name_rol
               FROM quotes Q
               LEFT JOIN quote_users QU ON  QU.fk_quote = Q.id
               LEFT JOIN users U ON U.id_us = QU.fk_us
               LEFT JOIN roles R ON R.id_ac_rol = U.fk_rol  '.$cond; 

      case 6:
         $cond = implode( ' ', $param );
         return'SELECT DISTINCT QU.fk_doc, QU.fk_us,
         U.firt_name, U.second_name, U.last_name, R.name_rol, U.email, U.date_of_birth, U.password
            FROM quotes Q
            LEFT JOIN quote_users QU ON  QU.fk_quote = Q.id
            LEFT JOIN users U ON U.id_us = QU.fk_us
            LEFT JOIN roles R ON R.id_ac_rol = U.fk_rol '.$cond;
         break;

         case 7: // consulta de calendario
            $cond = implode(' ', $param );
            return 'SELECT * FROM reuniones '.$cond;
            break;
         case 8: // select de tipo
            return 'SELECT * FROM tipo_reunion';

         case 9:
            return 'SELECT * FROM equipos';

         case 10:
            return 'SELECT U.id_us, CONCAT(U.nom1," ",U.ape1," "," ( ", R.nom_rol , " )" )
             FROM users U
             JOIN roles R ON R.id_acro = U.fk_rol
             ';

         case 11: // trae todas las tareas de usuario
            $cond = implode(' ' , $param);
            return 
            'SELECT T.id_tarea, T.nom, T.descript,  
            U.id_us ,
            T.esfuerzo_estimado, T.tiempo_plan_h,
            P.nom,
            T.status, T.fecha_asig, T.fecha_update,
            T.user_update
            FROM tareas T
            LEFT JOIN users U  ON T.fk_us = U.id_us
            LEFT JOIN roles R  ON R.id_acro = U.fk_rol
            LEFT JOIN proyectos P ON P.id_proyecto = T.fk_proyecto
            '.$cond;
            

         case 12: // select de proyectos
            return
            'SELECT id_proyecto, nom 
            FROM proyectos';

         case 13:
            $cond = implode(' ' , $param); // tareas
            return'SELECT P.nom, T.nom, T.descript, T.status
            FROM tareas T
            LEFT JOIN users U  ON T.fk_us = U.id_us
            LEFT JOIN roles R  ON R.id_acro = U.fk_rol
            LEFT JOIN proyectos P ON P.id_proyecto = T.fk_proyecto
            '.$cond;
         
         case 14: // consulta log de avances
            $cond = implode(' ', $param );
            return 'SELECT A.fecha, A.tipo,
            T.nom, U.id_us, T.id_tarea, P.id_proyecto, P.nom
            FROM log_avances  A
            JOIN tareas T ON T.id_tarea = A.fk_tarea
            JOIN users U ON T.fk_us = U.id_us 
            JOIN proyectos P ON T.fk_proyecto = P.id_proyecto
            '.$cond;

         case 15:
            $cond = implode(' ', $param );
            return 'SELECT id_acro,  nom_rol 
            FROM roles
            '.$cond;


         

   


      
      default:
         false;
         break;
   }
}

public function m_update($param ){
// UPDATE quotes SET date_quote ='2021-03-18',  status ="A" ;
   return 'UPDATE '.$param[0].' SET '.$param[1];
}

public function m_delete($param){
   return 'DELETE  FROM '.$param[0].' WHERE '.$param[1].' = '.$param[2];
}

public function m_insert($param, $id_No_Default = null){
   if(isset($id_No_Default)){
      return 'INSERT INTO '.$param[0]. ' VALUES ("'.implode('","' ,$param[1]).'")';
   }else{
      return 'INSERT INTO '.$param[0]. ' VALUES ( DEFAULT, "'.implode('","' ,$param[1]).'")';
   }
   
}

public function m_ultimo_id($param){
   $obj = ($this->db->m_ejecuta('SELECT MAX('.$param[0].') from '.$param[1].''));
   $i = 0;
   while ($result = mysqli_fetch_row($obj)) {
      $data[0] = $result;
      $i++;
   }
   return $data[0][0];
}

}