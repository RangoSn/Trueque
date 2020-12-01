<!--NAVBAR-->
    <header class="sticky-top">
        <nav class="navbar navbarLanding navbar-expand-md navbar-light">
            <a class="navbar-brand" href="<?php echo $tienda["dominio"]; ?>">
              <img class="logo img-fluid" src="<?php echo $tienda["dominio"];?><?php echo $tienda["logo"];?>" alt="Logo de MiMercado">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="menuMovil fas fa-ellipsis-h" style="color: white;"></i>
            </button>          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="linksSesion nav-link text-white" data-toggle="modal" data-target="#loginModal" href="">Iniciar sesión <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="linksSesion nav-link text-white" data-toggle="modal" data-target="#registerModal" href="">Registrarme</a>
                </li>
              </ul>
            </div>
          </nav>
    </header>    
  <!--END OF NAVBAR-->
