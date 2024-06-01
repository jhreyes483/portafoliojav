
<?php

namespace _view;

@session_start();
require_once '../autoload.php';
use _controller\indexController;
$obj = new indexController();
$obj->getIp();
die();
