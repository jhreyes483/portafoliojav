<?php 
if(isset($_POST['id'])):

    require "conexion.php";
    $user = new Conexion();
    $u = $user->buscar("barrio", "FK_localidad=".$_POST['id']);
    echo '<option value="">--Seleccione--</option>';
    foreach ($u as $value){
       // $html.="<option value='".$value['ID_barrio']."'>".$value['nom_barrio']."</option>";
       echo '<option '.((isset($_POST['barrio'] ) && $_POST['barrio'] == $value['ID_barrio'] )? ' selected ': '').' value="'.$value['ID_barrio'].'">'.$value['nom_barrio'].'</option>';
    }

else:
        echo "No hay datos";
    
endif;

?>

