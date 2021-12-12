<?
class c_rrhh{
   function m_consulta($id, $param=''){
      switch ($id){
         case 0:
            return 'SELECT '.$param[0].' 
                  FROM '.$param[1].' 
                  WHERE '.$param[2];
         break;

         case 10: // Cargos 
            return 'SELECT ' . 
                  $param[0] . ' 
                  FROM dt_rh_cargos
                  WHERE 1 ' .
                  $param[1] .' 
                  ORDER BY cargo_nombre';
         break;
         
         case 19: // Lineas de Dotacion Usadas
            return 'SELECT id_linea
                  FROM dt_rh_dotacion 
                  WHERE id_linea = ' . $param;
         break;
            
            case 20: // Lineas de Dotacion
            return 'SELECT id_linea, nombreLinea, tipo, ABS(baseTalla)
                  FROM dt_rh_dotacionLineas 
                  ORDER BY tipo, nombreLinea';
         break;
         
         case 21: // Dotaciones
            return 'SELECT D.id_dotacion, D.nombre, D.observaciones,
                  L.nombreLinea, L.tipo
                  FROM dt_rh_dotacion D
                  LEFT JOIN dt_rh_dotacionLineas L ON L.id_linea = D.id_linea
                  GROUP BY D.id_dotacion
                  ORDER BY L.tipo, L.nombreLinea, D.nombre';
         break;

         case 22:
            return 'CREATE TEMPORARY TABLE BOTAR_P_CARGOS 
                  SELECT C.id_dotacion, C.nombre, D.cantidad
                  FROM dt_rh_dotacion C
                  LEFT JOIN dt_rh_dotacion_cargos D USING (id_dotacion)   
                  WHERE cargo_id= '.$param.'               
                  ORDER BY C.nombre';
         break;

         case 23: // Dotaciones
            return 'SELECT D.id_dotacion, D.nombre, 
                  B.cantidad, 
                  L.nombreLinea, L.baseTalla
                  FROM dt_rh_dotacion D
                  LEFT JOIN BOTAR_P_CARGOS B USING (id_dotacion)
                  LEFT JOIN dt_rh_dotacionLineas L ON L.id_linea = D.id_linea
                  GROUP BY D.id_dotacion
                  ORDER BY L.nombreLinea, D.nombre';
         break;
         
         case 24: // Dotaciones
            return 'SELECT C.id_empleado, C.fecha, C.cantidad, C.talla,
                  CONCAT(E.emp_nombre, " ", E.emp_apellidos) emp,
                  CONCAT(E2.emp_nombre, " ", E2.emp_apellidos),
                  L.nombreLinea,
                  D.nombre
                  FROM dt_rh_dotacionEntrega C
                  INNER JOIN dt_rh_dotacion D USING (id_dotacion)   
                  INNER JOIN dt_rh_dotacionLineas L ON L.id_linea = D.id_linea
                  LEFT JOIN dt_empleado E ON E.id_empleado = C.id_empleado
                  LEFT JOIN dt_empleado E2 ON E2.id_empleado = C.entregadoPor
                  WHERE 1 ' .$param[0] . ' ' .   $param[1]. ' 
                  ORDER BY emp, C.fecha';
         break;
         
         case 25: // Dotaciones
            return 'SELECT E.id_empleado, CONCAT(E.emp_nombre, " ", E.emp_apellidos), E.tallas,
                  C.cargo_nombre, C.area, C.cargo_id, 
                  P.centroprod_nombre
                  FROM dt_empleado E
                  INNER JOIN dt_rh_cargos C USING(cargo_id)
                  INNER JOIN dt_centroprod P ON P.centroprod_id = E.centroprod_id
                  WHERE id_empleado= '.
                  $param;
         break;      
         
         case 26: // Huella digital
            $campo = ($param[0]==1? 'H.*':'H.dedoD, H.dedoI');
            return 'SELECT '.$campo.', H.fechaCambio,
                  CONCAT(E.emp_nombre, " ", E.emp_apellidos)
                  FROM dt_empleado_huellaDig H
                  INNER JOIN dt_empleado E ON E.id_empleado = H.quienCambia
                  WHERE H.id_empleado = '.$param[1];
         break;   
         
         case 30: // Jornadas laborales
            return 'SELECT ' . 
                  $param .' 
                  FROM dt_rh_turnos
                  ORDER BY nombre';
         break;
         
         case 31: //Turnos para los empleados
            return 'SELECT TE.fecha, T.desde, T.hasta, 
                  CONCAT(E.emp_nombre, " ", E.emp_apellidos) nombres, E.emp_cedula 
                  FROM dt_empleado_turnos TE 
                  INNER JOIN dt_rh_turnos T USING(id_turno) 
                  LEFT JOIN dt_empleado E ON E.id_empleado = TE.id_empleado 
                  WHERE TE.id_empleado IN ('. $param[0] .')  
                  AND TE.fecha BETWEEN "' .$param[1] . '" AND "' . $param[2] . '"  
                  UNION
                  SELECT "", "", "", CONCAT(E.emp_nombre, " ", E.emp_apellidos), E.emp_cedula 
                  FROM dt_empleado E
                  WHERE id_empleado IN ('. $param[0] .') 
                  ORDER BY nombres, fecha ';
         break;


         case 70:
            return 'SELECT ' . $param . ' 
                  FROM dt_rh_cargos
                  ORDER BY cargo_nombre';
         break;
         
         case 80:   // Grupos de Trabajo
            return 'SELECT *     
                  FROM dt_rh_gruposT
                  ORDER BY nombre_grupo';
         break;
         
         case 81:   // Grupos de Trabajo por una condicion
            return 'SELECT ' . $param[0] . ' 
                  FROM dt_rh_gruposT
                  WHERE '.$param[1].'
                  ORDER BY nombre_grupo';
         break;
         
         case 100: // Ingresos de los empleados // usado en marcacion.php y veriMarca.php
            return 'SELECT I.fecha, I.tipo, I.ip, I.motivo,
                  E.id_empleado, CONCAT(E.emp_nombre, " ", E.emp_apellidos) nombre, IF(MID(mTmC,2,1)=1,"No","Si") AS MyC,
                  T.id_turno, I.user, I.id, E.emp_cedula
                  FROM dt_sys_ingresoLog I
                  LEFT JOIN dt_empleado E USING(id_empleado)
                  LEFT JOIN dt_empleado_turnos T ON T.id_empleado = E.id_empleado AND date(I.fecha) = T.fecha
                  WHERE I.motivo >0 AND I.motivo '. ($param[0]??'')
                  . ($param[1]??'')
                  . ($param[2]??'')
                  . ($param[3]??'')
                  . ($param[4]??'')
                  . ($param[5]??'');
         break;
         
         case 150: //Listado de usuarios y Ids de Sesion 
            return '(SELECT CONCAT(E.emp_nombre, " ", E.emp_apellidos),
                  S.fechaIngreso, S.idSesion, S.modulo, S.idUsuario, S.id
                  FROM dt_sesionesAct S
                  INNER JOIN dt_empleado E ON E.id_empleado = S.idUsuario
                  WHERE tipoUsuario = 2
                  ORDER BY E.emp_nombre)
                  UNION
                  (SELECT REPLACE(C.cli_nombre , "|",  " "),
                  S.fechaIngreso, S.idSesion, S.modulo, S.idUsuario, S.id
                  FROM dt_sesionesAct S
                  INNER JOIN dt_clientes C ON C.id_cliente = S.idUsuario
                  WHERE tipoUsuario = 1
                  ORDER BY C.cli_nombre)
                  ';
         break;
         
         case 151: 
            return 'SELECT E.emp_cedula, S.idSesion, 2
                  FROM dt_sesionesAct S
                  INNER JOIN dt_empleado E ON E.id_empleado = S.idUsuario
                  WHERE tipoUsuario = 2
                  AND S.id = '.$param.'
                  UNION
                  SELECT C.cli_nit, S.idSesion, 1
                  FROM dt_sesionesAct S
                  INNER JOIN dt_clientes C ON C.id_cliente = S.idUsuario
                  WHERE tipoUsuario =1
                  AND S.id = '.$param;
         break;
         
         case 154: 
            if(isset($_SESSION['s_idEmpleado'])){
               $user   = $_SESSION['s_idEmpleado'];
               $tipo   = 2;
            }else{
               $user   = $_SESSION['s_idcliente'];
               $tipo   = 1;
            }
            return 'INSERT dt_sesionesAct VALUES (null, '.$user. ', '.$tipo . ', "' . date('Y-m-d H:i:s').'", "' . $_SESSION['s_modulo'] . '","' . session_id() .'")';
         break;
         
         case 155:
            return 'DELETE FROM dt_sesionesAct WHERE idSesion = "'. $param .'" LIMIT 1';
         break;
         
         
         case 400: //Listado de vendedores
            return 'SELECT emp_cedula, CONCAT(emp_nombre, " " , emp_apellidos)
                  FROM dt_empleado 
                  WHERE cargo_id IN(1,7)
                  AND estatus=0 
                  ORDER BY emp_nombre';
         break;
         
         case 401: // Grupos de trabajo y sus miembros
            return 'SELECT E.id_empleado, CONCAT(E.emp_nombre, " ", E.emp_apellidos) AS nombre, 
                  G.lider,
                  C.cargo_nombre,
                  E.estatus
                  FROM dt_empleado E
                  INNER JOIN dt_rh_gruposT_Inter I USING (id_empleado)
                  INNER JOIN dt_rh_gruposT G USING (id_grupo)
                  INNER JOIN dt_rh_cargos C ON C.cargo_id = E.cargo_id
                  WHERE I.id_grupo IN ('.$param.') 
                  GROUP BY E.id_empleado
                  ORDER BY C.escalafon, C.cargo_nombre, nombre';
         break;
         case 402: // Miembros del grupo de trabajo
            return 'SELECT G.id_grupo, G.nombre_grupo, G.cantidad, G.lider, G.cod_pedido, G.id_producto, 
                  GROUP_CONCAT(DISTINCT I.id_empleado)
                  FROM dt_rh_gruposT G 
                  LEFT JOIN dt_rh_gruposT_Inter I USING (id_grupo) 
                  WHERE G.id_grupo = '.$param.'
                  GROUP BY G.id_grupo 
                  ORDER BY nombre_grupo';
         break;

      
         case 403: //Miembros de un grupo de trabajo (por nombre de grupo) usado en ajustes de maquinaria
            return 'SELECT E.id_empleado, CONCAT(E.emp_nombre, " ", E.emp_apellidos) empleado '.$param[0].'
                  FROM dt_rh_gruposT G 
                  INNER JOIN dt_rh_gruposT_Inter I USING(id_grupo) 
                  INNER JOIN dt_empleado E USING (id_empleado) 
                  LEFT JOIN dt_sesion S ON S.identificacion = E.emp_cedula 
                  WHERE nombre_grupo = "'.$param[1].'" 
                  GROUP BY E.id_empleado
                  ORDER BY empleado';
         break;
         
         case 404: //Miembros de un grupo de trabajo (por id Grupos)
            return 'SELECT E.id_empleado, CONCAT(E.emp_nombre, " ", E.emp_apellidos) empleado
                  FROM dt_empleado E
                  INNER JOIN dt_rh_gruposT_Inter I USING (id_empleado) 
                  WHERE I.id_grupo IN ('.$param.') 
                  GROUP BY E.id_empleado
                  ORDER BY empleado';
         break;
         
         case 405: //Empleados activos
            return 'SELECT id_empleado, CONCAT(emp_nombre, " ", emp_apellidos) emple
               FROM dt_empleado 
               WHERE id_empleado>1 
               AND estatus = 0' . 
               $param .' 
               ORDER BY emple ASC';
         break;

         case 406: //Listado de empleados id , nombre y cedula
            return 'SELECT id_empleado, CONCAT(emp_nombre, " ", emp_apellidos) as vende, emp_cedula 
               FROM dt_empleado 
               WHERE id_empleado>1 
               AND estatus = 0 ' . 
               $param .' 
               ORDER BY vende ASC';
         break;
         
         case 407: //Empleado segun id //usado en facturas
            return 'SELECT CONCAT(emp_nombre, " ", emp_apellidos)
                  FROM dt_empleado 
                  WHERE id_empleado=' . $param ;
         break;
         
         case 408: //Empleado segun cedula //usado en facturas
            return 'SELECT CONCAT(emp_nombre, " ", emp_apellidos)
                  FROM dt_empleado 
                  WHERE emp_cedula=' . $param ;
         break;
         case 409: //IDs de empleado segun parte de su nombre
            return 'SELECT GROUP_CONCAT(id_empleado)
                  FROM dt_empleado 
                  WHERE emp_nombre LIKE "%' . $param .'%"';
         break;
         case 410: //Cedulas de empleado segun parte de su nombre
            return 'SELECT GROUP_CONCAT(emp_cedula)
                  FROM dt_empleado 
                  WHERE emp_nombre LIKE "%' . $param .'%"';
         break;
            
         case 411: //Cedulas de empleado segun el id del empleado
            return 'SELECT GROUP_CONCAT(emp_cedula)
                  FROM dt_empleado 
                  WHERE id_empleado IN (' . $param .')';
         break;
            
         case 412: //Listado de empleados cedula y nombre
            return 'SELECT emp_cedula, CONCAT(emp_nombre, " ", emp_apellidos) as vende
               FROM dt_empleado 
               WHERE id_empleado>1 
               AND estatus = 0 ' . 
               $param .' 
               ORDER BY vende ASC';
         break;
         
         case 413: //Listado de todo el personal
            return 'SELECT E.id_empleado, CONCAT(E.emp_nombre, " ", E.emp_apellidos) AS nombre, 
               E.emp_direccion, E.emp_cedula, E.emp_telefono, E.emp_celular, E.estatus,
               E.IPdeAcceso, GROUP_CONCAT(S.sesion_menumod  ORDER BY S.sesion_menumod SEPARATOR " ") modulos, E.GS, E.emp_email, E.emailCorp, E.segSoc, E.f_naci,
               LEFT(C.cargo_nombre,16) AS cargo, 
               LEFT(CP.centroprod_nombre,14) AS centroprod,
               H.id_empleado as Huella,
               TIMESTAMPDIFF(YEAR, E.f_naci, "'.date('Y-m-d').'"),
               IF(E.f_tc>0, E.F_tc, ""),
               MID(accesos, 3, 1)
               FROM dt_empleado AS E
               LEFT JOIN dt_sesion S ON E.emp_cedula = S.identificacion
               LEFT JOIN dt_rh_cargos C ON  E.cargo_id = C.cargo_id
               LEFT JOIN dt_centroprod AS CP ON E.centroprod_id = CP.centroprod_id 
               LEFT JOIN dt_empleado_huellaDig H ON H.id_empleado = E.id_empleado
               WHERE E.id_empleado>1 ' . $param. ' 
               GROUP BY E.emp_cedula
               ORDER BY nombre';
         break;
         
         case 414: //Igual al 413 pero para excel
            return 'SELECT E.id_empleado "Cod. Emp", E.emp_nombre Nombres,  E.emp_apellidos Apellidos, E.GS, E.f_ingreso "Fecha Ing",
               E.emp_direccion Direccion, E.emp_cedula Cedula, E.emp_telefono Telefono, E.emp_celular Celular, 
               IF(E.estatus=1,"Bloqueado", IF(E.estatus=2,"Retirado","Activo")) Estatus, E.emp_email "Email Pers.", E.emailCorp "Email Corp.",
               E.f_naci "Fecha Nacim.",
               SUBSTRING_INDEX( segSoc, ",", 1) EPS, 
                    SUBSTRING_INDEX( SUBSTRING_INDEX( segSoc, ",", 2 ), ",", -1 ) PENSIONES, 
                    SUBSTRING_INDEX( SUBSTRING_INDEX( segSoc, ",", 3 ), ",", -1 ) CESANTIAS, 
                    SUBSTRING_INDEX( segSoc, ",", -1) ARL,
               C.cargo_nombre Cargo, 
               CP.centroprod_nombre "Centro de oper."
               FROM dt_empleado AS E
               LEFT JOIN dt_sesion S ON E.emp_cedula = S.identificacion
               INNER JOIN dt_rh_cargos C ON  E.cargo_id = C.cargo_id
               INNER JOIN dt_centroprod AS CP ON E.centroprod_id = CP.centroprod_id 
               WHERE E.id_empleado>1 ' . $param. ' 
               GROUP BY E.emp_cedula
               ORDER BY estatus, E.emp_apellidos, E.emp_nombre;';
         break;
            
         case 415:
            return 'SELECT T.id, T.idEmpleado, IF(idEmpleado>0,0,1) orden
                  FROM dt_rh_empleadoTokens T
                  LEFT JOIN dt_empleado E ON E.id_empleado = T.idEmpleado
                  ORDER BY T.id ';
         break;
            
         case 420: // Cumpleaños
            if($param!=0) $condi = 'AND MONTH(f_naci) = ' . $param;
            return 'SELECT CONCAT(E.emp_nombre, " ", E.emp_apellidos ), E.f_naci, E.emp_cedula, E.f_ingreso,
                  C.cargo_nombre, E.id_empleado, TIMESTAMPDIFF(YEAR, E.f_naci, "'.date('Y-m-d').'")
                  FROM dt_empleado E
                  INNER JOIN dt_rh_cargos C USING(cargo_id)
                  WHERE E.estatus < 2 ' .
                  $condi. ' 
                  ORDER BY MONTH(f_naci), DAY(f_naci)';
         break;
            
            case 421: // Personas que cumplen años proximamente
            return 'SELECT CONCAT(emp_nombre, " ", emp_apellidos ), 
                        CONCAT(YEAR("'.date('Y-m-d').'"), "-", MONTH(f_naci), "-", DAY(f_naci))
                  FROM dt_empleado 
                  WHERE estatus < 2 
                        AND DATE(
                            CONCAT_WS("-",YEAR("'.date('Y-m-d').'"),MONTH(f_naci),DAY(f_naci))
                        )
                        BETWEEN "'.date('Y-m-d').'" AND ADDDATE("'.date('Y-m-d').'", INTERVAL '.$param.' DAY)
                  ORDER BY MONTH(f_naci), DAY(f_naci)';
         break;

      }
   }
   
   
   function m_actualiza($id, $param=''){
      // 001 al 100 para tablas del sistema o generales
      // 101 al 200 para clientes
      // 201 al 300 empleados
      switch ($id){
         case 0:
            return 'UPDATE '.$param[0].' 
                  SET '.$param[1].' 
                  WHERE '.$param[2];
         break;
      }
   }
   
   function m_inserta($id, $param=''){
      // 001 al 100 para tablas del sistema o generales
      // 101 al 200 para clientes
      // 201 al 300 empleados
      $ahora = date('Y-m-d H:i:s');
      switch ($id){
         case 0:
            return 'INSERT '.$param[0].' VALUES ' . $param[1];
         break;
         
         case 1:
            return 'INSERT dt_sys_ingresoLog 
                  VALUES (NULL, "' . $_SESSION['s_usuario'] . '", "' .$_SESSION['s_idEmpleado'].'", "'.$ahora.'", "' . $param[0] . '", ' . $param[1] . ', "'.$_SERVER["HTTP_X_FORWARDED_FOR"].'");';
         break;
         
         case 2: //Desde Lector de huellas digital
            return 'INSERT dt_sys_ingresoLog 
                  VALUES (NULL, "Biométrico", "' .$param[0].'", "'.$ahora.'", "' . $param[1] . '", ' . $param[2] . ', "'.$_SERVER["HTTP_X_FORWARDED_FOR"].'");';
         break;

         case 3:
            return 'INSERT dt_sys_ingFallidos 
                  VALUES ("'.$ahora.'", "' . $_SESSION['s_remAddress'] .'", "' . $param[0] . '", ' . $param[1] . ');';
         break;
         
         case 10:
            return 'INSERT dt_rh_turnos
                  VALUES ' .$param . ' 
                  ON DUPLICATE KEY UPDATE nombre=VALUES(nombre), desde=VALUES(desde), hasta=VALUES(hasta);';
         break;

      }
   }
   
   function m_elimina($id, $param=''){
      // 001 al 100 para tablas del sistema o generales
      // 101 al 200 para clientes
      // 201 al 300 empleados
      switch ($id){
         case 0:
            return 'DELETE FROM '. $param[0] . ' 
                  WHERE '. $param[1] ;
         break;
         
         case 11:
            return 'DELETE FROM dt_empleado_turnos
                  WHERE id_empleado = ' . $param[0] . ' 
                  AND fecha IN ("' . $param[1] .'")';
         break;

      }
   }
}


?>