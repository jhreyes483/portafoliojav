<?php

@session_start();
require "conexion.php";
include_once '../../application/Config.php';
$user = new Conexion();
if( !isset($_SESSION['usuario']) ){
header('location:' . BASE_URL . 'index');
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="<?= RUTAS_APP['ruta_css'] ?>jav.css" rel="stylesheet" type="text/css" />
    <link href="<?= RUTAS_APP['ruta_css'] ?>bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= RUTAS_APP['ruta_css'] ?>font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?= RUTAS_APP['ruta_css'] ?>chat.css" rel="stylesheet" type="text/css" />
    <script src="<?= RUTAS_APP['ruta_js'] ?>fontawasome-ico.js"></script>
</thead>

<?php
if (isset($_SESSION['s_menu'])) echo $_SESSION['s_menu'];
?>


<h3 class="text-center col-md-8 mx-auto lead border border-secondary p-3 text-white bg-dark mt-5 mx-5" style="font-weight: bold">Registro de dirección</h3>

<form action="<?= BASE_URL.'user/misdatos' ?>" method="post">
        <div class="  col-md-8 mx-auto card shadow border border-secondary mx-5">
            <div class="row col-md-12 mt-5">
                <div class="col-md-6">
                    <label for="" class="lead " style="font-weight: bold;">Ciudades:</label>
                    <select name="nom_ciudad" id="ciudad" class="form-control ">
                        <?php
                        $departamentos = $user->buscar("ciudad", "1");
echo '<option value="">--Seleccione--</option>';
foreach ($departamentos as $d) :
  echo '<option '.((isset($_POST['nom_ciudad'] ) && $_POST['nom_ciudad'] == $d['ID_ciudad'] )? ' selected ': '').' value="'.$d['ID_ciudad'].'">'.$d['nom_ciudad'].'</option>';
endforeach;
?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="" class="lead" style="font-weight: bold;">Localidades:</label>
                    <select name="localidad" id="localidades" class="form-control"></select>
                </div>
            </div>
            <div class="row col-md-12 my-5">
                <div class="col-md-6">
                    <label for="" class="lead" style="font-weight: bold;">Barrios:</label>
                    <select name="barrio" id="barrios" class="form-control"></select>
                </div>
                <div class="col-md-6">
                    <label for="" class="lead" style="font-weight: bold;" aria-placeholder="digite" require>Direccion:</label>
                    <input type="hidden" name="accion" value="insertDir">
                    <input type="text" name = "direccion"  class="form-control">
                </div>
            </div>
            <div class="col-md-6 mx-auto">
                <div><input class="form-control btn-success btn-sm my-4 text-white" type="submit" value="Enviar"></div>
            </div>
        </div>

    </form>


    <script src="<?= RUTAS_APP['ruta_js'] ?>jquery-1.9.0.js"></script>
    <script>
        $("#ciudad").change(function() {
            var parametros = "id=" + $("#ciudad").val();

            $.ajax({
                data: parametros,
                url: 'ajax_localidades.php',
                type: 'post',
                beforeSend: function() {},
                success: function(response) {
                    $("#localidades").html(response);
                },

                error: function() {
                    alert("error")
                }
            });
        })



        $("#localidades").change(function() {
            var parametros = "id=" + $("#localidades").val();
            $.ajax({
                data: parametros,
                url: 'ajax_barrios.php',
                type: 'post',
                beforeSend: function() {},
                success: function(response) {
                    $("#barrios").html(response);
                },
                error: function() {
                    alert("error")
                }
            });
        })


        /*
        $("#localidades").change(function(){
        	 		var parametros= "id="+$("#localidades").val();
        	 		$.ajax({
                        data:  parametros,
                        url:   'ajax_localidades.php',
                        type:  'post',
                        beforeSend: function () { },
                        success:  function (response) {                	
                            $("#localidades").html(response);
                        },
                        error:function(){
                        	alert("error")
                        }
                    });
        })
        */
    </script>






<script src="<?= RUTAS_APP['ruta_js'] ?>bootstrap.min.js"></script>

</html>