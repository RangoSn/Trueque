<?php
/**
 * 
 */
class modeloProductosComercio
{

	/*======================================
	=            Nuevo producto            =
	======================================*/
	static public function mdlnuevoProducto($tabla, $datos)
	{
		# code...
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_cat, id_com, nombre_producto, descripcion_producto, foto_producto, cantidad_producto, precio_producto) VALUES (:id_cat, :id_com, :nombre_producto, :descripcion_producto, :foto_producto, :cantidad_producto, :precio_producto)");
		$stmt ->bindParam(":id_cat", $datos["categoriaProducto"], PDO::PARAM_STR);
		$stmt ->bindParam(":id_com", $datos["usuario"], PDO::PARAM_STR);
		$stmt ->bindParam(":nombre_producto", $datos["nombreProducto"], PDO::PARAM_STR);
		$stmt ->bindParam(":descripcion_producto", $datos["descProducto"], PDO::PARAM_STR);		
		$stmt ->bindParam(":foto_producto", $datos["fotoProducto"], PDO::PARAM_STR);
		$stmt ->bindParam(":cantidad_producto", $datos["cantidad"], PDO::PARAM_INT);
		$stmt ->bindParam(":precio_producto", $datos["precio"], PDO::PARAM_INT);						
		if ($stmt -> execute()) {
			# code...
			return "ok";
		}else{
			return "errorRegistro";
		}
		$stmt->close();
		$stmt = null;	
	}		
	/*=====  End of Nuevo producto  ======*/
	
	/*=========================================
	=            ConsultarComercio            =
	=========================================*/
	static public function mdlconsultarComercio($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT $tabla1.id_producto, $tabla1.nombre_producto, $tabla1.descripcion_producto, $tabla1.foto_producto, $tabla2.nombre_comercio, $tabla3.titulo_categoria FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_com = $tabla2.id_comercio INNER JOIN $tabla3 ON $tabla1.id_cat = $tabla3.id_categoria ORDER BY DESC LIMIT $cantidad");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}
	/*=====  End of ConsultarComercio  ======*/

	/*==========================================
	=            consultarProductos            =
	==========================================*/
	static public function mdlconsultarProductos($tabla1, $tabla2, $tabla3, $desde, $cantidad, $item, $valor)
	{
		if ($item == null && $valor == null) {
			# code...
			$stmt = Conexion::conectar()->prepare("SELECT $tabla1.id_producto, $tabla1.nombre_producto, $tabla1.descripcion_producto, $tabla1.foto_producto, $tabla1.cantidad_producto, $tabla1.precio_producto, $tabla1.ruta_producto, $tabla2.id_comercio, $tabla2.nombre_comercio, $tabla3.id_categoria, $tabla3.titulo_categoria, $tabla3.ruta_categoria FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_com = $tabla2.id_comercio INNER JOIN $tabla3 ON $tabla1.id_cat = $tabla3.id_categoria ORDER BY $tabla1.id_producto DESC LIMIT $desde, $cantidad");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT $tabla1.id_producto, $tabla1.nombre_producto, $tabla1.descripcion_producto, $tabla1.foto_producto, $tabla1.cantidad_producto, $tabla1.precio_producto, $tabla1.ruta_producto, $tabla2.id_comercio, $tabla2.nombre_comercio, $tabla3.id_categoria, $tabla3.titulo_categoria, $tabla3.ruta_categoria FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_com = $tabla2.id_comercio INNER JOIN $tabla3 ON $tabla1.id_cat = $tabla3.id_categoria WHERE $item = :$item ORDER BY $tabla1.id_producto DESC LIMIT $desde, $cantidad");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		
		$stmt -> close();
		$stmt = null;
	}
	/*=====  End of consultarProductos  ======*/
	
	/*=======================================
	=            Total productos            =
	=======================================*/
	static public function mdlconsultarTotalProductos($tabla, $item, $valor)
	{
		if ($item == null && $valor == null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		
		$stmt -> close();
		$stmt = null;
	}
	/*=====  End of Total productos  ======*/
	
	/*========================================
	=            Editar productos            =
	========================================*/
	static public function mdleditarProducto($tabla, $datos)
	{
		# code...
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_cat = :id_cat, nombre_producto = :nombre_producto, descripcion_producto = :descripcion_producto, foto_producto = :foto_producto, cantidad_producto = :cantidad_producto, precio_producto = :precio_producto WHERE id_producto = :id_producto");
		$stmt ->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_STR);
		$stmt ->bindParam(":id_cat", $datos["categoriaProducto"], PDO::PARAM_STR);
		$stmt ->bindParam(":nombre_producto", $datos["nombreProducto"], PDO::PARAM_STR);
		$stmt ->bindParam(":descripcion_producto", $datos["descProducto"], PDO::PARAM_STR);
		$stmt ->bindParam(":foto_producto", $datos["fotoProducto"], PDO::PARAM_STR);
		$stmt ->bindParam(":cantidad_producto", $datos["cantidadProducto"], PDO::PARAM_INT);
		$stmt ->bindParam(":precio_producto", $datos["precioProducto"], PDO::PARAM_INT);	
		if ($stmt -> execute()) {
			# code...
			return "ok";
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;	
	}	
	
	
	/*=====  End of Editar productos  ======*/
	

	/*=======================================
	=            Elimar producto            =
	=======================================*/
	static public function mdlEliminarProducto($tabla,$valor)
	{			
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_producto = :id_producto");
		$stmt->bindParam(":id_producto",$valor, PDO::PARAM_INT);
		if ($stmt -> execute()) {
			# code...						
			return "ok";
		}else{
			print_r("error");
		}				
		$stmt -> close();
		$stmt = null;
	}
	/*=====  End of Elimar producto  ======*/

	/*================================
	=            Buscador            =
	================================*/
	static public function mdlBuscador($tabla1, $tabla2, $tabla3, $desde, $cantidad, $busqueda)
	{
		$stmt = Conexion::conectar()->prepare("SELECT $tabla1.id_producto, $tabla1.nombre_producto, $tabla1.descripcion_producto, $tabla1.foto_producto, $tabla1.cantidad_producto, $tabla1.precio_producto, $tabla1.ruta_producto, $tabla2.nombre_comercio, $tabla3.id_categoria, $tabla3.titulo_categoria, $tabla3.ruta_categoria FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_com = $tabla2.id_comercio INNER JOIN $tabla3 ON $tabla1.id_cat = $tabla3.id_categoria WHERE nombre_producto like '%$busqueda%' OR descripcion_producto like '%$busqueda%' OR nombre_comercio like '%$busqueda%' ORDER BY $tabla1.id_producto DESC LIMIT $desde, $cantidad");					
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();

		$stmt = null;
	}
	/*=====  End of Buscador  ======*/
	
	/*======================================
	=            Total buscador            =
	======================================*/
	static public function mdlTotalBuscador($tabla, $busqueda){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE nombre_producto like '%$busqueda%' OR descripcion_producto like '%$busqueda%'");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	
	
	/*=====  End of Total buscador  ======*/
	
	
}