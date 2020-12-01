<?php
require_once "conexion.php";
/**
 * Modelo para las acciones basicas de la aplicación
 */
class modeloTienda
{
	
	static public function mdlMostrarTienda($tabla)
	{
		# code...
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}
	static public function mdlMostrarCategorias($tabla)
	{
		# code...
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}
	/*===================================
	=            Nueva venta            =
	===================================*/
	static public function mdlNuevaVenta($tabla, $tabla2, $totalVenta)
	{
		# code...
		$tokenVenta = uniqid('venta',true);
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_venta,total_venta, fecha_venta, status) VALUES (:id_venta, :total_venta, NOW(),0)");
		$stmt ->bindParam(":id_venta", $tokenVenta, PDO::PARAM_STR);	
		$stmt ->bindParam(":total_venta", $totalVenta, PDO::PARAM_INT);		
		$stmt -> execute();	
		foreach ($_SESSION["carrito"] as $key => $value) {
			# code...
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla2 (id_sale, id_client, id_prod, id_comerce, precio_unit, cantidad_compra) VALUES (:id_sale, :id_client, :id_prod, :id_comerce,:precio_unit, :cantidad_compra)");
			$stmt ->bindParam(":id_sale", $tokenVenta, PDO::PARAM_STR);	
			$stmt ->bindParam(":id_client", $value["idUser"], PDO::PARAM_INT);
			$stmt ->bindParam(":id_prod", $value["idProducto"], PDO::PARAM_INT);		
			$stmt ->bindParam(":id_comerce", $value["idComercio"], PDO::PARAM_INT);			
			$stmt ->bindParam(":precio_unit", $value["precioUnit"], PDO::PARAM_INT);	
			$stmt ->bindParam(":cantidad_compra", $value["cantidad"], PDO::PARAM_INT);					
			$stmt -> execute();
		}	
		return "ok";
		$stmt -> close();
		$stmt = null;

		
	}
	/*=====  End of Nueva venta  ======*/
	function mdlIdVenta($tabla, $token)
	{
		# code...		
		$stmt = Conexion::conectar()->prepare("SELECT id_venta FROM $tabla WHERE tokenVenta = $token");
		$stmt -> execute();
		return $stmt -> fetch();	
	}

	/*=========================================
	=            consultar pedidos            =
	=========================================*/
	static public function mdlconsultarPedidos($tabla1, $tabla2, $tabla3)
	{
		$stmt = Conexion::conectar()->prepare("SELECT $tabla1.id_sale, $tabla1.precio_unit, $tabla1.cantidad_compra, $tabla2.nombre_cliente, $tabla2.email, $tabla3.nombre_producto FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_client = $tabla2.id_cliente INNER JOIN $tabla3 ON $tabla1.id_prod = $tabla3.id_producto");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}
	
	
	/*=====  End of consultar pedidos  ======*/
	


}

