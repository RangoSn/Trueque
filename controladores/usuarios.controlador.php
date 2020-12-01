<?php
/**
 * 
 */
class controladorUsuarios
{
	/*============================================
	=            Registro de clientes            =
	============================================*/
	static public function ctrRegistroClientes()
	{
		# code...		
		if(isset($_POST["rNameC"])){			
			if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["rNameC"]) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["rAppC"]) && preg_match('/^[0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["rAdressC"]) &&
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["rEmailC"]) &&
				preg_match('/^[0-9a-zA-Z]+$/', $_POST["rPwdC"]) &&
				preg_match('/^[0-9a-zA-Z]+$/', $_POST["rConfirmC"])){
				# code...				
				if ($_POST["rPwdC"] == $_POST["rConfirmC"]) {
					# code...
					$tabla = "clientes";
					$encriptPwd = crypt($_POST["rPwdC"],'$2a$07$asxx54ahjppf45sd87a5a4dDOGsystemdev$');
					$datos = array("nombre" => $_POST["rNameC"],
									"app" => $_POST["rAppC"],
									"adress" => $_POST["rAdressC"],
									"email" => $_POST["rEmailC"],
									"password" => $encriptPwd);	
					$respuesta = modeloUsuarios::mdlRegistrarClientes($tabla, $datos);
					if ($respuesta == "ok") {
						# code...
						echo '<script>
						        if(window.history.replaceState){
						          window.history.replaceState(null, null, window.location.href);
						        }
						        toastr["success"]("El usuario se ha almacenado correctamente ", "Usuario Registrado");
						        setTimeout(function(){
						         window.location.reload();
						        }, 500);
						        
						      </script>';						
						$_SESSION["loginUser"] = "ok";	
						$_SESSION["user"] = $_POST["rEmailC"];

					}		
				}else{
					$respuesta = "errorPasswordMatch";
					return $respuesta;
				}
			}else{
				$respuesta = "errorFormato";
				return $respuesta;
			}
			
		}
	}	
	/*=====  End of Registro de clientes  ======*/
	/*=============================================
	=            Registro de comercios            =
	=============================================*/
	static public function ctrRegistroComercios()
	{
		# code...
		if(isset($_POST["rNameCo"])){			
			if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["rNameCo"]) && preg_match('/^[0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["rAdressCo"]) &&
				preg_match('/^[0-9a-zA-Z_.]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["rEmailCo"]) &&
				preg_match('/^[0-9a-zA-Z]+$/', $_POST["rPwdCo"]) &&
				preg_match('/^[0-9a-zA-Z]+$/', $_POST["rConfirmCo"])){
				# code...					
				if ($_POST["rPwdCo"] == $_POST["rConfirmCo"]) {
					# code...
					$tabla = "comercios";
					$encriptPwd = crypt($_POST["rPwdCo"],'$2a$07$asxx54ahjppf45sd87a5a4dDOGsystemdev$');
					$datos = array("nombre" => $_POST["rNameCo"],
									"adress" => $_POST["rAdressCo"],
									"email" => $_POST["rEmailCo"],
									"password" => $encriptPwd);	
					$respuesta = modeloUsuarios::mdlRegistrarComercios($tabla, $datos);
					if ($respuesta == "ok") {
						# code...
						echo '<script>
						        toastr["success"]("El usuario se ha almacenado correctamente ", "Usuario Registrado");
						        if(window.history.replaceState){
						          window.history.replaceState(null, null, window.location.href);
						        }						        
						        window.location = "dashboard";	
						      </script>';						
						$_SESSION["loginUser"] = "ok";
						$_SESSION["user"] = $_POST["rEmailCo"];
					}					
				}else{
					$respuesta = "errorPasswordMatch";
					return $respuesta;
				}
			}else{
				$respuesta = "errorFormato";
				return $respuesta;
			}
			
		}
	}	
	/*=====  End of Registro de comercios  ======*/	
	/*=============================
	=            Login            =
	=============================*/
	static public function ctrlogin()
	{
		# code...
		if(isset($_POST["iEmail"])){
			$tabla = "userlogin";	
			$item = "email";
			$valor = $_POST["iEmail"];		
			$respuesta = modeloUsuarios::mdllogin($tabla, $item, $valor);
			if ($respuesta == null) {
				# code...
				echo '<script>
				        if(window.history.replaceState){
				          window.history.replaceState(null, null, window.location.href);
				        }
				      </script>';
				echo '<script>
				        toastr["error"]("Hubo un error, El usuario no existe.", "Error en login");
				      </script>';
			}else{
				$encriptPwd = crypt($_POST["iPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDOGsystemdev$');
				if ($respuesta["email"] == $_POST["iEmail"] && $respuesta["password"] == $encriptPwd && $respuesta["tipo_usuario"] == 1) {
					# code...

					echo '<script>
					        if(window.history.replaceState){
					          window.history.replaceState(null, null, window.location.href);
					        }					        
					        window.location.reload();
					      </script>';					
					$_SESSION["loginUser"] = "ok";
					$_SESSION["user"] = $respuesta["email"];					
					

				}else if ($respuesta["email"] == $_POST["iEmail"] && $respuesta["password"] == $encriptPwd && $respuesta["tipo_usuario"] == 2){
					echo '<script>
					        if(window.history.replaceState){
					          window.history.replaceState(null, null, window.location.href);
					        }
					        window.location = "dashboard";
					      </script>';					
					$_SESSION["loginUser"] = "ok";
					$_SESSION["user"] = $respuesta["email"];
					
				}else{
					echo '<script>
					        if(window.history.replaceState){
					          window.history.replaceState(null, null, window.location.href);
					        }
					      </script>';
					   echo '<script>
                            toastr["error"]("Hubo un error, verifica tus datos e intenta nuevamente.", "Error login");
                          </script>';
				}
			}			
		}
	}
	/*=====  End of Login  ======*/	
}