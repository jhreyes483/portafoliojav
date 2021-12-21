<?php


require_once '../../public/body/header.php';
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- SIDEBAR -->
        <?php include_once '../../public/body/sidebar.php'; ?>
        <!-- End of SIDEBAR -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- NAVBAR -->
                <?php include_once '../../public/body/navbar.php'; ?>
                <!-- End of NAVBAR -->

                <!-- CONTENIDO PRINCIPAL-->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Bienvenido Javier Reyes</h1>

                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">5+</span><span class="ml-2">Ver integrantes</span>
                        </a>
                        <!-- Dropdown - Integrantes -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                INTEGRANTES SICLOUD
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <img class="img-profile rounded-circle w-100" src="img/us/jav.png">
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">27 de enero, 2019</div>
                                    <span class="font-weight-bold">Javier Reyes</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <img class="img-profile rounded-circle w-100" src="img/us/anonymous.png">
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">27 de enero, 2019</div>
                                    <span class="font-weight-bold">Fabian Lopez</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <img class="img-profile rounded-circle w-100" src="img/us/al.png">
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">27 de enero, 2019</div>
                                    <span class="font-weight-bold">Angel Duran</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <img class="img-profile rounded-circle w-100" src="img/us/ruiz.jpg">
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">27 de enero, 2019</div>
                                    <span class="font-weight-bold">Daniel Ruiz</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <img class="img-profile rounded-circle w-100" src="img/us/polar.jpg">
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">27 de enero, 2019</div>
                                    <span class="font-weight-bold">David Rincon</span>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </div>



                    <!-- Content Row -->
                    <div class="row">



                    <iframe src="https://drive.google.com/file/d/1ruIWLzm1bK9Qb7EGhDmywzskqA_Nn8ue/preview" width="100%" height="480"></iframe>
                    </div>

                </div>
                <!-- FIN CONTENIDO PRINCIPAL -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include_once '../../public/body/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>



</body>

</html>