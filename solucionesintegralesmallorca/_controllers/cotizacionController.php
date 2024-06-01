<?php

include_once 'userController.php';



class cotizacionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->objM = $this->loadModel('userModel', 'userModel');
        $this->db = new c_MySQLi();
        $this->_view->products = [];

      //  Controller::ver(md5('password'));
    }


    public function index()
    {
    }

    public function test()
    {
        $this->_view->setCss(['new/bootstrapv5.min','new/bootstrapv4.min','new/jav','new/new-index']);
        $this->_view->setJs(['new/jquery-3.3.1.slim.min','new/popper.min','wow','new/bootstrapv4.min']);
        $this->_view->renderizar('test', 1);
    }


    public function selectAction()
    {
        if (isset($_POST['action'])) {
            switch ($this->getSql('action')) {
                case 'search':
                    $this->searchProduct();
                    break;

                default:
                    # code...
                    break;
            }
        }
    }
};
