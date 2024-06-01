<?php

class c_notificacion extends Controller
{
    public function __construct()
    {
        if (isset($_GET['mensaje'])) {
            $this->m_nuevoMensaje();
        }
    }


    public function index()
    {
    }

    public function notificacionPorRolLogin()
    {
        $db   = $this->loadModel('consultas.sql', 'sql');  // Carga modelo
        $objs = new Session();
        $s    = $objs->desencriptaSesion();
        $r    = $db->verNotificaciones($s['usuario']['ID_rol_n']);
     //  Controller::ver($r);
        if (isset($_SESSION['usuario'])) {
            foreach ($r as $row) {
                switch ($row[4]) { // id_notificacion
                    case 1: // Activar cuenta admin
                        $ruta = 'admin/controlUsuarios';
                        $m    =  $row['nom_tipo'] . ' Id usuario: ' . $row['descript'];
                        $id   =  $row['descript'];
                        $ac   =  'bId';
                        break;
                    case 3: // producto agitado - logistica
                        $ruta = '/producto';
                        $m    =  $row[5];
                        break;
                    case 4:// informe mensual - supervisor
                        $ruta = 'supervisor/infvrango';
                        $m    = $row[5];
                        break;
                    case 5: // Reporte de venta pendiente dar permisos en menu usuario
                        if ($s['usuario']['ID_rol_n'] == 4) { // si es ventas
                            $ruta = 'supervisor/facturas';
                            $us   = $s['usuario']['ID_us'];
                            $m    = $row[5];
                        }
                         $ruta = 'supervisor/facturas';
                         $m    = $row[5];
                        break;
                    case 8:
                          $ruta = 'admin/logActividad';
                          $m    =  $row[5];
                          $id   = '';
                        break;
                    case 10:
                        $ruta =  'index/promocion';
                        $m    =  $row[5];
                        break;
                    case 11: // pedido  - proveedor
                        $ruta = 'proveedor/pedidos';
                        $m    =  $row[5];
                        break;
                    case 12:
                        $ruta = 'comercial/solicitud';
                        $m    = $row[5];
                        break;
                }
                $a[] = [ $m, $ruta, ($ac ?? ''), ($id ?? ''), ($us ?? '') ];
            }

            if (count($a) != 0) {
                return [ 'response_status' => 'ok', 'response_msg' => $a ];
            } else {
                return [ 'response_status' => 'error', 'response_msg' => 'No hay notificaciones'];
            }
        }
    }


// NOTIFICACIONES
//-----------------------------------------------------------------------------

    public function verNotificaciones()
    {
        if (isset($_SESSION['usuario'])) {
            $db      = $this->loadModel('consultas.sql', 'sql');  // Carga modelo
            $id_rol  = openssl_decrypt($_SESSION['usuario']['ID_rol_n'], COD, KEY);
            return     $this->notificacion  = $db->verNotificaciones($id_rol);
        }
    }

    public function countNotificcacion()
    {
        return count($this->notificacion);
    }
//--------------------------------------------------------------------------------
// MENSAJES

    public function m_nuevoMensaje()
    {
        $db      = $this->loadModel('consultas.sql', 'sql');  // Carga modelo
        $estado = 0;
        $FK_rol = 1;
        $FK_ms =  1;
        $descrip = $_GET['mensaje'];
        $a = [ $estado, $descrip, $FK_rol , $FK_ms ];
        $db->insertMensaje($a);
        echo '<meta http-equiv="REFRESH" content="0;url=' . APP_LIBS . 'notificacion.php">';
    }


    public function m_verMensajes()
    {
        $db  = $this->loadModel('consultas.sql', 'sql');  // Carga modelo
        return $db->verMensaje1();
    }






//-------------------------------------------------------------------------------
}
