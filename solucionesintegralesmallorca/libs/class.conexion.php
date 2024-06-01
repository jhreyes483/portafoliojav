<?php
require_once __DIR__ . '../../../vendor/autoload.php';
 @session_start();

class c_MySQLi extends mysqli
{
    public function __construct()
    {
        /*  
        $this->DB_HOST = 'localhost';
        $this->DB_USER = 'u227058085_db_admon';
        $this->DB_PASS = 'devM4ll0rc4*';
        $this->DB_NAME = 'u227058085_db_mallorca';
        */
        parent:: __construct();
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '../../../');
        $dotenv->load();
        $this->conexion = mysqli_connect(
            $_ENV['MALLORCA_DB_HOST'], 
            $_ENV['MALLORCA_DB_USERNAME'], 
            $_ENV['MALLORCA_DB_PASSWORD'], 
            $_ENV['MALLORCA_DB_DATABASE'], 
            ) or die('Se genero un error de acceso ' . __LINE__);
    }


    public function __destruct()
    {
        $this->conexion->close();
    }

    public function m_ejecuta($sql)
    {
        $resultado = mysqli_query($this->conexion, $sql);
        if ($resultado) {
            return $resultado;
        } else {
            $errorString = mysqli_error($this->conexion);
        //defino antes de anular la transaccion
            $errorNumber = mysqli_errno($this->conexion);
            $this->m_anulaTRANS();
            die("<br>$sql $errorString");
        }
    }

    public function m_trae_lista($rs)
    {
        return mysqli_fetch_assoc($rs);
    }

    public function m_trae_array($sql, $tipo = 0)
    {
        $rs = $this->m_ejecuta($sql);
        if ($rs) {
            $i = 0;
            $data = array();
        ##Retorna un Objeto
            if ($tipo < 2) {
                if ($tipo == 0) {
                    while ($result = mysqli_fetch_row($rs)) {
                        $data[$i] = $result;
                        $i++;
                    }
                } else {
                //el indice del arreglo es el nombre del campo

                    while ($result = mysqli_fetch_assoc($rs)) {
                        $data[$i] = $result;
                        $i++;
                    }
                }

                mysqli_free_result($rs);

                $query = new stdClass();
                $query->row = isset($data[0]) ? $data[0] : array();
                $query->rows = $data;
                $query->num_rows = $i;

                unset($data);
            } else {
        //Retorna un array donde el indice es el primer campo
                while ($result = mysqli_fetch_row($rs)) {
                    $query[$result[0]] = $result[1];
                }
            }
            return $query;
        } else {
            return true;
        }
    }

    public function m_trae_array_vsp($sql, $tipo = 0)
    {
        $rs = $this->m_ejecuta($sql);
        if ($rs) {
            $i = 0;
            $data['data'] = array();
        ##Retorna un Objeto
            switch ($tipo) {
                case 0:
                    while ($result = mysqli_fetch_row($rs)) {
                        $data['data'][$i] = $result;
                        $i++;
                    }
                    if (isset($data['data'][0][0]) &&  $data['data'][0][0] == 'Error') {
                        $data['status'] = 0;
                        $data['msg']    = $data['data'][0][2] ?? 'error no espesifico';
                        $this->logError($data['msg'], $sql, 1);
                    } else {
                        $data['status'] = 1;
                        $data['msg']    = 'ok';
                    }

                    return $data;
                break;
                case 1: # array
                    while ($result = mysqli_fetch_assoc($rs)) {
                        $data['data'][$i] = (object) $result;
                        $i++;
                    }

                    if (!isset($data['data'][0]->Level)) {
                        $data['status'] = 1;
                        $data['msg']    = 'ok';
                    } else {
                        $data['status'] = 0;
                        $data['msg']    = $data['data'][0]->Message ?? 'error no espesifico';
                        $this->logError($data['msg'], $sql, 1);
                    }

                    return $data;

                    break;
                case 2:
                    while ($result = mysqli_fetch_row($rs)) {
                        $query[$result[0]] = $result[1];
                    }

                    break;

                default:
                    # code...


                    break;
            }

            $query = new stdClass();
            $query->row = isset($data[0]) ? $data[0] : array();
            $query->rows = $data;
            $query->num_rows = $i;
            return $query;

        /*
                   if($tipo<2){
               if($tipo==0){
                  while ($result = mysqli_fetch_row($rs)) {
                      $data['data'][$i] = $result;
                       $i++;
                  }
              }else{ //el indice del arreglo es el nombre del campo

                   while ($result = mysqli_fetch_assoc($rs)) {
                        $data['data'][$i] = $result;
                       $i++;
                  }
              }
                */

                mysqli_free_result($rs);

                $query = new stdClass();
            $query->row = isset($data[0]) ? $data[0] : array();
            $query->rows = $data;
            $query->num_rows = $i;
            return $query;

                unset($data);
        } else {
        //Retorna un array donde el indice es el primer campo
            while ($result = mysqli_fetch_row($rs)) {
                $query[$result[0]] = $result[1];
            }
        }
            return $query;
    }


    public function logError($error, $file, $type)
    {

        $params = [
            'p_error' => $error ,
            'p_file'  => $file ,
            'p_type_error' => $type ,
            'p_now' => date('Y-m-d H:i:s')

        ];
//       $insert = $this->db->execSP2('lsp_create_log_events_lv1( "1","'.date('y-m-d H:i:s').'","'.$this->userController->getIp().'" )');
        $r = $this->execSP2("lsp_create_error__system_lv1( '" . json_encode($error) . "','" . json_encode($file) . "','" . json_encode($type) . "','" . date('Y-m-d H:i:s') . "' )");
        return $r;
    }

    public function execSP2($sp, $tipo = 0)
    {

        $this->cleanTraceSp();
        $command = 'call ' . $sp;
/*
        $command = "CALL " . $spName ."(";

        $counter = 0;
       $c = "'";
        foreach ($params as $key => $value) {
            $value =  str_replace ( ['"', "'"],'', $value);
            $command.=  $c.$value.$c.(  $counter != (count($params)-1) ? ',':'' );
         $counter ++;
        }
        $command .= ")";
        //echo $command;
        */
        return $this->m_trae_array_vsp($command, $tipo);
    }



    public function execSP($spName, $params, $read = true, $tipo = 0)
    {

        $this->cleanTraceSp();
        $command = "CALL " . $spName . "(";
        $counter = 0;
        $c = "'";
        foreach ($params as $key => $value) {
            $value =  str_replace(['"', "'"], '', $value);
            $command .=  $c . $value . $c . (  $counter != (count($params) - 1) ? ',' : '' );
            $counter++;
        }
        $command .= ")";
//echo $command;
        return $this->m_trae_array_vsp($command, $tipo);
    }

    private function cleanTraceSp()
    {
        while (mysqli_next_result($this->conexion)) {
            if ($result2 = mysqli_store_result($this->conexion)) {
                mysqli_free_result($result2);
            }
        }
    }

    public function m_trae_row($rs)
    {
        return mysqli_fetch_row($rs);
    }

    public function m_num_rows($rs)
    {
        return mysqli_num_rows($rs);
    }

    public function m_afectadas()
    {
        return mysqli_affected_rows($this->conexion);
    }

    public function m_ultInsertado()
    {
        return mysqli_insert_id($this->conexion);
    }

    public function m_empiezaTRANS()
    {
        $null = mysqli_query($this->conexion, 'START TRANSACTION');
        return mysqli_query($this->conexion, 'BEGIN');
    }

    public function m_anulaTRANS()
    {
        return mysqli_query($this->conexion, 'ROLLBACK');
    }

    public function m_confirmaTRANS()
    {
        return mysqli_query($this->conexion, 'COMMIT');
    }
    public function m_error()
    {
        return mysqli_error($this->conexion);
    }
    public function m_error_no()
    {
        return mysqli_errno($this->conexion);
    }
    public function m_escape($str)
    {
        return mysqli_real_escape_string($this->conexion, $str);
    }

    static function fNum($v, $d = 2, $sd = '.', $sm = '')
    {
        $nFor = sprintf("%.{$d}f", $v);
        return $nFor;
    }



    public function m_clean($input)
    {
        if ($input === true || $input === false || $input === null) {
# is true, false, or null
            return $input;
        }

        if (is_array($input)) {
# is array
            foreach ($input as $key => $val) {
# sanitize both the keys and the values for good measure
                $clean_key          = self::clean($key);
                $input[$clean_key]  = self::clean($val);
            }
        } else {
        # is scalar
            $input = mysqli_real_escape_string($this->conexion, htmlspecialchars(trim($input), ENT_QUOTES, 'ISO-8859-1', false));
        }
        return $input;
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
        if ($sale == 1) {
            die();
        }
        if ($email != '') {
            mail('soporte@itt.com.co', 'SQL', $dato, '');
        }
    }
}
