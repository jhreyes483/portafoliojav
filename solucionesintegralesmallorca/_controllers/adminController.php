<?php

class adminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->db               = new c_MySQLi();
    }

    public function index()
    {


        $this->_view->setCss([
            'new/bootstrapv5.min',
           # 'new/jav-' . $this->_view->sliderCode,
            'new/bootstrap.min',
            'new/fontawesome',
            'new/index-mallorca',
            'new/font-awesome-v2.min',
            'new/bootstrapv42.min',
            'new/animate',
            'new/all',
         ]);
         $this->_view->setJs([
            'new/jquery-3.3.1.slim.min',
            'new/popper.min',
            'new/wow',
            'new/bootstrapv4.min',
            'new/bootstrap.bundle.min',
            'new/all-jav',
            'new/axios.min'
         ]);

         $this->_view->options['system'] = [
           // ['interagcion con chat','admin/logChat'],
            ['solicitudes usuario','admin/solicitud']
         ];

         $this->_view->renderizar('index', 1);
    }



    public function solicitud()
    {
        $this->_view->setCss([
         'new/bootstrapv5.min',
        # 'new/jav-' . $this->_view->sliderCode,
         'new/bootstrap.min',
         'new/fontawesome',
         'new/index-mallorca',
         'new/font-awesome-v2.min',
         'new/bootstrapv42.min',
         'new/animate',
         'new/all',
        ]);
        $this->_view->setJs([
         'new/jquery-3.3.1.slim.min',
         'new/popper.min',
         'new/wow',
         'new/bootstrapv4.min',
         'new/bootstrap.bundle.min',
         'new/all-jav',
         'new/axios.min'
        ]);
        if (!isset($_SESSION['user']) ||  !in_array($_SESSION['user']['rol_id'], [1])) {
            die('ingreso no autorizado');
        }
        $p2 = (isset($_POST['category_id']) &&  $_POST['category_id'] == '0' ? '' : $this->getSql('category_id') );


        $r = $this->db->execSP2('lsp_user_msgs__get_lv1(
        "' . ($_POST['search'] ?? '') . '","' . $p2 . '"

      )');



        $this->_view->solicitudes = $r;
        if (isset($_SESSION['index']['categories'])) {
            $this->_view->categories = $_SESSION['index']['categories'];
        }



        $this->_view->renderizar('solicitud', 1);
    }

    public function logChat()
    {
        $result = $this->db->execSP2('lsp_get_events__chat_lv1()');
        $this->logs = $result['data'];


        $this->_view->setCss([
            'new/bootstrapv5.min',
            'new/jav-' . $this->_view->sliderCode,
            'new/bootstrap.min',
            'new/fontawesome',
            'new/index-mallorca',
            'new/font-awesome-v2.min',
            'new/bootstrapv42.min',
            'new/animate',
            'new/all',
         ]);
         $this->_view->setJs([
            'new/jquery-3.3.1.slim.min',
            'new/popper.min',
            'new/wow',
            'new/bootstrapv4.min',
            'new/bootstrap.bundle.min',
            'new/all-jav',
            'new/axios.min'
         ]);

         $this->_view->renderizar('logChat', 1);
    }
}
