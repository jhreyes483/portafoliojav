<?php
include_once 'class.conexion.php';
class SQL extends Conexion{
   public $db;
   public function __construct() {
      $this->db = Conexion::conexionPDO();
   } 
   static function ningunDato(){
      return new self ();
   }


// CCUSER   
   public function store($d){
     // Controller::ver($d,1);
      $sql =
      "INSERT INTO users (id_doc, name1, name2 , last_name1, last_name2, email, create_date, gender, img, password, fk_rol, fk_doc_acron, estatus) 
      VALUES (? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ?)";
      $insertar = $this->db->prepare($sql);
      $insertar->bindValue(1, $d[0] );
      $insertar->bindValue(2, $d[1] );
      $insertar->bindValue(3, $d[2] );
      $insertar->bindValue(4, $d[3] );
      $insertar->bindValue(5, $d[4] );
      $insertar->bindValue(6, $d[5] );
      $insertar->bindValue(7, $d[6] );
      $insertar->bindValue(8, $d[7] );
      $insertar->bindValue(9, $d[8] );
      $insertar->bindValue(10, $d[9] );
      $insertar->bindValue(11, $d[10] );
      $insertar->bindValue(12, $d[11] );
      $insertar->bindValue(13, $d[12] );
      return $insertar->execute();
   }

//CCDOC
   public function verDocumeto(){
      $sql = "SELECT * FROM document_types";
      $consulta = $this->db->prepare($sql);
      $consulta->execute();
      $result =  $consulta->fetchAll();
      return $result;
   }
                        
   public function verRol(){
      $sql = "SELECT * FROM roles";
      $consulta = $this->db->prepare($sql);
      $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;
   }// fin de lectura rol

   public function verCategoria(){
      $sql = "SELECT * FROM categories";
      $consulta = $this->db->prepare($sql);
      $consulta->execute();
      $result = $consulta->fetchAll(); 
      return $result;
  }


  public function verCategoriasId($id){
   $sql = "SELECT * FROM `categories` WHERE `fk_cate_prin` = $id";
   $consulta = $this->db->prepare($sql);
   $consulta->execute();
   $result = $consulta->fetchAll(); 
   return $result;
}

  //SELECT * FROM `categories` WHERE `fk_cate_prin` = 1

//===========================================
//CPRODUCTO
   //query insertar producto                                     C
   public function insertarProducto($a){
      $sql ="INSERT INTO products ( name_prod, prices, stok, est_com, est_sis, descript, create_date, fk_cate, img) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
       $stm = $this->db->prepare($sql);
       $stm->bindValue(1, $a[0]);
       $stm->bindValue(2, $a[1]);
       $stm->bindValue(3, $a[2]);
       $stm->bindValue(4, $a[3]);
       $stm->bindValue(5, $a[4]);
       $stm->bindValue(6, $a[5]);
       $stm->bindValue(7, $a[6]);
       $stm->bindValue(8, $a[7]);
       $stm->bindValue(9, $a[8]);
       return $stm->execute();

    } // fin de javaScript

   // select * from products join categories on id_cate = fk_cate;

   public function verProducts(){
      $sql= "SELECT * FROM products join categories on id_cate = fk_cate" ;
      $consulta = $this->db->prepare($sql);
      $consulta->execute();
      $result =  $consulta->fetchAll();
      return $result;
   }

   
   public function verProductsId($id){
      $sql= 'SELECT * FROM products 
      join categories on id_cate = fk_cate
      WHERE id_cate = '.$id  ;
      $consulta = $this->db->prepare($sql);
      $consulta->execute();
      $result =  $consulta->fetchAll();
      return $result;
   }

   public function buscarPorNombreProducto($buscar){
      $sql = "SELECT * FROM products join categories on id_cate = fk_cate
      WHERE name_prod 
      LIKE '%$buscar%'
      order by name_prod";
      $consulta = $this->db->prepare($sql);
      $consulta->execute();
      return $consulta->fetchAll();
   }
   



