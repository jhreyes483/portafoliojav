<?
/*
AUTOR:       EGC
DESCRIPCION: Manejo de mensajeria interna
*/

include_once($_SERVER['DOCUMENT_ROOT'] . '/incl/mySQLi.class.php');
if(!isset($db)) $db	= new c_MySQLi(); 

class c_mensajes{
	public $datosSQL;
	public $identificacion;
	var $totReg;
	var $limiteMen = 1000;

	function m_consulta($id){

		global $db;
		switch($id) {
			case 1: //Mensajes nuevos para el cliente
			$sql='SELECT CONCAT(E.emp_nombre," ", E.emp_apellidos), 
					M.mensaje, M.fecha, @id:=M.id,  M.fechaLeido
					FROM dt_empleado E
					LEFT JOIN dt_sys_mensajes M ON E.emp_cedula = M.id_emisor
					WHERE M.id_receptor="' . $_SESSION['s_nitcliente'] .'" ' .
					$this->datosSQL ;
			break;
            
			case 2: //Mensajes nuevos para el empleado. 
			$sql='SELECT CONCAT(E.emp_nombre," ", E.emp_apellidos), 
					M.mensaje, M.fecha, M.id,  M.fechaLeido, M.id_emisor, E.id_empleado
					FROM dt_empleado E
					LEFT JOIN dt_sys_mensajes M ON E.emp_cedula = M.id_emisor
					WHERE M.id_receptor="'.$_SESSION['s_empcedula'] .'"'
               . $this->datosSQL.'
               GROUP BY id
			      ORDER BY fecha DESC';
            //Este debe ser así
					
			break;
			case 3: //Listado de posibles receptores empleados
				$sql='SELECT CONCAT(E.emp_nombre, " ", E.emp_apellidos) usuario, E.emp_cedula, "0"
					FROM dt_empleado E
					INNER JOIN dt_sesion S ON S.identificacion= E.emp_cedula
					WHERE estatus=0
					AND emp_cedula NOT IN (0, ' . $_SESSION['s_empcedula']. ') 
					GROUP BY emp_cedula
					ORDER BY usuario';
			break;
			case 4://Listado de posibles receptores clientes
				$sql='SELECT REPLACE(C.cli_nombre , "|",  " "), C.cli_nit, "1"
					FROM dt_clientes C
					INNER JOIN dt_sesion S ON C.cli_nit = S.identificacion
					WHERE C.estatus="A"
					GROUP BY C.cli_nombre
					ORDER BY C.cli_nombre;';
			break;
			case 5://Listado de posibles receptores empleados para el cliente VIP
				$sql='SELECT CONCAT(emp_nombre, " ", emp_apellidos) usuario, emp_cedula, "0"
					FROM dt_empleado
					WHERE estatus=0
					AND emp_cedula IN (' . $_SESSION['s_ejecutivocliente']. ')  
					ORDER BY usuario';
			break;
			case 6: //mensajes en el casillero del empleado
				$sql='SELECT CONCAT(E.emp_nombre," ", E.emp_apellidos), 
					M.mensaje, M.fecha, M.id, M.fechaLeido, E.id_empleado, 0, M.id_emisor
					FROM dt_empleado E
					LEFT JOIN dt_sys_mensajes M ON E.emp_cedula = M.id_emisor
					WHERE M.id_receptor="'.$this->identificacion.'" 
               GROUP BY id
               ORDER BY fecha DESC '
               . $this->datosSQL;
					
			break;
			case 7: //Nombres de las personas a quien se les envia el correo
				$sql='SELECT GROUP_CONCAT(CONCAT(emp_nombre," ",LEFT(emp_apellidos,1)) ORDER BY emp_nombre SEPARATOR ", ") 
						FROM dt_empleado WHERE emp_cedula IN ('.$this->datosSQL.')';
			break;

		}
		return $sql;
	}
	
	function m_inserta($datosG, $receptor){
		global $db;
		$hoy 	= date('Y-m-d H:i:s');
		$str	= '';
		foreach($receptor as $d){
			$str .= 	'(NULL, "'.$hoy.'", ' .$datosG[0].', ' .$d . ', \''.$datosG[1].'\', 0),';
		}
		$sql = 'INSERT dt_sys_mensajes VALUES '. substr($str,0,-1);
		$db->m_ejecuta($sql);
	}
	
	function m_modifica($id){
		global $db;
		$sql = 'UPDATE dt_sys_mensajes SET fechaLeido="'.date('Y-m-d H:i:s').'" WHERE id = '.$id;
		$db->m_ejecuta($sql);
		return true;
	}
	
	function m_ejecuta($sql){
		global $db;
		$db->m_ejecuta($sql);
		return true;
	}
}

?>