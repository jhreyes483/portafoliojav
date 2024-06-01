<?php

/**
 * Autor: Javier Reyes
 */



class indexController extends Controller
{
    public $userController;
    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->_view->products  = [];
        $this->model             = $this->loadModel('userModel', 'userModel');
        $this->db               = new c_MySQLi();
        $this->userController   = new userController();
    }



   /***********************Mallorca *********************************** */


   /**
    * @return void
    * @throws Exception
    */
    public function entidad(): void
    {
        $this->_view->titulo = 'Soluciones integrales Mallorca';
        $this->valiteIsIssetLogin();
        $this->_view->setCss([
         'new/bootstrapv5.min',
         'new/bootstrapv4.min',
         'new/animate',
         'new/jav',
         'new/new-index'
        ]);
        $this->_view->setJs([
         'new/jquery-3.3.1.slim.min',
         'new/popper.min',
         'new/bootstrapv4.min',
         'new/all-jav',
        ]);
        $this->_view->renderizar('entidad', 1, 0, 0, 0);
    }


   /**
    * @return void
    * @throws Exception
    */
    public function index(): void
    {
         $this->_view->titulo = 'Mallorca soluciones integrales';
        if (!session_status() == PHP_SESSION_ACTIVE) {
            @session_start();
        }

        $this->valiteIsIssetLogin();

        $imgSlider = [
         1 => RUTAS_APP['ruta_img'] . 'entity/Construccion.png',
         2 => RUTAS_APP['ruta_img'] . 'entity/Jardineria.png',
         3 => RUTAS_APP['ruta_img'] . 'entity/Limpieza.png'
        ];

        if (isset($_POST['js_slider']) &&  $_POST['js_slider'] == 0) { # peticion usuario
            if (!isset($_POST['slider'])  || $_POST['slider'] == '') {
                $this->_view->sliderCode = 1;
            } else {
                $this->_view->sliderCode = $_POST['slider'];
            }
        } else { # peticion js
            $this->_view->sliderCode = $_POST['js_slider'] ?? 1;
        }

        $this->_view->sliderImg     = $imgSlider[$this->_view->sliderCode]; // cosntruccion

        $this->getAllindexSession();

        $this->_view->telephone   = 34663094553;
        $this->_view->products    = $_SESSION['index']['services'][$this->_view->sliderCode];
        $this->_view->categories  = $_SESSION['index']['categories'];
        $this->_view->allServices = $_SESSION['index']['services'];
        $this->_view->usersComent = $_SESSION['index']['comments'];

        $this->_view->setCss([
         'new/jav-' . $this->_view->sliderCode,
         'new/base-jav',
        // 'new/bootstrapv5.min',

         'new/bootstrap.min',
        // 'new/fontawesome',
         'new/index-mallorca',
       //  'new/font-awesome-v2.min',
         'new/bootstrapv42.min',
         'new/animate',
         'new/all',
        ]);

/*
comprimido
      $this->_view->setCss([
         'new/jav-' . $this->_view->sliderCode,
         'new/base-jav',
        // 'new/bootstrapv5.min',

         'new/bootstrap.min',
        // 'new/fontawesome',
         'new/index-mallorca',
       //  'new/font-awesome-v2.min',
         'new/bootstrapv42.min',
         'new/animate',
         'new/all',
      ]);
 */


        $this->_view->setJs([
         'new/jquery-3.3.1.slim.min',
         'new/popper.min',
         'new/wow',
         'new/bootstrapv4.min',
         'new/bootstrap.bundle.min',
         'new/all-jav',
         'new/axios.min'
        ]);

        $this->_view->renderizar('cotiza', 1);
    }



   /**
    * @return void
    */
    public function getAllindexSession(): void
    {
        $this->userController->validateIseetMsg();
        if (
            //true
            !isset($_SESSION['index']['services']) ||  count($_SESSION['index']['services']) == 0
        ) {
            try {
             //  $resp     = $this->db->execSP('lsp_get_all__services_lv1', ['status' => 1]);
                $resp     = $this->db->execSP2('lsp_get_all__services_lv1(1)');
                $temp     = $this->formatModal($resp['data']);


                $comments    = $this->db->execSP2('lsp_get_user__recommendations_lv1()');
                foreach ($temp as $key => $item) {
                    $result[$item[15]][] = $item;
                    $category[$item[15]] = $item[5];
                }
                $_SESSION['index']['services']   = $result;
                $_SESSION['index']['categories'] = $category;
                $_SESSION['index']['comments']   = $comments['data'];
            } catch (\Throwable $th) {
                die($th->getMessage() . $th->getFile() . $th->getLine());

              // $this->db->logError($th->getMessage(), $th->getFile(), 2);
            }
        }
    }

   /**
    * @param $temp
    * @return array
    */
    public function formatModal($temp): array
    {
         $class = 1;
         $classColor = [1 => 'box-card-green', 2 => 'box-card', 3 => 'box-card-blue'];
        foreach ($temp as $key => $product) {
            if ($class > 3) {
                $class = 1;
            }
            $body = $product[2];
            $body = str_replace('[classColor]', $classColor[$class], $body);
            if (isset($product[13])) {
                $body = str_replace('[title]', $product[13], $body);
            } else {
                $body = str_replace('[title]', ' ', $body);
            }
            if (isset($product[10])) {
                $body = str_replace('[head]', $product[10], $body);
            }
            if (isset($product[12])) {
                $body = str_replace('[imgs]', $product[12], $body);
            }
            if (isset($product[11])) {
                $body = str_replace('[fotter]', $product[11], $body);
            }
            $body = str_replace('http://localhost/proyecto_/', BASE_URL, $body);
            $temp[$key][2] = $body;
            $class++;
        }
         return $temp;
    }

   /**
    * @return void
    */
    public function cerrar(): void
    {
        $this->userController->closeSession();
    }

    public function contactato_consulta()
    {
        $this->_view->titulo = 'Mallorca soluciones integrales';
        $this->valiteIsIssetLogin();

        $this->_view->setCss([
         'new/bootstrapv5.min',
         'new/bootstrapv4.min',
         'new/animate',
         'new/jav',
         'new/new-index'
        ]);
        $this->_view->setJs([
         'new/jquery-3.3.1.slim.min',
         'new/popper.min',
         'new/bootstrapv4.min',
          'new/all-jav',
        ]);
       //$this->_view->renderizar('contactanos', 1);
        $this->_view->renderizar('contactanos', 1, 0, 0, 0);
    }


    public function countClicks()
    {

            $location = $this->userController->getLocationUser($this->userController->getIp());
            $location = $location['data'];
            $r = $this->db->execSP2(
                'lsp_validate_location__by_ip_lv1( "'
                    . $location['country'] . '","'
                    . $location['city'] . '","'
                    . $location['timezone'] . '","'
                    . $location['zip'] . '","'
                    . $location['countryCode'] . '","'
                    . date('Y-m-d H:i:s') . '" )'
            );
            $city_id    = $r['data'][0][1];
            $country_id = $r['data'][0][2];


       /*
      $insert = $this->db->execSP(
         'lsp_create_log_events_lv1',
         [
            'p_type_event_id' => 1,
            'p_now'          => date('y-m-d H:i:s'),
            'p_ip'           => $this->userController->getIp()
         ]
      );

       */

          $insert = $this->db->execSP2(
              'lsp_create_log_events_lv1( 
            "1","'
              . date('y-m-d H:i:s') . '","'
              . $this->userController->getIp() . '","'
              . $city_id . '","'
              . $country_id . '")'
          );

      // $insert = $this->db->execSP2('lsp_create_log_events_lv1( "1","'.date('y-m-d H:i:s').'","'.$this->userController->getIp().'",".$city_id.",".$country_id." )');

        if ($insert['status']) {
            $this->setResponseJson(true, ['type' => 'success', 'content' => 'ok'], ['message' => 'insert ok']);
        } else {
            $this->setResponseJson(false, ['type' => 'warning', 'content' => 'No data proccess'], ['message' => 'error al insertar']);
        }
    }


    public function getCategory()
    {
 // 0
        $request = $this->getRequestAxios();
        $data    = $_SESSION['index']['services'][$request['slider']];
        $reponse = ['status' => 1, 'msg' => '', 'items' => $data];
        echo json_encode($reponse);
    }
}
