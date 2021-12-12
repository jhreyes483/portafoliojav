<?
if($_SERVER['SCRIPT_NAME']== '/incl/consultas.manteni.class.php') die();

class c_maquinaria{
	function m_consulta($id, $Cond=''){
		switch ($id){
			case 1:
				return'SELECT COUNT(id_equipo)
						FROM dt_maq_sol_servicio
						WHERE fechaCierre = 0
						AND fecha<="' .date('Y-m-d H:i:s').'" '. 
						$Cond;
			break;

			case 3://Listado de Soportes tecnicos solicitados (Dos sentencias ->  3 y 4)
				
				//Listado Historiales no cerrados
				return 'CREATE TEMPORARY TABLE TMP_MAQ_ID
					SELECT id_solicitud, 1 AS "abi"
					FROM dt_maq_historial H
					WHERE H.id_solicitud >0  ' . 
					$Cond. '
					GROUP BY id_solicitud
					HAVING SUM(H.estado) =0';
			break;		
			

			case 4: //Listado de Soportes tecnicos solicitados
				return'SELECT S.id_equipo, S.fecha, S.descripcion,
						M.nombre, M.ubicacion, 
						E.emp_nombre, S.fechaCierre, T.abi, S.calificacion, S.id
						FROM dt_maq_equipos M
						INNER JOIN dt_maq_sol_servicio S USING(id_equipo)
						LEFT JOIN dt_empleado E ON E.id_empleado = S.solicita
						LEFT JOIN TMP_MAQ_ID T ON T.id_solicitud = S.id
						WHERE (S.fechaCierre = 0 OR calificacion =0) 
						AND S.fecha<="' .date('Y-m-d H:i:s').'" '. 
						$Cond. ' 
						GROUP BY S.id
						ORDER BY S.fecha';
			break;
			
			case 6: //Soportes tecnicos solicitados por un usuario
				return'SELECT COUNT(id_equipo)
						FROM dt_maq_sol_servicio
						WHERE calificacion =0 
						AND fechaCierre>0
						AND solicita=' . $Cond;
			break;
			
			case 10: //Cronograma
				return'SELECT M.id_equipo, M.nombre, 
               S.tipo_serv, S.fecha, S.fechaCierre
					FROM dt_maq_equipos M
					INNER JOIN dt_maq_sol_servicio S USING (id_equipo)
					WHERE 1 '.
					$Cond . ' 
					ORDER BY S.fecha DESC';
				break;

			case 13: //Maquinaria que puede administrar un empleado
				return 'SELECT M.id_equipo, M.nombre
					FROM dt_maq_encargado_sop E
					RIGHT JOIN dt_maq_equipos M USING(id_equipo)
					WHERE 1'.
					$Cond . ' 
                    GROUP BY M.id_equipo
					ORDER BY M.nombre';
				break;
				
			case 14: //Ids de maquinas que puede administrar un empleado
				return 'SELECT GROUP_CONCAT(id_equipo)
					FROM dt_maq_encargado_sop
					WHERE id_empleado ='. $Cond .'
					GROUP BY id_empleado'; //Group by evita resultados nulos
			break;
				
			case 16: //Listado de todas las Máquinas
				return'SELECT id_equipo, nombre
					FROM dt_maq_equipos
					WHERE 1 '.
					$Cond . ' 
					ORDER BY nombre';
				break;
				
			case 17: //Listado de todas las Máquinas mas CP y tipo
				return 'SELECT M.id_equipo, M.nombre,
					CP.centroprod_nombre,
					M.estado
					FROM dt_maq_equipos M
					LEFT JOIN dt_centroprod CP USING(centroprod_id)
					LEFT JOIN tmpTipoMaquina T ON T.id = M.id_tipo
					GROUP BY M.id_equipo
					ORDER BY M.nombre';
				break;

		}
	}
}
?>