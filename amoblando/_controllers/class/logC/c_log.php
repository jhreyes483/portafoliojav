<?php

class Log
{
    private $archivoLog;
   //n/
    public function __construct($ruta = '', $nombreArchivo,)
    {
        {
         $this->archivoLog = fopen($ruta . $nombreArchivo, 'a+');
        }
    }
    public function m_escribeLinea($tipo, $msg)
    {
        fwrite($this->archivoLog, '[' . $tipo . '][' . date('Y-m-s H:i:s') . ']: ' . $msg . "\n");
    }



    public function m_escribeLineaParams($tipo, $arrayPost)
    {
        if ($arrayPost > 0) {
            $txt = '|';
            foreach ($arrayPost as $i => $d) {
                $txt .= ' k:' . $i . '->' . $d . ' |';
            }
        } else {
            $txt = "Parametros vacios";
        }
        fwrite($this->archivoLog, '[' . $tipo . '][' . date('Y-m-s H:i:s') . ']: ' . $txt . "\n");
    }


    public function m_cerrar()
    {
        fclose($this->archivoLog);
    }
}
