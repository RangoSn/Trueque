<!-- Modal -->
<div class="modal fade" id="registerComercioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content align-content-center ">      
        <div class="modal-header d-block">
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>          
            <h5 class="modal-title registerComerceModal text-white" id="exampleModalLabel">Registra tu negocio</h5> 
            <p class="text-white">Registrate como cliente <a id= "formCliOpen" data-dismiss="modal" href="#">aqui</a></p>  
        </div>      
        <div class="modal-body">   
           <div class="registro">
            <form method="POST">
              <div class="pagina slideForm form-row justify-content-center text-center">
                <div class="col-12 pb-2">Información de tu negocio</div>
                <div class="form-group col-12">
                  <input type="text" class="form-control text-center" name="rNameCo" placeholder="Nombre de tu negocio">
                </div>               
                <div class="form-group col-12">
                  <input type="text" class="form-control text-center" name="rAdressCo" placeholder="Dirección">
                </div>
                <div class="form-group col-12">
                  <input type="email" class="form-control text-center" name="rEmailCo" placeholder="Email">
                </div>
                <div class="form-group col-12">
                  <input type="password" class="form-control text-center" name="rPwdCo" placeholder="Contraseña">
                </div>
                <div class="form-group col-12">
                  <input type="password" class="form-control text-center" name="rConfirmCo" placeholder="Confirma tu contraseña">
                </div>
                <?php
                $registroComercio = controladorUsuarios::ctrRegistroComercios();                
                if ($registroComercio == "errorFormato") {
                  # code...
                  echo '<script>
                          if(window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                          }                           
                        </script>';
                    echo '<script>
                            toastr["error"]("Hubo un error, verifica tus datos.", "Error en registro");
                          </script>';
                }else if ($registroComercio == "errorPasswordMatch") {
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
