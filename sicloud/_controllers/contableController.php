<?php
class contableController extends Controller{
    //
    public function __construct(){
        parent::__construct();
        require_once ROOT.'_controllers/class/c_numerosLetras.php';
        $this->o_numeroLetras = new C_numerosLetras;
       // Controller::ver($this->m_numeroLetras);
        $this->s        = new Session;
        $this->session  = $this->s->desencriptaSesion();
        $this->db       = $this->loadModel('consultas.sql', 'sql');
        $this->_view->setCss(array( 'font-Montserrat' , 'google', 'bootstrap.min', 'jav', 'animate', 'fontawesome-all'));
        $this->estado_pago = ['Pendiente pago', 'Registrado'];
       // $this->_view->setJs(array('jquery-1.9.0','bootstrap.min','popper.min', 'fontawasome-ico', 'cUsuariosJquery','tablesorter-master/jquery.tablesorter'));
    }
    //
    public function index(){
      extract($_POST);
     if(isset($f1) && isset($f2) ){
      $cond[0] = " WHERE P.fecha BETWEEN  '$f1' AND  '$f2 23:59:59'";
     }else{
        $f1 = date('Y-m-01');
        $f2 = date('Y-m-29');
        $cond[0] = " WHERE P.fecha BETWEEN  '$f1' AND  '$f2 23:59:59'";
     }
      $cond[1] = 'AND P.naturaleza = "C"';

      if(isset($tipo_pago) && $tipo_pago !=''){
         $cond[1] = 'AND P.naturaleza = "'.$tipo_pago.'"';
      }
      $cond[5] = 'ORDER BY P.fecha DESC';
      $this->_view->creditos   = $this->db->verPagos($cond);
      $cond[1] = 'AND P.naturaleza = "D"';
      $this->_view->ingresos  = $this->db->verPagos($cond);
      $cond[1] = '';
      $r  = $this->db->verPagosT($cond);
      $this->_view->estado_pago  = $this->estado_pago;
      $this->verificaResul($r);
      if($this->_view->datos['response_status']=='ok'){
         $o = new c_numerosLetras;
         $t = ( array_sum(array_column($r,8))  );
         $this->_view->total['numeros']= ('$' . number_format(($t), 0, ',', '.')) ;
         $this->_view->total['letras'] =  ucfirst(strtolower( $o->convertirCifrasEnLetras($t))); 
      }
      $cuenta = $this->db->saldoBanco('1030607384');
      $this->_view->saldo = $cuenta[0][2];
      $this->_view->renderizar('index');
   }
    //
  
    public function dilipagos(){
      if( isset($_POST) && !empty($_POST) ){
         $o = new Session();
         $s = $o->desencriptaSesion();
     
         $b  = $this->db->insertMov([
            $this->getSql('actor'),
            $this->getSql('estado'),
            $this->getSql('valor'),
            ($s['usuario']['ID_us']),
            $this->getSql('fk_egreso'),
            $this->getSql('fk_motivo'),
            "D"
         ]);
         if($b){
            $_SESSION['message'] = 'Inserto datos';
            $_SESSION['color']   = 'success';
         }else{
            $_SESSION['message'] = 'Error al insertar pago';
            $_SESSION['color']   = 'danger';
         }
      }
      $tmp =  $this->db->verMotivPago();
      foreach( $tmp as $d ) $this->_view->motivo[$d[0]] = $d[1];
      $tmp = $this->db->verEgreso();
      foreach( $tmp as $d ) $this->_view->egreso[$d[0]] = $d[1];
      $this->_view->status = [ 1 =>'Cancelado',2 => 'Deuda' ];
      $this->_view->renderizar('dilipagos');
   }
    //*********************************************************/
    // Facturacion - interna
    //*********************************************************/
    // agrega producto de array pre venta
}








?>