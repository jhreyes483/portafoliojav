<?php

class C_sanear
{
   // zanetiza
    protected function getSql($name, $metodo = 'p')
    {
        switch ($metodo) {
 // extrae metodos
            case 'p':
                if (isset($_POST[$name]) && !empty($_POST[$name])) {
                    $_POST[$name] = strip_tags($_POST[$name]);
                    return trim($_POST[$name]);
                }

                break;
            case 'g';
                if (isset($_GET[$name]) && !empty($_GET[$name])) {
                    $_GET[$name] = strip_tags($_GET[$name]);
                    return trim($_GET[$name]);
                }

 break;
            case 'r';
                if (isset($_REQUEST[$name]) && !empty($_REQUEST[$name])) {
                    $_REQUEST[$name] = strip_tags($_REQUEST[$name]);
                    return trim($_REQUEST[$name]);
                }

 break;
        }
    }

    protected function getInt($name)
    {
        if (isset($_POST[$name]) && !empty($_POST[$name])) {
            $_POST[$name] = filter_input(INPUT_POST, $name, FILTER_VALIDATE_INT);
            return $_POST[$name];
        }
        return 0;
    }



    protected function verficaParametros($params)
    {
        $avaible             = true;
        $missingparams       = '';
        foreach ($params as $param) {
            if (!isset($_POST[$param]) || strlen($_POST[$param]) <= 0) {
                $avaible       = false;
                $missingparams = $missingparams . ',' . $param;
            }
        }
       // Si faltan parametros
        if (!$avaible) {
            die('Parametros:' . substr($missingparams, 1, strlen($missingparams)) . 'vacion');
        }
    }


    protected function verificaResult($a, $tipo = 1)
    {
        switch ($tipo) {
            case 0:
                if (count($a) != 0) {
                    return ['response_status' => 'ok', 'response_msg' => $a];
                } else {
                    return ['response_status' => 'error', 'response_msg' => 'No hay datos'];
                }

                break;
            case 1:
                if (count($a) != 0) {
                    return ['status' => 'ok', 'msg' => $a];
                } else {
                    return ['status' => 'error', 'msg' => 'No hay datos'];
                }

                break;
            case 2:
                if (isset($a->num_rows) && $a->num_rows != 0) {
                    return ['status' => 'ok', 'msg' => $a];
                } else {
                    return ['status' => 'error', 'msg' => 'No hay datos'];
                }

                break;
        }
    }


    public function limpiaArray($stringPorComas, $tipo = 'a')
    {
        $arrayResult = (array_unique(array_filter(explode(',', $stringPorComas))));
        switch ($tipo) {
            case 'a': // Retorna un arreglo sin valores vacíos ni repetidos
                return $arrayResult;
            break;
            case 's': // Retorna un string sin valores vacíos ni repetidos
                return implode(', ', $arrayResult);
            break;
        }
    }
}
