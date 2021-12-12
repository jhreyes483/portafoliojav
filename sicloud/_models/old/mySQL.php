<?php
include_once 'class.conexion.php';
include_once '../controlador/controladorsession.php';

class SQL extends Conexion{
   public $db;
   public function __construct() {
      $this->db = Conexion::conexionPDO();
   } 
   static function ningunDato(){
      return new self ();
   }
   
   //==================================================

   public function verPuntosYusuario($id){
      $sql = " SELECT U.ID_us  , U.nom1 , U.nom2 , U.ape1 , 
      U.ape2 , U.fecha , U.pass , U.foto , U.correo , 
      U.FK_tipo_doc , 
      RU.estado , 
      R.ID_rol_n , R.nom_rol , 
      P.puntos
         FROM tipo_doc TD 
         JOIN usuario U ON TD.ID_acronimo = U.FK_tipo_doc 
         JOIN rol_usuario RU ON U.ID_us = RU.FK_us 
         JOIN rol R ON FK_rol = R.ID_rol_n 
         JOIN puntos P ON U.ID_us = P.FK_us
         WHERE U.ID_us = :id"; 
      $c = $this->db->prepare($sql);
      $c->bindValue(':id', $id);
      $c->execute();
      $r = $c->fetch(PDO::FETCH_ASSOC);
      return $r;
   }



   public function consultaRangoInforme(){
      $sql ='SELECT cantidad, sum(f.total) as total, day(f.fecha) as dia
      from det_factura detf
      join factura f on f.ID_factura = detf.FK_det_factura
      group by dia'; 
      $c = $this->db->prepare($sql);
    //  $c->bindValue(':id', $id);
      $c->execute();
      $c->execute();
      $result = $c->fetchAll();
      return $result;  
   }
   // METODO INSERT USUARIO PDO MVC ---------------------------------------------------------------------
   public function InsertUsuario($a){ 
      $sql = "INSERT INTO usuario (ID_us, nom1, nom2, ape1, ape2, fecha, pass, foto, correo, FK_tipo_doc)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $insertar = $this->db->prepare($sql);
      foreach( $a as $i => $d   ){
      $pass_cifrado = password_hash($d[6], PASSWORD_DEFAULT);
      $insertar->bindValue(1, $d[0] );
      $insertar->bindValue(2, $d[1] );
      $insertar->bindValue(3, $d[2] );
      $insertar->bindValue(4, $d[3] );
      $insertar->bindValue(5, $d[4] );
      $insertar->bindValue(6, $d[5] );
      $insertar->bindValue(7, $pass_cifrado );
      $insertar->bindValue(8, $d[7] );
      $insertar->bindValue(9, $d[8] );
      $insertar->bindValue(10, $d[9] );
      }
     // echo $pass_cifrado; die();
      $bool =    $insertar->execute();
      if($bool){
         return true;
      }else{
         return $a;
      }
   }
   //-------------------------------------------------------------------------------------------------------
   //METODO SELECT USUARIO PDO MVC----------------(FALTA METODO API)-------------------------------------
   public function readUsuarioModel(){
      $sql = 'SELECT * FROM usuario';
      $consulta = $this->db->prepare($sql);
      $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;  
   }

     // Incio de select usuario
   public function selectUsuarios($id){
      $sql = "SELECT U.FK_tipo_doc, U.ID_us, 
      U.nom1, U.nom2, U.ape1, 
      U.ape2,  U.pass, U.foto, 
      U.correo,  U.fecha, 
      R.nom_rol, R_U.estado, R.ID_rol_n,
      T.tel, D.dir
      FROM usuario U 
      left JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
      left JOIN rol  R ON R_U.FK_rol = R.ID_rol_n 
      left JOIN telefono T ON U.ID_us = T.CF_us
      left JOIN direccion D ON D.CF_us = U.ID_us
      WHERE ID_us = :id
      LIMIT 1
      ";
      $c = $this->db->prepare($sql);
      $c->bindValue(":id", $id, PDO::PARAM_STR);
      $c->execute();
      $r = $c->fetchAll();
      return $r;
   } // Fin de select usuario
   //-------------------------------------------------------------------------------------------------------
   //METODO LOGIN USUARIO PDO MVC--------------------------------------------------------------------------
  
  /*
   public function loginUsuarioModel($datosModel){
   $sql ="SELECT U.* , TD.ID_acronimo , 
   RU.estado , 
   R.ID_rol_n , R.nom_rol 
   FROM tipo_doc TD 
   JOIN usuario U ON TD.ID_acronimo = U.FK_tipo_doc 
   JOIN rol_usuario RU ON U.ID_us = RU.FK_us 
   JOIN rol R ON FK_rol = R.ID_rol_n  
   WHERE U.ID_us       =  :ID_us  
   AND U.pass          = :pass
   AND TD.ID_acronimo  = :ID_acronimo";
   //AND identificacion = :identificacion";
   $consulta = $this->db->prepare($sql);
   foreach($datosModel as $i =>  $d ){
     // $pass_cifrado = password_hash($d[1], PASSWORD_DEFAULT);
       ;
      $consulta->bindValue( ':ID_us',       $d[0] , PDO::PARAM_STR );
      $consulta->bindValue( ':pass',        $d[1] , PDO::PARAM_STR );
      $consulta->bindValue( ':ID_acronimo', $d[2], PDO::PARAM_STR  );
   }
   $consulta->execute();
   $USER = $consulta->fetch(PDO::FETCH_ASSOC);
   if( $consulta->rowCount() > 0 ){ 
      return $USER;
   }else{
      return false;
   }

   }
*/


public function loginUsuarioModel($datosModel){
   $sql ="SELECT U.* , TD.ID_acronimo , 
   RU.estado , 
   R.ID_rol_n , R.nom_rol 
   FROM tipo_doc TD 
   JOIN usuario U ON TD.ID_acronimo = U.FK_tipo_doc 
   JOIN rol_usuario RU ON U.ID_us = RU.FK_us 
   JOIN rol R ON FK_rol = R.ID_rol_n  
   WHERE U.ID_us        = :ID_us  
   AND TD.ID_acronimo   = :ID_acronimo";
   $consulta = $this->db->prepare($sql);
   foreach($datosModel as $i =>  $d ){
     // $pass_cifrado = password_hash($d[1], PASSWORD_DEFAULT);
      $consulta->bindValue( ':ID_us',       $d[0] , PDO::PARAM_STR );
   // $consulta->bindValue( ':pass',        $d[1] , PDO::PARAM_STR );
      $consulta->bindValue(':ID_acronimo',  $d[2], PDO::PARAM_STR  );
      $pass = $d[1];
   }
  // echo $pass; die();

   $consulta->execute();
   $USER = $consulta->fetch(PDO::FETCH_ASSOC);
   if(($consulta->rowCount() > 0) && (password_verify($pass, $USER['pass']))){ 
      return $USER;
   }else{
      return false;
   }
 
   }



/*
      //Cambio contraseña por usuario
      public function validarPass($id, $pass){
         $sql = "SELECT * FROM usuario 
            WHERE ID_us = :ID_us 
            AND pass = :pass ";
         $c =$this->db->prepare($sql);
         $c->bindValue( ':ID_us', $id, PDO::PARAM_STR  );
         $c->bindValue( ':pass', $pass, PDO::PARAM_STR  );
         $c->execute();
         $r = $c->fetchAll();

         if($r){
            return $r;
         }else{
            return false;
         }
      }
      */


   //Cambio contraseña por usuario
   public function validarPass($id, $pass){
      $sql = "SELECT * FROM usuario 
         WHERE ID_us = :ID_us ";
      $c =$this->db->prepare($sql);
      $c->bindValue(':ID_us', $id, PDO::PARAM_STR );
      $c->execute();
      $USER = $c->fetch(PDO::FETCH_ASSOC);
      if( ($c->rowCount() > 0) &&  password_verify($pass, $USER['pass'])){
         return  true;
      }else{
         return false;
      }
   }


      // Cambiar contraseña
      //Cambio de contraseña
   public function cambioPass($id,  $contraseñaNueva){
    $sql = "UPDATE usuario 
       SET pass = :pass 
       WHERE ID_us = :ID_us ";
      $c =$this->db->prepare($sql);
      $pass_cifrado = password_hash($contraseñaNueva , PASSWORD_DEFAULT );
      $c->bindValue( ':ID_us', $id,            PDO::PARAM_STR  );
      $c->bindValue( ':pass', $pass_cifrado,   PDO::PARAM_STR  );
      $r = $c->execute();
      if($r){
         return true;
      }else{
         return false;
      }
   }
  //-------------------------------------------------------------------------

   public function validarCredecilesCorrreo($a){
      $sql = 'SELECT * FROM usuario 
      WHERE FK_tipo_doc = :FK_tipo_doc
      AND ID_us   =  :ID_us
      AND correo = :correo';
      $c = $this->db->prepare($sql);
      $c->bindValue( ':FK_tipo_doc', $a[0], PDO::PARAM_STR  );
      $c->bindValue( ':ID_us',       $a[1], PDO::PARAM_STR  );
      $c->bindValue( ':correo',      $a[2], PDO::PARAM_STR  );
      $c->execute();
      $r = $c->fetchAll();
      if($r){
         return $r;
      }else{
         return false;
      }
   }
     

  

   //-------------------------------------------------------------------------------------------------------
   //METODO DELETE USUARIO PDO MVC-------------------------(FALTA METODO API)-------------------------------
   public function eliminarUsuario($id_get){       
      $sql1 = "SET FOREIGN_KEY_CHECKS = 0";
      $consulta2 =$this->db->prepare($sql1);
      $rest1 = $consulta2->execute();
      if ($rest1) {
         $sql2 = "DELETE FROM usuario WHERE  ID_us = :id ";
         $consulta3=$this->db->prepare($sql2); 
         $consulta3->bindValue(":id", $id_get);
         $rest2=$consulta3->execute();
      }
      if ($rest2) {
         $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
         $consulta4 = $this->db->prepare($sql3);
         $rest3=$consulta4->execute();
      if ($rest3) {
         return true;
      }
      else{ 
         return false;
        } 

        
      }
   } // fin de metodo eliminar categoria

