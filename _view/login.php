<?php

namespace _view;

require_once '../public/body/header.php';
require_once('../autoload.php');
use _controller\indexController;
$obj = new indexController();

if (isset($_POST['a'])) {
    $obj->login();
}
?>



<body id="page-top" class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">BIENVENIDO A SICLOUD. <br> PORTAFOLIO <br>JAVIER REYES</h1>
                                    </div>
                                    <form   class="user" method="post">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Digita tu correo electronico">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder=" Escribe tu contraseña">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Recordar Contraseña</label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="a" value="login" >
                                        <input type="submit" value="iniciar sesion" class="btn btn-primary btn-user btn-block">
                                
                                        <div class="text-center">
                                            <a class="small" href="forgot-password.html">¿Olvidaste la contraseña?</a>
                                        </div>
                                        <a href="register.php" class="btn btn-primary btn-user btn-block mt-4">
                                        <i class="far fa-user"></i> ¿No tienes una cuenta? Registrate Ya!
                                        </a>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Iniciar sesion con Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Iniciar sesion con Facebook
                                        </a>
                                       
                                    </form>
                                    <hr>
                                    Credenciales publicas <br>
                                    Correo: jav-rn@hotmail.com  <br> Clave: 1
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
