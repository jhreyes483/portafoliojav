<?php
class proveedorController extends Controller{

    public function __construct(){
        parent::__construct();
        $this->_view->setCss(array( 'font-Montserrat' , 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
       // $this->_view->setJs(array('jquery-3.5.1.min','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery'));
        $this->db       = $this->loadModel('consultas.sql', 'sql');
    }
    //
    public function index(){
        $this->_view->renderizar('index');
    }

    public function pedido(){
        if(isset ($_POST['accion'])){
            switch ($_POST['accion']) {
                case 'insertPedido':
                    $pDB = $this->db->verProductos();
                    $mDB = $this->db->verMedida();
                    foreach( $pDB as $d ){
                        $precio[$d[0]] = $d[3].'@@@'.$d[2].'@@@'.$d[1];
                    }
                    foreach($mDB as $d){
                        $medida[$d[0]] = $d[1];
                    }
                    $aN=[
                        0, // estado
                        $this->getSql('documento').'@@@'.
                        $this->getSql('nom').'@@@'.
                        $this->getSql('ape').'@@@'.
                        $this->getSql('tel').'@@@'.
                        $this->getSql('email').'@@@'.  
                        $this->getSql('cantidad').'@@@'.  
                        $this->getSql('prod').'@@@'.  
                        $this->getSql('med').'@@@'.  
                        $this->getSql('descript').'@@@'. 
                        $precio[$this->getSql('prod')].'@@@'.
                        $medida[$this->getSql('med')].'@@@'.  
                        date('Y-m-s').'@@@'.
                        date('h:i'),
                        5, // llave foranea de usuario notificacion "rol de usario al que llega"
                        11 // tipo de notificacion
                     ];
                   //  Controller::ver($aN,1,1);
                     $b = $this->db->notInsertUsuario($aN);
                     if($b){
                        $this->_view->datos = ['color'=> 'success', 'response_msg' =>  'Su mensaje se envio con exito'];
                     }else{
                        $this->_view->datos = ['color' => 'danger', 'response_msg' => 'Error al emviar el mensaje' ];
                     }
                  break;
            }
        }

        $s = new Session();
        $u = $s->desencriptaSesion();
        $this->_view->us = [
            $u['usuario']['ID_us'],
            $u['usuario']['nom1'].' '.$u['usuario']['nom2'],
            $u['usuario']['ape1'].' '.$u['usuario']['ape2'],
            $u['usuario']['correo']
        ];
        $pDB =  $this->db->verProductos();
        $mDB =  $this->db->verMedida();
        foreach( $pDB as $d ){
            $f[$d[0]] = [$d[2], $d[3]];
        }
        foreach($mDB as $d){
            $m[$d[0]] = $d[1];
        }
        $this->_view->med  = $m;
        $this->_view->prod = $f;
       // $this->getSeguridad('DFERA');
        $this->_view->renderizar('pedidoproducto');
    }

    public function pedidos(){
        $this->getSeguridad('WSGOS1C');
        $this->_view->setJs(['all']);
        $pDB = $this->db->verProductos();
        foreach( $pDB as $d ){
            $precio[$d[0]] = $d[3];
        }
        $r =  $this->db->verNotificaciones(5,11);
        if( count($r) != 0){
            $this->_view->datos =['response_status'=>'ok', 'response_msg' => $r ];
        }else{
            $this->_view->datos =['response_status'=>'error', 'response_msg' => 'No hay pedidos' ];
        }
        $this->_view->renderizar('consultaPedidos');
    }

    public function detalle(){ // detalle de pedido porducto
        if(isset($_GET['id'])){
            $r = $this->db->verNotificacionId($_GET['id'] );
           
            if(count($r[0]) != 0 ){

                foreach( $r  as $d  ) $a = [ $d[0], $d[1] , $d[2] , $d[3] , $d[4] , $d[5]   ];
                $this->_view->datos = ['response_status' => 'ok', 'response_msg' => $a ];
            }else{
                $this->_view->datos = ['response_status' => 'error', 'response_msg' => 'No hay datos' ];
            }
        }else{
            $this->datos->_view = ['response_status'=> 'No ingreso id de notificaion'];
        }
        $this->_view->renderizar('pedidoDetalle',0);
    }

}
?>
