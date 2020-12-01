<?php
    /*=====================================
    =            Módulos fijos            =
    =====================================*/   
    if (isset($_SESSION["loginUser"])) {
      # code...
      if ($_SESSION["loginUser"] == "ok") {
        # code...
        include "modulos/navbarLandingCliente.php";
        include "modulos/banner.php";
        include "modulos/gridCategorias.php";
        include "modulos/productos.php";
        include "modulos/descripcionApp.php";
        include "modulos/footer.php";   
      }else{
        include "modulos/navbarLanding.php";
        include "modulos/loginContent.php";
        include "modulos/registerContent.php";
        include "modulos/registerComercioContent.php";
        include "modulos/banner.php";
        include "modulos/gridCategorias.php";
        include "modulos/productos.php";
        include "modulos/descripcionApp.php";
        include "modulos/footer.php";    
      }
    }else{
        include "modulos/navbarLanding.php";
        include "modulos/loginContent.php";
        include "modulos/registerContent.php";
        include "modulos/registerComercioContent.php";
        include "modulos/banner.php";
        include "modulos/gridCategorias.php";
        include "modulos/productos.php";
        include "modulos/descripcionApp.php";
        include "modulos/footer.php";  
    }

    /*=====  End of Módulos fijos  ======*/
    
