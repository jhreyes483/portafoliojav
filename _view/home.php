<?php

namespace _view;

@session_start();



//require_once '../public/body/header.php';
require_once '../autoload.php';

use _controller\indexController;
use public\c_body;


include '../public/body/header.php';


$urlHV = 'https://jhreyes483.github.io/Hoja_V/';
$obj = new indexController;
$r =   $obj->data();
if (isset($_SESSION['usuario'])) {
    $rol = ' (Rol ' . ($r['roles'][$_SESSION['usuario']['rol']] ?? '') . ') ';
}

?>


<body id="page-top">
    <div id="wrapper">
        <?php include '../public/body/sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include '../public/body/navbar.php'; ?>
                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 ">

                            <p class="typing" style="display: none; color: #0049E5 !important;">
                                Portafolio de Javier Reyes
                            </p>

                        </h1>

                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm interactive-button" data-color="120" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Informes</span>
                        </a>
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">

                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;" onclick=" PopupCenter('<?= $urlHV ?>', 'Hoja-vida', '1200', '700');">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <img class="img-profile rounded-circle w-100" src="../public/img/hv.jpg">
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">Javier Reyes</div>
                                    <span class="font-weight-bold">Hoja de vida</span>
                                </div>
                            </a>

                            <a class="dropdown-item text-center small text-gray-500" href="#"></a>
                        </div>
                    </div>



                    <!-- Content Row -->
                    <div class="row">



                        <?php include '../public/body/content.php'; ?>

                    </div>
                    <!-- FIN CONTENIDO PRINCIPAL -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include '../public/body/footer.php'; ?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>


        <style>
            .typing {
                display: inline-block;
            }

            @keyframes typing {
                0% {
                    width: 0;
                    border-right: .06em solid #000;
                }

                99% {
                    border-right: .06em solid #000;
                }

                100% {
                    border-right: 0;
                }
            }

            .typing {
                display: block !important;
                animation: typing 1.7s steps(28, end);
                font-weight: bolder;
                padding: 15px;
                width: 100%;
                color: #0d6efd;
                height: auto;
                white-space: nowrap;
            }

            p,
            span {
                padding: 0;
                margin: 0;
                display: contents;
                overflow: hidden;
            }


            .interactive-button {
                border: 4px solid white;
                transition: color 0.4s;
                outline: none;
            }

            .interactive-button:hover {
                font-weight: bold;
            }


            .interactive-button.reverted {
                font-weight: normal;
                text-shadow: none;
                -webkit-text-stroke: 0;
                border: none;
            }
        </style>

        <script>
            $(document).ready(function() {


                let buttons = document.querySelectorAll('.interactive-button');
                console.log(buttons)
                buttons.forEach(button => {

                    button.addEventListener('mousemove', function(e) {
                        const rect = this.getBoundingClientRect();
                        const x = (e.clientX - rect.left) / rect.width;
                        const gradientStart = Math.max(0, x * 100 - 10) + '%';
                        const gradientEnd = Math.min(100, x * 100 + 10) + '%';
                        const color = this.getAttribute('data-color');
                        this.style.color = `hsl(${color}, 100%, 50%)`;
                        //  this.style.borderRadius = '20px'; 
                        this.style.setProperty(
                            '--gradient',
                            `linear-gradient(
                to right,
                white 0%, 
                white ${gradientStart}, 
                hsl(${color}, 
                100%, 
                50%
              ) ${gradientStart}, 
              hsl(
                ${color}, 
                100%, 
                50%
              ) ${gradientEnd}, 
              white ${gradientEnd}, 
              white 100%)`
                        );
                        this.style.borderImage = `var(--gradient) 1`;
                    });

                    button.addEventListener('mouseleave', function() {
                        this.style.color = 'white';
                        this.style.borderImage = 'none';
                        this.style.borderColor = 'white';
                    });

                    button.addEventListener('click', function() {
                        const color = this.getAttribute('data-color');
                        this.style.color = `hsl(${color}, 100%, 50%)`; // Fija el color del texto
                        this.style.borderColor = `hsl(${color}, 100%, 50%)`; // Fija el color del borde
                        this.style.borderImage = 'none'; // Elimina el gradiente del borde si lo hubiera
                    });

                    button.addEventListener('mouseleave', function() {
                        this.classList.toggle('reverted');
                    });

                });


                //$('ul').addClass('sub-list-2')
                // $('.sub-list-3').children('a').addClass('e-sub-3');
                // $('.sub-list-2').children('a').addClass('e-sub-2');


            });

            //$('.ws_next').children('span').children('i').addClass('fas');
            //$('.ws_next').children('span').children('i').addClass('fa-angle-right');
            //$('.ws_prev').children('span').children('i').addClass('fas');
            //$('.ws_prev').children('span').children('i').addClass('fa-angle-left');
            //$('.ws_next').children('span').addClass('text-center');
        </script>
</body>



</html>