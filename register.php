<?php
require_once '_controller/indexController.php';
$obj = new indexController; 

session_destroy();
if( isset ($_POST['a'])){
    $obj->acces();
}


?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sicloud</title>

    <!-- Custom fonts for this template-->
    <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom styles for this template-->
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">

</head>
<div class="col-md-10 card card-body mx-auto">

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Registrate ya!</h1>
                            </div>
                            <form class="user" method="post">
                            <input type="hidden" name="a" value="createUser">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Primer nombre" name="nom1">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Segundo nombre" name="nom2">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Primer apellido" name="ape1">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Segundo apellido" name="ape2">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Direccion" name="direccion">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Telefono" name="telefono">
                                    </div>
                                </div>
                                <div class="form-group">
                                   <select name="rol" class="form-control" >
<?php
foreach (['C'=>'Cliente', 'I'=>'Instructor']   as $i => $d) {
echo '  <option '.(($_POST['rol'] == $i) ? ' selected ': '' ).'value="'.$i.'">'.$d.'</option>';
}
?>
            
                                 
                                   </select>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="correo" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Correo electronico">
                                </div>
                                <div class="form-group">
                                <input id="datepicker" width="100%" name="fecha_n" class="form-control form-control-user"/>
                                    <script>
                                        $('#datepicker').datepicker({
                                            uiLibrary: 'bootstrap4'
                                        });
                                    </script>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Digita tu contraseña" name="password">
                                </div>
           
                                <button type="submit"  class="btn btn-primary btn-user btn-block">
                                Crear cuenta
                                </button>
                          
                               
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">¿Olvidaste tu contraseña?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="index.php">Ya tienes una cuenta? Ir al login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="public/vendor/jquery/jquery.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="public/js/sb-admin-2.min.js"></script>

</body>

</html>