   //-------------------------------------------------------------------------------------------------------
   //METODO UPDATE USUARIO PDO MVC-------------------------(FALTA METODO API)-------------------------------
   public function actualizarDatosUsuario($id, $a){ 
      ///echo '<pre>'; print_r($a); echo '</pre>';  echo '<pre>'; print_r($id); echo '</pre>';    die();
      $sql = "UPDATE usuario SET ID_us = ?, nom1 = ?, nom2 = ?, ape1 = ?, ape2 = ?, 
      fecha = ?, foto = ?, correo = ?, FK_tipo_doc = ?
      WHERE ID_us = ?";
      $insertar = $this->db->prepare($sql);
      $bool = $insertar->execute([$a[0], $a[1], $a[2], $a[3], $a[4], $a[5], $a[7], $a[8], $a[9], $id]);       
      $bool =  $insertar->execute();
      if($bool){
         return true;
      }else{
      return false;
         }
      }

/*
      public function  selectUsuarioRol($r){
        $sql = "SELECT U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.pass, U.foto, U.correo,
           R.nom_rol,  
           R_U.estado
           FROM sicloud.usuario U 
           JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
           JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n
           WHERE R.ID_rol_n  = :id
           ORDER BY u.nom1 asc";
        $consulta= $this->db->prepare($sql);
        $consulta->bindValue(":id", $r);
        $result = $consulta->execute();
        $result = $consulta->fetchAll();
        return $result;
      }

 */

   public function  selectUsuarioRol($id,  $tipo = 0){
       $sql = "SELECT distinct U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, 
       U.ape1, U.ape2, U.pass, U.foto, U.correo, 
       R.nom_rol,  R.nom_rol,
       R_U.estado
       FROM usuario U 
       JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
       JOIN rol  R ON R_U.FK_rol = R.ID_rol_n 
       WHERE R.ID_rol_n IN ( :id )
        ";
       $c = $this->db->prepare($sql);
       $c->bindValue(":id", $id);
       $c->execute();


       switch ($tipo) {
         case 0:
         $r = $c->fetchAll();
         return $r;
         break;
         case 1:
         $r = $c->fetchAll(PDO::FETCH_ASSOC);
        // print json_encode($r, JSON_UNESCAPED_UNICODE);
         return $r;
         break;

       }
       
  
   }




   
   public function  selectUsuarioFac($id,  $tipo = 0){
      $sql = "SELECT distinct U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, 
      U.ape1, U.ape2, U.pass, U.foto, U.correo, 
      R.nom_rol,  R.nom_rol,
      R_U.estado
      FROM usuario U 
      JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
      JOIN rol  R ON R_U.FK_rol = R.ID_rol_n 
       ";
      $c = $this->db->prepare($sql);
      $c->bindValue(":id", $id);
      $c->execute();


      switch ($tipo) {
        case 0:
        $r = $c->fetchAll();
        return $r;
        break;
        case 1:
        $r = $c->fetchAll(PDO::FETCH_ASSOC);
       // print json_encode($r, JSON_UNESCAPED_UNICODE);
        return $r;
        break;

      }
      
 
  }




   public function conteoUsuariosActivos(){
      $sql = "SELECT count(*) AS usuariosActivos 
         FROM usuario  U JOIN rol_usuario RU ON RU.FK_us = U.ID_us
         WHERE RU.estado = 1";
      $c= $this->db->prepare($sql);
       $c->execute();
      $r = $c->fetchAll();
      foreach( $r as $d ){
         $con =   $d[0];
      }
      return $con;
   }
   public function conteoUsuariosInactivos(){
      $sql = "SELECT count(*) AS usuariosActivos 
         FROM usuario  U 
         JOIN rol_usuario RU ON RU.FK_us = U.ID_us
         WHERE RU.estado = 0";
      $c= $this->db->prepare($sql);
      $c->execute();
      $r = $c->fetchAll();
     foreach($r as  $d){
        $con= $d[0];
     }
      return $con;
   }

        //busqueda por ID
  public function selectIdUsuario($id){
   $sql = "SELECT distinct U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.pass, U.foto, U.correo, 
      R.nom_rol,  R.nom_rol,
      R_U.estado, U.fecha
      FROM usuario U 
      JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
      JOIN rol  R ON R_U.FK_rol = R.ID_rol_n 
      WHERE ID_us = :id
       ";
   $c = $this->db->prepare($sql);
   $c->bindValue(":id", $id);
   $c->execute();
   $r = $c->fetchAll();

   return $r;
 } // fin de busqueda por ID

 public function selectUsuariosPendientes($est){
   $sql = "SELECT U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.pass, U.foto, U.correo,  
      R.nom_rol, 
      R_U.estado
      FROM usuario U 
      JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
      JOIN rol  R ON R_U.FK_rol = R.ID_rol_n 
      WHERE R_U.estado =:id ";
   $c = $this->db->prepare($sql);
   $c->bindValue(":id",$est);
   $c->execute();
   $r = $c->fetchAll();
   return $r;
 } //Busqueda por estado pendiente
   //aprobar solicitud
   public function activarCuenta($id){
      $sql = "UPDATE rol_usuario 
         SET rol_usuario.estado = 1 
         WHERE rol_usuario.FK_us = ?";
            $c = $this->db->prepare($sql);
            $bool = $c->execute( [$id]  );       
           
    //  $c->bindParam(":id",$id);
      if ($bool) {
         $_SESSION['message'] = "Desactivo cuenta de usuario";
         $_SESSION['color'] = "danger";
         return true;
      } else {
         $_SESSION['message'] = "Error al descativar cuenta";
         $_SESSION['color'] = "danger";
         return false;
      }
      //header("location: ../CU009-controlUsuarios.php ");
   } // fin de desactibar cuenta
 
      ///header("location: ../CU009-controlUsuarios.php ");
     // fin de aprbar solicitud

    public function desactivarCuenta($id){
      $sql = "UPDATE rol_usuario 
         SET rol_usuario.estado = 0 
         WHERE rol_usuario.FK_us = ?";
            $c = $this->db->prepare($sql);
            $bool = $c->execute( [$id]  );       
           
    //  $c->bindParam(":id",$id);
      if ($bool) {
         $_SESSION['message'] = "Desactivo cuenta de usuario";
         $_SESSION['color'] = "danger";
         return true;
      } else {
         $_SESSION['message'] = "Error al descativar cuenta";
         $_SESSION['color'] = "danger";
         return false;
      }
      //header("location: ../CU009-controlUsuarios.php ");
   } // fin de desactibar cuenta

   public function verPuntosUs(){
      $sql = "SELECT P.id_puntos, P.puntos, P.fecha , 
         U.nom1 , U.nom2 , U.ape1
         FROM puntos P 
         JOIN usuario U ON  P.FK_us =  U.ID_us
         ORDER BY U.nom1 asc";
   $c = $this->db->prepare($sql);
   $c->execute();
   $r = $c->fetchAll();
   return $r;
   }
   

   // Actualzacion de datos por rol usuario---------------------------------------------------------
  public function insertUpdateUsuarioCliente($a){
   $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
   $consulta1 = $this->db->prepare($sql1);
        $res =  $consulta1->execute();   
   if ($res) {
      $sql2 = "UPDATE usuario 
      SET  nom1 = :nom1 ,  nom2 = :nom2 ,ape1 = :ape1 , ape2 = :ape2 , fecha = :fecha   , correo = :correo  
      WHERE  ID_us = :ID_us ";
      $consulta = $this->db->prepare($sql2);
      $consulta->bindValue( ':ID_us',  $a[0] , PDO::PARAM_STR );
      $consulta->bindValue( ':nom1',   $a[1] , PDO::PARAM_STR );
      $consulta->bindValue( ':nom2',   $a[2] , PDO::PARAM_STR );
      $consulta->bindValue( ':ape1',   $a[3] , PDO::PARAM_STR );
      $consulta->bindValue( ':ape2',   $a[4] , PDO::PARAM_STR );
      $consulta->bindValue( ':fecha',  $a[5] , PDO::PARAM_STR );
      $consulta->bindValue( ':correo', $a[6] , PDO::PARAM_STR );
      $res1 = $consulta->execute();
   }   
   if ($res1) {
      $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
      $consulta3 = $this->db->prepare($sql3);
      $res2 = $consulta3->execute();
   }
   if ($res2) {
      return true;
   } else {
      return false;
   }
}

//===========================================================================0   

//===========================================================================
//CCATEGORIA

    // Insertar datos           C
    public function insertCategoria($a){
        $sql = "INSERT INTO categoria (nom_categoria ) VALUES (:nom_categoria )";
        $consultar = $this->db->prepare($sql);
        $consultar->bindValue(":nom_categoria", $a[0], PDO::PARAM_STR );
        $bool = $consultar->execute();
         if($bool){
            return true;
         }else{
            return $a;
        }
   }


    // Ver categorias           R
    public function verCategoria(){
        $sql = "SELECT * FROM categoria";
        $consulta = $this->db->prepare($sql);
        $consulta->execute();
        $result = $consulta->fetchAll(); 
        return $result;
    }


        // Eliminar categoria           D
   public function eliminarCategoria($a){       
      $sql1 = "SET FOREIGN_KEY_CHECKS = 0";
      $consulta2 =$this->db->prepare($sql1);
      $rest1 = $consulta2->execute();
      if ($rest1) {
         $sql2 = "DELETE FROM categoria WHERE  ID_categoria = :id ";
         $consulta3=$this->db->prepare($sql2); 
         $consulta3->bindValue(":id", $a[0], PDO::PARAM_INT);
         $rest2=$consulta3->execute();
      }
      if ($rest2) {
         $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
         $consulta4 = $this->db->prepare($sql3);
         $rest3=$consulta4->execute();
         if ($rest3) {
            return true;
         } else{ 
            return false;
         } 
      }
   } // fin de metodo eliminar categoria



   // Actualizar datos             U
   public function actualizarDatosCategoria($a){
      $sql = 
      "UPDATE categoria 
         SET nom_categoria = :nom_categoria  
         WHERE ID_categoria = :ID_categoria ";
      $consulta = $this->db->prepare($sql);
      $consulta->bindValue(":ID_categoria", $a[0], PDO::PARAM_INT );
      $consulta->bindValue(":nom_categoria", $a[1], PDO::PARAM_STR );
      $result = $consulta->execute();
      if($result){ 
         return true;
      }else{
         return false;
      }
   }
    
     public function verCategoriaId($id){
         $sql = "SELECT * 
         FROM categoria
         WHERE ID_categoria = :ID_categoria";
         $consulta = $this->db->prepare($sql);
         $consulta->bindValue(":ID_categoria", $id);
         $consulta->execute();
         $result = $consulta->fetchAll();
         return $result;
     }
    // Ver categorias por id    R
    //static function verCategoriaId($id)

