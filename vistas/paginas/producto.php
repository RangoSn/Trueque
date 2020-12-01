<?php

    /*=====================================
    =            Módulos fijos            =
    =====================================*/
    if (isset($_SESSION["loginUser"])) {
      # code...
      if ($_SESSION["loginUser"] == "ok") { 
        include "modulos/navbarLandingCliente.php";
        include "modulos/banner.php";    
        include "modulos/productoContent.php";
        include "modulos/footer.php";
      }else{
        include "modulos/navbarLanding.php";
        include "modulos/loginContent.php";
        include "modulos/registerContent.php";
        include "modulos/registerComercioContent.php";
        include "modulos/banner.php";    
        include "modulos/productoContent.php";
        include "modulos/footer.php"; 
      }
    }else{
        include "modulos/navbarLanding.php";
        include "modulos/loginContent.php";
        include "modulos/registerContent.php";
        include "modulos/registerComercioContent.php";
        include "modulos/banner.php";    
        include "modulos/productoContent.php";
        include "modulos/footer.php"; 
    }   
      
    /*=====  End of Módulos fijos  ======*/
