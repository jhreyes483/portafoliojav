<?php
class supervisorController extends Controller{

    public function __construct(){
        parent::__construct();
        $this->db       = $this->loadModel('consultas.sql', 'sql');
        $this->_view->setCss(array( 'font-Montserrat' , 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
        //$this->_view->setJs(array('jquery-1.9.0','tablesorter-master/jquery.tablesorter','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery'));
        //$this->_view->setJs(array('jquery-1.9.0','tablesorter-master/jquery.tablesorter','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery'));
    }
    //
    public function index(){
      //  $this->_view->setJs(array('jquery-1.9.0','tablesorter-master/jquery.tablesorter','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery'));
        $this->_view->renderizar('index');

    }
    //
    public function consFactura(){
      //  $this->_view->setJs(array('jquery-1.9.0','tablesorter-master/jquery.tablesorter','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery'));
        $this->getSeguridad('S1CF');
        $this->_view->setJs(['all']);
        $this->_view->renderizar('consFactura');
    }
    //
    public function consulta(){
        $this->getSeguridad('S1FF');
        if( isset( $_REQUEST['f']) ){
                    $this->verFactura($_REQUEST['f']);
            }
    }
    //
    public function verFactura($id){
        $aFactura = $this->db->verFactura($id);
        if( count($aFactura) == 0){
          $this->_view->factura =  ['response_status'=> 'error', 'response_msg' => 'No existe factura' ];
        }else{
            $aProd = $this->db->consProductosFactura($id);
            $this->_view->factura =  ['response_status' => 'OK', 'response_msg' => [
                    $aFactura,
                    $aProd
                ]
            ];
        }
        $this->_view->renderizar('factura',0);
    }

    public function infFactura(){
        $this->_view->renderizar('generadorInfFactura');
      //  $this->_view->setJs(array('jquery-1.9.0','tablesorter-master/jquery.tablesorter','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery'));
    }

    public function facturasPdf(){
        require_once(ROOT . 'libs/mpdf/repo.php');
       // $this->_view->setJs(array('jquery-1.9.0','tablesorter-master/jquery.tablesorter','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery'));
        //$mpdf = new mPDF('c','A4');
        //Controller::ver($mpdf ,1);
        //$mpdf->writeHTML('<div>HOLA..</div>');
        //$mpdf->Output('repote.pdf','I');
    }

    // PENDINTE CIFRAS A LETRAS
    public function facturas(){

        $this->getSeguridad('S1FF');
       // $this->_view->setJs(['all']);
      // $this->_view->setJs(['all']);
     // $this->_view->setCss(['datatables/datatables.min','datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min', 'fontawesome-all']);
     // $this->_view->setJs(['jquery/jquery-3.3.1.min','popper/popper.min','bootstrap.min','datatables/datatables.min','datatables/Buttons-1.5.6/js/dataTables.buttons.min','datatables/JSZip-2.5.0/jszip.min','datatables/pdfmake-0.1.36/pdfmake.min','datatables/pdfmake-0.1.36/vfs_fonts','datatables/Buttons-1.5.6/js/buttons.html5.min','mainDatable', 'all', 'fontawasome-ico'] );

      if (isset($_POST['consulta'])) {

            extract($_POST);
            $r           = $this->db->verIntervaloFecha($f1, $f2);
            //$v            = new CifrasEnLetras();
            //Convertimos el total en letras
            //$letra = ($v->convertirEurosEnLetras($total));
            if( count($r) != 0 ){
                $total       = array_sum( array_column($r , 11));
                $this->_view->facturas = ['response_status' => 'ok', 'response_msg' => [$r, $total ] ];
            }else{
                $this->_view->facturas = ['response_status' => 'error', 'response_msg' => 'No hay facturas en el rango de fechas' ];
            }
        }
        $this->_view->renderizar('infVentas');
        $this->_view->setTable('facturas', 0);
    }
    // INFORMES
    public function infvrango(){
      //  $this->_view->setJs(array('jquery-1.9.0','tablesorter-master/jquery.tablesorter','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery'));
        $dia           = $this->db->verDia();
        //Controller::ver($dia);
        $totalD         = array_sum(array_column($dia, 1 ));
        $cD             = count($dia);
        $pD             =  floor ( ($totalD/$cD) ); 
        $promedioDia   = number_format($pD, 2, ',', '.');
        //
        $semana           = $this->db->verSemana();
        $totalS          = array_sum(array_column($semana, 1 ));
        $cS              = count($semana);
        $pS              = floor ( ($totalS/$cS) ); 
        $promedioSemana  = number_format($pS, 2, ',', '.');
        //
        $mes             = $this->db->verMes();
        $totalM          = array_sum(array_column($mes, 1 ));
        $cM              = count($mes);
        $pM              = floor ( ($totalM/$cM) ); 
        $promedioMensual = number_format($pM, 2, ',', '.');
        //
        $this->_view->promedio = [
            'dia'     => $promedioDia ,
            'semana'  => $promedioSemana,
            'mes'     => $promedioMensual
        ];


        if(isset($_POST['ventas'])){
            // Encabezado de tabla

                $t3 = 'Total';
                if ($_POST['ventas'] == 'busDia')  $t1 = 'Cantidad ventas';               $t2 = 'Día';
                if ($_POST['ventas'] == 'dia')     $t1 = 'Cantidad';                      $t2 = 'Día';
                if ($_POST['ventas'] == 'semana')  $t1 = 'Ventas por semana'; $t2 = 'Día cierre ventas';
                if ($_POST['ventas'] == 'mes')     $t1 = 'Ventas por Mes';    $t2 = 'Día cierre ventas';
                $this->_view->title = [ ($t1??''), $t2 , $t3 ];

       
            switch ($_POST['ventas']) {
                case 'Dia':
                    if( count($dia) != 0 ){
                        $this->_view->datos = ['response_status'=>'ok', 'response_msg' => $dia ];
                    }else{
                        $this->datos = ['response_status'=>'error', 'response_msg' => 'No hay ventas por dia' ]; 
                    }
                    break;
                case 'Semana':
                    if( count( $semana ) != 0 ){
                        $this->_view->datos = ['response_status'=>'ok', 'response_msg' => $semana ];
                    }else{
                        $this->_view->datos = ['response_status'=>'error', 'response_msg' => 'No hay venatas por semana' ]; 
                    }
                    break;
                
                case 'Mes':
                    if( count($dia) != 0 ){
                        $this->_view->datos = ['response_status'=>'ok', 'response_msg' => $mes ];
                    }else{
                        $this->_view->datos = ['response_status'=>'error', 'response_msg' => 'No hay venatas por mes' ]; 
                    }
                    break;
                case 'busDia':
                    $r = $this->db->verFecha($_POST['fecha']);
                    if( count($r) != 0 ){
                        $this->_view->datos = ['response_status'=>'ok', 'response_msg' => $r ];
                    }else{
                        $this->_view->datos = ['response_status'=>'error', 'response_msg' => 'No hay ventas en la fecha:  '.$_POST['fecha'] ]; 
                    }
                    break;
            }
        }
        $t =   ( isset($this->_view->datos) &&  $this->_view->datos['response_status'] == 'ok' ) ?  array_sum( array_column( $this->_view->datos['response_msg'],1 ) ) : null;
        if( isset ($t) ){
            $l = new c_numerosLetras  ;
            $this->_view->total[0] =  '$'.number_format(   $t , 0, ',', '.');
            $this->_view->total[1] =   $l->convertirEurosEnLetras($t);
        }

        $this->_view->renderizar('infVrango');
    }

}
?>