<?php
/*=============================================================
=            Productos de una categoria especifica            =
=============================================================*/
if (isset($rutas[0]) ) {
    # code...
    $productos = controladorProductosComercio::ctrconsultarProductos(0,12, "ruta_categoria", $rutas[0]);
    $totalProductos = controladorProductosComercio::ctrconsultarTotalProductos("id_cat", $productos[0]["id_categoria"]);
    $totalPaginas = ceil(count($totalProductos)/12);
}
/*=====  End of Productos de una categoria especifica  ======*/

/*===============================================
=            Paginación de categoria            =
===============================================*/
if (isset($rutas[1])) {
    # code...
    if (is_numeric($rutas[1])) {
        # code...
        if ($rutas[1] > $totalPaginas) {
        # code...
        echo '<script>
                window.location = "'.$tienda["dominio"].'error404";
              </script>';
        return;
        }    
        $paginaActual = $rutas[1];    
        $desde = ($rutas[1] - 1)*12;
        $cantidad = 12;
        $productos = controladorProductosComercio::ctrconsultarProductos($desde,$cantidad, "ruta_categoria", $rutas[0]);
    }else{
        if ($rutas[1] == "dashboard") {
            # code...
            echo '<script>
                            if(window.history.replaceState){
                              window.history.replaceState(null, null, window.location.href);
                            }
                            window.location = "'.$tienda["dominio"].'dashboard"
                          </script>';                   
        }
        if ($rutas[1] == "landing") {
            # code...
            echo '<script>
                            if(window.history.replaceState){
                              window.history.replaceState(null, null, window.location.href);
                            }
                            window.location = "'.$tienda["dominio"].'landing"
                          </script>';                   
        }
        if ($rutas[1] == "salir") {
            # code...
            echo '<script>
                            if(window.history.replaceState){
                              window.history.replaceState(null, null, window.location.href);
                            }
                            window.location = "'.$tienda["dominio"].'salir"
                          </script>';   
        }
        if ($rutas[1] == "myprofile") {
            # code...
            echo '<script>
                            if(window.history.replaceState){
                              window.history.replaceState(null, null, window.location.href);
                            }
                            window.location = "'.$tienda["dominio"].'myprofile"
                          </script>';  
        }
        if ($rutas[1] == "historyBuy") {
            # code...
            echo '<script>
                            if(window.history.replaceState){
                              window.history.replaceState(null, null, window.location.href);
                            }
                            window.location = "'.$tienda["dominio"].'historyBuy"
                          </script>';  
        }
        if ($rutas[1] == "carrito") {
            # code...
            echo '<script>
                            if(window.history.replaceState){
                              window.history.replaceState(null, null, window.location.href);
                            }
                            window.location = "'.$tienda["dominio"].'carrito"
                          </script>';  
        }
    }
}else{
    $paginaActual = 1;
}


/*=====  End of Paginación de categoria  ======*/


    /*=====================================
    =            Módulos fijos            =
    =====================================*/   
    if (isset($_SESSION["loginUser"])) {
      # code...
      if ($_SESSION["loginUser"] == "ok") { 
        include "modulos/navbarLandingCliente.php";
        include "modulos/banner.php";    
        include "modulos/productosCategoria.php";
        include "modulos/descripcionApp.php";
        include "modulos/footer.php"; 
      }else{
        include "modulos/navbarLanding.php";
        include "modulos/loginContent.php";
        include "modulos/registerContent.php";
        include "modulos/registerComercioContent.php";
        include "modulos/banner.php";    
        include "modulos/productosCategoria.php";
        include "modulos/descripcionApp.php";
        include "modulos/footer.php";    
      }
    }else{
        include "modulos/navbarLanding.php";
        include "modulos/loginContent.php";
        include "modulos/registerContent.php";
        include "modulos/registerComercioContent.php";
        include "modulos/banner.php";    
        include "modulos/productosCategoria.php";
        include "modulos/descripcionApp.php";
        include "modulos/footer.php";  
    }
    /*=====  End of Módulos fijos  ======*/
    