    //Capturar id
    public function capturarId(){
        //include_once 'class.conexon.php';
        //$con = new Conexion;
        $sql = "SELECT * FROM categoria ORDER BY ID_categoria DESC LIMIT 1 ";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
        //$datos = $con->query($sql);
        //while ($row = $datos->fetch_array());
        //$id = $row['ID_categoria'];
        //return $id;
    } // fin de metodo capturar ID

    // Ver categiria sin conexion
    public function verCategorias(){
        //include_once 'class.conexon.php';
        //$d = new Conexion;
        $sql = "SELECT * FROM categoria
        order by nom_categoria asc";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(); 
        return $result;
        //$result = $d->query($sql);
        //return $result;
    } // fin de ver categoria

//============================================================================
   
//==============================================================
//CCIUADAD
//-----------------------------------------------------------------
public function verCiudad(){
   $sql = "SELECT id_ciudad, nom_ciudad FROM ciudad";
   $stm=$this->db->prepare($sql);
   $stm->execute();
   $result=$stm->fetchAll();
   return $result;
 }
 
 //-----------------------------------------------------------------
 // fin de metodo ver datos ciudad
 //----------------------------------------------------------------
 
 //-----------------------------------------------------------------
 
 public function insertCiudad(){
   $sql = "INSERT INTO ciudad (id_ciudad, nom_ciudad) VALUES (:id_ciudad, :nom_ciudad)";
   $stm = $this->db->prepare($sql);
   $stm->bindValue(":id_ciudad", $this->id_ciudad);
   $stm->bindValue(":nom_ciudad", $this->nom_ciudad);
   $insert = $stm->execute();
   if($insert){
       include_once '../controlador/controlodarsession.php';
       $_SESSION['message'] = "Registro Ciudad";
       $_SESSION['color'] = "success";
     }else{ 
       $_SESSION['message'] = "No registro Ciudad";
       $_SESSION['color'] = "success";
   }
 }
 
 //-----------------------------------------------------------------
 // fin de metodo registrar datos ciudad
 //----------------------------------------------------------------
 
 //-----------------------------------------------------------------
 public function verCiudadId($ID_ciudad){
   //include_once 'class.conexion.php';
   //$c = new Conexion;
   $sql = "SELECT id_ciudad , nom_ciudad FROM ciudad WHERE ID_ciudad = '$ID_ciudad' ORDER BY nom_ciudad ASC ";
   $stm = $this->db->prepare($sql);
   $stm->execute();
   $result=$stm->fetchAll();
   return $result;
   //$result = $c->query($sql);
   //return $result;
 }// fin de metodo ver datos ciudad

//===========================================================
 //============================================================
 //CDOCUMENTO
 public function verDocumeto(){
   $sql = "SELECT * FROM tipo_doc";
   $consulta = $this->db->prepare($sql);
   $consulta->execute();
   $result =  $consulta->fetchAll();
   return $result;
}
//==============================================================
//==============================================================
//CEMPRESA
    //Metodo insertar 
   public function insertEmpresa($a){
      $sql = "INSERT INTO empresa_provedor (ID_rut, nom_empresa)VALUES( :ID_rut, :nom_empresa)";
      $stm = $this->db->prepare($sql);
      $stm->bindValue(":ID_rut", $a[0], PDO::PARAM_STR);
      $stm->bindValue(":nom_empresa", $a[1], PDO::PARAM_STR);
      $insert = $stm->execute();
      if($insert){
         return true;
      }else{ 
         return false;
      }
   }

   public function verDatoEmpresaPorId($id){
      $sql = "SELECT * FROM empresa_provedor WHERE ID_rut = :ID ";
      $consulta= $this->db->prepare($sql);
      $consulta->bindValue(":ID", $id, PDO::PARAM_STR);
      $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
  }
   //====================================




  public function ver($dato, $sale=0, $float= false, $email=''){
      echo '<div style="background-color:#fbb; border:1px solid maroon;  margin:auto 5px; text-align:left;'. ($float? ' float:left;':'').' padding:7px; border-radius:7px; margin-top:10px">';
      if(is_array($dato) || is_object($dato) ){
          echo '<pre><br><b>&raquo;&raquo;&raquo; DEBUG</b><br>'; print_r($dato); echo '</pre>'; 
      }else{
          if(isset($dato)){
              echo '<b>&raquo;&raquo;&raquo; DEBUG &laquo;&laquo;&laquo;</b><br><br>'.nl2br($dato); 	
          }else{
              echo 'LA VARIABLE NO EXISTE';
          }
      }
      echo '</div>';
      if($sale==1) die();
  }

  // Eliminar 
  public function eliminarEmpresa($a){
      $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
      $consulta1 = $this->db->prepare($sql1);
      $res =  $consulta1->execute();
      if($res){
          $sql2 = "DELETE  FROM empresa_provedor WHERE ID_rut = :id ";
          $consulta2=$this->db->prepare($sql2); 
          $consulta2->bindValue(":id", $a[0], PDO::PARAM_STR);
          $res1 = $consulta2->execute();
     }
     if($res1){
          $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
          $consulta3=$this->db->prepare($sql3);
          $res2 = $consulta3->execute();
     }

      if ($res2) {
         return true;
      } else {
         return false;
      }
  }
 
  public function verDatoPorId($id){
      $sql = "SELECT * FROM usuario WHERE ID_us = :ID ";
      $consulta= $this->db->prepare($sql);
      $consulta->bindValue(":ID", $id, PDO::PARAM_STR);
      $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
  }

  public function actualizarDatosEmpresa($a){ 
    // 
      $sql = "UPDATE empresa_provedor 
      SET nom_empresa = :nom_empresa 
      WHERE ID_rut = :ID ";
      $consulta = $this->db->prepare($sql);
      $consulta->bindValue(":ID",         $a[0], PDO::PARAM_STR);
      $consulta->bindValue(":nom_empresa",$a[1], PDO::PARAM_STR);
      $result = $consulta->execute();
      if ($result) {
         return true;
      } else {
         return false;
      }
  }

  // ver empresa
public function verEmpresa(){
   // $db = new Conexion;
    $sql = "SELECT * FROM empresa_provedor";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(); 
    return $result;
    
}
//==================================================================
//==================================================================
//CERROR

public function verError()
{

    //$c = new Conexion;
    $sql = "SELECT * FROM log_error";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll();
    return $result;
    //$insert =  $c->query($sql);
    //return $insert;
} // fin de ver error

public function eliminarErrorLog($id)
{
    //include_once 'class.conexion.php';
    //$c = new Conexion;
    $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
    $consulta1 = $this->db->prepare($sql1);
    $res =  $consulta1->execute();
    if ($res) {
        $sql2 = "DELETE FROM log_error WHERE ID_error = $id";
        $consulta2 = $this->db->prepare($sql2);
        $consulta2->bindValue(":id", $id);
        $res1 = $consulta2->execute();
    }
}   
//==================================================
//==================================================
//CFACTURA


   public function facturar($a){
      $sql ="INSERT INTO `factura`( `total`, `fecha`, `status`, `iva`, `FK_c_tipo_pago`,`FK_tipoV`) 
      VALUES (  :total , :fecha , :status ,:iva, :tipo_pago , :pago)";
      $consulta = $this->db->prepare($sql);
      $consulta->bindValue(":total", $a[0], PDO::PARAM_INT);
      $consulta->bindValue(":fecha", $a[1], PDO::PARAM_STR);
      $consulta->bindValue(":status", $a[2], PDO::PARAM_STR);
      $consulta->bindValue(":iva", $a[3], PDO::PARAM_STR);
      $consulta->bindValue(":tipo_pago", $a[4], PDO::PARAM_INT);
      $consulta->bindValue(":pago", $a[5], PDO::PARAM_INT);
      $result = $consulta->execute();
      $id = $this->db->lastInsertId();

      return $id;
   }



     public function verTipoV(){
        $sql= "SELECT * FROM `tipo_venta`";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(); 
     }
   public function insertaProductosFactura($a){
      $sql = "INSERT INTO det_factura( FK_det_factura ,  FK_det_prod, precio_unt, estado, cantidad, CF_us, CF_tipo_doc) 
      VALUES (:FK_factura, :FK_prod, :precioU, :estado, :cantidad, :CF_us, :CF_tipo_doc)";
      $consulta = $this->db->prepare($sql);
      $consulta->bindValue(":FK_factura",$a[0], PDO::PARAM_INT);
      $consulta->bindValue(":FK_prod", $a[1], PDO::PARAM_STR);
      $consulta->bindValue(":precioU", $a[2], PDO::PARAM_INT);
      $consulta->bindValue(":estado", 'NULL', PDO::PARAM_STR);
      $consulta->bindValue(":cantidad", $a[3], PDO::PARAM_INT);
      $consulta->bindValue(":CF_us", $a[4], PDO::PARAM_STR);
      $consulta->bindValue(":CF_tipo_doc", $a[5], PDO::PARAM_STR);
      $r = $consulta->execute();
      if($r){
         return true;
      }else{
         return false;
      }
   }
   
   
   


 public function insertarFactura($a){
    die('entro al modelo');
   // ControllerDoc::ver($a, 1);
 }


   public function verFecha($f){
      $sql = "SELECT cantidad, sum(f.total) as total, day(f.fecha) as dia
      from det_factura detf
      join factura f on f.ID_factura = detf.FK_det_factura
      where f.fecha = '$f'
      group by dia";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(); 
      return $result;

   } // fin  de ver fecha U

//  METODOS

// verjoinFactura