   public function deleteUser($id){
      $sql ='DELETE from users 
      WHERE id_doc = :id';
         $c = $this->db->prepare($sql);
         $c->bindValue(":id", $id, PDO::PARAM_STR);
         $c->execute();
         return $c->fetchAll();
   }

public function verUsuarios(){
      $sql = "SELECT * FROM `users` WHERE `fk_rol` = 2 ORDER BY `id_doc` ASC
      ";
      $c = $this->db->prepare($sql);
      $c->execute();
      $r = $c->fetchAll();
      return $r;
} // Fin de select usuario
   
// factura
public function selectUsuarios($id){
   $sql = "SELECT * FROM users
   WHERE id_doc = :id
   LIMIT 1
   ";
   $c = $this->db->prepare($sql);
   $c->bindValue(":id", $id, PDO::PARAM_STR);
   $c->execute();
   $r = $c->fetchAll();
   return $r;
} // Fin de select usuario


public function verProductos(){
   $sql = "SELECT * FROM products 
   JOIN categories on id_cate = fk_cate
   order by  name_prod  desc ";
   $stm = $this->db->prepare($sql);
   $stm->execute();
   $result = $stm->fetchAll();
   return $result;
} // fin de ver productos

public function verVentasFechaEstado($fecha = '', $estado = ''){
   $estado =($estado =='' )? '':' AND F.estatus = '.$estado.'';
   $sql =
   'SELECT F.date_inv, U.name1, U.last_name1, F.total,  F.iva, F.estatus,  F.id_factura, P.name_payment,
   F.obs
      FROM invoices F 
      JOIN users U ON U.id_doc = F.fk_user 
      JOIN payment P ON F.fk_payment = P.id_payment  
      WHERE F.date_inv BETWEEN :f1 AND  :f2'.$estado.'
      ';
      $stm = $this->db->prepare($sql);
      $stm->bindValue(':f1', $fecha[0] , PDO::PARAM_STR);
      $stm->bindValue(':f2', $fecha[1] , PDO::PARAM_STR);
      $stm->execute();
      $result = $stm->fetchAll();
      return $result;
}

public function verVentasFechaEstadoClietne($fecha = '', $estado = '', $cliente=''){
   $estado =($estado =='' )? '':' AND F.estatus = '.$estado.'';
   $sql =
   'SELECT F.date_inv, U.name1, U.last_name1, F.total,  F.iva, F.estatus,  F.id_factura, P.name_payment
      FROM invoices F 
      JOIN users U ON U.id_doc = F.fk_user 
      JOIN payment P ON F.fk_payment = P.id_payment  
      WHERE F.date_inv BETWEEN :f1 AND  :f2'.$estado.'
      AND id_doc = '.$cliente.'';
      $stm = $this->db->prepare($sql);
      $stm->bindValue(':f1', $fecha[0] , PDO::PARAM_STR);
      $stm->bindValue(':f2', $fecha[1] , PDO::PARAM_STR);
      $stm->execute();
      $result = $stm->fetchAll();
      return $result;
}

public function verUsuarioId($id){
   $sql = 'SELECT * 
   FROM users 
   JOIN roles ON id_rol = fk_rol
   WHERE id_doc = :id';
   $stm = $this->db->prepare($sql);
   $stm->bindValue(':id', $id , PDO::PARAM_INT);
   $stm->execute();
   $result = $stm->fetchAll();
   return $result;
}

public function verFacturaIdF($id){ 
   $sql= 'SELECT date_inv  
   FROM invoices 
   WHERE id_factura = :id';
   $stm = $this->db->prepare($sql);
   $stm->bindValue(':id', $id , PDO::PARAM_INT);
   $stm->execute();
   return $stm->fetchAll();
}

public function verFacturaId($id){ 
   $sql= 'SELECT F.id_factura , U.name1 , U.name2, U.last_name1, U.last_name2, U.email, P.name_payment, 
   F.date_inv, F.total, U.id_doc
   FROM invoices F
   JOIN users U ON U.id_doc = F.fk_user
   JOIN payment P ON P.id_payment = F.fk_payment 
   WHERE id_factura = :id';
   $stm = $this->db->prepare($sql);
   $stm->bindValue(':id', $id , PDO::PARAM_INT);
   $stm->execute();
   return $stm->fetchAll();
}

public function verProductosFacturaId($id){
   $sql = 'SELECT IP.amount, IP.sub_total, P.name_prod, P.prices, P.id_prod , P.stok
   FROM invoices_products IP 
   JOIN products P ON P.id_prod = IP.fk_prod 
   WHERE IP.fk_invoices = :id';
   $stm = $this->db->prepare($sql);
   $stm->bindValue(':id', $id , PDO::PARAM_INT);
   $stm->execute();
   return  $stm->fetchAll();
}

public function anulaFactura($id, $tipo=null ){
   // 1 activa factura - 2 peticion de reembolso 
   $sql= "UPDATE invoices 
   SET estatus = :estatus 
   WHERE invoices.id_factura = :id
   ";
   $stm = $this->db->prepare($sql);
   $stm->bindValue(':estatus', $tipo , PDO::PARAM_INT);
   $stm->bindValue(':id', $id , PDO::PARAM_INT);
   return $stm->execute();
}

public function verificaExisteUs($id){
   $sql = 'SELECT * FROM `users` 
   WHERE `id_doc` = :id';
   $stm = $this->db->prepare($sql);
   $stm->bindValue(':id', $id , PDO::PARAM_INT);
   $stm->execute();
   return  $stm->fetchAll();
}

public function verCreditos(){
   $sql = 'SELECT * FROM credits';
   $consulta = $this->db->prepare($sql);
   $consulta->execute();
   $result = $consulta->fetchAll();
   return $result;  
}

public function verPagos(){
   $sql = 'SELECT * FROM payment';
   $consulta = $this->db->prepare($sql);
   $consulta->execute();
   $result = $consulta->fetchAll();
   return $result;  
}

public function facturar($a){
   // Controller::ver($a,1,2,'Insert factura d');
   $sql ='INSERT INTO invoices ( total , date_inv , iva , fk_payment , fk_credits , fk_user , fk_doc, estatus ) 
   VALUES (?, ?, ?, ?, ?, ?, ?,  ?)';   
   $consulta = $this->db->prepare($sql);
   $consulta->bindValue(1,       $a[0], PDO::PARAM_INT);
   $consulta->bindValue(2,       $a[1], PDO::PARAM_STR);
   $consulta->bindValue(3,       $a[2], PDO::PARAM_INT);
   $consulta->bindValue(4,       $a[3], PDO::PARAM_INT);
   $consulta->bindValue(5,       $a[4], PDO::PARAM_INT);
   $consulta->bindValue(6,       $a[5], PDO::PARAM_INT);
   $consulta->bindValue(7,       $a[6], PDO::PARAM_STR);
   $consulta->bindValue(8,       $a[7], PDO::PARAM_STR);
   $consulta->execute();
   $id = $this->db->lastInsertId();
   return $id;
}

public function insertaProductosFactura($a){
   //Controller::ver($a, 1,2,'metodo facturar   AAA');
   $sql = "INSERT INTO `invoices_products` (sub_total, amount, fk_invoices, fk_prod) 
   VALUES (?,?,?,?)";
   $consulta = $this->db->prepare($sql);
   $consulta->bindValue(1 ,$a[0], PDO::PARAM_INT);
   $consulta->bindValue(2, $a[1], PDO::PARAM_INT);
   $consulta->bindValue(3, $a[2], PDO::PARAM_INT);
   $consulta->bindValue(4, $a[3], PDO::PARAM_INT);
   $r = $consulta->execute();
   if($r){
      return true;
   }else{
      return false;
   }
}

public function updateCantidadProducto(array $a){
   // 0 = stok, 1 = id_producto
   $sql = 
   'UPDATE products 
   SET stok = :stok
   WHERE id_prod = :id';
   $consulta = $this->db->prepare($sql);
   $consulta->bindValue(':stok' ,$a[0], PDO::PARAM_INT);
   $consulta->bindValue(':id', $a[1], PDO::PARAM_INT);
   return $consulta->execute();
}

public function updateObsFactura($a){
 //  Controller::ver($a,1);
   // 0 = obs, 1 = id_factura
   $sql = 'UPDATE invoices 
   SET obs = :obs 
   WHERE invoices.id_factura =:id_factura';
   $consulta = $this->db->prepare($sql);
   $consulta->bindValue(':obs'        ,$a[0], PDO::PARAM_STR);
   $consulta->bindValue(':id_factura', $a[1], PDO::PARAM_INT);
   return $consulta->execute();
}

public function loginUsuarioModel($d){
   $sql = 'SELECT * FROM users 
   join roles on fk_rol = id_rol
   WHERE email        = :email
   AND
   password = :pass
   ';
   $consulta = $this->db->prepare($sql);
      $consulta->bindValue( ':email',        $d[0] , PDO::PARAM_STR );
      $consulta->bindValue( ':pass',         $d[1] , PDO::PARAM_STR );
      $consulta->execute();
      $USER = $consulta->fetch(PDO::FETCH_ASSOC);
      if(($consulta->rowCount() > 0) ){ 
         return $USER;
      }else{
         return false;
      //}
      }
}
   // Actualzacion de datos por rol usuario---------------------------------------------------------
public function insertUpdateUsuarioCliente($a){
      // Controller::ver($a[9],1,1);
       $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
       $consulta1 = $this->db->prepare($sql1);
            $res =  $consulta1->execute();   
       if ($res) {
          $sql2 = "UPDATE users
          SET name1 = :name1, name2 = :name2 , last_name1 = :last_name1, 
          last_name2 =  :last_name2 , estatus = :estatus, email = :email, 
          create_date = :create_date, gender = :gender, img = :img, 
          password  = :password, fk_rol = :fk_rol, fk_doc_acron = :fk_doc_acron
          WHERE id_doc = :id_doc";
          $consulta = $this->db->prepare($sql2);
          $consulta->bindValue(':id_doc',       $a[0]   , PDO::PARAM_STR );
          $consulta->bindValue(':name1',        $a[1]   , PDO::PARAM_STR );
          $consulta->bindValue(':name2',        $a[2]   , PDO::PARAM_STR );
          $consulta->bindValue(':last_name1',   $a[3]   , PDO::PARAM_STR );
          $consulta->bindValue(':last_name2',   $a[4]   , PDO::PARAM_STR );
          $consulta->bindValue(':estatus',      $a[5]   , PDO::PARAM_STR );
          $consulta->bindValue(':email',        $a[6]   , PDO::PARAM_STR );
          $consulta->bindValue(':create_date',  $a[7]   , PDO::PARAM_STR );
          $consulta->bindValue(':gender',       $a[8]   , PDO::PARAM_STR );
          $consulta->bindValue(':img',          $a[9]   , PDO::PARAM_STR );
          $consulta->bindValue(':password',     $a[10]  , PDO::PARAM_STR );
          $consulta->bindValue(':fk_rol',       $a[11]  , PDO::PARAM_INT );
          $consulta->bindValue(':fk_doc_acron', $a[12]  , PDO::PARAM_STR );
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

   }
?>