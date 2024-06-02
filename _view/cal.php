<?php

namespace _view;

require_once '../autoload.php';
use _controller\calendarioController;
use Controller;

?>

<!DOCTYPE html>
<html lang="es">

<?php
$obj = new calendarioController();
@session_start();
/*
if (isset($_SESSION)) {
    $c   = $obj->accesEventos();
} else {
    die('<center>Por favor inicie sesión</center>');
}
*/
$c   = $obj->accesEventos();
?>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../public/css/bootstrap.min.css">
   <link rel="stylesheet" href="../public/css/fullcalendar.min.css">
   <title>Document</title>
</head>

<body id="page-top">
   <script src="../public/js/jquery-3.5.1.min.js"></script>
   <!-- LIBRERIA DE CALENDARIO -->
   <script src="../public/js/moment.min.js"></script>
   <script src="../public/js/fullcalendar.js"></script>
   <script src="../public/js/es.js"></script>

   <!-- BOOTSTRAP 4.0.0-->
   <script src="../public/js/popper.min.js"></script>
   <script src="../public/js/bootstrap.min.js"></script>


   <!-- Modal -->
   <div class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="tituloEvento"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               
            </div>
            <div class="modal-body">
            <b>Hora:</b>      <span id="evenHora"></span>
            <b>Fecha:</b>      <span id="evenFecha"></span><br>
            <b>Equipo:</b>   <span id="evenEquipo"></span>
 
            <b>Tipo:</b>    <span id="evenTipo"></span><br>
            <b>Descripcion </b>    <div id="descripcionEvento">
           
               
               </div>
            </div>
            <div class="modal-footer">
               <button type="button"  id="btnAgregarE" class="btn btn-success">Agregar</button>
               <button type="button" id="btnModificarE" class="btn btn-success">Modificar</button>
               <button type="button" id="btnBorrarE" class="btn btn-danger">Borrar</button>
               <button type="button" id="btnCancelarE" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="ModalDia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="tituloEvento"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div id="descripcionEvento">
                  <form action="" id="form1" method="post">
                     <label for="tipo">Tipo</label>
                     <select id="tipo" name="tipo" required>
                        <?php
                        echo '<option value="">seleccione uno</option>';
                        foreach ($c['tipo'] as $i => $d) {
                            echo '<option  value="' . $i . '">' . $d . '</option>';
                        }
                        ?>

                     </select>
                     <label for="equipo">Equipo</label>
                     <select id="equipo" name="equipo" required>
                        <?php
                        echo '<option value="">Sin equipo</option>';
                        foreach ($c['equipos'] as $i => $d) {
                            echo '<option   value="' . $i . '">' . $d . '</option>';
                        }
                        ?>
                     </select>
                     <label for="user">Usuario</label>
                     <select id="equipo" name="user" required>
                        <?php
                        foreach ($c['users'] as $i => $d) {
                            echo '<option ' . (($i == $_SESSION['user']['id']) ? ' selected ' : '') . '  value="' . $i . '">' . $d . '</option>';
                        }
                        ?>
                     </select>

                     Fecha: <input type="date" id="txtFecha" name="txtFecha" required><br>
                     Hora: <input type="time" id="txtHora" name="txtHora" required><br><br>
                     <hr/>
                     Titulo: <input type="text" id="txtTitulo" name="txtTitulo" required><br>
                     Descripcion: <textarea type="text" rows="3" id="txtDescripcion" name="txtDescipcion" required></textarea> <br>
                     Color <input type="color" value="#ff0000" name="color" id="txtColor" required><br>
                     <input type="hidden" id="a" name="a">
                  </form>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
               <button type="button" id="btnModifica" class="btn btn-success">Modificar</button>
               <button type="button" id="btnBorrar" class="btn btn-danger">Borrar</button>
               <button type="button" id="btnCerrar" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
         </div>
      </div>
   </div>

   <div class="container mx-auto">
      <div class="col-md-4 my-2 mx-auto">
         <form action="" method="post">
         <label for="">Seleccionar agendad de usuario</label>
            <select name="busqUserCal" onchange="submit(this)" id="">
               <?php
                foreach ($c['users'] as $i => $d) {
                    echo '<option ' . (( isset($_POST['busqUserCal']) && $i ==  $_POST['busqUserCal']  ) ? ' selected ' : '') . '  value="' . $i . '">' . $d . '</option>';
                }
                ?>
            </select>
         </form>
      </div>

   </div>



   <div class="container mx-auto">
      <div class="row">
         <div class="col col-10 col mx-auto" >
            <div id="CalendarioWeb"></div>
         </div>
      </div>
   </div>

   <script>
      $("#btnAgregar").click(function() {
         $("#a").val("insert");
         $("#form1").submit();
      })
      $("#btnModifica").click(function() {
         $("#a").val("update");
         $("#form1").submit();
      })
      $("#btnBorrar").click(function() {
         $("#a").val("delete");
         $("#form1").submit();
      })
      $("btnCerrar").click(function() {
         $("#descripcionEvento").closest();
      });


   </script>


   <script>
      $(document).ready(function() {
         $('#CalendarioWeb').fullCalendar({
            header: {
               left: 'today,prev,next,Miboton',
               center: 'title',
               right: 'month, basicWeek, basicDay, agendaWeek, agendaDay'
            },
            customButtons: {
               Miboton: {
                  text: "Boton 1",
                  click: function() {
                     alert("accion de boton");
                  }
               }
            },
            dayClick: function(date, jsEvent, view) {
            //   alert("valor seleccionado:" + date.format()); // dia se puede enviar a un hidden
               // pinta el dia seleccionado
               $(this).css('background-color', '#B4E197');
               $("#txtFecha").val(date.format());
               $("#ModalDia").modal();
               // activa modal

            },
            // color de eventos
            eventSources: [{
               // eventos
               events: [
                  <?php
                    foreach ($c['eventos'] as $i => $d) {
                        $end = ((isset($d[6])) ? "end: '" . $d[6] . ",'" : '');
                        ?> {
                        title: '<?= $d[1] ?>',
                        descripcion: "<?= $d[2] ?>",
                        start: '<?= $d[6] ?>',
                        color: "<?= $d[3] ?>",
                        textColor: "<?= $d[4] ?>",
                        tipo: "<?= $c['tipo'][$d[9]] ?>",
                        equipo: "<?= $c['equipos'][$d[8]] ?>",
                        <?= $end ?>
                     },

                        <?php
                    }
                    ?>
                  // 
                  // {
                  //    title: 'Evento 1, promacion 1 a 8,000',
                  //    descripcion: "Desarrollo web",
                  //    start: '2021-04-01',
                  //    color: "#FF0F0",
                  //    textColor: "#FFFFFF",
                  // },
                  // {
                  //    title: 'Evento 2, promacion 2 a 8,005',
                  //    descripcion: "Reunion de requerimientos",
                  //    start: '2021-04-01',
                  //    end: '2021-04-03',
                  // },
                  // {
                  //    title: 'Evento 3, promacion 2 a 8,005',
                  //    start: '2021-04-04T12:30:00',
                  //    descripcion: "Hay una diligencia",
                  //    allDay: false,
                  //    color: "#FF0F0",
                  //    textColor: "#FFFFFF",
                  // }
               ],
               // COLOR DEFAULT
               color: "black",
               textColor: "yellow",

            }],

            // pasa la informacion de evento al modal
            eventClick: function(calEvent, jsEvent, view) {
             //  f = start.split(' ');
               $("#btnAgregarE").prop("disabled", true);
               f = calEvent.start._i.split(" ");
               $('#evenFecha').html(f[0]);  
               $('#evenHora').html(f[1]);  
               $('#tituloEvento').html(calEvent.title);
               $('#descripcionEvento').html(calEvent.descripcion);
               $('#evenEquipo').html(calEvent.equipo);
               $('#evenTipo').html(calEvent.tipo);
               $("#modalEvento").modal();
            }
         });
      });

      $('select').addClass('form-control');
      $('input').addClass('form-control');
      $('textarea').addClass('form-control');
   </script>
</body>

</html>