   public function verjoinFactura(){
      $sql = "SELECT  ID_us  ,nom1, ape1 ,nom_prod, f.fecha , nom_tipo_pago , total
      from det_factura df
      join usuario u on df.CF_us = u.ID_us and df.CF_tipo_doc = u.FK_tipo_doc
      join producto p on df.FK_det_prod = p.ID_prod
      join factura f on df.FK_det_factura = f.ID_factura
      join tipo_pago  tp on f.FK_c_tipo_pago = tp.ID_tipo_pago  order by nom1 asc  ";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(); 
      return $result;
   } // fin de metodo ver join factura


//----------------------------------------------------------

//-------------------------------------------------------------
//Consulta de que usuarios han realizado compras = Vista = comprasUsuarios.php
   public function usuariosComprasRealizadas(){
      $sql = "SELECT U.ID_us , U.nom2 , U.nom1 , U.ape1 , U.ape2 , U.foto , U.correo , DF.FK_det_factura , F.fecha
      from factura F join det_factura DF on F.ID_factura = DF.FK_det_factura
      right join  usuario U on U.ID_us = DF.CF_us
      order by (DF.FK_det_factura) desc, (F.fecha) desc ,(U.nom1) desc";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(); 
      return $result;
   }
//-------------------------------------------------------------
   public function verDia(){
      $sql = "SELECT cantidad, sum(f.total) as total, day(f.fecha) as dia
          from det_factura detf
          join factura f on f.ID_factura = detf.FK_det_factura
          group by dia";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(); 
      return $result;
   }
   public function verSemana(){
      $sql = "SELECT count(*) as 'cantidad',sum(F.total) as Total, DATE_ADD(
        DATE (F.fecha),
        interval(7 - dayofweek(F.fecha)) day)
        dia_final_semana FROM factura F
        group by dia_final_semana
        order by fecha asc";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll();
      return $result;
   }
   public function verMes(){
      $sql = "SELECT count(*) as 'cantidad',sum(F.total) as Total, DATE_ADD(
         DATE (F.fecha),
         interval(30 - dayofmonth(F.fecha)) day)
         dia_final_mes FROM factura F
         group by dia_final_mes
         order by fecha asc";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(); 
      return $result;
   }
// valida factura en un periodo de fechas
   public function verIntervaloFecha($fF, $fI){
      $sql = "SELECT  DISTINCT TD.nom_doc , U.ID_us,  U.nom1,  U.nom2 , U.ape1 , U.ape2 , U.correo, 
      F.ID_factura, F.fecha, D.dir , TP.nom_tipo_pago , F.total
               FROM factura F 
               LEFT JOIN tipo_pago TP on F.FK_c_tipo_pago = TP.ID_tipo_pago
               LEFT JOIN det_factura DF on F.ID_factura = DF.FK_det_factura
               LEFT JOIN producto Pr on Pr.ID_prod = DF.FK_det_prod
               LEFT JOIN usuario U  on U.ID_us =  DF.CF_us
               LEFT JOIN direccion D on D.CF_us = U.ID_us
               LEFT JOIN tipo_doc TD on U.FK_tipo_doc = TD.ID_acronimo
       WHERE F.fecha BETWEEN  '$fF' AND  '$fI' 
          ORDER BY fecha ASC";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(); 
      //echo $sql;
      //die();
      return $result;
   }
// Ver datos  usuario en factura
   public function verUsuarioFactura($id){
      $sql = "SELECT U.nom1, U.nom2, U.ape1, U.ape2 , T.tel , D.dir
         FROM usuario U JOIN telefono T ON T.CF_us = U.ID_us
         JOIN direccion D ON D.CF_us = U.ID_us
         WHERE U.ID_us = ?
         LIMIT 1";
      $stm = $this->db->prepare($sql);
      $stm->bindValue( 1, $id, PDO::PARAM_STR );
      $stm->execute();
      $result = $stm->fetchAll(); 
      return $result;
   }
   public function verFactura($id){
      $sql = "SELECT  TD.nom_doc , U.ID_us,  U.nom1,  U.nom2 , U.ape1 , U.ape2 , U.correo, 
      F.ID_factura, F.fecha, D.dir , TP.nom_tipo_pago , F.total, V.tipo
               FROM factura F 
               LEFT JOIN tipo_pago TP on F.FK_c_tipo_pago = TP.ID_tipo_pago
               LEFT JOIN det_factura DF on F.ID_factura = DF.FK_det_factura
               LEFT JOIN producto Pr on Pr.ID_prod = DF.FK_det_prod
               LEFT JOIN usuario U  on U.ID_us =  DF.CF_us
               LEFT JOIN direccion D on D.CF_us = U.ID_us
               LEFT JOIN tipo_doc TD on U.FK_tipo_doc = TD.ID_acronimo
               JOIN tipo_venta V ON V.id_tipoV =  FK_tipoV
               WHERE ID_factura = ?
         LIMIT 1";
      $stm = $this->db->prepare($sql);
      $stm->bindValue( 1, $id, PDO::PARAM_INT );
      $stm->execute();
      $result = $stm->fetchAll(); 
      return $result;
   }
   public function consProductosFactura($id){
      $sql = "SELECT   DF.FK_det_factura, DF.FK_det_prod, PR.nom_prod,
      DF.cantidad , PR.val_prod , TD.nom_doc , U.ID_us
               FROM factura F join tipo_pago TP on F.FK_c_tipo_pago = TP.ID_tipo_pago 
               LEFT JOIN det_factura DF on F.ID_factura = DF.FK_det_factura
               LEFT JOIN producto PR on PR.ID_prod = DF.FK_det_prod
               LEFT JOIN usuario U  on U.ID_us =  DF.CF_us
               LEFT JOIN direccion D on D.CF_us = U.ID_us
               LEFT JOIN tipo_doc TD on U.FK_tipo_doc = TD.ID_acronimo
               WHERE ID_factura = ?";
               $stm = $this->db->prepare($sql);
      $stm->bindValue( 1, $id, PDO::PARAM_INT );
      $stm->execute();
      $result = $stm->fetchAll(); 
      return $result;
   }
//==============================================
//==============================================
//CLOCALIDAD
   public  function verLocalidadId($ID_ciudad){
      $sql = "SELECT ID_localidad , nom_localidad 
      FROM localidad 
      WHERE FK_ciudad = ? ";
      $stm = $this->db->prepare($sql);
      $stm->bindValue(":nom_medida", $ID_ciudad, PDO::PARAM_STR);
      $stm->execute();
      $result = $stm->fetchAll(); 
      return $result;
   }
//============================================
//============================================
//CMEDIDA
   public function insertMedia($a){
      $sql = "INSERT INTO tipo_medida(nom_medida, acron_medida)
      VALUES( :nom_medida,  :acron_medida)";
      $stm = $this->db->prepare($sql);
      $stm->bindValue(":nom_medida", $a[0],   PDO::PARAM_STR);
      $stm->bindValue(":acron_medida", $a[1], PDO::PARAM_STR);
      $insert = $stm->execute();
      if ($insert ) {
         return true;
      } else {
         return false;
      }
   } 
   public function verMedida(){
      $sql = "SELECT * FROM  tipo_medida";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(); 
      return $result;
   }

   public function verMedidaPorId($ID){
      $sql = "SELECT * FROM  tipo_medida
      WHERE ID_medida = :ID ";
      $stm = $this->db->prepare($sql);
      $stm->bindValue(":ID", $ID, PDO::PARAM_INT);
      $stm->execute();
      $result = $stm->fetchAll(); 
      return $result;
   }

//mostrar datos por ID


//Actualizar datos 
   public function actualizarDatosMedida($a){
      $sql =
         "UPDATE tipo_medida 
         SET nom_medida = :nom_medida , acron_medida = :acron_medida  
         WHERE ID_medida = :id ";
      $stm = $this->db->prepare($sql);
      $stm->bindValue(":id", $a[0] , PDO::PARAM_INT );
      $stm->bindValue(":nom_medida", $a[1] , PDO::PARAM_STR );
      $stm->bindValue(":acron_medida", $a[2] , PDO::PARAM_STR );
      $result = $stm->execute();
      if ($result) {
         return true;
      } else {
         return false;
      }
      header("location: ../vista/formMedida.php");
   }


//eliminar registros
   public function eliminarDatosMedia($a){
      $sql = 
         "DELETE FROM tipo_medida 
         WHERE ID_medida = :id ";
      $stm = $this->db->prepare($sql);
      $stm->bindValue(":id",$a[0], PDO::PARAM_INT );
      $result = $stm->execute();
      if ($result) {
         return true;
      } else {
         return false;
      }
   }
//==============================
//==============================
//CNOTIFICACION
//------------------------------------------
//Ver fecha actual
public function fechaActual(){
   $sql = "SELECT CURDATE() as fecha";
   $stm= $this->db->prepare($sql);
   $result = $stm->execute();
   $result = $stm->fetchAll();
   return $result;
   $fecha = $result['fecha'];
   return $fecha;
}
//------------------------------------------
//------------------------------------------
//Ver fecha hora
public function horaActual(){
  $sql = "  SELECT DATE_FORMAT(NOW( ), '%H:%i:%S' )as hora ;";
  $stm =$this->db->prepare($sql);
  $result = $stm->execute();
  $result = $stm->fetchAll();
  $hora =  $result['hora'];
  return $hora;
}
//------------------------------------------
//------------------------------------------
//insertar modificacion 
public function insertModificacion($a){
  // $this->ver($a, 1);
   $sql = "INSERT INTO modific(descrip , fecha , hora ,
   FK_us , FK_doc , FK_modific) 
   VALUE ( :descrip , :fecha , :hora , :FK_us , :FK_doc , :FK_modific )";
   $stm = $this->db->prepare($sql);
   $stm->bindValue(":descrip",   $a[0], PDO::PARAM_STR);
   $stm->bindValue(":fecha",     $a[1], PDO::PARAM_STR);
   $stm->bindValue(":hora",      $a[2], PDO::PARAM_STR);
   $stm->bindValue(":FK_us",     $a[3], PDO::PARAM_STR);
   $stm->bindValue(":FK_doc",    $a[4], PDO::PARAM_STR);
   $stm->bindValue(":FK_modific",$a[5], PDO::PARAM_STR);
   $insert = $stm->execute();
   if ($insert) {
      return true;
   } else {
      return false;
   }
}// fin de insersion modificacion
//------------------------------------------
//------------------------------------------
//Muestra todas las notificaciones
public function consNotificacionesT(){
   $sql = 'SELECT N.ID_not , N.estado , N.descript , R.nom_rol, T.nom_tipo
   FROM notificacion N 
   JOIN rol R ON N.FK_rol = R.ID_rol_n
   JOIN tipo_not T ON T.ID_tipo_noT = N.FK_not ';
   $stm = $this->db->prepare($sql);
   $stm->execute();
   $aR = $stm->fetchAll();
   return $aR;
}

public function delteNotificacion($id){
   $sql = 'DELETE FROM notificacion  WHERE ID_not = :id';
   $stm = $this->db->prepare($sql);
   $stm->bindValue(":id",   $id, PDO::PARAM_STR);
   $delete = $stm->execute();
   if ($delete) {
      return true;
   } else {
      return false;
   }
}





