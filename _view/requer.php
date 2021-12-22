<?php
namespace _view;

require_once '../autoload.php';
use _controller\indexController;

//require_once '_controller/indexController.php';
$obj = new indexController;
$req = $obj->acces();
include_once '../public/body/header.php';
?>


   <!-- Custom fonts for this template-->
   <link href="../public/css/searchstyle.css" rel="stylesheet">

 
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <link href="../public/css/sb-admin-2.min.css" rel="stylesheet">
   <script src="../public/js/fontawasome-ico.js"></script>
   <script src="../public/js/jquery-3.5.1.min.js"></script>
   <script src="../public/js/searchmain.js"></script>

   <!-- Custom styles for this template-->

</head>

<body id="page-top">
   <div id="wrapper">
      <?php include '../public/body/sidebar.php'; ?>
      <div id="content-wrapper" class="d-flex flex-column">
         <div id="content">
            <?php include '../public/body/navbar.php'; ?>
            <div class="container">
               <div class="card card-title text-center shadow my-2 col-md-12 ">

                  <div class=" row">
                     <div class="col-md-12">
                        <h3 class="my-3"><?= $req['p'][1] ?></h3>
                     </div>
                  </div>
               </div>

               <div class="col-md-12 my-4" style="margin-top: 20%;">
                  <div class="row my-6" style="margin-top: 8%;">
                     <div class="col-md-3">
                        <form action="" method="post">
                           <div class="sample twelve">
                              <input type="text" name="search" class="form-control" placeholder="Requerimiento">
                              <button type="submit" class="btn btn-search">
                                 <i class="fa fa-search"></i>
                              </button>
                              <button type="reset" class="btn btn-reset fa fa-times"></button>
                           </div>
                        </form>
                     </div>
                     <div class="col-md-3">
                        <form action="" method="post">
                           <button type="submit" name="todos" class="col-md-8 form-control mx-auto btn-primary">Todos</button>
                        </form>
                     </div>
                     <div class="col-md-3">
                        <button type="button" value="consulta" id="toggle" class="  col-md-8 form-control mx-auto  btn-primary">Busqueda avanzada</button>
                     </div>
                     <div class="col-md-3">
                        <button type="button" value="consulta" id="togleDoc" class="  col-md-8 form-control mx-auto  btn-primary">Documentos</button>
                     </div>
                  </div>
               </div>
            </div>

            <!-- menu de documentos -->
            <div class="  col-md-8 mx-auto text-center " id="menuDoc" style="display: none;">
               <div class=" row col-md-12 mx-auto shadow" style="margin-top: 5%;">
                  <div class="card card-body col-md-4 shadow ">
                     <form action="tareas.php" method="post">
                        <input type="hidden" name="id_proyecto" value="<?= $_REQUEST['id_proyecto'] ?>">
                        <button type="submit" value="consulta" id="togleDoc" class="col-md-8 form-control mx-auto  btn-primary">product-backlog</button>
                     </form>
                  </div>
                  <div class="card card-body col-md-4 shadow">
                     <form action="backlog.php" method="post">
                        <input type="hidden" name="id_proyecto" value="<?= $_REQUEST['id_proyecto'] ?>">
                        <button type="submit" value="consulta" id="togleDoc" class="col-md-8 form-control mx-auto  btn-primary">sprint-backlog</button>
                     </form>
                  </div>
                  <div class="card card-body col-md-4 shadow">
                     <button href="logAvance.php"  type="button" class="col-md-8 form-control mx-auto  btn-primary" >Log de tareas</button>
                  </div>
               </div>
            </div>

            <!-- Busqueda avanzada -->
            <form method="post">
               <div class="  col-md-8 mx-auto text-center " id="form" style="display: none;">
                  <div class=" row col-md-12 mx-auto shadow" style="margin-top: 5%;">
                     <div class="card card-body col-md-4 shadow ">
                        <h6>Estado</h6>
                        <div class="card card-body mx-auto col-10 my-2 shadow border">
                           <select name="status" id="" class="form-control">
                              <?php
                              foreach (['' => 'Sin filtro', 'P' => 'Pendiente', 'A' => 'Aprobado'] as $k => $v) {
                                 echo '<option  ' . (($_POST['status'] == $k) ? ' selected ' : '') . ' value="' . $k . '">' . $v . '</option>';
                              }
                              ?>
                           </select>


                        </div>
                     </div>
                     <div class="card card-body col-md-4 shadow">
                        <h6>Periodo Actualizacion</h6>
                        <div class="card card-body mx-auto col-10 my-2 shadow border">
                           Fecha inicial
                           <input type="date" name="fIA" value="" class="form-control">
                           Fecha final
                           <input type="date" name="fFA" value="" class="form-control">
                        </div>
                     </div>
                     <div class="card card-body col-md-4 shadow">
                        <h6>Periodo Creacion</h6>
                        <div class="card card-body mx-auto col-10 my-2 shadow border">
                           Fecha inicial
                           <input type="date" name="fIC" class="form-control">
                           Fecha final
                           <input type="date" name="fFC" value="" class="form-control">
                        </div>
                     </div>
                     <input type="submit" value="consulta" class="form-control mx-auto col-md-3 my-2 btn-primary">
                  </div>
               </div>
            </form>

            <div class="container" style="margin-top: 2%;">
               <?php
               if (isset($req['r'])) {
                  foreach ($req['r'] as $i => $d) {
                     $hidden = $class  = $text = '';
                     if ($d[8] == '' &&  $d[8] == '') {
                        $class  = ' btn-success';
                        $text   = 'Registrar Requerimiento';
                     } else {
                        $class = ' btn-primary';
                        $text   = 'Actualizar';
                     }
               ?>
                     <div class="card card-body col.md-8 mx-auto my-6 shadow" style="margin-top: 3%;">
                        <div class="box-header width-border d-flex justify-content-between">
                           <div class="btn-group btn-toggle ">
                              <div class="btn btn-sm btn-success" data-toggle="submit" aria-pressed="true" onclick="encender('form<?= $i ?>')">
                                 <i class="far fa-clipboard"></i>
                                 Activar Edicion
                              </div>
                           </div>
                        </div>
                        <form action="" id="form<?= $i ?>" method="post">

                           <div class="row">
                              <div class="col-md-6 my-4">
                                 Requerimiento o Historia de usuario
                                 <textarea name="obs" cols="30" rows="1" class="form-control"><?= $d[9] ?></textarea>
                                 Criterio de aceptación
                                 <textarea name="criterio_acept" cols="30" rows="4" class="form-control"><?= $d[8] ?></textarea>
                                 <input type="hidden" name="id_proyecto" value="<?= $_REQUEST['id_proyecto'] ?>">
                                 <input type="hidden" name="id_requ" value="<?= $d[6] ?>">
                                 <input type="hidden" name="a" value="updateReq">
                              </div>
                              <div class="col-md-6 my-4">
                                 Estado
                                 <select name="status" class="form-control">
                                    <?php
                                    foreach (['P' => 'Pendiente', 'A' => 'Aprobado'] as $k => $v) {
                                       echo '<option  ' . (($d[12] == $k) ? ' selected ' : '') . ' value="' . $k . '">' . $v . '</option>';
                                    }
                                    ?>
                                 </select>
                                 Prioridad
                                 <select name="priori" class="form-control">
                                    <?php
                                    foreach (['A' => 'Alta', 'M' => 'Media', 'B' => 'Baja'] as $k => $v) {
                                       echo '<option  ' . (($d[7] == $k) ? ' selected ' : '') . ' value="' . $k . '">' . $v . '</option>';
                                    }
                                    ?>
                                 </select>
                                 <input type="submit" class="my-4 col-md-6 mx-auto bt btn-primary form-control" value="Actualizar">
                              </div>
                              <b> Fecha y hora: </b><br> Creacion <?= $d[13] ?>
                              Actualizacion: <?= $d[14] ?>
                           </div>

                        </form>
                     </div>
               <?php
                  }
               }
               ?>

               <form method="post">
                  <div class="card shadow card-body col.md-8 mx-auto my-6" style="margin-top: 3%;">
                     <div class="row">
                        <div class="col-md-6">
                           Requerimiento o Historia de usuario
                           <textarea name="obs" cols="30" rows="1" class="form-control"></textarea>
                           Criterio de aceptación
                           <textarea name="criterio_acept" cols="30" rows="4" class="form-control"></textarea>
                           <input type="hidden" name="id_proyecto" value="<?= $_REQUEST['id_proyecto'] ?>">
                           <input type="hidden" name="a" value="insertReq">
                        </div>
                        <div class="col-md-6 my-2">
                           Estado
                           <select name="status" id="" class="form-control">
                              <?php
                              foreach (['P' => 'Pendiente', 'A' => 'Aprobado'] as $k => $d) {
                                 echo '<option value="' . $k . '">' . $d . '</option>';
                              }
                              ?>
                           </select>
                           Priodad
                           <select name="priori" id="" class="form-control">
                              <?php
                              foreach (['A' => 'Alta', 'M' => 'Media', 'B' => 'Baja'] as $k => $v) {
                                 echo '<option   value="' . $k . '">' . $v . '</option>';
                              }
                              ?>
                           </select>
                           <input type="hidden" name="id_proyecto" value="<?= $_REQUEST['id_proyecto'] ?>">
                           <input type="hidden" name="a" value="insertReq">
                           <input type="submit" class="my-4 bt btn-success form-control col-md-6 mx-auto" value="Registrar Requerimiento">
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <?php include '../public/body/footer.php'; ?>
      </div>
   </div>
</body>

<script>
   <?php
   if (isset($req['r'])) {
      foreach ($req['r'] as $key => $value) {
         echo 'encender("form' . $key . '");';
      }
   }
   ?>

   function encender(idFrm) {
      enciende = false
      idElemen = document.getElementById(idFrm).elements;
      $.each(idElemen, function(i, n) {
         if (n.type == 'text' || n.type == 'number' || n.type == 'email' || n.type == 'tel' || n.type == 'textarea' || n.type == 'submit' || n.type == 'button' || n.type == 'select-one' || n.type == 'select-multiple' || n.type == 'radio' || n.type == 'date' || n.type == 'select' || n.type == 'hidden')
            n.disabled = (!n.disabled);
      });
      enciende = !enciende;
   }

   $(document).ready(function() {
      // busqueda avanzada
      var elemento = $("#form");
      var mostrar = $("#toggle");
      mostrar.click(function() {
         elemento.toggle(1000);
      });
      //--------------------
      // Menu documentos scrum
      var elemen = $("#menuDoc");
      var ver = $("#togleDoc");
      ver.click(function() {
         elemen.toggle(1000);
      });
   });
</script>

</html>