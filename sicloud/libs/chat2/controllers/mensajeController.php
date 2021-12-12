<?php
include_once '../clases/class.conexion.php';
include_once '../clases/class.SQL.php';
include_once '../../../application/Config.php';
@session_start();
$aV['usuario']['nom1']          =  openssl_decrypt( $_SESSION['usuario']['nom1'], COD, KEY);
$aV['usuario']['nom2']          =  openssl_decrypt( $_SESSION['usuario']['nom2'], COD, KEY);
$aV['usuario']['ape1']          =  openssl_decrypt( $_SESSION['usuario']['ape1'], COD, KEY);
$aV['usuario']['ape2']          =  openssl_decrypt( $_SESSION['usuario']['ape2'], COD, KEY);


$estado = 0;
$nom_us = $aV['usuario']['nom1'].' '.$aV['usuario']['nom2'].' '.$aV['usuario']['ape1'];


$FK_ms =  1;
$descrip = $_GET['mensaje'];




 $notificacion = new SQL();
$a = [ $estado, $descrip, $nom_us , $FK_ms ];

//die();
 $notificacion->insertMensaje($a);
echo '<meta http-equiv="REFRESH" content="0;url=../index.php">';
?>

