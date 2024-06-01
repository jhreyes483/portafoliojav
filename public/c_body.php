<?php

namespace public;

class c_body
{
    public static function header()
    {
        echo
        '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <title>Portafolio Javier R.</title>
         <!--<link href="https://portafoliojav.herokuapp.com/sicloud/public/layout1/css/fontawasome-ico.css" rel="stylesheet" type="text/css" />-->
           <link href="../public/css/fonts1.css" rel="stylesheet">
           <link href="../public/css/bootstrap.min.css" rel="stylesheet">
           <link href="../public/css/sb-admin-2.min.css" rel="stylesheet">
           <link href="../public/css/jav.css" rel="stylesheet">
           <script src="../public/js/fontawasome-ico.js"></script>
           <script src="../public/js/jquery-3.5.1.min.js"></script>
        </head>';
    }

    public static function footer()
    {
        echo
        '<footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Dev Javier Reyes. ' . date('Y-m-d') . '</span>
            </div>
        </div>
    </footer>
    <script src="../public/js/jav.js"></script>
    <script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/sb-admin-2.min.js"></script>
    ';
    }

    public function navbar()
    {
        echo
        '<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <div class="text-center d-none d-md-inline">
            <a class=" hyper text-primary" type="button" style="display: none;" id="sidebarToggle"><i class="fas fa-align-center" id="ico-cent"></i></a> <br>
            <a class=" hyper text-primary animate__animated animate__bounce" title="Ver proyectos" type="button" id="sidebarToggle2"> <i class="fas fa-arrow-right fs-2" id="btn-toggle-sidebar"></i></a>
        </div>
        <!-- Topbar Search -->
        <h4 class="ml-3">Portafolio</h4>
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto " id="page-top">
            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">' . ($_SESSION['usuario']['nombres'] ?? '') . '</span>
                    <img class="img-profile rounded-circle" src="../public/img/us/jav.png">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
    
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Cerrar Sesion
                    </a>
                </div>
            </li>
        </ul>
    </nav>';
    }
}
