<?php
namespace _view;
require_once '../autoload.php';
use _controller\prodbController;
$obj = new prodbController;
$c   = $obj->peticion();
@session_start();

if(isset($_SESSION['usuario'])){
   $edit = (($_SESSION['usuario']['rol'] == 'SM') ? ' ' : ' disabled ');
}else{
   echo '<script>alert("Incie sesion para continuar");</script>';
}
include_once '../public/body/header.php';
?>



<body id="page-top">
   <div id="wrapper">
      <?php include '../public/body/sidebar.php'; ?>
      <div id="content-wrapper" class="d-flex flex-column">
         <div id="content">
            <?php include '../public/body/navbar.php'; ?>
            <!-- CONTENIDO PRINCIPAL-->
            <div class="container">
               <div class="card card-body col-md-10 mx-auto">
                  <b>
                     <h5 class="text-center">Product-backlog</h5>
                  </b>
               </div>
            </div>
            <div class="">

               <table class=" mx-auto my-4 table table-bordered table-striped bg-white table-sm">
                  <thead>
                     <th>Id tarea</th>
                     <th>Tarea</th>
                     <th>Descripcion</th>
                     <th>Usuario asignado</th>
                     <th>Esfuerzo estimado</th>
                     <th>Esfuerzo planificado (H)</th>
                     <th>Proyecto</th>
                     <th>Estado</th>

                     <th></th>
                  </thead>
                  <tbody>
                     <?php
                     if ($c['tareas']['response_status'] == 'ok') {
                        foreach ($c['tareas']['response_msg'] as $d) {
                           $timeC =  explode(' ', $d[8]);
                           $timeA =  explode(' ', $d[9]);
                     ?>
                           <tr>
                              <form method="post">
                                 <input type="hidden" name="a" value="update">
                                 <td><?= $d[0] ?></td>
                                 <td><input type="text" name="tarea" <?= $edit ?> value="<?= $d[1] ?>"></td>
                                 <td> <textarea name="descript" cols="20" rows="3"><?= $d[2] ?></textarea> </td>
                                 <input type="hidden" name ="id_tarea"  value="<?= $d[0] ?>">
                                 <td>
                                    <select name="user_asg">
                                       <?php
                                       foreach ($c['users'] as $k => $v) {
                                          echo '<option  ' . (($k == $d[3]) ? ' selected ' : '') . ' value="' . $k . '">' . $v . '</option>';
                                       }
                                       ?>
                                    </select>
                                 </td>
                                 <td><input type="number" name="esPoint" <?= $edit ?> value="<?= $d[4] ?>"></td>
                                 <td> <input type="text" name="esPlanificado" <?= $edit ?> value="<?= $d[5] ?>"></td>
                                 <td>
                                    <select name="proyecto_asg">
                                       <?php
                                       foreach ($c['proyect'] as $k => $v) {
                                          echo '<option  ' . (($k == $d[6]) ? ' selected ' : '') . ' value="' . $k . '">' . $v . '</option>';
                                       }
                                       ?>
                                    </select>
                                 <td>
                                    <select name="status">
                                       <?php
                                       foreach ($c['status'] as $k => $v) {
                                          echo '<option  ' . (($k == $d[7]) ? ' selected ' : '') . ' value="' . $k . '">' . $v . '</option>';
                                       }
                                       ?>
                                    </select>
                                 </td>

                                 <td> <input type="submit" value="Actualizar" class="btn btn-sm btn-primary"></td>
                           <tr>
                              <td>
                                 <h6>Datos de regitro</h6>
                              </td>
                              <td>
                                 <b>Creación</b>
                              </td>
                              <td> 
                                 <?= ($timeC[0]??'' ) ?><br>
                                 <?= ($timeC[1]?? '') ?>
                            
                                 <td>
                                 <b>Actualizacion</b>
                                 </td>
                                 <td>
                                 <?= ($timeA[0]?? '') ?><br>
                                 <?= ($timeA[1]?? '') ?><br>
                              </td>
                              <td>
                                 <b>Usuario actualizo</b><br>
                                 </td><td>
                                 <?= $c['users'][$d[10]] ?>
                              </td>



                           </tr>
                           </form>
                           </tr>

                     <?php
                        }
                     }
                     ?>
                     <tr>
                        <form action="" method="post">
                           <input type="hidden" name="a" value="insert">

                           <td></td>
                           <td><input type="text" name="tarea" value=""></td>
                           <td> <textarea name="descript" cols="30" rows="3"></textarea> </td>
                           <td>
                              <select name="user_asg">
                                 <?php
                                 foreach ($c['users'] as $k => $v) {
                                    echo '<option  ' . (($k == $d[7]) ? ' selected ' : '') . ' value="' . $k . '">' . $v . '</option>';
                                 }
                                 ?>
                              </select>
                           </td>
                           <td><input type="number"  name="esPoint" value=""></td>
                           <td> <input type="text" name="esPlanificado" value=""></td>
                           <td>
                              <select name="proyecto_asg">
                                 <?php
                                 foreach ($c['proyect'] as $k => $v) {
                                    echo '<option  ' . (($k == $d[6]) ? ' selected ' : '') . ' value="' . $k . '">' . $v . '</option>';
                                 }
                                 ?>
                              </select>
                           <td>
                              <select name="status">
                                 <?php
                                 foreach ($c['status'] as $k => $v) {
                                    echo '<option  ' . (($k == $d[7]) ? ' selected ' : '') . ' value="' . $k . '">' . $v . '</option>';
                                 }
                                 ?>

                              </select>

                           </td>

                           <td> <input type="submit" value="Registrar" class="btn btn-success"></td>

                        </form>
                     </tr>
                  </tbody>
               </table>
               <div class="col-md-2 mx-auto ">
                <a href="backlog.php" class="btn btn-primary">Spring-backlog</a>
              </div>
               <?php

               // pendiente else
               ?>
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

<script>
   $('.row').addClass('form-group');
   $('select').addClass('form-control');
   $('textarea').addClass('form-control');
   $('input').addClass('form-control')
</script>

</html>