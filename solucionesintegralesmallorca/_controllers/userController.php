<?php

// use Mpdf\Tag\Section;

class userController extends Controller
{
    private $db;
    private $param;
    private $model;
    //
    public function __construct()
    {

        parent::__construct();
        $this->model = $this->loadModel('userModel', 'userModel');
        $this->db    = new c_MySQLi();
        $this->param = $this->getParam();
    }

    public function index()
    {
    }

    public function valiteIsIssetLogin()
    {
        $this->userController       = new userController();
        if (isset($_POST['action'])   && $_POST['action'] == 'login') {
            $this->userController->login();
        }
    }

    public function validateIseetMsg()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'send_msg') {
            $ip = $this->getIp();
            if ($ip == 'UNKNOWN' || $ip == '::1') {
                $ip = '186.155.72.187';
            }
            $location = $this->getLocationUser($ip);
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

            $r = $this->db->execSP2(
                'lsp_msg_user__create_lv1( "'
                . $this->getSql('category_id') . '","'
                . $this->getSql('name') . '","'
                . $this->getSql('cel') . '","'
                . $this->getSql('msg_user') . '","'
                . $ip . '","'
                . $city_id . '","'
                . $country_id . '","'
                . date('Y-m-d H:i:s') . '" )'
            );

            $_SESSION['response'] = [
                'status' => 0,
                'msg'    => 'Mensaje enviado, nos comunicaremos con usted, gracias.'
            ];
        }
    }


    public function getIp()
    {
        ## geolocalizacion IP https://www.cual-es-mi-ip.net/geolocalizar-ip-mapa
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } elseif (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }
        $ipaddress = explode('1', $ipaddress, 1)[0];

        return $ipaddress;
    }

    public function getLocationUser($ip)
    {
        return $this->sendData('http://ip-api.com/json/' . $ip, [], 'get');
    }


    public function login()
    {
        $this->validateRequestEmail();

        if (count($_SESSION['response']) == 0) {
            $login = $this->db->execSP2('lsp_get_user__login_account_lv1("' . $this->getSql('email') . '","' . md5($this->getSql('password')) . '")');
            if (count($login['data']) > 0) {
                $r = new stdClass();
                $r->row = $login['data'][0];
                if (!session_status() == PHP_SESSION_ACTIVE) {
                    @session_start();
                }
                $_SESSION['user'] = [];
                $_SESSION['user']['id']         = $r->row[0];
                $_SESSION['user']['name']       = $r->row[1];
                $_SESSION['user']['photo']      = $r->row[2];
                $_SESSION['user']['document']   = $r->row[3];
                $_SESSION['user']['created_at'] = $r->row[4];
                $_SESSION['user']['rol_id']     = $r->row[5];
                $_SESSION['user']['rol_name']   = $r->row[6];
                $_SESSION['user']['status']     = $r->row[7];
                $this->verificarAcceso();
            } else {
                $_SESSION['response'] = [
                    'status' => 0,
                    'msg'    => 'Credenciales incorrectas'
                ];
                //echo '<script>alert("Credenciales incorrectas")</script>';
            }
        }
    }


    public function closeSession()
    {
        session_destroy();
        $this->redireccionar('index');
    }

    private function validateRequestEmail()
    {
        $response = [];
        if (isset($_POST) && !empty($_POST)) {
            if (!isset($_POST['email'])  || $_POST['email'] == '') {
                $response = [
                    'status' => 0,
                    'msg'    => 'Debe ingresar correo'
                ];
            } else {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $response = [
                        'status' => 0,
                        'msg'    => 'Correo invalido'
                    ];
                }
            }

            if (!isset($_POST['password']) || $_POST['password'] == '') {
                $response = [
                    'status' => 0,
                    'msg' => 'Debe ingresar contraseña'
                ];
            }

            $_SESSION['response'] = $response;
        }
    }
}
