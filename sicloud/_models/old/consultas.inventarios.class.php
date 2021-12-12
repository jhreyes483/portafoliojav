<?
if($_SERVER['SCRIPT_NAME']== '/incl/consultas.inventarios.class.php') die();

class c_inventarios{
	function m_consulta($id, $Cond=''){
		switch ($id){
			case 1:
            return 'SELECT id_linea, linea,
               IF(reservadoSistema=0,1,0) AS orden
               FROM dt_inv_lineas 
               ORDER BY orden, linea';
			break;
         
         case 4:
            return 'CREATE TEMPORARY TABLE TMP_SALDOS
                  (INDEX id_producto (id_producto))
                  SELECT D.id_producto, SUM(D.saldo) saldo
                  FROM dt_inv_ingresoDetalle D 
                  INNER JOIN dt_inv_ingreso I USING (id_ingreso) 
                  LEFT JOIN dt_inv_bodegas B USING (id_bodega ) 
                  WHERE D.saldo>0 
                  AND B.tipo= "Intermedia" OR B.tipo="General" 
                  GROUP BY D.id_producto ';
			
         case 5:
				return 'SELECT P.id_producto, P.cod_pedido, P.refInterna, P.refProveedor, P.saldo_minimo,
						C.vrcm2, C.vr_unitario, C.vr_kilo, C.valor_minimo,
						GROUP_CONCAT( T.pedido SEPARATOR "<br>"), L.linea, L.id_linea,
                  S.saldo,
                  if(C.fechaModi>0, CONCAT(C.quienModi, "<br>", LEFT(C.fechaModi,16)), ""),
						(
                      SELECT SUBSTRING_INDEX(GROUP_CONCAT(D.precioUnitario ORDER BY id DESC),",",3)
                      FROM dt_inv_ingresoDetalle D
                      INNER JOIN dt_inv_ingreso I USING(id_ingreso)
                      WHERE I.concepto !=7 AND id_producto = P.id_producto
                  )
                  FROM dt_inv_productos P
						LEFT JOIN dt_inv_productosCaract C USING(id_producto)
                  LEFT JOIN TMP_SALDOS S ON S.id_producto = P.id_producto
						LEFT JOIN dt_inv_lineas L ON P.id_linea = L.id_linea
						LEFT JOIN dt_tipospedido T ON FIND_IN_SET(T.cod_pedido, P.cod_pedido)
						WHERE P.id_producto>10 '.$Cond[0].'
						GROUP BY P.id_producto
						ORDER BY '.$Cond[1].'L.linea, P.refInterna';
			break;
			case 6:
				return 'SELECT P.refInterna Referencia, P.refProveedor AS "Ref. Proveedor", P.saldo_minimo "Stock Mínimo",
						C.vrcm2 "Vr. X Cm2", C.vr_unitario "Vr. Unidad", C.valor_minimo "Cobro Mínimo",
						GROUP_CONCAT( T.pedido SEPARATOR ", ") Servicio, L.Linea
						FROM dt_inv_productos P
						LEFT JOIN dt_inv_productosCaract C USING(id_producto)
						LEFT JOIN dt_inv_lineas L ON P.id_linea = L.id_linea
						LEFT JOIN dt_tipospedido T ON FIND_IN_SET(T.cod_pedido, P.cod_pedido)
						WHERE id_producto>10 '.$Cond.'
						GROUP BY P.id_producto
						ORDER BY L.linea, P.refInterna';
			break;
            
			case 50: //Orden de Compra
				return	'SELECT O.*, 
					REPLACE(C.cli_nombre , "|",  " ") cli_nombre, C.cli_nit, C.cli_direccion,
                    SC.nombreCiudad,
					CONCAT(E.emp_nombre, " ", E.emp_apellidos ) elaboro	,
					CONCAT(E2.emp_nombre, " ", E2.emp_apellidos ) revisa, O.fechaRev,
					CONCAT(E3.emp_nombre, " ", E3.emp_apellidos) firma, O.fechaFir
					FROM dt_ordenes_xcompra O
					INNER JOIN dt_empleado E USING(id_empleado)
					LEFT JOIN dt_empleado E2 ON E2.id_empleado = O.revisada
					LEFT JOIN dt_empleado E3 ON E3.id_empleado = O.firmada
					INNER JOIN dt_clientes C ON C.id_cliente = O.id_cliente
               LEFT JOIN ineditto.dt_locaciones3 SC ON SC.idCiudad = C.ciudad_id
					WHERE id_oc = '.$Cond ;
			break;
         
			case 51:
				return 'SELECT D.vrUnitario, D.cantidad, D.iva,
					P.refInterna, P.refProveedor
					FROM dt_ordenes_xcompra_det D
					LEFT JOIN dt_inv_productos P USING(id_producto)
					WHERE id_oc = '.$Cond ;
			break;
         
			case 60:
				return 'SELECT id_cliente, REPLACE(cli_nombre , "|",  " "),  plazoC
					FROM dt_clientes
					WHERE esProveedor IN (1,2)
					ORDER BY cli_nombre';
			break;
			
			case 61: //Productos de un proveedor 
            return 'SELECT P.id_producto, P.refInterna, P.refProveedor, P.uMedida, P.ivaCompras
					FROM dt_inv_productos P
					WHERE FIND_IN_SET('.$Cond.', P.id_proveedor)
					ORDER BY refInterna';
				/*return 'SELECT P.id_producto, P.refInterna, P.refProveedor, P.uMedida, P.ivaCompras, C.tipoTer FROM dt_inv_productos P INNER JOIN dt_clientes C ON FIND_IN_SET(992, P.id_proveedor) WHERE FIND_IN_SET(992, P.id_proveedor) GROUP BY P.id_producto ORDER BY refInterna';*/
			break;
			
			case 63:
				return 'SELECT REPLACE(cli_nombre , "|",  " "), cli_direccion, cli_telefono
					FROM dt_clientes 
					WHERE id_cliente = ' . $Cond;
			break;
            
         case 70:
            return 'CREATE TEMPORARY TABLE tmp_ordenC
                  SELECT O.id_oc, IFNULL( GROUP_CONCAT( DISTINCT I.id_ingreso ) , "" ) entradas
                  FROM dt_ordenes_xcompra O
                  INNER JOIN dt_inv_ingreso I ON O.id_oc = I.ordenC  AND I.prodTer = 0'
                  . $Cond[1] .' 
                  WHERE  1 ' . $Cond[0] .' 
                  GROUP BY O.id_oc';
         break;
         
			case 71: //Reporte Consolidado
				return 'SELECT O.id_oc OC, O.Fecha, O.Estado, O.uniMon "Unidad Monetaria", "", IF(O.TRM>1,O.TRM,"") TRM,
						IF(SUM(D.cantidad-D.recibido)>0, "No Recibida","Recibida") Estado,
						SUM(D.Cantidad * D.vrUnitario) "Vr Total", 
						LEFT(REPLACE(C.cli_nombre , "|",  " "),35) "Proveedor",
						CONCAT(E.emp_nombre, " ", E.emp_apellidos) "Elaboró",
						CONCAT(E2.emp_nombre, " ", E2.emp_apellidos," (", O.fechaRev, ")") "Revisó",
						CONCAT(E3.emp_nombre, " ", E3.emp_apellidos," (", O.fechaFir, ")") "Autorizó",
						IFNULL(GROUP_CONCAT(DISTINCT T.entradas),"") "Entrada Almacén",
                  O.obsInternas
						FROM dt_ordenes_xcompra O
						INNER JOIN dt_ordenes_xcompra_det D USING(id_oc)
						INNER JOIN dt_clientes C ON C.id_cliente = O.id_cliente  
						INNER JOIN dt_empleado E ON E.id_empleado = O.id_empleado
						LEFT JOIN dt_empleado E2 ON E2.id_empleado = O.revisada 
						LEFT JOIN dt_empleado E3 ON E3.id_empleado = O.firmada 
						LEFT JOIN tmp_ordenC T ON T.id_oc = O.id_oc  
						WHERE 1 ' . $Cond[0] .' 
						GROUP BY O.id_oc
						ORDER BY O.id_oc DESC';
			break;
         
         case 72: //Reporte Detallado
             return 'SELECT O.id_oc OC, O.Fecha, O.Estado, O.uniMon "Unidad Monetaria", CONCAT(D.IVA,"%"), IF(O.TRM>1,O.TRM,"") TRM,
                  IF(SUM(D.cantidad-D.recibido)>0, "No Recibida","Recibida") Estado,
                  D.vrUnitario "Vr Unit.",
                  LEFT(REPLACE(C.cli_nombre , "|",  " "),35) "Proveedor",
                  CONCAT(E.emp_nombre, " ", E.emp_apellidos) "Elaboró",
                  CONCAT(E2.emp_nombre, " ", E2.emp_apellidos," (", O.fechaRev, ")") "Revisó",
                  CONCAT(E3.emp_nombre, " ", E3.emp_apellidos," (", O.fechaFir, ")") "Autorizó",
                  IFNULL(GROUP_CONCAT(DISTINCT I.id_ingreso),"") "Entrada Almacén",
                  D.Cantidad, P.refInterna
                  FROM dt_ordenes_xcompra O
                  INNER JOIN dt_ordenes_xcompra_det D USING(id_oc)
                  INNER JOIN dt_clientes C ON C.id_cliente = O.id_cliente  
                  INNER JOIN dt_empleado E ON E.id_empleado = O.id_empleado
                  LEFT JOIN dt_empleado E2 ON E2.id_empleado = O.revisada 
                  LEFT JOIN dt_empleado E3 ON E3.id_empleado = O.firmada 
                  LEFT JOIN dt_inv_ingreso  I ON O.id_oc = I.ordenC  AND I.prodTer = 0 '
                  . $Cond[1] .' 
                  WHERE 1 ' . $Cond[0] .' 
                  GROUP BY D.id_oc_detalle
                  ORDER BY O.id_oc DESC, D.id_oc_detalle';
			break;
			case 80: //Autoriza - Firma
				return 'SELECT revisada, firmada, estado
						FROM dt_ordenes_xcompra 
						WHERE id_oc = ' . $Cond .'
						LIMIT 1';
			break;
         
         case 200:
            //2018-08-15 
            // Se usa el campo "estado" para validar que un ingreso puede facturarse, pues los ingresops de fechas anteriores quedarían disponibles
            // Se determina cambiar su valor a 9 cuando un cliente solicite que no le aparezcan
            return 'SELECT
							I.ordenC,GROUP_CONCAT(I.id_ingreso),
							I.fecha, CONCAT(E.emp_nombre, " ",E.emp_apellidos)
							FROM dt_ordenes_xcompra O
                     LEFT JOIN dt_inv_ingreso I ON I.ordenC = O.id_oc
                     LEFT  JOIN dt_empleado E ON E.id_empleado= I.id_empleado
							WHERE I.estado=0
                     AND I.idFactCompra = 0 
                     AND I.ordenC > 0  
                     AND I.id_proveedor = ' . $Cond.'
							GROUP BY I.ordenC
                     ORDER BY O.fecha';
         break;
		}
	}
}

?>