//------------------------------------------
//ver join de modificaciones
   public function verJoinModificacionesDB(){
      $sql = "SELECT M.ID_modifc , M.descrip , M.fecha , M.hora , 
      M.FK_us , M.FK_doc  ,  U.nom1 , U.ape1 ,  T_M.nom_modific , R.nom_rol , U.nom2 , U.ape2 
         from tipo_modific T_M JOIN modific M on T_M.ID_t_modific =  M.FK_modific
         JOIN usuario U ON M.FK_us = U.ID_us
         JOIN rol_usuario R_U on U.ID_us = R_U.FK_us
         JOIN rol R on R_U.FK_rol = R.ID_rol_n
         ORDER BY fecha, hora";
      $consulta= $this->db->prepare($sql);
      $result = $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;   
   }// fin de join modificacion
//------------------------------------------
//METODOS
//fecha actual
   public function insertEntrada($a){
      $sql = "INSERT INTO orden_entrada ( fecha_ingreso , CF_rol , CF_rol_us , CF_tipo_doc) 
      VALUES (? , ? , ? , ? )";
      $stm = $this->db->prepare($sql);
      $stm->bindValue(":fecha_ingreso",$a[0], PDO::PARAM_STR );
      $stm->bindValue(":CF_rol",       $a[1], PDO::PARAM_INT );
      $stm->bindValue(":CF_rol_us",    $a[2], PDO::PARAM_STR );
      $stm->bindValue(":CF_tipo_doc",  $a[3], PDO::PARAM_STR );
      $insert = $stm->execute();
      if($insert){   
         return true;
      }else{
         return true;
      }// fin de insrtar datos
   }
//===========================================
//===========================================
//CPAGO
   public function verPago(){
      $sql = "SELECT *  FROM tipo_pago";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(); 
      return $result;
   }
//===========================================
//CPRODUCTO
   //query insertar producto                                     C
   public function insertarProducto($a){
      $sql = "INSERT INTO producto (ID_prod, nom_prod, 
      val_prod, stok_prod, estado_prod, 
      CF_categoria, CF_tipo_medida)
      VALUES(?, ? ,? , ? ,? ,? ,?)";
      $stm = $this->db->prepare($sql);
      $stm->bindValue(1, $a[0]);
      $stm->bindValue(2, $a[1]);
      $stm->bindValue(3, $a[2]);
      $stm->bindValue(4, $a[3]);
      $stm->bindValue(5, $a[4]);
      $stm->bindValue(6, $a[5]);
      $stm->bindValue(7, $a[6]);
      $ejecucion = $stm->execute();
      if ($ejecucion) {
          return true;
      } else {
          return false;
      }
   } // fin de javaScript


   //query ver productos                                        R
   public function verProductos(){
      $sql = "SELECT P.ID_prod , P.img , P.nom_prod , 
      P.val_prod , P.stok_prod , P.estado_prod , 
      C.nom_categoria , M.nom_medida , P.img
      from producto P join categoria C on C.ID_categoria = P.CF_categoria
      join tipo_medida M on P.CF_tipo_medida = M.ID_medida
      order by  P.stok_prod  desc , P.nom_prod asc;";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll();
      return $result;
   } // fin de ver productos


   public function verProductosGrafica(){
      $sql = "SELECT  nom_prod , stok_prod  
      FROM producto 
      order by stok_prod";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll();
      return $result;
   }

   //query ver productos                                        R
   public function verPromociones(){
      $sql = "SELECT P.ID_prod , P.img , P.nom_prod , P.val_prod , 
      P.stok_prod , P.estado_prod , C.nom_categoria , M.nom_medida
      from producto P 
      join categoria C on C.ID_categoria = P.CF_categoria
      join tipo_medida M on P.CF_tipo_medida = M.ID_medida 
      where estado_prod = 'Promoción'
      order by P.nom_prod asc ";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll();
      return $result;
   } // fin de ver productos

   //query ver productos                                       
   public function verProductosId($id){
      $sql = "SELECT P.ID_prod , P.nom_prod , P.val_prod , P.stok_prod , P.estado_prod , 
      C.nom_categoria, T_M.nom_medida, 
      P.CF_categoria, P.CF_tipo_medida, 
      FK_rut
         FROM producto P 
         LEFT JOIN categoria C ON P.CF_categoria = C.ID_categoria 
         LEFT JOIN tipo_medida T_M ON P.CF_tipo_medida = T_M.ID_medida 
         LEFT JOIN det_producto DP ON P.ID_prod = DP.FK_prod
         WHERE ID_prod = :ID_prod ";
      $stm = $this->db->prepare($sql);
      $stm->bindValue(":ID_prod", $id, PDO::PARAM_STR );;
      $stm->execute();
      $result = $stm->fetchAll();
      return $result;
   } // fin de ver productos por id


   public function verJoin($id){
      $sql = "SELECT C.ID_categoria , C.nom_categoria, 
         P.ID_prod , P.nom_prod , P.val_prod , P.stok_prod , P.estado_prod , P.estado_prod , 
         T.ID_medida , T.nom_medida , T.acron_medida, EP.nom_empresa , P.img
         FROM categoria C 
         LEFT JOIN producto P ON C.ID_categoria = P.CF_categoria 
         LEFT JOIN tipo_medida T ON T.ID_medida = P.CF_tipo_medida
         LEFT JOIN det_producto DP ON P.ID_prod = DP.FK_prod
         LEFT JOIN empresa_provedor EP ON DP.FK_rut = EP.ID_rut 
         WHERE  P.ID_prod = '$id' LIMIT 1";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll();
      return $result;
   }



   //EDITAR PRODUCTO                                             U
   public function editarProducto($a){
    //  ControllerDoc::ver($a, 1);
      //die('modelo');
      $sql = "UPDATE producto SET ID_prod = :ID_prod , 
         nom_prod = :nom_prod , val_prod = :val_prod , 
         stok_prod = :stok_prod , estado_prod = :estado_prod, 
         CF_categoria = :CF_categoria , CF_tipo_medida = :CF_tipo_medida  
      WHERE ID_prod = :ID_prod";
      $stm = $this->db->prepare($sql);
      $stm = $this->db->prepare($sql);
      $stm->bindValue(":ID_prod",        $a[0] , PDO::PARAM_STR );
      $stm->bindValue(":nom_prod",       $a[1] , PDO::PARAM_STR );
      $stm->bindValue(":val_prod",       $a[2] , PDO::PARAM_INT );
      $stm->bindValue(":stok_prod",      $a[3] , PDO::PARAM_INT );
      $stm->bindValue(":estado_prod",    $a[4] , PDO::PARAM_STR );
      $stm->bindValue(":CF_categoria",   $a[5] , PDO::PARAM_INT );
      $stm->bindValue(":CF_tipo_medida", $a[6] , PDO::PARAM_INT );
      $r = $stm->execute();
      if ($r) {
         return true;
      } else {
         return false;
      }
   } // fin de editar productos



   //ELIMINAR PRODUCTO                                    D
   public function eliminarProducto($id){
      $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
      $consulta1 = $this->db->prepare($sql1);
      $res =  $consulta1->execute();
      if ($res) {
         $sql2 = " DELETE FROM producto  WHERE ID_prod = :id  ";
         $consulta2 = $this->db->prepare($sql2);
         $consulta2->bindValue(":id", $id, PDO::PARAM_STR );
         $res1 = $consulta2->execute();
      }
      if ($res1) {
         $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
         $consulta3 = $this->db->prepare($sql3);
         $res2 = $consulta3->execute();
      }
      if ($res2) {
         return true;
      } else {
         return false;
      }
   }

//$cant, $stock, $id
   public function inserCatidadProducto($a){
         // ControllerDoc::ver($a[1], 1);

      // UPDATE sicloud.producto SET stok_prod = '8' WHERE ID_prod = '0529063441';
      $sql = "UPDATE producto SET stok_prod = :stok_prod WHERE ID_prod = :ID_prod ";
      $stm = $this->db->prepare($sql);
      $stm->bindValue(":stok_prod", $a[0], PDO::PARAM_INT );
      $stm->bindValue(":ID_prod", $a[1],  PDO::PARAM_STR );
      $result = $stm->execute();
      if ($result) {
         return true;
      } else {
         return false;
      }
   }

   public function verProductosAlfa($id){
      $sql = "SELECT nom_prod , stok_prod , nom_categoria  from producto sp
         JOIN categoria sc on sp.CF_categoria = sc.ID_categoria 
         WHERE sc.ID_categoria = :ID_categoria
         ORDER BY nom_prod asc";
      $consulta = $this->db->prepare($sql);
      $consulta->bindValue(":ID_categoria", $id,  PDO::PARAM_STR );
      $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
   }

   public function ConteoProductosT(){
      $sql = "SELECT nom_prod , sum(stok_prod) as total 
      FROM producto GROUP BY nom_prod
      UNION
      SELECT estado_prod, sum(stok_prod) as total
      FROM producto";
      $consulta = $this->db->prepare($sql);
      $result = $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
   }

   // METODO para ver los productos de una categoria 
   public function verPorCategoria($id){
      $sql = "SELECT  P.ID_prod ,  P.nom_prod ,P.img , P.val_prod , 
         P.stok_prod , P.estado_prod  , P.CF_tipo_medida , 
         C.ID_categoria , C.nom_categoria
         FROM producto P 
         JOIN categoria C ON  P.CF_categoria = C.ID_categoria
         WHERE C.ID_categoria = :id
         order by P.nom_prod asc";
      $consulta = $this->db->prepare($sql);
      $consulta->bindValue(':id', $id);
      $result = $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
   }

   // METODO
   //-----------------------------------------------------------------
   //Imagenes en pantalla
   public function listaProductosImg(){
      $sql = "SELECT * from producto";
      $consulta = $this->db->prepare($sql);
      $result = $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
   }
   //-----------------------------------------------------------------
   //-----------------------------------------------------------------
   //busquda de producto por primera letra
   public function primeraLetra($letra){
      $sql = "SELECT * from producto 
      WHERE nom_prod LIKE '$letra%'";
      $consulta = $this->db->prepare($sql);
      $result = $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
   }
   //----------------------------------------------------------------
   //imput bscador
   public function buscarPorNombreProducto($buscar){
      $sql = "SELECT  P.ID_prod ,  P.nom_prod ,P.img , 
      P.val_prod , P.stok_prod , P.estado_prod  , 
      P.CF_tipo_medida , C.ID_categoria , 
      C.nom_categoria
      FROM producto P 
      JOIN categoria C ON  P.CF_categoria = C.ID_categoria
      WHERE (ID_prod 
      LIKE '%$buscar%' or nom_prod  
      LIKE '%$buscar%') 
      order by nom_prod";
      $consulta = $this->db->prepare($sql);
      $result = $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
   }

   public function inserTfotoUs( $foto,  $id_us){
       $sql = "UPDATE  usuario 
       SET foto = ? 
       where ID_us = ? ";
       $consulta = $this->db->prepare($sql);
       $consulta->bindValue( 1 ,  $foto, PDO::PARAM_STR );
       $consulta->bindValue( 2 ,  $id_us, PDO::PARAM_STR );
       $consulta = $consulta->execute();
       return true;
   }

   public function inserTfotoProd( $foto,  $ID_prod){
      $sql = "UPDATE  producto 
      SET img = ? 
      where ID_prod = ? ";
      $consulta = $this->db->prepare($sql);
      $consulta->bindValue( 1 ,  $foto, PDO::PARAM_STR );
      $consulta->bindValue( 2 ,  $ID_prod, PDO::PARAM_STR );
      $consulta = $consulta->execute();
      return true;
   }




   public function verProductosIdCarrito($id){
      $sql = "SELECT P.img , P.ID_prod , P.nom_prod , 
      P.stok_prod , P.descript , P.val_prod , 
      P.estado_prod , C.nom_categoria, 
      T_M.nom_medida
      from producto P 
      join categoria C on P.CF_categoria = C.ID_categoria 
      join tipo_medida T_M on P.CF_tipo_medida = T_M.ID_medida 
      WHERE P.ID_prod = '$id' ";
      $consulta = $this->db->prepare($sql);
      $result = $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
   }

   //=================================================
   //=================================================
   //CPROVEDOR
   public function verProveedor(){
      $sql = "SELECT * FROM empresa_provedor";
      $c = $this->db->prepare($sql);
      $c->execute();
      $r = $c->fetchAll();
      return $r;
   }
