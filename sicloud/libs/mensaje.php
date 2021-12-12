<?php

//include_once 'clases/class.conexion.php';
//include_once 'clases/class.SQL.php';
$db = new c_notificacion;

$datos = $db->m_verMensajes();
echo'<table bg-primary class=" mx-auto col-lg-10 col-md-10 table table-bordered  table-striped bg-white table-sm mx-auto text-center  text-center">';
echo '<thead>';
echo '<tr><th>Id</th>';
echo '<th class = "col-md-6">Mensajes</th><tr>';
echo '</thead>';
echo '<tbody>';

foreach(  $datos as $d ){
    echo '<tr>';
    echo "<td>".$d['ID_not']."</td>";
    echo "<td>".$d['descript']."</td>";
    echo '</tr>';

}

echo '</tbody>';
echo '</table>';
?>