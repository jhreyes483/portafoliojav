<?php
require_once '_controller/calendarioController.php';
$obj = new calendarioController;
$c   = $obj->tipoReunion();
@session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SICLOUD</title>

    <!-- Custom fonts for this template-->
   <link href="https://jfa.herokuapp.com/sicloud/public/layout1/css/fontawasome-ico.css" rel="stylesheet" type="text/css" />
   <link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <script src="https://jfa.herokuapp.com/sicloud/public/layout1/js/fontawasome-ico.js"></script>

   <link href="https://jfa.herokuapp.com/sicloud/public/layout1/css/fontawasome-ico.css" rel="stylesheet" type="text/css" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
   <script src="https://jfa.herokuapp.com/sicloud/public/layout1/js/fontawasome-ico.js"></script>
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/19562886.js"></script>
<!-- End of HubSpot Embed Code -->

    <!-- Custom styles for this template-->
    <link href="template/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- SIDEBAR -->
        <?php include './public/body/sidebar.php'; ?>
        <!-- End of SIDEBAR -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- NAVBAR -->

                <?php include './public/body/navbar.php'; ?>
                <!-- End of NAVBAR -->

                <!-- CONTENIDO PRINCIPAL-->
  
                <!-- FIN CONTENIDO PRINCIPAL -->

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
            <?php include './public/body/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

  

</body>

</html>