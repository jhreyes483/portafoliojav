<?php

die('conexion');
class Conexion extends mysqli
{
    private $DB_HOST = 'bmflydmhky78zpgmwam0-mysql.services.clever-cloud.com';
    private $DB_USER = 'ufjhou3db5j6bg6l';
    private $DB_PASS = 'vzqWcZFBTkwMLBZ2FaYQ';
    private $DB_NAME = 'bmflydmhky78zpgmwam0';

    public function __construct()
    {
        parent:: __construct($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
        $this->set_charset('utf-8');
        $this->connect_errno ? die('Error en la conexion' . mysqli_connect_errno()) : $m = 'conectado ;D';
    }
}
