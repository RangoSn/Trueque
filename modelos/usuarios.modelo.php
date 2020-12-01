<?php

/**
 * 
 */
class modeloUsuarios
{
	/*============================================
	=            Registro de clientes            =
	============================================*/
	static public function mdlRegistrarClientes($tabla, $datos)
	{
		# code...
		$tipo_usuario = 1;
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_cliente, app_cliente, direccion_cliente, email, password, tipo_usuario) VALUES (:nombre_cliente, :app_cliente, :direccion_cliente, :email, :password, :tipo_usuario)");
		$stmt ->bindParam(":nombre_cliente", $datos["nombre"], PDO::PARAM_STR);
		$stmt ->bindParam(":app_cliente", $datos["app"], PDO::PARAM_STR);
		$stmt ->bindParam(":direccion_cliente", $datos["adress"], PDO::PARAM_STR);
		$stmt ->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt ->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt ->bindParam(":tipo_usuario", $tipo_usuario, PDO::PARAM_INT);
		if ($stmt -> execute()) {
			# code...
			return "ok";
		}else{
			return "errorRegistro";
		}
		$stmt->close();
		$stmt = null;
	}
	/*=====  End of Registro de clientes  ======*/
	/*=============================================
	=            Registro de comercios            =
	=============================================*/
	static public function mdlRegistrarComercios($tabla, $datos)
	{
		# code...
		$tipo_usuario = 2;
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_comercio, direccion_comercio, email,password,tipo_usuario) VALUES (:nombre_comercio, :direccion_comercio, :email, :password, :tipo_usuario)");
		$stmt ->bindParam(":nombre_comercio", $datos["nombre"], PDO::PARAM_STR);
		$stmt ->bindParam(":direccion_comercio", $datos["adress"], PDO::PARAM_STR);
		$stmt ->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt ->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt ->bindParam(":tipo_usuario", $tipo_usuario, PDO::PARAM_INT);
		if ($stmt -> execute()) {
			# code...
			return "ok";
		}else{
			return "errorRegistro";
		}
		$stmt->close();
		$stmt = null;
	}
	/*=====  End of Registro de comercios  ======*/	
	/*=============================
	=            Login            =
	=============================*/
	static public function mdllogin($tabla, $item, $valor)
	{
		# code...
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt ->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt->close();
		$stmt = null;
	}
	/*=====  End of Login  ======*/
	/*===============================================
	=            Consultar ID de usuario             =
	===============================================*/
	static public function mdlIdUser($tabla, $item, $user)
	{
		# code...
		$stmt = Conexion::conectar()->prepare("SELECT id_userLogin FROM userlogin WHERE $item = :$item");
		$stmt ->bindParam(":".$item, $user, PDO::PARAM_STR);
		$stmt -> execute();		
		return $stmt -> fetch();
		$stmt->close();
		$stmt = null;
	}
	/*=====  End of Consultar ID de usuario  ======*/
	/*====================================================
	=            Traer información de cliente            =
	====================================================*/
	static public function mdlGetUser($tabla, $item, $user)
	{
		# code...
		$stmt = Conexion::conectar()->prepare("SELECT * FROM clientes WHERE $item = :$item");
		$stmt ->bindParam(":".$item, $user, PDO::PARAM_STR);
		$stmt -> execute();		
		return $stmt -> fetch();
		$stmt->close();
		$stmt = null;
	}	
	/*=====  End of Traer información de cliente  ======*/
	
	
}