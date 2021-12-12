<?php
include_once 'clases/class.conexion.php';
include_once 'clases/class.SQL.php';
$db = new SQL;
$datos = $db->verMensaje1();
foreach(  $datos as $d ){  ?>
<li class="other">      
            <div class="msg"> 
                <p class="text-primary" ><?= $d['nom_us'] ?></p>
                <i class="far fa-comment"></i>
                <p><?= $d['descript'] ?>
                </p>
                <time><?= $d['nom_us'] ?> </time>
            </div>
        </li>
    <?php
}
?>

