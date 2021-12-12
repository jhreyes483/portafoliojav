<?php
require_once '_controller/prodbController.php';
$obj = new prodbController;
$c   = $obj->peticionGrafico();
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
  <link href="public/css/searchstyle.css" rel="stylesheet">
  <link href="https://jfa.herokuapp.com/sicloud/public/layout1/css/fontawasome-ico.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="template/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="public/css/stylebacklog.css" rel="stylesheet">
  <script src="https://jfa.herokuapp.com/sicloud/public/layout1/js/fontawasome-ico.js"></script>
  <script src="public/js/jquery-3.5.1.min.js"></script>
  <script src="public/js/searchmain.js"></script>
  <!-- Custom styles for this template-->
</head>

<body id="page-top">
  <div id="wrapper">
    <?php include './public/body/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include './public/body/navbar.php'; ?>
        <div class="container-fluid">
          <div class="card-header text-center bg-primary text-white">
            <label for="" class="lead">SPRINT BACKLOG</label>
          </div>

          <form action="" method="post">
            <div class="row col-md-8 mx-auto form-group">
              <div class="col-md-4 mx-auto">
                <label class="my-2" for="">Usuario</label>
                <select name="us" class="form-control col-md-5" onchange="submit(this)">
                  <?php
                  echo '<option value="">Todo los usuarios</option>';
                  foreach ($c['u'] as $i => $d) {
                    echo '<option ' . (($i == $_REQUEST['us']) ? ' selected ' : '') . ' value="' . $i . '">' . $d . '</option>';
                  }
                  ?>
                </select>

              </div>
              <div class="col-md-4 mx-auto">
                <label class="my-2" for="">Proyectos</label>
                <select name="id_proyecto" class="form-control col-md-5" onchange="submit(this)">
                  <?php
                  echo '<option value="">Todos los proyectos</option>';
                  foreach ($c['p'] as $i => $d) {
                    echo '<option  ' . (($i == $_REQUEST['id_proyecto']) ? ' selected ' : '') . '  value="' . $i . '">' . $d . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-4  ">
                <a href="tareas.php" class="btn my-5  mx-auto btn-primary">Product-backolg</a>
              </div>
            </div>
          </form>
          <?php


          if ($c['t']['response_status'] == 'ok') {
          ?>

            <div class="card-body p-0 my-4 ">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Forecast</th>
                    <th scope="col">To-Do</th>
                    <th scope="col">In-Progress</th>
                    <th scope="col">Done</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($c['t']['response_msg'] as $i => $d) {


                  ?>

                    <tr>
                      <td width="200">
                        <div class="col-md-12">
                          <div class="card  p-3 text-center  " id="card">
                            <p title="<?= $i ?>"><?= $i ?></p>
                          </div>
                        </div>
                      </td>
                      <td width="310">
                        <div class="row">
                          <?php
                          if (is_array($d)) {
                            foreach ($d as $item => $v) {
                              $o = 5;
                              if ($c['c'][$i][1]  % 2 != 0) $o = 5;
                              //  if ($c['c'][$i][1] == 1) $o = 10;
                              if ($v[1]  != '') {
                                $dt = explode('||', $v[1]);
                          ?>
                                <div class="card col-md-<?= $o ?> col-sx-5 my-3 mx-auto card2">
                                  <p title="<?= $dt[1] ?>"><?= $dt[0]  ?></p>
                                </div>
                          <?php
                              }
                            }
                          }
                          ?>
                        </div>

                      </td>
                      <td width="310">
                        <div class="row">
                          <?php
                          if (is_array($d)) {
                            foreach ($d as $item => $v) {
                              $o = 5;
                              if ($c['c'][$i][2]  % 2 != 0) $o = 5;
                              //if ($c['c'][$i][2] == 1) $o = 10;
                              if ($v[2]  != '') {
                                $dt = explode('||', $v[2]);
                          ?>
                                <div class="card col-md-<?= $o ?> col-sx-5 my-3 mx-auto card2">
                                  <p title="<?= $dt[1] ?>"><?= $dt[0]  ?></p>
                                </div>
                          <?php
                              }
                            }
                          }
                          ?>
                        </div>


                      </td>
                      <td width="310">
                        <div class="row">
                          <?php
                          if (is_array($d)) {
                            foreach ($d as $item => $v) {
                              $o = 5;
                              // Controllers::ver($c['c'][$i][3]);
                              if ($c['c'][$i][3]  % 2 != 0 || $c['c'][$i][3] == 1) $o = 5;
                              if ($v[3]  != '') {
                                $dt = explode('||', $v[3]);
                          ?>
                                <div class="card col-md-<?= $o ?> col-sx-5 my-3 mx-auto card2">
                                  <p title="<?= $dt[1] ?>"><?= $dt[0]  ?></p>
                                </div>
                          <?php
                              }
                            }
                          }
                          ?>
                        </div>

                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
      <?php include './public/body/footer.php'; ?>

    </div>
  </div>
</body>


</html>