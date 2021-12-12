<?php
require_once '_controller/logactivController.php';
$obj = new logactivController;
$c   = $obj->dataAvance();
@session_start();
// pendiente filtro por proyecto
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
   <script src="public/js/loaderChart.js"></script>
   <!-- Start of HubSpot Embed Code -->
   <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/19562886.js"></script>
   <!-- End of HubSpot Embed Code -->

   <!-- Custom styles for this template-->
   <link href="template/css/sb-admin-2.min.css" rel="stylesheet">

</head>


<body id="page-top">>
   <div id="wrapper">
      <?php include './public/body/sidebar.php'; ?>
      <div id="content-wrapper" class="d-flex flex-column">
         <div id="content">
            <?php include './public/body/navbar.php'; ?>
            <!-- CONTENIDO PRINCIPAL-->
            <div class="container">
               <form method="post">
                  <div class="col-md-10 mx-auto text-center " id="form">
                     <div class=" row col-md-12 for-group shadow" style="margin-top: 5%;">
                        <div class="col-md-6 my-2 mx-auto">
                           <div>
                              <label for="fIA">Fecha inicial</label>
                              <input type="date" id="fIA" name="fIA" value="" class="form-control">
                              <label for="fFA">Fecha final</label>
                              <input type="date" id="fFA" name="fFA" value="" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-6 my-2 mx-auto">
                           <label for="us">Usuario</label>
                           <select name="us" id="us" class="form-control " onchange="submit(this)">
                              <?php
                              echo '<option value="">Todo los usuarios</option>';
                              foreach ($c['user'] as $i => $d) {
                                 echo '<option ' . (($i == $_REQUEST['us']) ? ' selected ' : '') . ' value="' . $i . '">' . $d . '</option>';
                              }
                              ?>
                           </select>
                           <label for="id_proyecto">Proyectos</label>
                           <select name="id_proyecto" id="id_proyecto" class="form-control" onchange="submit(this)">
                              <?php
                              echo '<option value="">Todos los proyectos</option>';
                              foreach ($c['proyectDb'] as $i => $d) {
                                 echo '<option  ' . (($i == $_REQUEST['id_proyecto']) ? ' selected ' : '') . '  value="' . $i . '">' . $d . '</option>';
                              }
                              ?>
                           </select>
                        </div>

                        <div class="col-md-12 row mx-auto  ">
                           <div class="col-md-6">
                              <input type="submit" value="consulta" class="form-control mx-auto col-md-10 my-2 btn-primary">
                           </div>
                           <div class="col-md-6">
                              <a href="tareas.php" class="form-control mx-auto col-md-10 my-2 btn-primary">Product-backolg</a>
                           </div>
                        </div>


                     </div>
                  </div>
               </form>

               <table class=" mx-auto my-4 table table-bordered table-striped bg-white table-sm">
                  <thead>
                     <th>Actividad</th>
                     <th>Inicio</th>
                     <th>Fin</th>
                     <th>Usuario</th>
                     <th>Tipo</th>
                     <th>Tiempo de actividad</th>
                  </thead>
                  <tbody>

                     <?php
                     if ($c['data']['response_status'] == 'ok') {
                        foreach ($c['data']['response_msg'] as $d) {
                     ?>
                           <tr>
                              <td><?= $d[2] ?></td>
                              <td><?= $d[0] ?></td>
                              <td><?= $d[1] ?></td>
                              <td><?= $c['user'][$d[3]] ?></td>
                              <td><?= $c['tipo'][$d[30]] ?></td>
                              <td><?= $d[22] ?></td>
                           </tr>
                        <?php
                        }
                     }
                     if(isset($c['total'])){
                     foreach ($c['total']  as $i => $d) {
                        ?>
                        <tr>
                           <td> <b>Total de todas las actividades</b> </td>
                           <td>Usuario asig.</td>
                           <td><?= $c['user'][$i] ?></td>

                           <td></td>
                           <td>Proyecto</td>
                           <td>
                              <?php
                              foreach ($c['total'][$i]  as $k  => $v) {
                                 echo '<b>' . $k . '</b> ' . $c['total'][$i][$k]['p'] . '<br>';
                              }
                              ?>
                           </td>
                        </tr>
                     <?php
                     }
                  }
                     ?>
                  </tbody>
               </table>
               <div id="timeline" class="my-4" style="height: 180px;"></div>
               <div class="col-md-4  ">

               </div>
            </div>

            <!-- FIN CONTENIDO PRINCIPAL -->
         </div>
         <div class="container my-4">
         </div>
         <?php include './public/body/footer.php'; ?>
      </div>
   </div>
   <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
   </a>
</body>



<script type="text/javascript">
   google.charts.load('current', {
      'packages': ['timeline']
   });
   google.charts.setOnLoadCallback(drawChart);

   function drawChart() {
      var container = document.getElementById('timeline');
      var chart = new google.visualization.Timeline(container);
      var dataTable = new google.visualization.DataTable();

      dataTable.addColumn({
         type: 'string',
         id: 'President'
      });
      dataTable.addColumn({
         type: 'date',
         id: 'Start'
      });
      dataTable.addColumn({
         type: 'date',
         id: 'End'
      });
      dataTable.addRows([
         <?php
         foreach ($c['data']['response_msg'] as $d) {
            # code...

         ?>

            ['<?= $d[2] . ' (' . $d[40] . ') ' ?>', new Date(<?= date('Y,m,d,H,i,s', strtotime($d[0])) ?>), new Date(<?= date('Y,m,d,H,i,s', strtotime($d[1])) ?>)],
         <?php
         }
         ?>

      ]);

      chart.draw(dataTable);
   }
</script>


</html>

<script>
   $('.row').addClass('form-group');
   $('select').addClass('form-control');
   $('textarea').addClass('form-control');
   $('input').addClass('form-control')
</script>

</html>