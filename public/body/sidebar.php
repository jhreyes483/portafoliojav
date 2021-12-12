<?php
require_once '_controller/indexController.php';
$obj = new indexController;
$r =   $obj->data();


?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion  " style="display: none;" id="accordionSidebar">
<div>
        <!-- Sidebar - Brand --> 
    <a class="sidebar-brand d-flex align-items-center justify-content-center " href="./home.php">
       
        <span class="">
        <br> 
            <i class=" fas fa-laptop-code fs-2"></i> <br>
            J. R.</span>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0 ">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="./home.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>INICIO</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#agenda" aria-expanded="true" aria-controls="agenda">
            <i class="fas fa-user-friends"></i>
            <span>REUNIONES</span>
        </a>
        <div id="agenda" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="javascript:void(0)" onclick="PopupCenter('cal.php','Sicloud-detalle','1000','900');">
                    <i class="far fa-calendar-check"></i>
                    Calendario</a>
                <a class="collapse-item" href="reun.php" title="Detalle de reunion">
                    <i class="far fa-handshake"></i>
                    Dt. Reuniones</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Menu de navegacion
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>ANALISIS</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">DOCUMENTACION:</h6>
                <a class="collapse-item">Levantamiento de <br> Informacion</a>
                <a class="collapse-item">Requerimientos<br>Funcionales</a>
                <!-- 
                        <a class="collapse-item" href="template/controldeversiones.php">Control de Versiones</a>
                 -->

            </div>
        </div>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-database"></i>
            <span>BASE DE DATOS</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">UML:</h6>
                <a class="collapse-item">BPMN</a>
                <a class="collapse-item">Caso de uso</a>
                <a class="collapse-item">Modelo relacional</a>
                <a class="collapse-item">Diagrama de clases</a>
                <a class="collapse-item">SQL</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#proyectos" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-code"></i>
            <span>PROYECTOS</span>
        </a>
        <div id="proyectos" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">HEROKU:</h6>
                <?php
                foreach ($r['proyectos'] as $d) {
                    echo '<a class="collapse-item" href="' . $d[4] . '">' . $d[8] . '</a> ';
                }
                ?>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#requer" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="far fa-file-alt"></i>
            <span>REQ F.</span>
        </a>
        <div id="requer" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">SICLOUD:</h6>
                <?php
                foreach ($r['proyectos'] as $d) {
                ?>
                    <p>
                        <span class="collapse-item"><?= $d[8] ?></span>
                        <a href="./requer.php?id_proyecto=<?= $d[0] ?>&a=requer" class="collapse-item">
                            ver requerimientos
                            <i class="far fa-eye"></i>
                        </a>
                        <input type="hidden" name="id_proyecto" value="<?= $d[0] ?>">
                        <input type="hidden" name="a" value="requer">
                    </p>

                <?php
                }
                ?>
            </div>
        </div>
    </li>

</div>






</ul>