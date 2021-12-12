<?
/*******************************************************************
* Base de framework Desarrollado por: Javier Reyes N 
*
* Desripcion: 	1. Desarrollo para calidad, con el cual se podra: clasificar,
* 					2. modificar las solicitudes generadas por el sistema 
*					3. Actualizaci�n servicio no conforme
*					4. Se agrega tareas, se agrega viabilidad futura
*					5. Se agrega fecha de reporte de solucion o seguimiento
* Fecha Modificaciones:	
*
*					
* Precauciones: 
*					1. Al ir a la url no colocar index
*******************************************************************/

class indexController extends Controller {
		
	//protected $tpS;
	
	public function __construct(){
		parent::__construct();		
		$this->_bitacora = $this->loadModel('bitacora');	
		$this ->_view->setCss(['bitacora', 'estilos']);
		$this ->_view->setJs(['jquery-1.8.3.min', 'fontawasome-ico']);
	}
		 
	public function index(){
		
		if($this->getTexto('enviar') == 'Aceptar'){
			$this->dato = $_POST;
			$this->tpS = $this->dato['tipo'];			
			$this->dato = $_POST;  
			
			//if($_SERVER['HTTP_HOST']== 'localhost') print_r($this->dato);
						 
			if(!$this->getTexto('tipo')){
				$this->_view->_error = 'Debe seleccionar un tipo';
				$this->_view->renderizar('index', 'bitacora');
				exit;				
			}
			//actualiza a revisado
			$this->_bitacora->actualizarRevision($this->dato['id'], 1);			
			$mod=0;
			if(!(isset($this->dato['tarea1']))){ $tarea1 = 0; } else { $tarea1 = $this->dato['tarea1']; }
			
			if($this->dato['tipo'] != $this->dato['tipoI']){
				$this->_bitacora->cambiarTipoSolicitud($this->dato['id'],$this->dato['tipo']);
				if($this->dato['viabi']>0) $this->_bitacora->actualizarViabilidad($this->dato['id'], $this->dato['viabi'],$tarea1);
				$mod=1; // para no permitir agregar datos insuficientes, 	
			}
			$this->_bitacora->_db->m_empiezaTRANS(); 
			$this->_bitacora->actualizarViabilidad($this->dato['id'], $this->dato['viabi'], $tarea1);
			switch($this->dato['tipo']) {
				//Solicitud tipo soporte				
				case 'S':			
					$solu = $this->_bitacora->consultarSolucion($this->dato['id']);
					$solu = $solu->row;
										
					if(count($solu) > 0){
						if(isset($this->dato['solucion']) && $this->dato['solucion'] != ''){
							$datoS = $solu[1].'<br>Por: '.$solu[4].' ';
							$sol = $datoS.'<br>'.$fechaR.' '.$this->dato['solucion'];
							$this->_bitacora->actualizarSolucion($this->dato['id'],$sol, $this->dato['encargado']);							
						}
					}else{
						if(isset($this->dato['solucion']) && $this->dato['solucion'] != ''){	
							$this->_bitacora->insetarSolucion($this->dato['id'], $fechaR.' '.$this->dato['solucion'], $this->dato['encargado']);
						}						
					}			
				break;
				// Solicitud tipo queja
				case 'Q':	
					$solu = $this->_bitacora->consultarSolucion($this->dato['id']);
					$solu = $solu->row;
					if(count($solu)>0){
						if(isset($this->dato['solucion']) && $this->dato['solucion'] != ''){
							$datoS = $solu[1].'<br>Por: '.$solu[4].' ';
							$sol = $datoS.'<br>'.$fechaR.' '.$this->dato['solucion'];
							$this->_bitacora->actualizarSolucion($this->dato['id'],$sol, $this->dato['encargado']);							
						}
					}else{
						if(isset($this->dato['solucion']) && $this->dato['solucion'] != ''){	
							$this->_bitacora->insetarSolucion($this->dato['id'], $fechaR.' '.$this->dato['solucion'], $this->dato['encargado']);
						}						
					}						
				break;
				// Solicitud tipo salida no conforme
				case 'N':	
					$solu = $this->_bitacora->consultarSolucion($this->dato['id']);
					$solu = $solu->row;
					if(count($solu)>0){
						if(isset($this->dato['solucion']) && $this->dato['solucion'] != ''){
							$datoS = $solu[1].'<br>Por: '.$solu[4].' ';
							$sol = $datoS.'<br>'.$fechaR.' '.$this->dato['solucion'];
							$this->_bitacora->actualizarSolucion($this->dato['id'],$sol, $this->dato['encargado']);							
						}
					}else{
						if(isset($this->dato['solucion']) && $this->dato['solucion'] != ''){
							$this->_bitacora->insetarSolucion($this->dato['id'], $fechaR.' '.$this->dato['solucion'], $this->dato['encargado']);
						}						
					}						
				break;
				// solicitudes tipo sugerencia
				case 'U':
					$msmError='';
					if($mod!=1 && $this->dato['viabi']!=0){
						switch($this->dato['viabi']) {
							case 0:
								if(isset($this->dato['analisis']) && $this->dato['analisis']!=''){
									$repor = $this->_bitacora->consultarReportes($this->dato['id'],'');
									if(count($repor->row) == 0) { 	
										$this->_bitacora->insertarReporte($this->dato['id'], 1, $this->dato['analisis'], $this->dato['encargado']);											
									}else{	
										$this->_bitacora->actualizarAnalisis($this->dato['id'], 1, $this->dato['analisis'], $this->dato['encargado']);	
									}
								}	
							break;
							case 1:
								if(isset($this->dato['analisis']) && $this->dato['analisis'] != ''){
									$this->_bitacora->insetarSolucion($this->dato['id'], $fechaR.' '.$this->dato['solucion'], $this->dato['encargado']);
								}
							break;
							
							case 2: 			// 2 viable para desarrollo
								$this->_bitacora->actualizarSugerencia($this->dato['id'], $this->dato['priori'], $this->dato['tiempo'],$this->dato['titulo'], $this->dato['recursos']);
								$repor = $this->_bitacora->consultarReportes($this->dato['id'],'');
								if(count($repor->row) == 0) { 						
									$this->_bitacora->insertarReporte($this->dato['id'], 1, $this->dato['analisis'], $this->dato['encargado']);
										
								}else{							
									$this->_bitacora->actualizarAnalisis($this->dato['id'], 1, $this->dato['analisis'], $this->dato['encargado']);	
								}	
							break;
						}
					}else{
						$msmError='Se realizo modificaci�n de tipo de solicitud a sugerencia, <br>el formulario no estaba completo<br>intente de nuevo';
						$this->_bitacora->actualizarViabilidad($this->dato['id'], 0, $tarea1);
						$this->_view->error[0] = $this->dato['id'];	
						$this->_view->error[1] = '<br>'.$msmError;
					} 	
												
				break;
				// Solicitudes tipo felicitaci�n
				case 'F':
					$solu = $this->_bitacora->consultarSolucion($this->dato['id']);
					$solu = $solu->row;
					if(count($solu)>0){
						if(isset($this->dato['solucion']) && $this->dato['solucion'] != ''){
							$datoS = $solu[1].'<br>Por: '.$solu[4].' ';
							$sol = $datoS.'<br>'.$fechaR.' '.$this->dato['solucion'];
							$this->_bitacora->actualizarSolucion($this->dato['id'],$sol, $this->dato['encargado']);							
						}
					}else{
						if(isset($this->dato['solucion']) && $this->dato['solucion'] != ''){						
							$this->_bitacora->insetarSolucion($this->dato['id'], $fechaR.' '.$this->dato['solucion'], $this->dato['encargado']);
						}						
					}				
				break;									
			}
			
			$this->_bitacora->_db->m_confirmaTRANS();
			// ejecucion del filtro
			$sqlFiltro = $this->elaborarFiltro(
														$this->dato['viabi2'], 
														$this->dato['empresa'], 
														$this->dato['bustipo'], 
														$this->dato['det'], 
														$this->dato['idS'], 
														$this->dato['fI'],
														$this->dato['fF'], 
														isset($this->dato['tarea1']));

			$datos = $this->_bitacora->consultarRegistros($sqlFiltro);
			$this->_view->datos = $datos->rows;
			$this->_view->x = $this->dato['ancla'];									
		}			
			
		if($this->getTexto('buscar') == 'Buscar'){
			$this->filtro = $_POST;
			$sqlFiltro = $this->elaborarFiltro(
												$this->filtro['viabi2'], 
												$this->filtro['empresa'], 
												$this->filtro['bustipo'], 
												$this->filtro['det'], 
												$this->filtro['idS'], 
												$this->filtro['fI'], 
												$this->filtro['fF'], 
												isset($this->filtro['tarea']));
												
			$datos = $this->_bitacora->consultarRegistros($sqlFiltro);
			$this->_view->datos = $datos->rows;			
		}
		$this->_view->titulo = 'Solicitudes';
		$this->_view->renderizar( 'index', 'bitacora' );
	}
	
