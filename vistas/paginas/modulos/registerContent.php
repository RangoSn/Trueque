<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content align-content-center ">      
        <div class="modal-header d-block">
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>          
            <h5 class="modal-title loginModal text-white" id="exampleModalLabel">Registrate</h5> 
            <p class="text-white">¿Tienes un negocio? <a id= "formCoOpen" data-dismiss="modal" href="#">registralo aqui</a></p>  
        </div>      
        <div class="modal-body">   
           <div class="registro">
            <form method="POST">
              <div class="pagina slideForm form-row justify-content-center text-center">
                <div class="col-12 pb-2">Información Personal</div>
                <div class="form-group col-12">
                  <input type="text" required class="form-control text-center" name="rNameC" placeholder="Nombre">
                </div>
                <div class="form-group col-12">
                  <input type="text" required class="form-control text-center" name="rAppC" placeholder="Apellido">
                </div>
                <div class="form-group col-12">
                  <input type="text" required class="form-control text-center" name="rAdressC" placeholder="Dirección">
                </div>
                <div class="form-group col-12">
                  <input type="email" required class="form-control text-center" name="rEmailC" placeholder="Email">
                </div>
                <div class="form-group col-12">
                  <input type="password" required class="form-control text-center" name="rPwdC" placeholder="Contraseña">
                </div>
                <div class="form-group col-12">
                  <input type="password" required class="form-control text-center" name="rConfirmC" placeholder="Confirma tu contraseña">
                </div>
                <?php
                $registroCliente = controladorUsuarios::ctrRegistroClientes();
                if ($registroCliente == "errorFormato") {
                  # code...
                  echo '<script>
                          if(window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                          }                           
                        </script>';
                    echo '<script>
                            toastr["error"]("Hubo un error, verifica tus datos.", "Error en registro");
                          </script>';
                }else if ($registroCliente == "errorPasswordMatch") {
                  # code...
                  echo '<script>
                          if(window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                          }                           
                        </script>';
                    echo '<script>
                            toastr["error"]("Hubo un error, las contraseñas no coinciden.", "Error en registro");
                          </script>';
                }
                ?>  
                <button type="submit" class="btn btn-danger">Registrarme</button> 
              </div>
            </form> 
          </div>                     
        </div>        
      </div>
  </div>
</div>