//===================================================
//===================================================
//CPUNTOS
public function insertPuntos( $a ){
  // $this->ver($a , 1); die();
   $sql = "INSERT INTO puntos ( puntos , fecha , FK_us , FK_tipo_doc)
   VALUE(  :puntos , :fecha , :FK_us , :FK_tipo_doc)";
   $stm = $this->db->prepare($sql);
   $stm->bindValue(":puntos",      $a[0], PDO::PARAM_INT );
   $stm->bindValue(":fecha",       $a[1], PDO::PARAM_STR );
   $stm->bindValue(":FK_us",       $a[2], PDO::PARAM_STR );
   $stm->bindValue(":FK_tipo_doc", $a[3], PDO::PARAM_STR );
   $r = $stm->execute();
   if($r){
      return true;
   }else{
      return false;
   }

}// fin de insert punto
//=============================================
//============================================
//CROL USUARIO

  //METODOS

   public function insertrRolUs($a){
      $sql = "INSERT INTO rol_usuario(FK_rol,FK_us,FK_tipo_doc,fecha_asignacion,estado)
      VALUES (?,?,?,?,?)";
      //PDO::PARAM_INT
      //PDO::PARAM_STR
      $stm = $this->db->prepare($sql);
      foreach( $a as $i => $d ){
      $stm->bindValue( 1, $d[10], PDO::PARAM_INT );
      $stm->bindValue( 2 ,$d[0] , PDO::PARAM_STR );
      $stm->bindValue( 3 ,$d[9] , PDO::PARAM_STR  );
      $stm->bindValue( 4 ,$d[11] , PDO::PARAM_STR );
      $stm->bindValue( 5 ,$d[12] ,  PDO::PARAM_STR );
      //$stm->bindValue( 5 , 1 ,  PDO::PARAM_STR );
      }
      $bool = $stm->execute();
      if($bool){
        return true;
      }else{
        return $a;
      }
   }
   

//========================================
//=======================================
//CROL

   public function rolMenu($id_rol){
      $sql = 'SELECT acronimo, nom_rol, permisos , token
      FROM `rol` 
      WHERE `ID_rol_n` LIKE :acronimo';
      $stm = $this->db->prepare($sql);
      $stm->bindValue(":acronimo", $id_rol,   PDO::PARAM_STR );    
      $stm->execute();
      $result = $stm->fetchAll();
      return $result;
   }


   // metodo ver roles                            R
   public function verRol(){
      $sql = "SELECT DISTINCT * FROM rol";
      $consulta = $this->db->prepare($sql);
      $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
   }// fin de lectura rol

   

   // metodo ver rol por id                   R
   public function verRolId($id){
      $sql = "SELECT * FROM rol WHERE ID_rol_n = $id";
      $consulta = $this->db->prepare($sql);
      $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
   }// fin de ver rol por ID

   // Actualizar datos                       U
   public function insertUpdateRol( $a){ 
      $sql = "UPDATE rol_usuario SET FK_rol= :FK_rol  WHERE FK_us = :FK_us";
      $stm = $this->db->prepare($sql);
      $stm->bindValue(":FK_rol", $a[10], PDO::PARAM_INT );
      $stm->bindValue(":FK_us", $a[0],   PDO::PARAM_STR );
      $ri = $stm->execute();
      if($ri){ 
         return true;
      }

   }// fin de insert update rol       

   // Borrar rol                               D
   public function eliminarRol($id){ 
      $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
      $stm = $this->db->prepare($sql1);
      $res = $stm->execute();
      if($res){
         $sql2 = " DELETE FROM rol WHERE ID_rol_n = :ID_rol_n ";
         $stm->bindValue(":ID_rol_n", $id, PDO::PARAM_INT );
         $stm = $this->db->prepare($sql2);
         $res1 = $stm->execute(); 
      }
      if($res1){
         $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
         $stm = $this->db->prepare($sql3);
         $res2 = $stm->execute();
      }
      if($res2){
         return true;
      }else{
         return false;
      }
   }



//Borrar registro de rol de tabla Rol_usuario
public function eliminarRoldeUsuario($id){ 
   $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
   $stm = $this->db->prepare($sql1);
   $res = $stm->execute();
      $res  = true;
   if($res){
      $sql2 = "DELETE FROM rol_usuario WHERE FK_us = $id";
      $stm = $this->db->prepare($sql2);
      $res1 = $stm->execute(); 
   }
   if($res1){
      $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
      $stm = $this->db->prepare($sql3);
      $res2 = $stm->execute();
   }
   if($res2){
      return true;
   }else{
      return false;
   }
}







//======================================
//======================================
//CTELEFONO
   public function insertTelefonoUsuario($a){
      $sql = "INSERT INTO telefono ( tel,CF_us)values(:tel , :CF_us )";
      $stm = $this->db->prepare($sql);
      $stm -> bindValue (":tel",  $a[0], PDO::PARAM_STR  );
      $stm -> bindValue (":CF_us",$a[1], PDO::PARAM_STR );
      $insert = $stm->execute();
      if($insert){   
         $_SESSION['message'] =  'A registrado telefono para su cuenta, si desea ingresa otro telefono, favor digite';
         $_SESSION['color']   = 'success'; 
         return true;
       }else{
         $_SESSION['message'] =  'No registro telefono';
         $_SESSION['color'] = 'danger'; 
         return false;
      }
   }// fin de insert telefono usuario

// muestra los datos por id------------------------------------------------------------
   public function verTelefonosUsuarioPorID($id){
      $sql = "SELECT U.ID_us , U.nom1 , U.ape1 , R.nom_rol , T.tel
         from rol R join rol_usuario R_U on R.ID_rol_n = R_U.FK_rol
         join usuario U on R_U.FK_us = U.ID_us
         join telefono T on  U.ID_us = T.CF_us
         where CF_us = :id";
      $consulta= $this->db->prepare($sql);
      $consulta->bindValue(':id', $id);
      $result = $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
   }
   // Fin de mostrar datos por id
//-----------------------------------------------------------------------------------------


// muestra los datos por id------------------------------------------------------------
public function verTelefonosUsuario(){
   $sql = "SELECT U.ID_us , U.nom1 , U.ape1 , R.nom_rol , T.tel
   from rol R join rol_usuario R_U on R.ID_rol_n = R_U.FK_rol
   join usuario U on R_U.FK_us = U.ID_us
   join telefono T on  U.ID_us = T.CF_us";
   $consulta= $this->db->prepare($sql);
   $result = $consulta->execute();
   $result = $consulta->fetchAll();
   return $result;
}
   // Fin de mostrar datos por id
   //------------------------------------------------------------------------------------------


// muestra los datos por rol------------------------------------------------------------
   public function verTelefonosUsuarioRol($rol){
      $sql = "SELECT U.ID_us , U.nom1 , U.ape1 , R.nom_rol , T.tel
         from rol R join rol_usuario R_U on R.ID_rol_n = R_U.FK_rol
         join usuario U on R_U.FK_us = U.ID_us
         join telefono T on  U.ID_us = T.CF_us
         where R_U.FK_rol = :rol";
      $consulta= $this->db->prepare($sql);
      $consulta -> bindValue (":rol",$rol);
      $result = $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
   }
   // Fin de mostrar telefono rol
   //------------------------------------------------------------------------------------------

// muestra telefonos de empresa------------------------------------------------------------
public function verTelefonosEmpresa(){
   $sql = "SELECT E_P.ID_rut , E_P.nom_empresa , T.tel
   from empresa_provedor  E_P 
   join telefono T on E_P.ID_rut = T.CF_rut;";
   $consulta= $this->db->prepare($sql);
   $result = $consulta->execute();
   $result = $consulta->fetchAll();
   return $result;
}
   // Fin de ver telefonos empresas
   //------------------------------------------------------------------------------------------
 
   
   // Filtro por id
 

   public function eliminarTelefono($idg){
      $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
      $consulta2 = $this->db->prepare($sql1);
           $rest1 =  $consulta2->execute();   
      if ($rest1) {
         $sql2 = "DELETE FROM telefono WHERE CF_us =:CF_us ";   
         $consulta3 = $this->db->prepare($sql2);
         $consulta3->bindValue(":CF_us",$idg, PDO::PARAM_STR);
         $res2 = $consulta3->execute();  
      }   
      if ($res2) {
         $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
         $consulta4 = $this->db->prepare($sql3);
         $res3 = $consulta4->execute();
      }
      if ($res3) {
         $_SESSION['message'] = $_SESSION['usuario']['nom1'] . 'Elimino telefono';
         $_SESSION['color'] = 'success';
         return true;
      } else {
         $_SESSION['message'] = 'No elimino telefono';
         $_SESSION['color'] = 'danger';
         return false;
      }
   }

   //CTIENDA
   public function listaProductos(){
      $sql = "SELECT * from productos";
      $consulta= $this->db->prepare($sql);
      $result = $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
      foreach ($result as $row) {
         $lista[]=$row;
      }
      return $lista;
   }
