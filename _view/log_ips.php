<?php
require_once '../public/body/header.php';
include_once '../autoload.php';

use _controller\userController;
use _controller\Controller;
//Controller::ver()

$obj = new userController;
$c   = $obj->getLogIp();
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
                    <div class="card">
                        <div class="card-body">
                            <table class=" mx-auto my-5 table table-bordered table-striped table-hover bg-white table-sm">
                                <thead>
                                    <tr>
                                        <th>Id log</th>
                                        <th>creción enveto</th>
                                        <th>creción ciudad</th>
                                        <th>País</th>
                                        <th>Ciudad</th>
                                        <th>Longitud</th>
                                        <th>Latitud</th>
                                        <th>accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($c['logs'] as $d) {
                                    ?>
                                        <tr>
                                            <form method="post" action="location.php">
                                                <input type="hidden" name="a" value="update">
                                                <td><?= $d['id'] ?></td>
                                                <td><?= $d['event_created_at'] ?></td>
                                                <td><?= $d['city_created_at'] ?></td>
                                                <td><?= $d['co_name'] ?></td>
                                                <td><?= $d['c_name'] ?></td>
                                                <td><?= $d['longitud'] ?></td>
                                                <td><?= $d['latitud'] ?></td>
                                                <input type="hidden" name="lat" value="<?= $d['latitud'] ?>">
                                                <input type="hidden" name="lng" value="<?= $d['longitud'] ?>">
                                                <input type="hidden" name="location" value="<?= $d['c_name'] . ', ' . $d['co_name'] ?>">

                                                <td class="text-center">
                                                    <input type="submit" value="ver" class="btn btn-sm btn-primary">
                                                </td>
                                        </tr>
                                        </form>
                                        </tr>

                                    <?php
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
            <?php include '../public/body/footer.php'; ?>
        </div>
    </div>
</body>