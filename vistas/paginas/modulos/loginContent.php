<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content align-content-center ">
      <form method="post">
        <div class="modal-header d-block">
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>          
            <h5 class="modal-title loginModal text-white" id="exampleModalLabel">Inicia sesión</h5>   
            <p class="text-white">Ingresa tu correo y contraseña para acceder</p>
        </div>      
        <div class="modal-body">
                
                <div class="form-row justify-content-center text-center">
                  <div class="form-group col-md-12">  
                    <div class="input-group">
                      <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                      <input type="email" class="form-control text-center" name="iEmail" placeholder="Correo electrónico">
                    </div>                                  
                  </div>
                  <div class="form-group col-md-12">  
                    <div class="input-group">
                      <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                      </div>
                      <input type="password" class="form-control text-center" name="iPassword" placeholder="Contraseña">
                    </div>                                  
                  </div>
                </div>
                              
        </div>
        <div class="modal-footer">
          <?php
          $login = controladorUsuarios::ctrlogin();?>  
          <button type="submit" class="btn btn-danger">Iniciar sesión</button>
        </div>
      </form>            
    </div>
  </div>
</div>