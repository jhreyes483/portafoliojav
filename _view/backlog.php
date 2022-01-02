<?php
//require_once '_controller/prodbController.php';

require_once '../autoload.php';
include '../public/body/header.php'; 
use _controller\prodbController;

$obj = new prodbController;
$c   = $obj->peticionGrafico();
@session_start();
?>

  <link href="../public/css/stylebacklog.css" rel="stylesheet">

  <!-- Custom styles for this template-->
</head>

<body id="page-top">
  <div id="wrapper">
    <?php include '../public/body/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include '../public/body/navbar.php'; ?>
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
      <?php include '../public/body/footer.php'; ?>

    </div>
  </div>
</body>


</html>