<?php
require_once '../autoload.php';

use _controller\calendarioController;

$obj = new calendarioController;
$c   = $obj->tipoReunion();
@session_start();
include_once '../public/body/header.php';
?>


<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- SIDEBAR -->
        <?php include '../public/body/sidebar.php'; ?>
        <!-- End of SIDEBAR -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- NAVBAR -->
                <?php include '../public/body/navbar.php'; ?>
                <!-- End of NAVBAR -->

            </div>
            <!-- End of Main Content -->
            <div class="container my-4">
                <div class="col-md-12 b">
                    <div class="row">
                        <div class="col-md-4">
                            <h5><b>Reunion</b></h5>
                        </div>
                        <div class="col-md-8">
                            <h5><b>Descripcion</b></h5>
                        </div>
                    </div>
                </div>

                <?php
                foreach ($c as $d) {
                ?>

                    <div class="row">
                        <div class="col-md-2 my-4 ">
                            <span class="my-4">
                                <b><?= $d[1] ?></b>
                            </span>
                        </div>
                        <div class="col-md-8 my-4">
                            <span class="my-4">
                                <p> <?= $d[2] ?></p>
                            </span>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
            <!-- Footer -->
            <?php include '../public/body/footer.php'; ?>
            <!-- End of Footer -->

        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
</body>

</html>