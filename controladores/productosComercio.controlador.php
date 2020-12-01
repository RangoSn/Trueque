<?php
 /**
  * 
  */
 class controladorProductosComercio
 {
 	/*======================================
 	=            Nuevo producto            =
 	======================================*/
 	static public function ctrnuevoProducto($user)
 	{
 		# code...
 		if(isset($_POST["rNameProduct"])){
 			if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["rNameProduct"]) && 
 				$_POST["rCategoriaProd"] != "Selecciona una opción" &&
 				preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["rDescProd"]) &&
 				$_POST["rCantidadProd"] != "Selecciona una opción" &&
 				$_POST["rPrecioProduct"] > 0) {
 				# code...
 				if (isset($_FILES["fotoProducto"]["tmp_name"]) && !empty($_FILES["fotoProducto"]["tmp_name"])) {
 					# code...
 					list($ancho, $alto) = getimagesize($_FILES["fotoProducto"]["tmp_name"]);
 					$nuevoAncho = 200;
 					$nuevoAlto = 200;
 					$directorio = "vistas/img/productos/productos"; 					
 					if($_FILES["fotoProducto"]["type"] == "image/jpeg"){
 						$aleatorio = mt_rand(100, 9999);
 						$ruta = $directorio.$aleatorio.".jpg"; 						
 						if (@imagecreatefromjpeg($_FILES["fotoProducto"]["tmp_name"]) == false) {
 							# code...
 							 echo '<script>
                              if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                              }
                            </script>';
 							echo '<script>
							        toastr["error"]("Hubo un error ", "Formato de imagen dañado");
							      </script>';								
 						}else{
 							$origen = imagecreatefromjpeg($_FILES["fotoProducto"]["tmp_name"]);
 							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
 							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
 							imagejpeg($destino, $ruta); 						
 						} 						 						
 					}else if($_FILES["fotoProducto"]["type"] == "image/png"){
						$aleatorio = mt_rand(100, 9999);
						$ruta = $directorio.$aleatorio.".png";
						if (@imagecreatefrompng($_FILES["fotoProducto"]["tmp_name"]) == false) {
							# code...
							 echo '<script>
                              if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                              }
                            </script>';
 							echo '<script>
							        toastr["error"]("Hubo un error", "Formato de imagen dañado");
							      </script>';	
							return "error-imagen";
						}else{
							$origen = imagecreatefrompng($_FILES["fotoProducto"]["tmp_name"]);
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
							imagealphablending($destino, FALSE);
							imagesavealpha($destino, TRUE);	
							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagepng($destino, $ruta);
						}						
					}else{
						return "error-formato";	
					}
				}else{
					$ruta = "vistas/img/usuarios/default.png";
				}
				$tabla = "userlogin";
				$item = "email";				
				$userID = modeloUsuarios::mdlIdUser($tabla, $item, $user);	
				$tabla = "productos";	
				$datos = array("categoriaProducto" => $_POST["rCategoriaProd"],	
							   "usuario" => $userID["id_userLogin"],
							   "nombreProducto" => $_POST["rNameProduct"],		
							   "descProducto" => $_POST["rDescProd"],		
							   "fotoProducto" => $ruta,
							   "cantidad" => $_POST["rCantidadProd"],
							   "precio" => $_POST["rPrecioProduct"]);
				$respuesta = modeloProductosComercio::mdlnuevoProducto($tabla, $datos);
				return $respuesta;

 			}else{
 				echo '<script>						        
						        toastr["error"]("Error al almacenar el producto", "Producto no registrado");
						      </script>';
 			}
 			
 		}
 	} 	
 	/*=====  End of Nuevo producto  ======*/
 	
 	/*===========================================
 	=            Consultar productos            =
 	===========================================*/
 	static public function ctrconsultarProductos($desde, $cantidad, $item, $valor)
 	{
 		# code...
 		$tabla1 = "productos"; 		
 		$tabla2 = "comercios"; 		
 		$tabla3 = "categorias"; 		
		$respuesta = modeloProductosComercio::mdlconsultarProductos($tabla1,$tabla2,$tabla3, $desde, $cantidad, $item, $valor);
		return $respuesta;
 	}
 	/*=====  End of Consultar productos  ======*/
 	
 	/*=======================================
 	=            Total productos            =
 	=======================================*/
 	static public function ctrconsultarTotalProductos($item, $valor)
 	{
 		# code...
 		$tabla = "productos"; 			
		$respuesta = modeloProductosComercio::mdlconsultarTotalProductos($tabla, $item, $valor);
		return $respuesta;
 	}
 	/*=====  End of Total articulos  ======*/

 	/*========================================
 	=            Editar productos            =
 	========================================*/
 	static public function ctreditarProducto($user, $id_producto)
 	{
 		# code...	
 		if(isset($_POST["eNameProduct"])){
 			$nombre = "";

 			if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["eNameProduct"]) ) {
 				# code...	
 				$nombre = $_POST["eNameProduct"];
 			}else{
 				echo '<script>						        
						        toastr["error"]("Error al actualizar el producto", "Producto no registrado");
						      </script>';
 			}
 			if ($_POST["eCategoriaProd"] != "") {
 				# code...
 				$categoria = $_POST["eCategoriaProd"];
 			}else{
 				$categoria = $_POST["eCategoriaProdPrevId"];
 			}
 			if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ .,]+$/', $_POST["eDescProd"])) {
 				# code...
 				$desc = $_POST["eDescProd"];
 			}else{
 				echo '<script>						        
						        toastr["error"]("Error al actualizar el producto", "Producto no registrado");
						      </script>';
 			}
 			if (isset($_FILES["fotoProducto"]["tmp_name"]) && !empty($_FILES["fotoProducto"]["tmp_name"])) { 				
					# code...
					list($ancho, $alto) = getimagesize($_FILES["fotoProducto"]["tmp_name"]);
					$nuevoAncho = 200;
					$nuevoAlto = 200;
					$directorio = "vistas/img/productos/productos"; 					
					if($_FILES["fotoProducto"]["type"] == "image/jpeg"){
						$aleatorio = mt_rand(100, 9999);
						$ruta = $directorio.$aleatorio.".jpg"; 						
						if (@imagecreatefromjpeg($_FILES["fotoProducto"]["tmp_name"]) == false) {
							# code...
							 echo '<script>
		                  if(window.history.replaceState){
		                    window.history.replaceState(null, null, window.location.href);
		                  }
		                </script>';
							echo '<script>
						        toastr["error"]("Hubo un error ", "Formato de imagen dañado");
						      </script>';								
						}else{
							$origen = imagecreatefromjpeg($_FILES["fotoProducto"]["tmp_name"]);
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagejpeg($destino, $ruta); 						
						} 						 						
					}else if($_FILES["fotoProducto"]["type"] == "image/png"){
					$aleatorio = mt_rand(100, 9999);
					$ruta = $directorio.$aleatorio.".png";
					if (@imagecreatefrompng($_FILES["fotoProducto"]["tmp_name"]) == false) {
						# code...
						 echo '<script>
		                  if(window.history.replaceState){
		                    window.history.replaceState(null, null, window.location.href);
		                  }
		                </script>';
							echo '<script>
						        toastr["error"]("Hubo un error", "Formato de imagen dañado");
						      </script>';	
						return "error-imagen";
					}else{
						$origen = imagecreatefrompng($_FILES["fotoProducto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagealphablending($destino, FALSE);
						imagesavealpha($destino, TRUE);	
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}						
				}else{
					return "error-formato";	
				}
			}else{
				$ruta = $_POST["eFotoProducto"];
			}
			if ($_POST["eCantidadProd"] != "") {
				# code...
				$cantidad = $_POST["eCantidadProd"];
			}else{
				$cantidad = $_POST["eCantidadProdPrev"];
			}
			if ($_POST["ePrecioProd"] != "") {
				# code...
				$precio = $_POST["ePrecioProd"];
			}else{
				$precio = $_POST["ePrecioProdPrev"];
			}
 			if ($nombre != "" && $categoria != "" && $desc != "" && $ruta != "" && $cantidad != "" && $precio != "") {
 					# code...
 				$tabla = "productos";	
				$datos = array("id_producto" => $id_producto,
							   "nombreProducto" => $nombre,
							   "categoriaProducto" => $categoria,
							   "descProducto" => $desc,
							   "fotoProducto" => $ruta,
							   "cantidadProducto" => $cantidad,
							   "precioProducto" => $precio);
				$respuesta = modeloProductosComercio::mdleditarProducto($tabla, $datos);
				return $respuesta;
 				}else{
 					echo '<script>						        
						        toastr["error"]("Error al actualizar el producto", "Producto no registrado");
						      </script>';
 				}
 		}
 	} 	
 	/*=====  End of Editar productos  ======*/
 	

 	/*==========================================
 	=            Eliminar productos            =
 	==========================================*/
 	public function ctrEliminarProducto()
 	{
 		if (isset($_POST["eProducto"])) {
 			# code... 			
 			$tabla = "productos";
 			$valor = $_POST["eProducto"];
 			$respuesta = modeloProductosComercio::mdlEliminarProducto($tabla, $valor);
 			if ($respuesta == "ok") {
					# code...
					echo '<script>
					        if(window.history.replaceState){
					          window.history.replaceState(null, null, window.location.href);
					          window.location.reload();
					        }
					      </script>';

				}
 		}
 	}
 	/*=====  End of Eliminar productos  ======*/

 	/*================================
 	=            Buscador            =
 	================================*/
 	static public function ctrBuscador($desde, $cantidad, $busqueda)
 	{
 		# code...
 		$tabla1 = "productos"; 		
 		$tabla2 = "comercios"; 		
 		$tabla3 = "categorias"; 		
		$respuesta = modeloProductosComercio::mdlBuscador($tabla1,$tabla2,$tabla3, $desde, $cantidad, $busqueda);
		return $respuesta;	
 	}
 	/*=====  End of Buscador  ======*/
 	
 	/*======================================
 	=            Total buscador            =
 	======================================*/
 	static public function ctrTotalBuscador($busqueda)
 	{
 		$tabla = "productos";

 		$respuesta = modeloProductosComercio::mdlTotalBuscador($tabla, $busqueda);

 		return $respuesta;
 	}
 	
 	/*=====  End of Total buscador  ======*/
 	
 	
 }