//===================================================
//==================================================
//CNOTIFICACION

    //Insertar notificacion--------------------------------------------------------------
   public function insertNotific($a) {
      $sql = "INSERT into notificacion( estado, descript, FK_rol , FK_not ) 
      VALUES (? , ? , ? , ?)";
      $stm = $this->db->prepare($sql);
      $stm->bindValue( 1, $a[1], PDO::PARAM_INT );
      $stm->bindValue( 2, $a[2], PDO::PARAM_STR );
      $stm->bindValue( 3, $a[3], PDO::PARAM_STR );
      $stm->bindValue( 4, $a[4], PDO::PARAM_INT );
      $bool = $stm->execute();
      if($bool){
         return true;
      }else{
          return $a;
      }
   }
    // fin de insert notificacion----------------------------------------------------

    // Notificacion leida-----------------------------------------------------------------
   public function notificacionLeida($id) {
      $sql = "UPDATE notificacion SET estado = 1
      WHERE ID_not = ?";
      $stm = $this->db->prepare($sql);
      $stm->bindValue( 1, $id, PDO::PARAM_INT );
      $bool = $stm->execute();
      if($bool){
         return true;
      }else{
         return false;
      }
   } // Fin de leer notificacion----------------------------------------------------

    // Ver notificacion------------------------------------------------------------------
   public function verNotificacion($id_rol){
      $sql = "SELECT N.ID_not , N.estado , N.descript , 
      N.FK_rol , N.FK_not ,  t.nom_tipo
      FROM notificacion N join tipo_not T ON N.FK_not = T.ID_tipo_not
      join rol R ON N.FK_rol = ID_rol_n
      WHERE R.ID_rol_n = ? and  N.estado = '0'";
      $stm = $this->db->prepare($sql);
      $stm->bindValue( 1, $id_rol, PDO::PARAM_INT );
      $result = $stm->execute();
      return $result;
   } // fin de ver notificaiones por rol------------------------------------------------

    // Conteo de mensajes------------------------------------------------------------------
   public function verNotificaciones($id_rol) {
      //$this->ver($id_rol, 1);
      $sql = "SELECT N.ID_not , N.estado , N.descript , N.FK_rol , N.FK_not,
      T.nom_tipo
         FROM notificacion N 
         JOIN tipo_not T ON N.FK_not = T.ID_tipo_not
         JOIN rol R ON N.FK_rol = ID_rol_n
      WHERE R.ID_rol_n = ? and  N.estado = '0'";
      $stm = $this->db->prepare($sql);
      $stm->bindValue( 1, $id_rol, PDO::PARAM_INT );
      $stm->execute();
      $r = $stm->fetchAll();
      return $r;
   } // fin de conteo de notificaciones------------------------------------------------

    // Notificacion de nueva cuenta a admin--------------------------------------------
   public function notInsertUsuarioAdmin($a){
    //  $this->ver($a, 1);
      $sql =  "INSERT INTO notificacion( estado, descript, FK_rol , FK_not ) 
      VALUES ( ?, ?, ?, ?)";
      $stm = $this->db->prepare($sql);
      $stm->bindValue( 1, $a[0], PDO::PARAM_STR );
      $stm->bindValue( 2, $a[1], PDO::PARAM_STR );
      $stm->bindValue( 3, $a[2], PDO::PARAM_INT );
      $stm->bindValue( 4, $a[3], PDO::PARAM_INT );
      $result = $stm->execute();
      return $result;
   } // fin de notificacion admin------------------------------------------------------

   // Eliminar notificaciones de usuario ----------------------------------------------
   public function deleteNotificacionAdmin($ID_not){
      $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
      $stm = $this->db->prepare($sql1);
      $res = $stm->execute();
      if ($res) {
         $sql2 = "DELETE from notificacion where ID_not = ? ";
         $stm->bindValue( 1, $ID_not , PDO::PARAM_INT );
         $stm = $this->db->prepare($sql2);
         $res1 = $stm->execute();
      } // fin de if $res
      if ($res1) {
         $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
         $stm = $this->db->prepare($sql3);
         $res2 = $stm->execute();
         if ($res2) {
            return true;
         } else {
            return false;
         } // fin de if de message
      } // fin de if $res2¡
   } // fin de metodo eliminar notificaciones-----------------------------------------------------------
   //=================================================================================
   //================================================================================
   //CLOG
   public function deleteLog($id_log){
      $sql = "DELETE from modific where ID_modifc = ? ";
      $stm = $this->db->prepare($sql);
      $stm->bindValue( 1, $id_log , PDO::PARAM_INT );
      $res = $stm->execute();
      if ($res) {
         return true;
      } else {
         return false;
      } // fin de if de message
   }
   




} //Fin Clase Usuario




        
          # Pasar en el mismo orden de los ?


     /* if ($result = true) {
          echo '<script>alert("inserto datos");</script>';
         // $_SESSION['message'] = "Actualizacion exitosa";
         // $_SESSION['color'] = "primary";
      } else {
          echo '<script>alert("no actualizo");</script>';
         // $_SESSION['message'] = "Fallo actualizacion";
         // $_SESSION['color'] = "danger";
      }
      header("location: ../forms/FormEmpresa.php"); */












  /* public function deleteUserModel($id_get){
      $sql = "DELETE FROM sicloud.usuario WHERE ID_us = :id";
      $consulta = $this->db->prepare($sql);
      if($consulta->execute()){
         echo 'Usuario eliminado correctamente';
      } else {
         echo 'El usuario no pudo ser eliminado';
      }
   } */



 /* public function ver($dato, $sale=0, $float= false, $email=''){
      echo '<div style="background-color:#fbb; border:1px solid maroon;  margin:auto 5px; text-align:left;'. ($float? ' float:left;':'').' padding:7px; border-radius:7px; margin-top:10px">';
      if(is_array($dato) || is_object($dato) ){
          echo '<pre><br><b>&raquo;&raquo;&raquo; DEBUG</b><br>'; print_r($dato); echo '</pre>'; 
      }else{
          if(isset($dato)){
              echo '<b>&raquo;&raquo;&raquo; DEBUG &laquo;&laquo;&laquo;</b><br><br>'.nl2br($dato); 	
          }else{
              echo 'LA VARIABLE NO EXISTE';
          }
      }
      echo '</div>';
      if($sale==1) die();
  }
  */

   /* public function VerifyLogin($nombre, $password){
      $this->nombre = $nombre;
      $this->pass = $password;
      $this->db = self::conexionPDO();
      $infousuario = $this->SearchUsuario();
      foreach($infousuario as $usuario){
          if(password_verify($password, $usuario->pass)){
          $_SESSION['nombre'] = $usuario->nombre;
          $_SESSION['pass'] = $usuario->pass;
          $_SESSION['rol'] = $usuario->rol;
          } else {
              echo 'Contraseña Incorrecta';
          }
      }      
   } 

   public function SearchUsuario(){
      $sql = "SELECT * FROM usuario WHERE nombre = '$this->nombre'";
      $consulta = $this->db->prepare($sql);
      $consulta->execute();
      $objconsulta = $consulta->fetchAll(PDO::FETCH_OBJ);
      return $objconsulta;
   }
} */

   
   
   /*
   public function verUsuarios(){
      $sql = "SELECT distinct U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.pass, U.foto, U.correo, 
         R.nom_rol,  R.nom_rol,
         R_U.estado
         FROM sicloud.usuario U 
         JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
         JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n";
      $consulta = $this->db->prepare($sql);
      $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;  
    } // fin de busqueda por ID
/*
   public function insertUpdateUsuario($idg){
      $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
      $consulta1 = $this->db->prepare($sql1);  
      $res = $consulta1->execute();
      if($res){
         $sql2 = "UPDATE sicloud.usuario SET ID_us = '$this->ID_us',nom1 = '$this->nom1' ,  nom2 = '$this->nom2' ,ape1 = '$this->ape1' , ape2 = '$this->ape2' , fecha = '$this->fecha' , pass = '$this->pass' , foto = '$this->foto' , correo = '$this->correo' , FK_tipo_doc = '$this->FK_tipo_doc' WHERE  ID_us = $idg   ";

         $res1 = $this->db->query($sql2);
      }   
      if ($res1) {
         $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
         $res2 = $this->db->query($sql3);
      }
      if ($res2) {
         $_SESSION['message'] = 'Se actualizo cuenta de usuario';
         $_SESSION['color'] = 'primary';
      } else {
         $_SESSION['message'] = 'Error no se cuenta de usuario';
         $_SESSION['color'] = 'danger';
      }

      }



      //Crea la consulta y la almasena en la varible $sql

         

   
  /*
  //---------------------------------------------------------------

  //fecha actual
  public function fechaActual(){
       $sql = "SELECT CURDATE() as fecha";
       $dat =  $this->db->query($sql);
       while ($row = $dat->fetch_assoc()) {
          $fecha = $row['fecha'];
       }
   
       return $fecha;
  }


  // Actualzacion de datos por rol usuario---------------------------------------------------------
  public function insertUpdateUsuarioCliente($idg){
     include_once 'session/sessiones.php';
     $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
     $res =   $this->db->query($sql1);   
     if ($res) {
        $sql2 = "UPDATE sicloud.usuario SET  nom1 = '$this->nom1' ,  nom2 = '$this->nom2' ,ape1 = '$this->ape1' , ape2 = '$this->ape2' , fecha = '$this->fecha'   , correo = '$this->correo'  WHERE  ID_us = '$idg' ";
        $res1 = $this->db->query($sql2);
     }   
     if ($res1) {
        $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
        $res2 = $this->db->query($sql3);
     }
     if ($res2) {
        $_SESSION['message'] = $_SESSION['usuario']['nom1'] . ' Actualizo datos';
        $_SESSION['color'] = 'success';
     } else {
        $_SESSION['message'] = 'Error al actualizar datos';
        $_SESSION['color'] = 'danger';
     }
  } //-------------------------------------------------------------------------------------------------------



  // actualizar datos de usario por administrador------------------------------------------------------------
  public function insertUpdateUsuario($idg){
     $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
     $res =   $this->db->query($sql1);   
     if ($res) {
        $sql2 = "UPDATE sicloud.usuario SET ID_us = '$this->ID_us',nom1 = '$this->nom1' ,  nom2 = '$this->nom2' ,ape1 = '$this->ape1' , ape2 = '$this->ape2' , fecha = '$this->fecha' , pass = '$this->pass' , foto = '$this->foto' , correo = '$this->correo' , FK_tipo_doc = '$this->FK_tipo_doc' WHERE  ID_us = $idg   ";
        $res1 = $this->db->query($sql2);
     }   
     if ($res1) {
        $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
        $res2 = $this->db->query($sql3);
     }
     if ($res2) {
        $_SESSION['message'] = 'Se actualizo cuenta de usuario';
        $_SESSION['color'] = 'primary';
     } else {
        $_SESSION['message'] = 'Error no se cuenta de usuario';
        $_SESSION['color'] = 'danger';
     }
  } // fin de update usuario----------------------------------------------------------------------------------


  // insersion a usuario------------------------------------------------------------------------------
  public function insertUsuario(){
    //Crea la consulta y la almasena en la varible $sql
    $sql = "INSERT INTO sicloud.usuario (ID_us,nom1,nom2,ape1,ape2,fecha,pass,foto,correo,FK_tipo_doc)
        VALUES('$this->ID_us ','$this->nom1','$this->nom2','$this->ape1','$this->ape2',' $this->fecha ','$this->pass','$this->foto','$this->correo','$this->FK_tipo_doc')";
    $this->db->query($sql);
 

  } //fin de la funcion insert------------------------------------------------------------------------


  // Muestra los datos en la tabla usuario
  public function selectUsuario(){
    $sql = "SELECT U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.fecha, U.pass, U.foto, U.correo, R_U.estado 
        FROM sicloud.usuario U 
        JOIN  rol_usuario R_U ON R_U.FK_us = ID_us 
        ORDER BY R_U.estado desc ";
    $result = $this->db->query($sql);
    return $result;
  } // fin de muestra los datos de la tabla usuario



  // Incio de select usuario
  static function selectUsuarios($id){
    include_once 'class.conexion.php';
    $c = new Conexion();
    $sql = "SELECT U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2,  U.pass, U.foto, U.correo,  U.fecha, 
       R.nom_rol, R_U.estado, R.ID_rol_n
       FROM sicloud.usuario U 
       JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
       JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n 
       WHERE ID_us = $id ";
    $result = $c->query($sql);
    return $result;
  } // Fin de select usuario

  //ver usuario por un registro id
  static function verUsarioId($idg){
    include_once 'class.conexion.php';
    $db_usuario = new Conexion();
    $sql = "SELECT U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, R.nom_rol, U.pass, U.foto, U.correo, 
       R_U.estado
       FROM sicloud.usuario U 
       JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
       JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n 
       WHERE ID_us = '$idg' ";
    $result = $db_usuario->query($sql);
    return $result;
  } // fin de busqueda por ID






  public function verUsuarios(){
    $sql = "SELECT distinct U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.pass, U.foto, U.correo, 
       R.nom_rol,  R.nom_rol,
       R_U.estado
       FROM sicloud.usuario U 
       JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
       JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n";
    $result = $this->db->query($sql);
    return $result;
  } // fin de busqueda por ID


  //Busqueda por estado pendiente
  public function selectUsuariosPendientes($est){
    $sql = "SELECT U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.pass, U.foto, U.correo,  
       R.nom_rol, 
       R_U.estado
       FROM sicloud.usuario U 
       JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
       JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n 
       WHERE R_U.estado = '$est' ";
    $result = $this->db->query($sql);
    return $result;
  } //Busqueda por estado pendiente


  //aprobar solicitud
  public function activarCuenta($id){
    $sql = " UPDATE sicloud.rol_usuario 
       SET rol_usuario.estado = 1 
       WHERE rol_usuario.FK_us = $id ";
    $insert = $this->db->query($sql);
    // if($insert){ echo "<script>alert('Se desactivo cuenta');</script>";   echo "<script>window.location.replace('../CU009-controlUsuarios.php');</script>"; }else{ echo "<script>alert(no se ha activado');</script>"; echo "<script>window.location.remplace('../CU009-controlUsuarios.php');</script>"; } 
    if ($insert) {
      $_SESSION['message'] = "Activo cuenta de usuario";
      $_SESSION['color'] = "success";
    } else {
      $_SESSION['message'] = "Error al activar cuenta";
      $_SESSION['color'] = "success";
    }
    header("location: ../CU009-controlUsuarios.php ");
  } // fin de aprbar solicitud

  //desactivar cuenta
  public function desactivarCuenta($id){
     $sql = " UPDATE sicloud.rol_usuario 
        SET rol_usuario.estado = 0 
        WHERE rol_usuario.FK_us = $id ";
     $conexion = $this->db->query($sql);
     if ($conexion) {
        $_SESSION['message'] = "Desactivo cuenta de usuario";
        $_SESSION['color'] = "danger";
     } else {
        $_SESSION['message'] = "Error al descativar cuenta";
        $_SESSION['color'] = "danger";
     }
     header("location: ../CU009-controlUsuarios.php ");
  } // fin de desactibar cuenta


  //Compara contraseña tabla usuario--------------------------------------------------------------------------
  public function DocPass($ID_us, $pass, $doc){
     $sql = " SELECT U.* , TD.ID_acronimo , 
        RU.estado , 
        R.ID_rol_n , R.nom_rol 
        FROM tipo_doc TD 
        JOIN usuario U ON TD.ID_acronimo = U.FK_tipo_doc 
        JOIN rol_usuario RU ON U.ID_us = RU.FK_us 
        JOIN rol R ON FK_rol = R.ID_rol_n  
        WHERE U.ID_us =  '$ID_us' 
        AND U.pass = '$pass' 
        AND TD.ID_acronimo = '$doc' ";
     $result = $this->db->query($sql);
     return $result;
  } // fin de comprobar contraseña----------------------------------------------------------------------------------


  //---------------------------------------------------------------------------------------------------------------
  //Cambio de contraseña
  public function cambioPass($id,  $contraseñaNueva){
     $sql = "UPDATE usuario 
        SET pass = '$contraseñaNueva' 
        WHERE ID_us = '$id'";
     // echo $sql;
     $r = $this->db->query($sql);
     if ($r) {
        $_SESSION['message'] = "Cambio contraseña";
        $_SESSION['color'] = "success";
     } else {
        $_SESSION['message'] = "Error al cambiar contraseña";
        $_SESSION['color'] = "danger";
     }
    //-------------------------------------------------------------------------
  }


  public function validarPass($id, $pass){
    $sql = "SELECT * FROM usuario 
       WHERE ID_us = '$id' 
       AND pass = '$pass'";
    $i = $this->db->query($sql);
    return $i;
  }


  // insertar foto
  public function inserTfoto($destino, $id){
     $sql = "UPDATE  usuario 
        SET foto = ('$destino')
        WHERE ID_us = '$id'";
     $e = $this->db->query($sql);
     ($e) ??  header("location: ../CU002-registrodeUsuario.php ");

  }


  // filtro por rol
  public function  selectUsuarioRol($r){
     $sql = "SELECT U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.pass, U.foto, U.correo,
        R.nom_rol,  
        R_U.estado
        FROM sicloud.usuario U 
        JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
        JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n
        WHERE R.ID_rol_n  = '$r'
        ORDER BY u.nom1 asc";
     $resultConsulta = $this->db->query($sql);
     // consulta para mensaje de rol 
     if ($resultConsulta) {   
        $sql2 = "SELECT nom_rol FROM rol 
           WHERE ID_rol_n = $r 
           LIMIT 1";
        $datos  = $this->db->query($sql2);
        $row = $datos->fetch_assoc();
        $rol = $row['nom_rol'];
        $_SESSION['message'] = "Filtro por rol:  " . $rol;
        $_SESSION['color'] = "info";
        return $resultConsulta;
     }
  } // fin de metodo select usaurio



  // ver puntos usuario
  static function verPuntosUs(){
     include_once 'class.conexion.php';
     $c = new Conexion;
     $sql = "SELECT P.id_puntos, P.puntos, P.fecha , 
        U.nom1 , U.nom2 , U.ape1
        FROM puntos P 
        JOIN usuario U ON  P.FK_us =  U.ID_us
        ORDER BY U.nom1 asc";
     $con = $c->query($sql);   
     return $con;
  }

  static function verPuntosYusuario($id){
     include_once 'class.conexion.php';
     $c = new Conexion;
     $sql = " SELECT U.ID_us  , U.nom1 , U.nom2 , U.ape1 , U.ape2 , U.fecha , U.pass , U.foto , U.correo , 
     TD.nom_doc , 
     RU.estado , 
     R.ID_rol_n , R.nom_rol , 
     P.puntos
        FROM tipo_doc TD 
        JOIN usuario U ON TD.ID_acronimo = U.FK_tipo_doc 
        JOIN rol_usuario RU ON U.ID_us = RU.FK_us 
        JOIN rol R ON FK_rol = R.ID_rol_n 
        JOIN puntos P ON U.ID_us = P.FK_us
        WHERE U.ID_us = '$id'";   
     $con = $c->query($sql);
     return $con;
  }



  public function conteoUsuariosActivos(){
     $sql = "SELECT count(*) AS usuariosActivos 
        FROM usuario  U JOIN rol_usuario RU ON RU.FK_us = U.ID_us
        WHERE RU.estado = 1";
     $datos = $this->db->query($sql);
     while ($row = $datos->fetch_assoc()) {
        $con = $row['usuariosActivos'];
     }
     return $con;
  }


  public function conteoUsuariosInactivos(){
     $sql = "SELECT count(*) AS usuariosActivos 
        FROM usuario  U 
        JOIN rol_usuario RU ON RU.FK_us = U.ID_us
        WHERE RU.estado = 0";
     $datos = $this->db->query($sql);
     while ($row = $datos->fetch_assoc()) {
       $con = $row['usuariosActivos'];
     }
     return $con;
  }


  public function conteoUsuariosTotal(){
     $c = new Conexion;
     $sql = "SELECT count(*) AS usuariosActivos 
        FROM usuario  U 
        JOIN rol_usuario RU ON RU.FK_us = U.ID_us
     ";
     $datos = $this->db->query($sql);
     while ($row = $datos->fetch_assoc()) {
       $con = $row['usuariosActivos'];
       }
     return $con;
  }
}// fin de clase usaurio



*/



//$objMod->insertUsuario( 1030 ,' nom1' ,'nom2','ape1','ape2','10-04-2020','pass','foto','correo','CC'  );

?> 
