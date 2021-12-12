<?
if($_SERVER['SCRIPT_NAME']== '/incl/consultas.coti.class.php') die();


class c_cotizaciones{
   function m_consulta($id, $Cond=''){
		// 001 al 200 para tablas del sistema o generales
	   switch ($id){
		   case 10:
            return 'SELECT valor2
						FROM dt_sys_ajustes 
						WHERE tipo="COBER"
                  LIMIT 1';
			break;
         case 11:
             /*return 'SELECT id_tinta, tipo_tinta 
                     FROM dt_cot_tintas
                     ORDER BY id_tinta';*/
            return 'SELECT id_tinta, nombreTinta, tipoSelector, color 
                     FROM dt_cot_tintas
                     ORDER BY id_tinta';
            break;
         
         case 15:
             return 'SELECT id_formato, nom_formato 
                     FROM dt_cot_formatosHoja 
                     WHERE tipo="P"
                     ORDER BY nom_formato'; 
            break;
         
         case 16:
             return 'SELECT medida_x, medida_y, nom_formato
                     FROM dt_cot_formatosHoja
                     WHERE tipo="F" 
                     ORDER BY nom_formato';
            break;
         
         case 20:
             return 'SELECT valor2 FROM dt_sys_ajustes
                  WHERE tipo="COM_V"';
            break;
         
         case 110:   //// Características de un sustrato
             return 'SELECT P.id_producto, CR.w, CR.h, P.refInterna, CR.vr_unitario, CR.absorcion, CR.vrcm2
                     FROM dt_inv_productos AS P 
                     INNER JOIN dt_inv_productosCaract CR USING(id_producto)
                     WHERE P.id_producto = ' . $Cond. '
                     LIMIT 1';
         break;

         case 120: // Listado de acabados
            return 'SELECT P.compartir, P.descripcion, P.id_producto, P.refInterna, 
                  A.id_acabado, A.fijo, C.id_porcen
                  FROM dt_inv_productos AS P 
                  LEFT JOIN dt_cot_acabados A USING(id_producto) 
                  LEFT JOIN dt_cot_costoAcabado C ON C.id_acabado = A.id_acabado
                  WHERE P.compartir IN ('.$Cond[0].')
                  GROUP BY P.id_producto
                  ORDER BY '.$Cond[1]; 
         break;
            
         case 122: // Listado de acabados
            return 'SELECT id_producto, refInterna
                  FROM dt_inv_productos
                  WHERE '
                  . $Cond.' 
                  ORDER BY refInterna'; 
         break;
         
         case 123: // Planchas para usar en las Máquinas
            return 'SELECT P.id_producto, P.refInterna,
                 GREATEST(C.vr_unitario, ROUND(C.vrcm2*C.w*C.h)) vr_general
                 FROM dt_inv_productos P
                 INNER JOIN dt_inv_productosCaract C USING(id_producto)
                 WHERE P.id_linea = 2 or P.cod_pedido=2
                 HAVING vr_general >0
                 ORDER BY P.refInterna'; 
         break;
          
         case 140: // Cambiar datos de la cotizacion y datos en Hoja de Costos
            return 'SELECT C.num_cotiza, C.nit, C.cliente, C.contacto, C.validez, C.referencia, C.estado, C.modificado, C.origen, 
                  C.fecha, CONCAT("(hace ", DATEDIFF("'.date('Y-m-d H:i:s').'", fecha), " días)"), C.vrUnitDecimal, 
                  CONCAT(E.emp_nombre," ", E.emp_apellidos) elaboro, 
                  C.emp_cedula, C.formaPago, C.email, C.tipo, ivaYtotalizada, O.nOrden,
                  C.observaciones
                  FROM dt_coti_cotizacion C
                  LEFT JOIN dt_empleado E ON E.id_empleado = C.elaboro
                  LEFT JOIN dt_ordenes O ON O.num_cotiza = '. $Cond.'
                  WHERE C.num_cotiza ='. $Cond;
         break;
         
         case 141: //Elementos de una cotizacion
            return 'SELECT C.id_elemento, C.ref_elemento, C.formato_x, C.formato_y, C.tintas, C.paginas, C.espe_tiro, 
                  C.espe_retiro,  C.cabida, C.pliegoImp_x, C.pliegoImp_y, MID(C.datosCabida,1,4), C.planchas, LEFT(C.nombrePlanchas,26),
                  P.refInterna, 
                  M.nombre_maquina
                  FROM dt_coti_cotizacionPartes C
                  LEFT JOIN dt_inv_productos P USING (id_producto)
                  LEFT JOIN dt_cot_maquinas M ON M.id_maquina = C.id_maquina
                  WHERE num_cotiza = ' . $Cond.' 
                  GROUP BY C.id_elemento';
         break;
      
         case 150: //Reporte de Envios
            return 'SELECT SQL_CALC_FOUND_ROWS IF(C.Origen>0, "M","") Origen, nCot "No. Cot.", C.Cliente,
                  E.enviado_a "Enviado a",  E.enviado_email Email, E.enviado_por "Enviado por",  E.Fecha, E.tipoEnvio AS Formato
                  FROM dt_sys_enviosEmail E
                  INNER JOIN dt_coti_cotizacion C ON C.num_cotiza = E.nCot
                  WHERE tipoDoc = 0 
                  AND E.fecha BETWEEN "' . $Cond[0].'" AND "' . $Cond[1] .' 23:59:59"'.
                  $Cond[2]. ' 
                  ORDER BY E.Fecha DESC';
         break;
            
         //155 al 161 Reporte Cotizaciones elaboradas
         case 155:
            $campo = ($Cond[5]>0? 'C.num_cotiza ='.$Cond[5] : 'C.fechaCambioEstado BETWEEN "'.$Cond[0].'" AND "' .$Cond[1] .' 23:59:59"');
             return 'CREATE TEMPORARY TABLE tmp_deta_coti
                     SELECT P.id_elemento, PC.cantidad,
                     E.emp_nombre AS Vendedor, 
                     IF(C.Origen>0, "M","") tipoCot, C.num_cotiza, C.fecha, C.nit, 
                     IF(C.nit>0, REPLACE(CL.cli_nombre , "|",  " "), CONCAT("(**)", C.cliente)) AS Cliente, C.referencia, 
                     CASE M.id_tipoMaquina 
                         WHEN 1 THEN "Digital B/W" 
                         WHEN 4 THEN "Digital Color" 
                         WHEN 2 THEN "Plotter" 
                         WHEN 3 THEN "Offset" 
                         WHEN 0 THEN "N/A" 
                         END AS Servicio, 
                     IF(M.ubicacion ="MI", " Interna" , IF(M.ubicacion ="ME"," Externa","")) AS Tipo,  
                     SUM(PC.costo_papel+PC.costo_maquina+PC.costo_tintas+PC.costo_corte+PC.costo_planchas+PC.costo_otros) AS Costos,
                     SUM(PC.margenCS) MS, SUM(PC.margenCP) MP, SUM(PC.margenContri) MC, 
                     SUM(PC.financiacion) AS FIN, SUM(PC.comAgencia) AS CA, SUM(PC.comVend) AS CV, 
                     AVG(PC.porCV) AS porCV,
                     CE.abreviatura,
                     C.fechaCambioEstado, C.vrUnitDecimal
                     FROM dt_coti_cotizacion C 
                     INNER JOIN dt_coti_cotizacionPartes P USING ( num_cotiza ) 
                     INNER JOIN dt_coti_cotizacionPartesCostos PC USING ( id_elemento )
                     LEFT JOIN dt_empleado E ON E.emp_cedula = C.emp_cedula 
                     LEFT JOIN dt_cot_maquinas M ON M.id_maquina = P.id_maquina 
                     INNER JOIN dt_cot_estados CE ON CE.id_estado = C.estado
                     LEFT JOIN dt_clientes CL ON CL.id_cliente = C.idCliente
                     WHERE ' . $campo  
                     . $Cond[2]   
                     . $Cond[3] 
                     . $Cond[4] . ' 
                     GROUP BY C.num_cotiza 

                     UNION

                     SELECT P.id_elemento, PC.cantidad,
                     E.emp_nombre AS Vendedor, 
                     IF(C.Origen>0, "M",""), C.num_cotiza, "Fecha", "", "", "referencia", "Acabados", "", 
                     SUM(PCA.costo_acabados) , 0, 0, 0, 0, 0, 0, 0,
                     CE.abreviatura,
                     C.fechaCambioEstado, C.vrUnitDecimal
                     FROM dt_coti_cotizacion C 
                     JOIN dt_coti_cotizacionPartes P USING ( num_cotiza )
                     JOIN dt_coti_cotizacionPartesCostos PC USING (id_elemento) 
                     JOIN dt_coti_cotizacionPartesCostosAca PCA ON PCA.id_costos = PC.id ' . /* 2017-07-01 Aqui había un join con id_elemento, pero obvio era una error
                                                                                                Porque se multiplicaban las candtidades de acuerdo a las cantidades cotizadas */ '
                     LEFT JOIN dt_empleado E ON E.emp_cedula = C.emp_cedula 
                     JOIN dt_cot_estados CE ON CE.id_estado = C.estado
                     LEFT JOIN dt_clientes CL ON CL.id_cliente = C.idCliente
                     WHERE ' . $campo 
                     . $Cond[2]   
                     . $Cond[3] 
                     . $Cond[4] 
                     . ' GROUP BY C.num_cotiza';
         break;

         case 156:  //Organiza el resultado de la 155
             return 'CREATE TEMPORARY TABLE tmp_deta_coti_I
                     SELECT T.id_elemento, T.cantidad, T.tipoCot, T.num_cotiza AS Cotizacion, T.Cliente, T.Fecha, 
                     T.Vendedor, T.Servicio, T.Tipo, SUM(T.Costos) AS Valor, T.MS, T.MP, T.MC, T.FIN, T.CA, T.CV, T.porCV, 
                     T.referencia, T.abreviatura, T.fechaCambioEstado, T.vrUnitDecimal,
                     "" AS estado,
                     O.nOrden AS OP, O.fechaCliente
                     FROM tmp_deta_coti T
                     LEFT JOIN dt_ordenes O USING(num_cotiza)
                     WHERE 1 '. 
                     $Cond .' 
                     GROUP BY Cotizacion';
         break;

         case 157: //Consolidado
             return 'SELECT TipoCot AS tipo_cot, Cotizacion AS cot_excel, "" AS "Estado Cot.", "" AS cli_excel, "" AS Fecha, "" AS referencia, Vendedor, Servicio, Tipo, 
                     SUM(Valor) AS Valor, SUM(MS) AS "Marg. Sustr.", SUM(MP) AS "Marg. Planchas", SUM(MC) AS "Marg. Cont.", SUM(FIN) AS "Costo Fin.", SUM(CA) AS "Com. Age.", SUM(CV) AS "Com. Ven.", referencia,
                     cantidad
                     FROM tmp_deta_coti_I
                     GROUP BY Vendedor, Servicio, Tipo;';
         break;

         case 158: //Detallado
             return 'SELECT TipoCot, Cotizacion, abreviatura AS "Estado Co", Cliente, Fecha, referencia,
                     Vendedor, Servicio, Tipo, Valor, MS, MP, MC AS "Marg. Con", FIN AS "Costo Fin.", 
                     CA AS "Com. Agencia", CV AS "Com. Vend.", 
                     (Valor + MS + MP + MC + FIN + CA + CV) AS "Total Co", cantidad, "" AS "Total Aprob.",
                     fechaCambioEstado, OP, "" AS Estado, "" AS Factura, "" AS id_fac, vrUnitDecimal, fechaCliente,
                     porCV 

                     FROM tmp_deta_coti_I
                     GROUP BY Cotizacion
                     ORDER BY Cotizacion, id_elemento, cantidad';
         break;

         case 159:
             return 'SELECT GROUP_CONCAT(PA.id_aprobado)
                     FROM dt_coti_cotizacionPartes P
                     INNER JOIN dt_coti_cotizacionPartesCostos PC USING ( id_elemento )
                     INNER JOIN dt_coti_cotizacionPartesApro PA ON PA.id_Aprobado = PC.id
                     WHERE P.num_cotiza =' . $Cond;
         break;

         case 160:
            return 'SELECT (costo_papel+costo_maquina+costo_tintas+costo_corte+costo_planchas+costo_otros) AS Costos,
                     margenCS, margenCP, margenContri, financiacion, comAgencia, comVend, Cantidad,
                     porCV, vrUnitario, id_elemento

                     FROM dt_coti_cotizacionPartesCostos
                     WHERE id IN ('.$Cond.')';
            
//            return 'SELECT (costo_papel+costo_maquina+costo_tintas+costo_corte+costo_planchas+costo_otros) AS Costos,
//                     margenCS, margenCP, margenContri, financiacion, comAgencia, comVend, Cantidad,
//                     porCV, vrUnitario
//
//                     FROM dt_coti_cotizacionPartesCostos
//                     WHERE id IN ('.$Cond.')
//                     UNION
//                     SELECT SUM(costo_acabados), 0, 0, 0, 0, 0, 0, 0, 0, 0
//                     FROM  dt_coti_cotizacionPartesCostosAca
//                     WHERE id_costos IN ('.$Cond.')';
         break;

         case 161:
             return 'SELECT O.nOrden, 
                     CASE O.aprobado
                         WHEN 0 THEN "En Proc."  
                         WHEN 1 THEN "En Proc." 
                         WHEN 9 THEN "Finaliz." 
                         WHEN 11 THEN "Anulada" 
                         WHEN 12 THEN "Stand By" 
                         WHEN 15 THEN "PostCost." 
                     END,
                     IFNULL(GROUP_CONCAT(DISTINCT D.nFactura SEPARATOR ", "),""), 
                     GROUP_CONCAT(DISTINCT D.id_factura)
                     FROM  dt_ordenes O
                     LEFT JOIN dt_ad_facturacionDetalle D USING (nOrden)
                     WHERE O.nOrden IN ('. implode(',', $Cond).')
                     GROUP BY nOrden
                     ORDER BY nOrden;';
         break;

         case 170: // Detalle de cotizaciones
            return 'SELECT IF(C.Origen>0, "M",""), C.num_cotiza, C.Cliente, 
                  M.nombre_maquina, 
                  CONCAT(
                     CASE M.id_tipoMaquina
                        WHEN 1 THEN "Digital B/W"
                        WHEN 4 THEN "Digital Color"
                        WHEN 2 THEN "Plotter"
                        WHEN 3 THEN "Offset"
                        WHEN 0 THEN "N/A"
                     END ,
                     IF(M.ubicacion ="MI", " Interna", IF(M.ubicacion ="ME"," Externa",""))
                  ),
                  C.fecha, C.referencia,
                  P.ref_elemento, 
                  GROUP_CONCAT(PC.cantidad SEPARATOR "<br>") Cantidades,
                  CASE C.estado
                     WHEN 1 THEN "Pendiente"  
                     WHEN 2 THEN "Aprobada" 
                     WHEN 3 THEN "Procesada" 
                     WHEN 4 THEN "Aprobada por el cliente" 
                     WHEN 5 THEN "Cliente no ha definido"
                     WHEN 10 THEN "NA - Precio" 
                     WHEN 11 THEN "NA - Error Datos"
                     WHEN 12 THEN "NA - No seguimiento"
                     WHEN 13 THEN "NA - Uso otro sistema"
                     WHEN 14 THEN "NA - Vto. Proyecto"
                     WHEN 15 THEN "NA - Investigación Precio"
                     WHEN 16 THEN "NA - No cotizar a tiempo"
                     WHEN 17 THEN "NA - Cambio en Especific."
                  END AS Estado, 
                  E.emp_nombre, CONCAT(E2.emp_nombre, " ", LEFT(E2.emp_apellidos,1),"."),
                  C.estado, PC.id_elemento
                  
                  FROM dt_coti_cotizacion C
                  INNER JOIN dt_coti_cotizacionPartes P USING ( num_cotiza )
                  INNER JOIN dt_coti_cotizacionPartesCostos PC USING ( id_elemento ) ' 
                   . /*LEFT  JOIN dt_coti_cotizacionPartesApro A ON A.id_Aprobado = PC.id  ****La consulta no es correcta, por eso trabajo con el CASE 161*/ '
                  LEFT  JOIN dt_empleado E ON E.emp_cedula = C.emp_cedula
                  LEFT  JOIN dt_empleado E2 ON E2.id_empleado = C.elaboro
                  LEFT  JOIN dt_cot_maquinas M ON M.id_maquina = P.id_maquina
                  WHERE fecha BETWEEN "' . $Cond[0].'" AND "' . $Cond[1] .' 23:59:59" '
                  .$Cond[2] . $Cond[3] . ' 
                  GROUP BY C.num_cotiza, PC.id_elemento';
         break;			

         case 171:  //Cantidad aprobada de una cotizacion
            return 'SELECT cantidad 
                  FROM dt_coti_cotizacionPartesCostos PC
                  INNER JOIN dt_coti_cotizacionPartesApro A ON A.id_Aprobado = PC.id
                  WHERE PC.id_elemento = ' . $Cond;
         break;

         case 180:
            return 'SELECT C.cli_nit, REPLACE(C.cli_nombre , "|",  " "), 
                  F.formapago_id, F.porcentaje_cotizacion, C.estatus, C.id_cliente, C.esProveedor
                  FROM dt_clientes C
                  LEFT JOIN dt_sys_formaspago AS F ON C.plazo=F.formapago_id '.
                  $Cond[1]. ' 
                  WHERE C.esProveedor IN (0,2,3) 
                  AND estatus <> "I" ' . 
                  $Cond[0] . '
                  GROUP BY C.id_cliente
                  ORDER BY C.cli_nombre';
         break;

            case 189:
                return 'SELECT nombre_maquina, id_tipoMaquina, torres
                        FROM dt_cot_maquinas 
                        WHERE id_maquina = ' . $Cond. '
                        LIMIT 1';
            break;

         case 190: //Datos para calcular costo de impresion
            return 'SELECT C.id_costo, C.promedio, C.min_produccion, C.costo_pred, 
                  C.fracciones,
                  M.valor_alistamiento, M.montajePlanchas, M.cobraTintas, M.costoHora,
                  M.caras,  M.cobro_pred, M.caras, M.torres, M.id_tipoMaquina, M.tiempo_alistamiento, M.tiempoMontaje, M.uniMedida
                  FROM dt_cot_maquinas M
                  LEFT JOIN dt_cot_costoMaquina C ON C.id_cobro=M.cobro_pred AND M.id_maquina=C.id_maquina
                  WHERE M.id_maquina='. $Cond. ' 
                  GROUP BY M.id_maquina';
         break;

         case 191:
            return 'SELECT pasadas, velocidad
                  FROM dt_cot_maquinasVel
                  WHERE id_maquina='.$Cond;
         break;

         case 192: // Listado de las Fórmulas para los métodos de cobro
            return 'SELECT id_cobro, nom_cobro, consejo, formula, modifica, 
                     IF(id_cobro<200,1,2) orden
                     FROM dt_cot_cobrar 
                     WHERE FIND_IN_SET(2, aplica_id) 
                     ORDER BY orden, nom_cobro';

            /*return 'SELECT * FROM (SELECT id_cobro, nom_cobro, consejo, formula, modifica
                  FROM  dt_cot_cobrar
                  WHERE FIND_IN_SET(2, aplica_id)
                  AND id_cobro<200
                  ORDER BY nom_cobro) A

                  UNION

                  SELECT * FROM(SELECT id_cobro, nom_cobro, consejo, formula, modifica
                  FROM  dt_cot_cobrar
                  WHERE FIND_IN_SET(2, aplica_id)
                  AND id_cobro>=200
                  ORDER BY nom_cobro) B'; */
         break;

         case 193: //títulos de los metodos de cobro
            return 'SELECT id_cobro, nom_cobro
                  FROM  dt_cot_cobrar
                  WHERE FIND_IN_SET(2, aplica_id)
                  ORDER BY id_cobro';
         break;

         case 194:  //Varia velocidad de maq.
            return 'SELECT variaV
                  FROM dt_inv_productosCarTec
                  WHERE id_producto = '.$Cond;
         break;
            
         case 200: //Personas que han elaborado cotizaciones
            return 'SELECT E.id_empleado, CONCAT(E.emp_nombre, " ", E.emp_apellidos)
                  FROM dt_coti_cotizacion C
                  INNER JOIN dt_empleado E ON E.id_empleado = C.elaboro
                  GROUP BY C.elaboro';
            break;

         
         //Al cotizar
         case 300:
             return 'SELECT GROUP_CONCAT(A.id_acabado), GROUP_CONCAT(I.refInterna SEPARATOR ", ")
                 FROM dt_cot_acabados A
                 INNER JOIN dt_inv_productos I USING(id_producto)
                 WHERE A.fijo=1 
                 AND I.compartir>0
                 LIMIT 1';
         break;

         //Al recotizar
         case 350: //Nombre de los acabados seleccionados al recotizar
             return 'SELECT GROUP_CONCAT(I.refInterna SEPARATOR " &bull; ")
                     FROM dt_inv_productos I
                     INNER JOIN dt_cot_acabados A USING(id_producto)
                     WHERE A.id_acabado IN('.$Cond.')
                     ORDER BY I.orden
                     LIMIT 1';
         break;

         case 360: //Acabados ajustados para las solicitudes
            return 'SELECT TRIM(datos) FROM dt_coti_solicitud
               WHERE id=1';

         break;

         case 361:
            return 'SELECT A.id_acabado, P.refInterna, "" AS refUsuario 
               FROM dt_inv_productos P
               INNER JOIN dt_cot_acabados A USING(id_producto)
               WHERE A.id_acabado IN ('.implode(',',$Cond).')
               ORDER BY P.refInterna';
         break;

         case 365: //Solicitud de Cotización
             return 'SELECT CONCAT(E.emp_nombre, " ", E.emp_apellidos),
                  S.fecha, S.datosG, S.datos, S.id,
                  S.id_empleado
                  FROM dt_coti_solicitud S
                  INNER JOIN dt_empleado E USING(id_empleado)
                  WHERE id>1 ' 
                  . $Cond;
         break;

         case 366:
            return 'SELECT S.id, S.fecha, S.datosG, S.datos, S.num_cotiza,
                  CONCAT(E.emp_nombre, " ", E.emp_apellidos),
                  C.fecha
                  FROM dt_coti_solicitud S
                  LEFT JOIN dt_empleado E ON E.id_empleado = S.estado
                  LEFT JOIN dt_coti_cotizacion C ON C.num_cotiza = S.num_cotiza
                  WHERE id>1 AND ' . $Cond;
         break;

		}
	}
}
