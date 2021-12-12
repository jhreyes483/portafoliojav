<?php
class c_notificacion extends Controller {

   public function __construct(){
      if(isset($_GET['mensaje'])) $this->m_nuevoMensaje();
   }


   public function index()
   {

   }

   public function notificacionPorRolLogin(){

      }
            



// NOTIFICACIONES
//-----------------------------------------------------------------------------

   public function verNotificaciones(){
         if(isset($_SESSION['usuario'])){
         $db      = $this->loadModel('consultas.sql', 'sql');  // Carga modelo
         $id_rol  = openssl_decrypt( $_SESSION['usuario']['ID_rol_n'], COD, KEY);
         return     $this->notificacion  = $db->verNotificaciones($id_rol); 
      }
   }

   public function countNotificcacion(){
      return count($this->notificacion);
   }
//--------------------------------------------------------------------------------
// MENSAJES

   public function m_nuevoMensaje(){
      $db      = $this->loadModel('consultas.sql', 'sql');  // Carga modelo
      $estado = 0;
      $FK_rol = 1;
      $FK_ms =  1;
      $descrip = $_GET['mensaje'];
      $a = [ $estado, $descrip, $FK_rol , $FK_ms ];
      $db->insertMensaje($a);
      echo '<meta http-equiv="REFRESH" content="0;url='.APP_LIBS.'notificacion.php">';
   }


   public function m_verMensajes(){
      $db  = $this->loadModel('consultas.sql', 'sql');  // Carga modelo
      return $db->verMensaje1();
   }






//-------------------------------------------------------------------------------








 }

?>