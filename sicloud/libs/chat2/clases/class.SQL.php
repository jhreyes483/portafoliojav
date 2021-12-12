<?php

class SQL
{

    public function __construct()
    {
        $this->db = Conexion::conexionPDO();
    }

/*
    protected $estado;
    protected $descript;
    protected $FK_rol;
    protected $FK_not;
    protected $ID_not;

    public function __construct($_estado, $_descript, $_FK_rol, $_FK_not)
    {
        $this->estado = $_estado;
        $this->descript = $_descript;
        $this->FK_rol = $_FK_rol;
        $this->FK_not = $_FK_not;
    }

*/
    //Insertar mensaje--------------------------------------------------------------
    public function insertMensaje(array $d){
        $sql = "INSERT into mensaje( estado, descript, nom_us , FK_ms ) 
        VALUES (?, ?, ?, ?)";
        $insert = $this->db->prepare($sql);
        $insert->bindValue(1, $d[0] );
        $insert->bindValue(2, $d[1] );
        $insert->bindValue(3, $d[2] );
        $insert->bindValue(4, $d[3] );
        return $insert->execute();
    } // fin de insert mensaje----------------------------------------------------

    public function verMensaje1(){
        $sql = "SELECT * FROM mensaje 
        ORDER BY  ID_not desc
         ";
        $c   = $this->db->prepare($sql);
        $c->execute();
        $r   = $c->fetchAll();
        return $r;
    }

}// FIN DE CLASE USUARIO
