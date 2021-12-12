<?
class c_logistica{
	function m_consulta($id, $Cond=''){
		switch ($id){
			case 0:
				return 'SELECT nombre, valor2, valor3
					FROM dt_sys_ajustes
					WHERE tipo="LOGIS"
					ORDER BY nombre';
			break;
			case 1: //Listado de personas disponibles para hacer mensajería
				return 'SELECT E.emp_cedula, CONCAT(E.emp_nombre, " ", E.emp_apellidos) mensajero 
					FROM dt_empleado E
					INNER JOIN dt_rh_gruposT_Inter USING(id_empleado)
					INNER JOIN dt_rh_gruposT G USING(id_grupo)
					WHERE E.estatus = 0 ' .
					$Cond  . ' 
					AND G.cod_pedido = 16
					GROUP BY id_empleado
					ORDER BY emp_nombre ASC;';
			break;
			case 3: //Listado de diligencias
				return 'SELECT L.motivo, L.estado, L.id_gestion, L.fechaSolicita, L.horaIngreso, L.destino, L.contacto, L.direccion, 
					L.telefono, L.observaciones, L.solicita, L.emp_cedula, L.horaDespachos, L.comentarios,
					CONCAT(E.emp_nombre, " ", E.emp_apellidos) asignado,
					L.calificacion, L.id_cliente
					FROM dt_logistica L
					LEFT JOIN dt_empleado E USING (emp_cedula) '.
					(isset($Cond[5])? $Cond[5] : '') . ' 
					WHERE date(fechaSolicita) BETWEEN ' .
					$Cond[0] .
					$Cond[1] . 
					$Cond[2] . 
					(isset($Cond[3])? $Cond[3] : '') . 
					(isset($Cond[4])? $Cond[4] : '') . ' 
					ORDER BY horaDespachos';
			break;
					
			case 7: //Total de diligencias por fechas y/o mensajero
				return 'SELECT COUNT(id_gestion)
						FROM dt_logistica
						WHERE  DATE(fechaSolicita) BETWEEN "' .
						$Cond[0] .'" AND "' .
						$Cond[1] . '" ' .
						$Cond[2] ;
			break;
			case 8: //diligencias para el indicador de gestion
				return 'SELECT COUNT(calificacion), calificacion
						FROM dt_logistica 
						WHERE  DATE(fechaSolicita) BETWEEN "' .
						$Cond[0] .'" AND "' .
						$Cond[1] . ' 23:59:59 " ' .
						$Cond[2] . ' 
						GROUP BY calificacion
						ORDER BY calificacion';
			break;
			
			case 9:
				return 'SELECT COUNT( * )
						FROM dt_logistica
						WHERE ISNULL(calificacion)
						AND solicita = LEFT( "'.$Cond.'", 30 ) ';
			break;
			
			case 10:
				return 'SELECT L.Solicita, count( L.id_gestion ) Total, count( L2.id_gestion ) Sin_Calificar
					FROM dt_logistica L
					LEFT JOIN dt_logistica L2 ON L2.id_gestion = L.id_gestion AND isnull( L.calificacion )
					WHERE L.fechaSolicita BETWEEN "'.$Cond[0].'" AND "'.$Cond[1].' 23:59:59"
					GROUP BY L.solicita
					ORDER BY Sin_Calificar DESC, Total  DESC';
			break;	
			
			case 11:
				return 'SELECT comentarios
						FROM dt_logistica 
						WHERE id_gestion = '. $Cond;
			break;
			case 20: // email para enviar notificacion de despachos
				return 'SELECT emailDes 
						FROM dt_clientes C
						WHERE id_cliente ='.$Cond;
			break;	
		}
	}
}


?>