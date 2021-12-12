<?
if($_SERVER['SCRIPT_NAME']== '/incl/consultas.comercial.class.php') die();

class c_comercial{
	function m_consulta($id, $cond=''){
      $curdate = date('Y-m-d');
		// 001 al 200 para tablas del sistema o generales
		switch ($id){
			case 10: //Listado Unificar Prospectos
				return 'SELECT C.id_cliente, REPLACE(C.cli_nombre, "|", ""), C.cli_direccion, 
					C.cli_telefono,
					if(actualiza!="", C.actualiza, "<span class=\"nodef\">N/A</span>"),
					CIU.nombreCiudad,
					GROUP_CONCAT(CONCAT(E.emp_nombre, " ", LEFT(E.emp_apellidos,1),".") separator "<br>"),
               CASE C.esProveedor WHEN 0 THEN "Cliente" WHEN 2 THEN "Cliente" WHEN 3 THEN "Prospecto" END
					FROM dt_clientes C
					LEFT JOIN ineditto.dt_locaciones3 CIU ON CIU.idCiudad = C.ciudad_id
					LEFT JOIN dt_empleado E ON FIND_IN_SET (E.emp_cedula, C.emp_cedula)
					WHERE C.esProveedor != 1
               AND C.cli_nombre LIKE "%' . $cond .'%"
					GROUP BY C.id_cliente
					ORDER BY C.cli_nombre';
			break;
			
			case 12:
				return 'SELECT GROUP_CONCAT(REPLACE(cli_nombre , "|",  " ") SEPARATOR "</b> y<br><b>")
					FROM dt_clientes
					WHERE id_cliente
					IN ('.$cond[0].','.$cond[1].')';
			break;
         
         
         case 100:
            return 'SELECT id_subsec, nom_subsector 
               FROM dt_cm_subsectores 
               WHERE 1 ' . $cond;
         break;
         
         case 101:
            return 'SELECT id_sectdiv, nom_sectdiv
               FROM dt_cm_sectdiv
               WHERE 1 ' . $cond;   
         break;

			case 200: //Eventos pendientes por reportar agenda
				return 'SELECT C.id_cliente, C.cli_nombre
					FROM dt_clientes C
					LEFT JOIN dt_cm_agenda A USING(id_cliente)
					WHERE A.idEmpleado=' .$_SESSION['s_idEmpleado'] . ' 
					AND A.estado_evento=0 
					AND A.fechaI>="'.$curdate.'"
					AND A.tipo_evento= "'. $cond . '"
					GROUP BY A.id_cliente ORDER BY C.cli_nombre';
			break;


         case 201: //Eventos pasados no reportados
            return 'SELECT A.id_evento, C.cli_nombre
               FROM dt_cm_agenda A 
               INNER JOIN dt_clientes C USING(id_cliente)
               WHERE A.idEmpleado=' . $_SESSION['s_idEmpleado']. '
               AND A.fechaI<"'. $curdate. '" 
               AND A.estado_evento=2
               GROUP BY C.cli_nombre';
         break;
			
			
			case 208: //Prospectos por agendar
				return 'SELECT C.id_cliente, C.cli_nombre
						FROM dt_clientes C
						LEFT JOIN dt_cm_agenda A USING (id_cliente)
						WHERE FIND_IN_SET('.$_SESSION['s_empcedula'].', C.emp_cedula)
						AND C.id_cliente NOT IN(
						  SELECT id_cliente 
						  FROM dt_cm_agenda
						  WHERE idEmpleado = '.$_SESSION['s_idEmpleado'].'
						  AND estado_evento = 0
						)
						GROUP BY C.id_cliente
						ORDER BY C.cli_nombre';
			break;
		}
	}
}
