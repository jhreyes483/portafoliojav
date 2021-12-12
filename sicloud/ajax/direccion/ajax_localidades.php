<?php 
if(isset($_POST['id'])):
    require "conexion.php";
    $user = new Conexion();
    $u = $user->buscar("localidad", "FK_ciudad=".$_POST['id']);//  
    echo '<option value="">--Seleccione--</option>';
    foreach ($u as $value){
        echo '<option '.((isset($_POST['localidad'] ) && $_POST['localidad'] == $value['ID_localidad'] )? ' selected ': '').' value="'.$value['ID_localidad'].'">'.$value['nom_localidad'].'</option>';
    }
else:
        echo "No hay datos";
endif;

?>

