<?
if($_SERVER['SCRIPT_NAME']== '/incl/consultas.produccion.class.inc') die();

include_once($_SERVER['DOCUMENT_ROOT'].'/incl/mySQLi.class.php');

class c_produccion{
   
   protected $db;   // Conector a base de datos
   function __construct(){
      $this->db   = new c_MySQLi();
   }
   
	function m_consulta($id, $cond=''){
		switch ($id){
			case 1: //Programador Consolidados
				return 'SELECT O.nOrden, O.fechaAprobacion, O.fechaProd, LEFT(O.referencia, 30), O.cli_nit,
					LEFT(REPLACE(C.cli_nombre , "|",  " "), 20),
					IFNULL(GROUP_CONCAT(DISTINCT I.cod_pedido),""),
					GROUP_CONCAT(DISTINCT RI.remision), 
					V.ult_modi, SUM(I.centroprod_id), O.num_cotiza, O.codProducto, ""
					FROM dt_ordenes O
					LEFT JOIN dt_ordenes_items I USING(nOrden)
					LEFT JOIN dt_remisionesItems RI USING(nOrden)
					LEFT JOIN dt_clientes C ON C.id_cliente = O.id_cliente
					LEFT JOIN dt_ordenes_observa V ON V.nOrden = O.nOrden AND V.tipo = 1
					WHERE O.aprobado = 1 '. 
					$cond . ' 
					GROUP BY O.nOrden
					ORDER BY O.fechaProd';
			break;
            
			case 2: //Programador Detallado
				return 'SELECT O.nOrden, O.fechaProd, O.centroprodOri,  O.referencia,
					I.prioridad, I.referencia AS Ref2, I.cPaginas,  I.cCopias,  I.asignado, I.id_item, I.estado_item, I.cod_pedido,
					LEFT(REPLACE(C.cli_nombre , "|",  " "),25),
					GROUP_CONCAT(DISTINCT RI.remision),
					IC.cantPliegosOri, IC.sobrantes
					FROM dt_ordenes O
					INNER JOIN dt_ordenes_items I USING(nOrden)
					LEFT JOIN dt_ordenes_itemsC IC USING(id_item)
					LEFT JOIN dt_clientes C USING(id_cliente)
					LEFT JOIN dt_remisionesItems RI USING(nOrden)
					WHERE O.aprobado = 1 ' . 
					$cond[0] . ' 
					AND I.cod_pedido = ' . $cond[1]. ' 
					GROUP BY I.id_item
					ORDER BY I.prioridad, I.nOrden';
			break;
            
			case 3: //Carga Maquina
				return 'SELECT O.nOrden, O.fechaProd, O.centroprodOri, O.referencia,
					I.prioridad, I.referencia ref2, (I.cPaginas * I.cCopias), I.id_item, I.cod_pedido, I.estado_item, 
					LEFT(REPLACE(C.cli_nombre , "|",  " "), 18),
					IC.cabida, 
               IF(I.cod_pedido=18, REPLACE(IA.colores,".",""), IC.tintasP), 
               IC.tintasE, IC.cantPliegosOri, IC.sobrantes,
					IP.tiempoM, IP.tiempoA,
					GROUP_CONCAT(DISTINCT CONCAT(MID(E.emp_nombre, 1,1), ". ", MID(E.emp_apellidos, 1,1),".") SEPARATOR "<br>") emp,
					P.refInterna,
               IA.colores
					FROM dt_ordenes O
					INNER JOIN dt_ordenes_items I USING(nOrden)
					LEFT JOIN dt_ordenes_itemsC IC USING(id_item)
               INNER JOIN dt_ordenes_itemsA IA USING(id_item)
					LEFT JOIN dt_ordenes_itemsProgram IP USING (id_item)
					LEFT JOIN dt_empleado E ON FIND_IN_SET(E.id_empleado, I.asignado) 
					LEFT JOIN dt_clientes C ON O.cli_nit = C.cli_nit
					LEFT JOIN dt_inv_productos P ON P.id_producto = I.id_producto
					WHERE O.aprobado = 1
					AND I.cod_pedido IN (4,15,17,18,20,22) ' . 
					$cond[0]  . ' 
					AND IC.maquina IN (' . $cond[1] . ')
					GROUP BY I.id_item
					ORDER BY I.prioridad, I.nOrden';
			break;
            
			case 4: //Maquinas de acabados
				return 'SELECT O.nOrden, O.fechaProd, O.centroprodOri, O.referencia,
					I.prioridad, LEFT(I.referencia, 18), I.cCopias,  I.id_item, I.cod_pedido, I.estado_item, 
					LEFT(REPLACE(C.cli_nombre , "|",  " "), 18),
					"" cabida,"" tintasP, "" tintasE, "" cantPl, "" sobrantes,
					IP.tiempoM, IP.tiempoA,
					GROUP_CONCAT(DISTINCT CONCAT(MID(E.emp_nombre, 1,1), ". ", MID(E.emp_apellidos, 1,1),".") SEPARATOR "<br>") emp
					FROM dt_ordenes O
					INNER JOIN dt_ordenes_items I USING(nOrden)
					LEFT JOIN dt_ordenes_itemsProgram IP USING (id_item)
					LEFT JOIN dt_empleado E ON FIND_IN_SET(E.id_empleado, I.asignado) 
					LEFT JOIN dt_clientes C ON O.cli_nit = C.cli_nit
					WHERE O.aprobado = 1 ' . 
					$cond[0]  . ' 
					AND I.id_producto IN (' . $cond[2] . ')
					GROUP BY I.id_item
					ORDER BY I.prioridad, I.nOrden';
			break;
			
			case 5: //Programador Acabados
				return 'SELECT O.nOrden, O.fechaCliente, O.centroprodOri, O.referencia AS refOP,
					I.prioridad, LEFT(I.referencia, 18) referencia, (I.cPaginas * I.cCopias) totalPag,  I.id_item, I.cod_pedido, I.estado_item,
					LEFT(REPLACE(C.cli_nombre , "|",  " "), 18) cli_nombre,
					GROUP_CONCAT(DISTINCT RI.remision) remisiones,
					IC.cabida,
					IP.tiempoM, IP.tiempoA,
					GROUP_CONCAT(DISTINCT CONCAT(MID(E.emp_nombre, 1,1), ". ", MID(E.emp_apellidos, 1,1),".") SEPARATOR "<br>") asignado
					FROM dt_ordenes O
					INNER JOIN dt_ordenes_items I USING(nOrden)
					LEFT JOIN dt_ordenes_itemsC IC USING(id_item)
					LEFT JOIN dt_ordenes_itemsProgram IP USING (id_item)
					LEFT JOIN dt_empleado E ON FIND_IN_SET(E.id_empleado, I.asignado ) 
					LEFT JOIN dt_clientes C ON O.id_cliente = C.id_cliente
					LEFT JOIN dt_remisionesItems RI USING(nOrden)
					WHERE O.aprobado = 1 ' .
					$cond[0] . '
					AND I.id_producto IN (' . $cond[1] . ')
					GROUP BY I.id_item
					ORDER BY I.prioridad, I.nOrden';
			break;
			
			case 6: //Programador Total
				return 'SELECT O.nOrden,  O.fechaProd, LEFT(O.referencia, 20),
					LEFT(REPLACE(C.cli_nombre , "|",  " "), 20) cli_nombre,
					GROUP_CONCAT(DISTINCT I.cod_pedido)
					FROM dt_ordenes O
					LEFT JOIN dt_ordenes_items I USING(nOrden)
					LEFT JOIN dt_clientes C ON C.id_cliente = O.id_cliente
					WHERE aprobado = 1 '. 
					$cond . ' 
					GROUP BY O.nOrden
					ORDER BY O.nOrden';
			break;
			
			case 10: //Ordenes en Stand By	
			return 'SELECT O.nOrden, LEFT(O.referencia,50), 
					LEFT(REPLACE(C.cli_nombre , "|",  " "), 40),
					GROUP_CONCAT(DISTINCT RI.remision),
					GROUP_CONCAT(LEFT(S.motivo,100)  ORDER BY id DESC SEPARATOR "||")
					FROM dt_ordenes O
					LEFT JOIN dt_clientes C USING(id_cliente)
					LEFT JOIN dt_remisionesItems RI USING(nOrden)
					LEFT JOIN dt_ordenes_StandBy S ON S.nOrden = O.nOrden
					WHERE O.aprobado = 12
					AND O.centroprod_id = '.$_SESSION['s_centroprod'].' 
					GROUP BY O.nOrden
					ORDER BY O.nOrden';
			break;
            
         case 15:
            return 'SELECT REPLACE(C.cli_nombre , "|",  " "), CONCAT(C.cli_telefono, " ", C.telefono2, " ", C.celular),
                  O.entregarEn, O.id_agencia, O.contactoProd, O.referencia, O.nContrato, O.tipoTrabajo,
                  CONCAT(E.emp_nombre, " ", E.emp_apellidos),
                  IFNULL(R.nOrdenOld,0), O.codProducto
                  FROM '.$cond[1].'dt_ordenes O
                  INNER JOIN '.$cond[1].'dt_clientes C USING(id_cliente)
                  LEFT JOIN  '.$cond[1].'dt_empleado E ON E.emp_cedula = O.vendedor
                  LEFT JOIN  '.$cond[1].'dt_ordenesRepro R USING(nOrden)
                  WHERE O.nOrden=' . $cond[0]; //uso LEFT JOIN  para el empleado, pq cuando se previsualiza una OP, aun no se ha definido el vendedor
            break;


         //Avances de produccion
			case 20:
				return 'SELECT  fase1, fase2, fase3, fase4, fase5, fase6, fase7, fase8, 
					simil1, simil2, simil3, simil4, simil5, simil6, simil7, simil8
					FROM dt_tipospedido 
					WHERE cod_pedido=' .$cond . ' 
					ORDER BY orden;';
			break;
            
			case 22:
				return 'SELECT SUM(f1), SUM(f2), SUM(f3), SUM(f4), SUM(f5), SUM(f6), SUM(f7), SUM(f8)
					FROM dt_prod_avances
					WHERE id_item=' .$cond ;
			break;
            
			case 30:
				return 'SELECT nOrden, referencia, anuladoPor, fecha
					FROM dt_ordenes_itemElimina
					WHERE '. $cond.' 
					ORDER BY fecha DESC';
			break;
         
         case 31:
				$sql = 'SELECT nOrden FROM dt_ordenes WHERE nOrden=' . $cond;
            return $this->db->m_trae_array($sql);
			break;
            
			case 40:
				return 'SELECT nombreArchivo, pedido, cod_pedido, fase1, fase2, fase3, fase4, fase5, fase6, fase7, fase8, 
					simil1, simil2, simil3, simil4, simil5, simil6, simil7, simil8
					FROM dt_tipospedido 
					WHERE nombreArchivo<>""
					ORDER BY orden';
			break;
            
			case 50:
				return 'SELECT LEFT(CONCAT(emp_nombre, " ", emp_apellidos),15)
						FROM dt_empleado 
						WHERE id_empleado IN ('.$cond.')';
			   break;
            
         case 54:
            return 'SELECT O.codProducto, O.fechaAprobacion, O.referencia, O.aprobado, O.entregarEn, O.contactoProd, O.nContrato,
               C.id_cliente, REPLACE(C.cli_nombre , "|",  " "), C.cli_direccion, 
               CONCAT(E.emp_nombre, " ", E.emp_apellidos), E.id_empleado
               FROM dt_ordenes O
               INNER JOIN dt_clientes C USING(id_cliente)
               LEFT JOIN dt_empleado E ON E.emp_cedula = O.vendedor
               WHERE nOrden='.$cond;
            break;
            
         case 55:
            return 'SELECT I.cCopias, I.cPaginas, I.id_item, I.id_producto, I.referencia,
                  A.colores, A.xFormato, A.yFormato,
                  C.tintasP, C.tintasE,
                  SUM(IF(R.cobro<>3,RI.cantEntregada,0)),
                  T.cod_pedido, T.pedido,
                  if(P.refparaVenta!="", P.refparaVenta, P.refInterna),
                  I.centroprod_id,
                  O.cantUnica
                  FROM dt_ordenes O
                  INNER JOIN dt_ordenes_items I USING (nOrden)
                  LEFT JOIN dt_remisionesItems RI USING(id_item)
                  LEFT JOIN dt_remisiones R ON R.remision=RI.remision
                  LEFT JOIN dt_ordenes_itemsA A ON I.id_item = A.id_item
                  LEFT JOIN dt_ordenes_itemsC C ON I.id_item = C.id_item
                  LEFT JOIN dt_tipospedido T ON I.cod_pedido = T.cod_pedido
                  LEFT JOIN dt_inv_productos P ON P.id_producto = I.id_producto
                  WHERE I.nOrden = '.$cond. ' 
                  GROUP BY I.id_item
                  ORDER BY T.orden, I.referencia';
            break;
            
         case 56:
            return 'SELECT R.remision, R.fecha, CONCAT(E.emp_nombre, " ", E.emp_apellidos ), R.cobro 
                  FROM dt_remisiones R
                  INNER JOIN dt_remisionesItems RI USING (remision)
                  INNER JOIN dt_empleado E ON E.id_empleado = R.elaboro
                  WHERE RI.nOrden IN (SELECT nOrden FROM dt_ordenes WHERE nOrden='.$cond.')
                  GROUP BY remision';
            break;
            
         case 70: //Datos para crear cabezote Certificado de Calidad
            return 'SELECT C.id_cliente, REPLACE(C.cli_nombre , "|",  " "), CONCAT(FORMAT(C.cli_nit,0),"-", C.dv), C.cli_direccion, C.cli_telefono,
                  O.nContrato, DATE(O.fechaProd),
                  DATE(MAX(R.fecha)),
                  O.referencia,
                  GROUP_CONCAT(DISTINCT I.cCopias),
                  GROUP_CONCAT(DISTINCT I.id_producto),                 
                  GROUP_CONCAT(DISTINCT I.id_item)                  
                  FROM '.($cond[1]??'').'dt_ordenes O
                  INNER JOIN '.($cond[1]??'').'dt_clientes C USING (id_cliente)
                  INNER JOIN '.($cond[1]??'').'dt_ordenes_items I ON I.nOrden = O.nOrden AND cod_pedido IN (4,12,15,17,18,22)
                  
                  LEFT JOIN dt_remisionesItems RI ON RI.nOrden = O.nORden
                  LEFT JOIN dt_remisiones R ON R.remision = RI.remision
                  WHERE O.nOrden=' . $cond[0]; 
            break;
            
         case 71: //Datos para el Certificado Digital
            return 'SELECT GROUP_CONCAT(DISTINCT CONCAT(xFormato,"|", yFormato))
                     FROM '.($cond[1]??'').'dt_ordenes_itemsA
                     WHERE id_item IN ('.$cond[0].')';
            break;
         
			case 72://Datos para crear Detalle Certificado de Calidad
            return 'SELECT P.refInterna
                  FROM '.($cond[1]??'').'dt_ordenes_items I
                  INNER JOIN '.($cond[1]??'').'dt_inv_productos P USING(id_producto)
                  WHERE I.cod_pedido=3
                  AND nOrden = ' . $cond[0]
                  .' ORDER BY P.orden'; 
            break;
         
			case 73: //Sustratos para el certificado de calidad
            return 'SELECT GROUP_CONCAT(refParaVenta SEPARATOR ",  ")
                  FROM '.($cond[1]??'').'dt_inv_productos 
                  WHERE id_producto IN ('.$cond[0].')'; 
            break;         
			
         case 74: // Certificados elaborados anteriormente
            return 'SELECT C.idCert, C.fecha, C.producto, CONCAT(E.emp_nombre, " ", E.emp_apellidos)
                  FROM '.($cond[1]??''). 'dt_sgc_certCalidad C
                  INNER '.($cond[1]??''). 'JOIN dt_empleado E ON E.id_empleado = C.idEmpleado
                  WHERE nOrden ='.$cond[0]; 
            break;
         
         case 75:
            return 'SELECT C.idCert, C.fecha, C.nOrden,
                     REPLACE(CL.cli_nombre, "|",""), CONCAT(CL.cli_nit, "-",CL.dv), CL.cli_direccion, CL.cli_telefono, CL.email, 
                     C.ordenC, C.producto, C.sustrato, C.tamano, C.cantidad,
                     C.fechaP, C.fechaR, C.obs,
                     CONCAT(E.emp_nombre, " ", E.emp_apellidos)
                     FROM '.($cond[1]??''). 'dt_sgc_certCalidad C
                     INNER '.($cond[1]??''). 'JOIN dt_clientes CL ON CL.id_cliente = C.idCliente
                     INNER '.($cond[1]??''). 'JOIN dt_empleado E ON E.id_empleado = C.idEmpleado
                     WHERE idCert=' . $cond[0];
            break;  
               
         case 76:
            return 'SELECT acabados, cumple
                     FROM dt_sgc_certCalidadDet
                     WHERE idCert = ' . $cond[0];
            break;

         case 80: //Datos para modificar un Certificado
            return 'SELECT C.id_cliente, REPLACE(C.cli_nombre , "|",  " "), CONCAT(FORMAT(C.cli_nit,0),"-", C.dv), C.cli_direccion, C.cli_telefono,
                     CE.ordenC, CE.fechaP, CE.fechaR, CE.producto, CE.cantidad, CE.sustrato, CE.tamano, 
                     CE.obs
                     FROM '.($cond[1]??'').'dt_sgc_certCalidad CE
                     INNER JOIN '.($cond[1]??'').'dt_clientes C ON C.id_cliente = CE.idCliente
                     WHERE idCert='.$cond[0];
            break;
			
         case 81:
            return 'SELECT acabados, cumple
                     FROM '.($cond[1]??'').'dt_sgc_certCalidadDet
                     WHERE idCert='.$cond[0];
            break;
			
			case 100:
				return 'SELECT GROUP_CONCAT(id_producto)
						FROM dt_cot_maquinasSustratos
						WHERE id_maquina ='. $cond. '
						GROUP BY id_maquina';
			break;
			
			case 110:
				return 'SELECT id_maquina, nombre_maquina, tiempo_alistamiento, tiempoMontaje, id_tipoMaquina
						FROM dt_cot_maquinas
						WHERE habilitadaProd = 1 '.
						$cond . ' 
						ORDER BY nombre_maquina';
			break;
            	
         case 115:
             return 'SELECT GROUP_CONCAT(id_producto)
                     FROM dt_cot_maquinasSustratos
                     WHERE id_maquina = '. $cond;
         break;
            
			case 116: //Trabajos asignados a una máquina
				return 'SELECT LEFT(REPLACE(CL.cli_nombre , "|",  " "),30) "Cliente", O.nOrden, 
					LEFT(O.fechaingreso,16) "F. Apertura", 
					LEFT(O.fechaCliente,16) "F. Solicitada X cliente", 
					LEFT(O.fechaProd,16) "F. Entrega Programada",  
					LEFT(I.referencia,40), ' .
					$cond[0]. '   
					INSERT(C.tintasP, 2,0,"X") "Tintas Pro.", 
					INSERT(C.tintasE, 2,0,"X") "Tintas Esp.", 
					GROUP_CONCAT(AV.hora,"|", AV.periodo ORDER BY AV.hora),
					CONCAT(E.emp_nombre, " ", LEFT(E.emp_apellidos,1), "."), 
					P.tiempoM
					FROM dt_ordenes_items I
					LEFT JOIN dt_ordenes_itemsC C USING (id_item) ' .
					$cond[1].' 
					INNER JOIN dt_ordenes O ON I.nOrden = O.nOrden
					INNER JOIN dt_clientes CL ON CL.id_cliente = O.id_cliente
					LEFT JOIN dt_prod_avances AV ON AV.id_item = I.id_item
					LEFT JOIN dt_empleado E ON E.id_empleado = AV.id_empleado
					LEFT JOIN dt_ordenes_itemsProgram P ON P.id_item = AV.id_item
					WHERE I.cod_pedido IN ('.$cond[2].') ' .
					$cond[3]. 
               $cond[4]. '
					GROUP BY AV.id_item, AV.id_empleado
					ORDER BY AV.hora';
						
			break;
            
         case 117: //Trabajos asignados a un operario
				return 'SELECT IFNULL( GROUP_CONCAT( DISTINCT AV.id_item ORDER BY AV.hora ),0)
                    FROM dt_prod_avances AV
                    WHERE AV.periodo != "D" ' . 
                    $cond[1] . $cond[2] ;
			break;
            
         case 118:
            return 'SELECT IFNULL(I.id_item,0), O.nOrden,
						LEFT(I.referencia,40),
						AV.hora, 
						if(AV.periodo="R","I", IF(AV.periodo="P","F",AV.periodo)) AS periodo,
						IFNULL(A.nombre,P.pedido),
                  CONCAT(E.emp_nombre, " ", E.emp_apellidos),
                     AV.id
                  FROM dt_prod_avances AV 
                  LEFT JOIN dt_ordenes_items I ON I.id_item = AV.id_item
                  LEFT JOIN dt_ordenes O ON I.nOrden = O.nOrden
                  LEFT JOIN dt_tipospedido P ON P.cod_pedido = AV.seccion
                  LEFT JOIN dt_sys_ajustes A ON A.valor2 = AV.seccion AND A.tipo="MINUT"
                  LEFT JOIN dt_empleado E ON E.id_empleado = AV.id_empleado
                  WHERE AV.periodo != "D" AND AV.id_item IN ('.$cond[3].')' .
                     $cond[1]. $cond[2]. ' 
                     ORDER BY AV.hora, FIELD (AV.periodo,"I","R","P","F")';
			break;
            
         case 119: # Consulta Juan
            return '
            (SELECT IFNULL(I.id_item,"") AS id_item, O.nOrden,
                        AV.id,
                           LEFT(I.referencia,40) AS "referencia",
                           AV.hora,
                           IF(A.valor2>0,"S", AV.periodo),
                           IFNULL(P.pedido,A.nombre),
                        AV.id_empleado,
                                CONCAT(E.emp_nombre, " ", E.emp_apellidos),
                        IF(AV.f1>0, CONCAT(AV.f1,"|",P.fase1),"") AS f1,
                        IF(AV.f2>0, CONCAT(AV.f2,"|",P.fase2),"") AS f2,
                        IF(AV.f3>0, CONCAT(AV.f3,"|",P.fase3),"") AS f3,
                        IF(AV.f4>0, CONCAT(AV.f4,"|",P.fase4),"") AS f4,
                        IF(AV.f5>0, CONCAT(AV.f5,"|",P.fase5),"") AS f5,
                        IF(AV.f6>0, CONCAT(AV.f6,"|",P.fase6),"") AS f6,
                        IF(AV.f7>0, CONCAT(AV.f7,"|",P.fase7),"") AS f7,
                        IF(AV.f8>0, CONCAT(AV.f8,"|",P.fase8),"") AS f8,
                        A.valor2 AS noAsociados,
                        P.cod_pedido
                                FROM dt_prod_avances AV
                                LEFT JOIN dt_ordenes_items I ON I.id_item = AV.id_item
                     LEFT JOIN dt_ordenes O ON I.nOrden = O.nOrden
                                LEFT JOIN dt_tipospedido P ON P.cod_pedido = AV.seccion
                                LEFT JOIN dt_sys_ajustes A ON A.valor2 = AV.seccion AND A.tipo="MINUT"
                                LEFT JOIN dt_empleado E ON E.id_empleado = AV.id_empleado
                  WHERE 1 '.
                   $cond[1].$cond[2].' )

                   UNION

                   (SELECT "" ,"", "","ZZZ" ,fecha,
                           IF(L.tipo="e","I","F") ,"Jornada" , L.id_empleado, CONCAT(E.emp_nombre, " ", E.emp_apellidos),
                           "", "", "", "", "", "", "", "", "", ""
                           FROM dt_sys_ingresoLog L
                           LEFT JOIN dt_empleado E ON E.id_empleado = L.id_empleado
                           WHERE L.tipo="s" AND E.estatus = "0" AND L.motivo = 1  '.$cond[4].$cond[5].'
                           )
                           ORDER BY id_empleado, hora, id_item';

            break;

			case 120:
            return 'SELECT GROUP_CONCAT(DISTINCT AV.id_empleado)
               FROM dt_prod_avances AV
               LEFT JOIN dt_ordenes_items I ON I.id_item = AV.id_item
               LEFT JOIN dt_ordenes O ON I.nOrden = O.nOrden
               LEFT JOIN dt_tipospedido P ON P.cod_pedido = AV.seccion
               LEFT JOIN dt_sys_ajustes A ON A.valor2 = AV.seccion AND A.tipo="MINUT"
               LEFT JOIN dt_empleado E ON E.id_empleado = AV.id_empleado
               WHERE 1 '.$cond[2].'
               ';
            break;

         case 121:
            return '(SELECT * FROM BOTAR)
            UNION
            (SELECT * FROM BOTAR1)';
         break;

        # Consulta para reporte de avances
         case 122:
            return 'SELECT IFNULL(I.id_item,"") AS id_item, O.nOrden,
                        AV.id,
                                                LEFT(I.referencia,40) AS "referencia",
                                                AV.hora,
                                                IF(A.valor2>0,"S", AV.periodo),
                                                IFNULL(P.pedido,A.nombre),
                        AV.id_empleado,
                                CONCAT(E.emp_nombre, " ", E.emp_apellidos),
                        IF(AV.f1>0, CONCAT(AV.f1,"|",P.fase1),"") AS f1,
                        IF(AV.f2>0, CONCAT(AV.f2,"|",P.fase2),"") AS f2,
                        IF(AV.f3>0, CONCAT(AV.f3,"|",P.fase3),"") AS f3,
                        IF(AV.f4>0, CONCAT(AV.f4,"|",P.fase4),"") AS f4,
                        IF(AV.f5>0, CONCAT(AV.f5,"|",P.fase5),"") AS f5,
                        IF(AV.f6>0, CONCAT(AV.f6,"|",P.fase6),"") AS f6,
                        IF(AV.f7>0, CONCAT(AV.f7,"|",P.fase7),"") AS f7,
                        IF(AV.f8>0, CONCAT(AV.f8,"|",P.fase8),"") AS f8,
                        A.valor2 AS noAsociados,
                        P.cod_pedido
                                FROM dt_prod_avances AV
                                LEFT JOIN dt_ordenes_items I ON I.id_item = AV.id_item
                     LEFT JOIN dt_ordenes O ON I.nOrden = O.nOrden
                                LEFT JOIN dt_tipospedido P ON P.cod_pedido = AV.seccion
                                LEFT JOIN dt_sys_ajustes A ON A.valor2 = AV.seccion AND A.tipo="MINUT"
                                LEFT JOIN dt_empleado E ON E.id_empleado = AV.id_empleado
                  WHERE AV.periodo IN ("I", "R") '.
                   $cond[1].$cond[2].' ORDER BY  AV.id_empleado, hora';
            break;

         case 123:
            return 'SELECT "" ,"", "","" ,fecha,
                    IF(L.tipo="e","I","F") ,
                    CASE L.motivo WHEN 1 THEN "Jornada"
                     WHEN 2 THEN "Almuerzo"
                     WHEN 3 THEN "Descanso"
                     WHEN 4 THEN "Permiso" WHEN 5 THEN "Cita Médica" WHEN 6 THEN "Labor externa" WHEN 7 THEN "Hora Extra" END , L.id_empleado, CONCAT(E.emp_nombre, " ", E.emp_apellidos),
                    "", "", "", "", "", "", "", "", "", ""
                    FROM dt_sys_ingresoLog L
                    LEFT JOIN dt_empleado E ON E.id_empleado = L.id_empleado
                    WHERE '.$cond[0].$cond[1].$cond[2].$cond[3].$cond[5].'';

            break;
         case 124:
            return 'SELECT IFNULL(I.id_item,"") AS id_item, O.nOrden,
                        AV.id,
                        LEFT(I.referencia,40) AS "referencia",
                        AV.hora,
                        IF(A.valor2>0,"S", AV.periodo),
                        IFNULL(P.pedido,A.nombre),
                        AV.id_empleado,
                        CONCAT(E.emp_nombre, " ", E.emp_apellidos),
                        IF(AV.f1>0, CONCAT(AV.f1,"|",P.fase1),"") AS f1,
                        IF(AV.f2>0, CONCAT(AV.f2,"|",P.fase2),"") AS f2,
                        IF(AV.f3>0, CONCAT(AV.f3,"|",P.fase3),"") AS f3,
                        IF(AV.f4>0, CONCAT(AV.f4,"|",P.fase4),"") AS f4,
                        IF(AV.f5>0, CONCAT(AV.f5,"|",P.fase5),"") AS f5,
                        IF(AV.f6>0, CONCAT(AV.f6,"|",P.fase6),"") AS f6,
                        IF(AV.f7>0, CONCAT(AV.f7,"|",P.fase7),"") AS f7,
                        IF(AV.f8>0, CONCAT(AV.f8,"|",P.fase8),"") AS f8,
                        A.valor2 AS noAsociados,
                        P.cod_pedido
                                FROM dt_prod_avances AV
                                LEFT JOIN dt_ordenes_items I ON I.id_item = AV.id_item
                     LEFT JOIN dt_ordenes O ON I.nOrden = O.nOrden
                                LEFT JOIN dt_tipospedido P ON P.cod_pedido = AV.seccion
                                LEFT JOIN dt_sys_ajustes A ON A.valor2 = AV.seccion AND A.tipo="MINUT"
                                LEFT JOIN dt_empleado E ON E.id_empleado = AV.id_empleado
                  WHERE (AV.periodo IN ("D","P","F")) '.
                   $cond[1].$cond[2].$cond[3].$cond[4].$cond[5];

            break;
            
         case 125:
               return 'SELECT *
            			FROM dt_empleado_turnos T
                     INNER JOIN dt_rh_turnos R USING (id_turno)
                     WHERE '.$cond[0].$cond[1];

               break;
            
			case 200: //Listado de servicios de una OP para generar OST
				return 'SELECT O.num_cotiza,
						I.id_item, I.referencia,  
						P.pedido, 
						PR.refInterna, I.cPaginas, I.cCopias, P.cod_pedido, IC.cantPliegosOri,
                  I.id_producto
						FROM dt_ordenes_items I
						INNER JOIN dt_tipospedido P USING(cod_pedido)
						LEFT JOIN dt_inv_productos PR ON PR.id_producto = I.id_producto
						INNER JOIN dt_ordenes O ON O.nOrden = I.nOrden
						LEFT JOIN dt_ordenes_itemsC IC ON IC.id_item = I.id_item
						WHERE I.nOrden = '.$cond.'
						GROUP BY I.id_item
						ORDER BY P.orden';
			
			break;
			
			case 205: //Autorizar OST
				return 'SELECT O.id_os, O.fecha, O.plazo, O.contacto, O.revisada, O.firmada,
						REPLACE(C.cli_nombre , "|",  " ")
						FROM dt_ordenes_terceros O
						INNER JOIN dt_clientes C ON C.id_cliente = O.id_cliente  
						WHERE (revisada=0 || firmada = 0)
						AND estado = "I"
						AND id_os = ' . $cond .'
						LIMIT 1';
			break;
			
         
         case 209:
            'SELECT D.id_os_detalle
						FROM dt_ordenes_terceros OT
						INNER JOIN dt_ordenes_terceros_det D ON D.id_os = OT.id_os
						INNER JOIN dt_ordenes_items I ON I.id_item = D.id_item
						WHERE OT.estado != "A" ' .
						$cond[0]. 
						$cond[1]. 
						$cond[2]. ' 
						GROUP BY D.id_os_detalle';
            
         break;
            
			case 210: //Seguimiento a OST
				return 'SELECT OT.id_os, OT.fecha_entrega,
						D.id_os_detalle, IF(D.recibido>0, D.recibido, ""), D.detalleRecibido,  
                  LEFT(CONCAT(E.emp_nombre, " ", E.emp_apellidos),20),
                  D.Cantidad, D.vrTotal,
                  GREATEST(IFNULL(CA.costo_acabados,0), IF(I.cod_pedido IN (4,15,17,18), CT.costo_maquina, 0), IF(I.cod_pedido=2, CT.costo_planchas,0)),
						LEFT(REPLACE(C.cli_nombre , "|",  " "),30),
						LEFT(REPLACE(C2.cli_nombre , "|",  " "),30),
						I.nOrden,
						P.refInterna,
						T.pedido,
						OT.estado
						FROM dt_ordenes_terceros OT
						INNER JOIN dt_clientes C USING(id_cliente)
						INNER JOIN dt_ordenes_terceros_det D ON D.id_os = OT.id_os
						INNER JOIN dt_ordenes_items I ON I.id_item = D.id_item
						INNER JOIN dt_ordenes O USING(nOrden)
						INNER JOIN dt_clientes C2 ON C2.cli_nit = O.cli_nit
						INNER JOIN dt_inv_productos P USING(id_producto)
						LEFT JOIN dt_tipospedido T ON T.cod_pedido = I.cod_pedido
						LEFT JOIN dt_empleado E ON E.id_empleado = D.id_empleado
                  LEFT JOIN dt_cot_acabados A ON A.id_producto = I.id_producto 
                  LEFT JOIN dt_coti_cotizacionPartesCostosAca CA ON CA.id_acabado = A.id_acabado AND CA.id_costos = I.idAprobado
                  LEFT JOIN dt_coti_cotizacionPartesCostos CT ON CT.id = I.idAprobado
						WHERE OT.estado != "A" 
                  AND (I.idAprobado = CA.id_costos OR isnull(CA.id_costos) OR isnull(I.idAprobado) OR I.idAprobado>=0) ' .
						$cond[0]. 
						$cond[1]. 
						$cond[2]. ' 
						GROUP BY D.id_os_detalle';
			break;  


			case 211: //Listado a OST
				return 'SELECT OT.id_os "OST", IF(OT.Estado="A","X","") AS Anulada,  OT.fecha_entrega "Solicitada para",
						LEFT(REPLACE(C.cli_nombre , "|",  " "),30) Proveedor,
                  D.recibido "Fecha Recibido",
                  T.pedido, P.refInterna,
                  D.Cantidad, D.vrTotal "Valor Servicio",
                  GREATEST(
                     IFNULL(CA.costo_acabados, -1), 
                     IF(I.cod_pedido IN (4,15,17,18), CT.costo_maquina, -1), 
                     IF(I.cod_pedido=2, CT.costo_planchas, -1)
                  ) "Vr. Cotizado",
                  I.nOrden "O.P.",
                  O.num_cotiza, I.idAprobado
                  
						FROM dt_ordenes_terceros OT
						INNER JOIN dt_clientes C USING(id_cliente)
						INNER JOIN dt_ordenes_terceros_det D ON D.id_os = OT.id_os
						INNER JOIN dt_ordenes_items I ON I.id_item = D.id_item
						INNER JOIN dt_ordenes O USING(nOrden)
						INNER JOIN dt_inv_productos P USING(id_producto)
						LEFT JOIN dt_tipospedido T ON T.cod_pedido = I.cod_pedido
                  LEFT JOIN dt_cot_acabados A ON A.id_producto = I.id_producto 
                  LEFT JOIN dt_coti_cotizacionPartesCostosAca CA ON CA.id_acabado = A.id_acabado AND CA.id_costos = I.idAprobado
                  LEFT JOIN dt_coti_cotizacionPartesCostos CT ON CT.id = CA.id_costos
						WHERE (I.idAprobado = CA.id_costos OR isnull(CA.id_costos) OR isnull(I.idAprobado) OR I.idAprobado>=0) ' .
						$cond[0]. 
						$cond[1]. 
						$cond[2]. ' 
						GROUP BY D.id_os_detalle';
			break;
			
			case 212: //OST previas
				return 'SELECT OT.id_os, LEFT(REPLACE(C.cli_nombre , "|",  " "),30), T.pedido, P.refInterna, 
                  OT.fecha, OT.estado,
                  D.cantidad, D.vrTotal
						FROM dt_ordenes_terceros OT 
						INNER JOIN dt_clientes C USING(id_cliente) 
						INNER JOIN dt_ordenes_terceros_det D ON D.id_os = OT.id_os 
						INNER JOIN dt_ordenes_items I ON I.id_item = D.id_item 
						INNER JOIN dt_ordenes O USING(nOrden)
						INNER JOIN dt_inv_productos P ON P.id_producto = I.id_producto
						INNER JOIN dt_tipospedido T ON T.cod_pedido = P.cod_pedido 
						WHERE O.nOrden = ' . $cond.'
						ORDER BY OT.id_os';
			break;
            
         case 220:
             return 'SELECT O.plazo, O.contacto, O.fecha, O.fecha_entrega, O.obs, O.fechaRev, O.fechaFir, O.estado, O.firmada, 
                     REPLACE(C.cli_nombre , "|",  " ") cli_nombre, C.cli_nit, C.cli_direccion,
                     C.cli_nit, REPLACE(C.cli_nombre , "|",  " "), C.cli_direccion, 
                     CONCAT(E.emp_nombre, " ", E.emp_apellidos ) elaboro	,
                     CONCAT(E2.emp_nombre, " ", E2.emp_apellidos ) revisa, 
                     CONCAT(E3.emp_nombre, " ", E3.emp_apellidos) firma,
                     SC.nombreCiudad
                     FROM dt_ordenes_terceros O
                     INNER JOIN dt_empleado E USING(id_empleado)
                     LEFT JOIN dt_empleado E2 ON E2.id_empleado = O.revisada
                     LEFT JOIN dt_empleado E3 ON E3.id_empleado = O.firmada
                     INNER JOIN dt_clientes C ON C.id_cliente = O.id_cliente
                     LEFT JOIN ineditto.dt_locaciones3 SC ON SC.idCiudad = C.ciudad_id
                     WHERE id_os = '.$cond ;
         break;
		}
	}
   
   function m_inserta($id, $cond=''){
		// 001 al 100 para tablas del sistema o generales
		// 101 al 200 para clientes
		// 201 al 300 empleados
		switch ($id){
			case 0:
				$sql = 'INSERT '.$cond[0].' VALUES ' . $Cond[1];
            $this->db->m_ejecuta($sql);
			break;
            
         case 31:
				$sql = 'INSERT dt_ordenes (nOrden, fechaIngreso) 
                  VALUES ('.$cond.', "'.date('Y-m-d H:i:s').'")';
            $this->db->m_ejecuta($sql);
			break;
		}
	}
   
   //Consultas de producción cuando existen grupos empresariales
   function m_consultaProdxGE($sql){
      $sqlRpl  = '';
      $order   = explode('ORDER BY ', $sql);
      $order2  = $order[1];
      $order   = str_replace('I.','', $order2);
      $order   = str_replace('O.','', $order);
      foreach($_SESSION['s_grupoEmpresarial'] as $i=>$val){
         $sqlRpl = str_replace('FROM ','FROM '.$val.'.', $sql);
         $sqlRpl = str_replace('FROM ',', "'.$val.'", "'.$i.'" FROM ', $sqlRpl); //SE anexan los campos del nombre de la empresa y su indice de la var. de sesion
         $sqlRpl = str_replace('JOIN ','JOIN '.$val.'.', $sqlRpl);
         if($i==0) {
            $sql3 = 'CREATE TEMPORARY TABLE TMP_PRODU (' . $sqlRpl . ')';
            $this->db->m_ejecuta($sql3);
            unset($sql3);
         }else{
            $sql3 =  'INSERT TMP_PRODU ' . $sqlRpl;
            $this->db->m_ejecuta($sql3);
         }
      }
      $sql  = 'SELECT * FROM TMP_PRODU ORDER BY '.$order;
      $rs   = $this->db->m_trae_array($sql);
      $sql  = 'DROP TABLE TMP_PRODU';
      $this->db->m_ejecuta($sql);
      return $rs;
   }
}

?>