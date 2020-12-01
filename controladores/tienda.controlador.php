<?php
/**
 * 
 */
class controladorTienda
{
	
	static public function ctrMostrarTienda()
	{
		# code...
		$tabla = "tienda";
		$respuesta = modeloTienda::mdlMostrarTienda($tabla);
		return $respuesta;
		
	}
	static public function ctrMostrarCategorias()
	{
		# code...
		$tabla = "categorias";
		$respuesta = modeloTienda::mdlMostrarCategorias($tabla);
		return $respuesta;
	}

	/*====================================
	=            CARRITO            =
	====================================*/
	static public function ctrNuevoPedido($cliente)
	{
 		if(isset($_POST["cProductoName"])){
 			# code...
				$tabla = "userlogin";
				$item = "email";				
				$userData = modeloUsuarios::mdlGetUser($tabla, $item, $cliente);
				$clienteData = array(
						"idUser" => $userData["id_cliente"],
						"nombreCliente" => $userData["nombre_cliente"],
						"ApellidoCliente" => $userData["app_cliente"],
						"DireccionCliente" => $userData["direccion_cliente"],
						"emailCliente" => $userData["email"]
					);
					$_SESSION["dataUser"]= $clienteData;
				if (!isset($_SESSION["carrito"])) {
					# code...
					$productosData = array(
						"idProducto" => $_POST["cIdProducto"],
						"idUser" => $userData["id_cliente"],
						"cantidad" => $_POST["cCantidadProd"],
						"nombreProducto" => $_POST["cProductoName"],		
						"descProducto" => $_POST["cDescProd"],
						"precioUnit" => $_POST["cPrecioProducto"],
						"totalProducto" => $_POST["cPrecioTotalProducto"],
						"idComercio" => $_POST["cIdComercio"],
						"nombreComercio" => $_POST["cComercioName"]
					);					
					$_SESSION["carrito"][0] = $productosData;
						echo '<script>
					        if(window.history.replaceState){
					          window.history.replaceState(null, null, window.location.href);
					          window.location.reload();
					        }
					      </script>';
				}else{
					$idProductos = array_column($_SESSION["carrito"], "idProducto");
					if (in_array($_POST["cIdProducto"], $idProductos)) {
						# code...
						echo '<script>
							        toastr["error"]("Hubo un error ", "El producto ya fue agregado previamente");
							      </script>';
					}else{
						$NumProducto = count($_SESSION["carrito"]);
						$productosData = array(
							"idProducto" => $_POST["cIdProducto"],
							"idUser" => $userData["id_cliente"],
							"cantidad" => $_POST["cCantidadProd"],
							"nombreProducto" => $_POST["cProductoName"],		
							"descProducto" => $_POST["cDescProd"],
							"precioUnit" => $_POST["cPrecioProducto"],
							"totalProducto" => $_POST["cPrecioTotalProducto"],
							"idComercio" => $_POST["cIdComercio"],
							"nombreComercio" => $_POST["cComercioName"]
						);							
						$_SESSION["carrito"][$NumProducto] = $productosData;
							echo '<script>
						        if(window.history.replaceState){
						          window.history.replaceState(null, null, window.location.href);
						          window.location.reload();
						        }
						      </script>';
					}
				}
 			}
	}
	/*=====  End of CARRITO  ======*/
	/*============================================
	=            Eliminar item pedido            =
	============================================*/
	static public function ctrEliminarItemPedido()
	{		
 		if(isset($_POST["eIdProducto"])){
 			# code...
				foreach ($_SESSION["carrito"] as $key => $value) {
					# code...
					if ($value["idProducto"] == $_POST["eIdProducto"]) {
						# code...
						unset($_SESSION["carrito"][$key]);
						echo '<script>
					        if(window.history.replaceState){
					          window.history.replaceState(null, null, window.location.href);
					          window.location.reload();
					        }
					      </script>';
					}
				}
 			}
	}
	/*=====  End of Eliminar item pedido  ======*/
	/*====================================
	=            Nueva compra            =
	====================================*/
	static public function ctrNuevaVenta()
	{
 		if(isset($_POST["ntotalVenta"])){
 			# code...
				$tabla = "ventas";	
				$tabla2 = "detalleventa";	
				$totalVenta = $_POST["ntotalVenta"];	
				$userData = modeloTienda::mdlNuevaVenta($tabla, $tabla2, $totalVenta);
				if($userData == "VentaAlmacenada"){
					echo '<script>					
					        toastr["success"]("La venta se ha almacenado correctamente ", "Venta registrada");		
					      </script>';
				}
 			}
	}
	/*=====  End of Nueva compra  ======*/

	/*=========================================
	=            Consultar pedidos            =
	=========================================*/
	static public function ctrconsultarPedidos()
 	{
 		# code...
 		$tabla1 = "detalleventa"; 		 		
 		$tabla2 = "clientes";
 		$tabla3 = "productos"; 		
		$respuesta = modeloTienda::mdlconsultarPedidos($tabla1, $tabla2, $tabla3);
		return $respuesta;
 	}
	/*=====  End of Consultar pedidos  ======*/
	
	
	
}