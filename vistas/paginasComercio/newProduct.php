<?php
    if (!isset($_SESSION["loginUser"])) {
      # code...
      echo '<script>
              window.location = "login";
            </script>';
      return;
    }else{

      if ($_SESSION["loginUser"] != "ok") {
        # code...
         echo '<script>
                window.location = "login";
              </script>';
        return;
      }
       
    }

    /*=====================================
    =            Módulos fijos            =
    =====================================*/    
    include "modulos/navbar.php";
    include "modulos/sidebar.php";
    include "modulos/newProductContent.php";
    include "modulos/footer.php";
    include "modulos/controlSidebar.php";    
    /*=====  End of Módulos fijos  ======*/
    