	public function elaborarFiltro($viabi, $empresa, $tipo, $detalle, $idS, $fI, $fF, $tarea){
		$sqlanex			=' AND viabilidad = '.$viabi;
		if($fI != '') $sqlanex .= ' AND ( fechaIngreso BETWEEN "'.$fI.'" AND "'.$fF.'" )'; 
		if($empresa != '') 	$sqlanex .= ' AND cliente LIKE "%'.$empresa.'%"';
		if($tipo != '') 	$sqlanex .= ' AND tipo = "'.$tipo.'"';
		if($detalle != '') 	$sqlanex .= ' AND solicitud LIKE "%'.$detalle.'%"';
		if($tarea != 0) $sqlanex .= ' AND tareas = '.$tarea.' '; 
		if($idS != '')  	$sqlanex = ' AND id_solicitud = "'.$idS.'"';
		return $sqlanex;
	}
	
	// Consulta los datos correspondientes a una solicitud, 
	public function gSolicitudes($id, $ancla='0'){
		$this->_view->ancla = $ancla;
		$this->_view->idSolicitud = $id;
		$this->_view->datosS =  $this->_bitacora->consultarSolicitud($id);
		$this->_view->datPEjecu = $this->_bitacora->consultarReportes($id, 'An�lisis');
		$this->_view->datosSoluc = $this->_bitacora->consultarSolucion($id);	
		$this->_view->renderizar_vista('gSolicitudes');
	}
	
