<?php

class mailModel
{
    public function m_consulta()
    {
        $this->db =  new c_MySQLi();
    }


    public function m_insert($tipo, $p)
    {
        switch ($tipo) {
            case 1: // inserta configuracion
                 $sql =
                         'INSERT INTO config (id_config, mailRemitente, host, puerto, pasword) 
            VALUES (NULL, "' . $p[0] . '", "' . $p[1] . '", "' . $p[2] . '", "' . $p[3] . '")';

                break;
            case 2:  // inserta registro de correo
                 $id_config  = $this->db->m_ultimo_id($p);
                     $sql =
                       'INSERT INTO log_correos (id, asunto, body, format, mailEnvio, titulo, remitente, estado, error, id_config, fecha) 
            VALUES (NULL, "' . $p[0] . '", "' . $p[1] . '", "' . $p[2] . '", "' . $p[3] . '", "' . $p[4] . '", "' . $p[5] . '", "' . $p[6] . '","' . ( $p[7] == 'error' ? $p[8] : "") . '", "' . $id_config . '","' . date('Y-m-d H:i:s') . '")';

                break;
        }
        return $this->db->m_ejecuta($sql);
    }
}
