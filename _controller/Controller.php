<?php

namespace _controller;

require_once('../autoload.php');

class Controller
{
  protected function getSql($clave)
  {
    if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
      $_POST[$clave] = strip_tags($_POST[$clave]);
      return trim($_POST[$clave]);
    }
  }

  protected function verificaResul($r)
  {
    if (isset($r) && count($r) > 0) {
      return ['response_status' => 'ok', 'response_msg' => $r];
    } else {
      return ['response_status' => 'error', 'response_msg' => 'No hay datos'];
    }
  }

  protected function objetos($id_objeto)
  {
    switch ($id_objeto) {
      case 1: // estado de proyecto
        return [
          'P' => 'Pendiente', // to do 
          'I' => 'Inicio', // progreso
          'T' => 'Terminado' // Done 
        ];
      case 2: // estado de actividad grafica en linea
        return [
          'p' => 'Productivo',
          'i' => 'Improductivo',
          'e' => 'Horas extra',
          'j' => 'Jornada'
        ];





      default:
        # code...
        break;
    }
  }


  public static function ver($dato, $sale = 0, $bg = 0, $tit = '', $float = false, $email = '')
  {
    switch ($bg) {
      case 1:
        $bgColor = 'b0ffff';
        break;
      case 2:
        $bgColor = 'd0ffb9';
        break;
      default:
        $bgColor = 'ffcfcd';
        break;
    }



    echo '<div style="background-color:#' . $bgColor . '; border:1px solid maroon;  margin:auto 5px; text-align:left;' . ($float ? ' float:left;' : '') . ' padding: 0 7px 7px 7px; border-radius:7px; margin-top:10px; ">';
    echo '<h2 style="padding: 5px 5px 5px 10px;	margin: 0 -7px; color: #FFF; background-color: #FF6F00; border-radius: 6px 6px 0 0; display:flex"><img src="/public/layout1/ico/debugging.png">&nbsp;Debugging for:&nbsp;&nbsp;<span style="color:black">' . $tit . '</span></h2>';
    if (is_array($dato) || is_object($dato)) {
      echo '<pre>';
      print_r($dato);
      echo '</pre>';
    } else {
      if (isset($dato)) {
        echo '<b>&raquo;&raquo;&raquo; DEBUG &laquo;&laquo;&laquo;</b><br><br>' . nl2br($dato);
      } else {
        echo 'LA VARIABLE NO EXISTE';
      }
    }
    echo '</div>';
    if ($sale == 1) die();
    if ($email != '') mail('soporte@itt.com.co', 'SQL', $dato, '');
  }



  public function sendHttp(string $url, array $params = [], string $method = 'POST', $authorization = []): array
  {
    try {
      $resp = ['status' => true, 'data' => [], 'msg' => 'ok', 'url' => $url];
      $body = json_encode($params);

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 60000); // Aumentar el tiempo de espera a 60 segundos (o cualquier valor adecuado)
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

      $headers = $authorization;
      $head    = [
        'Authorization:  Bearer ' . (isset($headers['token']) ? $headers['token'] : ''),
        'Content-Type: application/json'
      ];
      curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
      $response = curl_exec($ch);

      if (curl_errno($ch)) {
        $resp['status'] = false;
        $resp['msg']    = curl_error($ch);
      }
      $resp['data'] = json_decode($response, true);
    } catch (\Throwable $e) {
      $resp['status'] = false;
      $resp['msg'] = 'error->' . $e->getMessage() . ' line->' . $e->getLine() . ' file->' . $e->getFile();
      return $resp;
    }
    $resp['code'] = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    // $resp['time'] = curl_getinfo($ch, CURLINFO_STARTTRANSFER_TIME);
    // $resp['time'] = round($resp['time'] * 1000);
    return $resp;
  }

  public function getLocationUser($ip): array
  {
    return $this->sendHttp('http://ip-api.com/json/' . $ip);
  }

  public function getPublicIp()
  {
    ## geolocalizacion IP https://www.cual-es-mi-ip.net/geolocalizar-ip-mapa
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) {
      $ipaddress = getenv('HTTP_CLIENT_IP');
    } else if (getenv('HTTP_X_FORWARDED_FOR')) {
      $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    } else if (getenv('HTTP_X_FORWARDED')) {
      $ipaddress = getenv('HTTP_X_FORWARDED');
    } else if (getenv('HTTP_FORWARDED_FOR')) {
      $ipaddress = getenv('HTTP_FORWARDED_FOR');
    } else if (getenv('HTTP_FORWARDED')) {
      $ipaddress = getenv('HTTP_FORWARDED');
    } else if (getenv('REMOTE_ADDR')) {
      $ipaddress = getenv('REMOTE_ADDR');
    } else {
      $ipaddress = 'UNKNOWN';
    }
    $ipaddress = explode('1', $ipaddress, 1)[0];

    return $ipaddress;
  }


  public function createLog($typeId, $model, $db): array
  {
    $ip        = $this->getPublicIp();
    // $ip = '186.155.33.182';
    if (!$ip || $ip == 'UNKNOWN') {
      return ['code' => 404, 'status' => false, 'msg' => 'Ip no encontrada'];
    }


    $location  = $this->getLocationUser($ip);
    $location  = $location['data'] ?? false;

    if (isset($location) && !count($location)) {
      return ['code' => 404, 'status' => false, 'msg' => 'Localizacion no encontrada'];
    }
    date_default_timezone_set('America/Bogota');


    $sql      = $model->m_consulta(20, ['WHERE countryCode = "' . $location['countryCode'] . '"']);
    $country  =  $db->m_trae_array($sql, 1)->row;

    if (!isset($country) || !isset($country['id'])) {
      $p[0] = ' countries ';
      $p[1] = [
        $location['countryCode'],
        $location['country'],
        $location['zip'],
        date('Y-m-d H:i:s'),
        date('Y-m-d H:i:s')
      ];

      $sql = $model->m_insert($p);
      $b   = $db->m_ejecuta($sql);

      $sql      = $model->m_consulta(20, ['WHERE countryCode = "' . $location['countryCode'] . '"']);
      $country  =  $db->m_trae_array($sql, 1)->row;
    }

    $sql      = $model->m_consulta(21, ['WHERE name = "' . $location['city'] . '"']);
    $city     =  $db->m_trae_array($sql, 1)->row;


    if (!isset($city) || !isset($city['id'])) {
      $p[0] = ' cities ';
      $p[1] = [
        $location['city'],
        $location['timezone'],
        $country['id'],
        date('Y-m-d H:i:s'),
        date('Y-m-d H:i:s')
      ];

      $sql = $model->m_insert($p);
      $b   = $db->m_ejecuta($sql);

      $sql      = $model->m_consulta(21, ['WHERE name = "' . $location['city'] . '"']);
      $city     =  $db->m_trae_array($sql, 1)->row;
    }

    $p[0] = ' events ';
    $p[1] = [
      $typeId,
      date('Y-m-d H:i:s'),
      date('Y-m-d H:i:s'),
      $ip,
      $city['id'],
      $country['id'],
      $location['lat'],
      $location['lon']
    ];
    $sql = $model->m_insert($p);
    $b   = $db->m_ejecuta($sql);
    return ['code' => 200, 'status' => true, 'msg' => 'se creo el log con id '];
  }

}