	public function repF_AT(){
		$datos 		= $this->_bitacora->f_AT();
		$this->_view->datos = $datos->rows; 
		$this->_view->titulo='PROGRAMACI�N DE DESARROLLO';
		$this->_view->renderizar('repF_AT', 'bitacora');
	}
	
	public function repCSop(){
		if($this->getTexto('buscar') == 'Buscar'){
			$this->getdate('fechaI');
			$datos 		= $this->_bitacora->repCSop($this->getdate('fechaI'), $this->getdate('fechaF'));
			$this->_view->datos = $datos->rows; 
			$this->_view->titulo='';
			$this->_view->renderizar('repCSop', 'bitacora');
		}
		$this->_view->renderizar('repCSop', 'bitacora');
		
	}
	
	public function regAvances($id){
		$datos 					= $this->_bitacora->consultarSolicitud($id);
		$datosReporte 			= $this->_bitacora->consultarReportes($id, '');
		$fecha 					= $this->_bitacora->consultarReportes($id, 'Anal�sis');
		$this->mDa($fecha);
		$this->_view->fecha 	= $fecha->row;
		$datosSolu 				= $this->_bitacora->consultarSolucion($id);
		$this->_view->datosS	= $datos; 
		$this->_view->datosR	= $datosReporte;
		$this->_view->datosSoluc= $datosSolu->row;

		if($this->getTexto('regReporte') == 'REGISTRAR'){
			$this->dato = $_POST;
			if(!$this->dato['tpReporte']) {			
				$this->_view->_error = 'Debe seleccionar un tipo de reporte';
				$this->_view->renderizar_vista('repF_AT_02', $id);	
				exit;			
			}
			
			if(!$this->dato['detaReporte']){
				$this->_view->_error = 'Debe escribir un detalle de reporte';
				$this->_view->renderizar_vista('repF_AT_02', $id);				
				exit;			
			}
			
			if(!$this->getTexto('respReporte')){
				$this->_view->_error = 'Debe seleccionar un responsable de reporte';
				$this->_view->renderizar_vista('repF_AT_02', $id);				
				exit;		
			}
			$reportes = $datosReporte->row;
			
			if($reportes){
				if($this->dato['tpReporte'] == 6){
					$solucionF = 'Se da soluci�n, se comunica a los interesados ';
					$this->_bitacora->insetarSolucionSugerencia($id, $solucionF, $fecha->row[0], $this->dato['respReporte']);
				}
				$this->_bitacora->insertarReporte($id, $this->dato['tpReporte'], $this->dato['detaReporte'], $this->dato['respReporte']);
			}else{
				$this->_view->_error = 'No cuenta con an�lisis previo<br>(Dirigirse a clasificaci�n de sugerencias y busque el id solicitud '.$id.')';	
			}
			$datos = $this->_bitacora->consultarSolicitud($id);
			$datosReporte = $this->_bitacora->consultarReportes($id, '');
			$datosSolu = $this->_bitacora->consultarSolucion($id, '');
			$fecha = $this->_bitacora->consultarReportes($id, 2);
			$this->_view->fecha = $fecha->row;
			$this->_view->datosS = $datos; 
			$this->_view->datosR = $datosReporte;
			$this->_view->datosSoluc = $datosSolu->row;
			$this->_view->renderizar_vista('repF_AT_02');
			exit;
		}
		$datos 					= $this->_bitacora->consultarSolicitud($id);
		$datosReporte 			= $this->_bitacora->consultarReportes($id, '');
		$fecha 					= $this->_bitacora->consultarReportes($id, 'Implementaci�n');
		$this->_view->fecha 	= $fecha->row;
		$datosSolu 				= $this->_bitacora->consultarSolucion($id);
		$this->_view->datosS	= $datos; 
		$this->_view->datosR	= $datosReporte;
		$this->_view->datosSoluc= $datosSolu->row;		
		$this->_view->titulo='PLAN DE EJECUCI�N';
		$this->_view->renderizar_vista('repF_AT_02');
	}
	
	public function mDa($dato){
		if($_SERVER['HTTP_HOST']== 'localhost') echo '<div style="background-color:#FF89ff; padding: 5px; margin:10px 0; width:90% ">'.$dato.'</div>';
		
	} 




	
}

?>