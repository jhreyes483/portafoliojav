<?php
//require_once '_controller/logactivController.php';

include_once '../autoload.php';

use _controller\logactivController;

$obj = new logactivController;
$c   = $obj->dataAvance();
include_once '../public/body/header.php';
@session_start();
// pendiente filtro por proyecto
?>



<body id="page-top">
   <div id="wrapper">
      <?php include '../public/body/sidebar.php'; ?>
      <div id="content-wrapper" class="d-flex flex-column">
         <div id="content">
            <?php include '../public/body/navbar.php'; ?>
            <!-- CONTENIDO PRINCIPAL-->
            <div class="container">
               <form method="post">
                  <div class="col-md-10 mx-auto text-center shadow-sm card card-body" id="form">
                     <div class=" row col-md-12">
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

               <div class="table-responsive">

                  <table class=" mx-auto my-4 table table-bordered table-hover bg-white table-striped table-sm">
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
                        if (isset($c['total'])) {
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

               </div>

               <div id="timeline" class="my-4" style="height: 180px;"></div>
               <div class="col-md-4  ">

               </div>
            </div>

            <!-- FIN CONTENIDO PRINCIPAL -->
         </div>
         <div class="container my-4">
         </div>
         <?php include '../public/body/footer.php'; ?>
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