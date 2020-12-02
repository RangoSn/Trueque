<?php

date_default_timezone_set("America/Mexico_City");
session_start();
$tienda = controladorTienda::ctrMostrarTienda();
$categorias = controladorTienda::ctrMostrarCategorias();
$productos = controladorProductosComercio::ctrconsultarProductos(0,12, null, null);
$totalProductos = controladorProductosComercio::ctrconsultarTotalProductos(null, null);
$totalPaginas = ceil(count($totalProductos)/12);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--Señalización de responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $validarRuta = "";
    if (isset($_GET["pagina"])) {
      # code...
      $rutas = explode("/",  $_GET["pagina"]);
      foreach ($categorias as $key => $value) {
        # code...
        if(!is_numeric($rutas[0]) && $rutas[0] == $value["ruta_categoria"]){
          $validarRuta = "categorias";
          break;
        } 
      }
      if ($validarRuta == "categorias") {
        # code...
        echo '<title>'.$tienda["titulo"].' | '.$value["titulo_categoria"].'</title>
              <meta name="title" content="'.$value["titulo_categoria"].'>">
              <meta name="description" content="'.$value["desc_categoria"].'">';
        $palabras_claves = json_decode($value["p_claves_categoria"], true);

        $p_claves = "";
        foreach ($palabras_claves as $key => $value) {
          # code...
          $p_claves .= $value.", ";
        }
        $p_claves = substr($p_claves, 0, -2);
        echo '<meta name="keywords" content="'.$p_claves.'">';
      }else{
        echo '<title>'.$tienda["titulo"].'</title>
              <meta name="title" content="'.$tienda["titulo"].'>">
              <meta name="description" content="'.$tienda["descripcion"].'">';
        $palabras_claves = json_decode($tienda["palabras_clave"], true);

        $p_claves = "";
        foreach ($palabras_claves as $key => $value) {
          # code...
          $p_claves .= $value.", ";
        }
        $p_claves = substr($p_claves, 0, -2);
        echo '<meta name="keywords" content="'.$p_claves.'">';
      }
    }else{
      echo '<title>'.$tienda["titulo"].'</title>
            <meta name="title" content="'.$tienda["titulo"].'>">
            <meta name="description" content="'.$tienda["descripcion"].'">';
      $palabras_claves = json_decode($tienda["palabras_clave"], true);

      $p_claves = "";
      foreach ($palabras_claves as $key => $value) {
        # code...
        $p_claves .= $value.", ";
      }
      $p_claves = substr($p_claves, 0, -2);
      echo '<meta name="keywords" content="'.$p_claves.'">';
    }    
    ?>    
    <!--LINKS Y SCRIPTS-->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">    

     <!--STYLOS CSS-->    
    <link rel="stylesheet" href="<?php echo $tienda["dominio"];?>vistas/css/style.css"> 

    <!--JQUERY-->
    <script src="<?php echo $tienda["dominio"];?>vistas/plugins/jquery/jquery.min.js"></script>

    <!-- TOASTR -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />

    <!-- TOASTR SCRIPT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <?php if (isset($rutas[0])): ?>
      <?php if ($rutas[0] == "dashboard" || $rutas[0] == "products-view" || $rutas[0] = "product-edit" || $rutas[0] == "myprofile" || $rutas[0] == "historyBuy"): ?>
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bbootstrap 4 --> 
        <link rel="stylesheet" href="<?php echo $tienda["dominio"];?>vistas/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo $tienda["dominio"];?>vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="<?php echo $tienda["dominio"];?>vistas/plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo $tienda["dominio"];?>vistas/dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?php echo $tienda["dominio"];?>vistas/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?php echo $tienda["dominio"];?>vistas/plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="<?php echo $tienda["dominio"];?>vistas/plugins/summernote/summernote-bs4.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
      <?php endif ?>
    <?php endif ?>    
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php
    /*==================================
    =            Navegacion            =
    ==================================*/
    $validarRuta = "";
    if (isset($_GET["pagina"])) {
      # code...
      $rutas = explode("/",  $_GET["pagina"]);
      if (is_numeric($rutas[0])) {

        # code...
        $desde = ($rutas[0] - 1)*12;
        $cantidad = 12;
        $productos = controladorProductosComercio::ctrconsultarProductos($desde,$cantidad, null, null);
      }else{
        foreach ($categorias as $key => $value) {
          # code...
          if ($rutas[0] == $value["ruta_categoria"]) {
            # code...
            $validarRuta = "categorias";          
            break; 
          }else{
            $validarRuta = "buscador";
          }
        }
        if ($rutas[0] == "landing") {
          # code...
          $validarRuta = "landing";
        }
        if ($rutas[0] == "myprofile") {
          # code...
          $validarRuta = "myprofile";
        }
        if ($rutas[0] == "historyBuy") {
          # code...
          $validarRuta = "historyBuy";
        }
        if ($rutas[0] == "carrito") {
          # code...
          $validarRuta = "carrito";
        }
        if ($rutas[0] == "dashboard") {
          # code...
          $validarRuta = "dashboard";                    
        }else if ($rutas[0] == "products-view") {
          # code...
          $validarRuta = "products-view";                    
        }else if ($rutas[0] == "salir") {
          # code...
          $validarRuta = "salir";                    
        }else if ($rutas[0] == "product-new") {
          # code...
          $validarRuta = "product-new";                    
        }
        else if ($rutas[0] == "product-edit") {
          # code...
          $validarRuta = "product-edit";                    
        }else if ($rutas[0] == "pedidos") {
          # code...
          $validarRuta = "pedidos";                    
        }
      } 

      /*==================================================
      =            Validar rutas de productos            =
      ==================================================*/
      if (isset($rutas[1])) {
        # code...
        if (is_numeric($rutas[1])) {
          # code...
          $desde = ($rutas[1] - 1)*12;
          $cantidad = 12;
          $productos = controladorProductosComercio::ctrconsultarProductos($desde,$cantidad, null, null);
        }else{
          foreach ($totalProductos as $key => $value) {
            # code...
            if ($rutas[1] == $value["ruta_producto"]) {
              # code...
              $validarRuta = "productos";          
              break; 
            }
          }
        }
      }
      
      
      /*=====  End of Validar rutas de productos  ======*/
      

      /*=====================================
      =            Validar Rutas            =
      =====================================*/
      if ($validarRuta == "categorias") {
        # code...
        include "paginas/categorias.php";  
      }
      else if ($validarRuta == "buscador") {     
        include "paginas/buscador.php";  
      }
      else if ($validarRuta == "productos") {     
        include "paginas/producto.php";  
      }
      else if ($validarRuta == "landing") {     
        include "paginas/landing.php";  
      }
      else if ($validarRuta == "myprofile") {     
        include "paginas/myprofile.php";  
      }
      else if ($validarRuta == "historyBuy") {     
        include "paginas/historyBuy.php";  
      }
      else if ($validarRuta == "carrito") {     
        include "paginas/carrito.php";  
      }
      else if ($validarRuta == "dashboard") {     
        include "paginasComercio/dashboard.php";  
      }
      else if ($validarRuta == "products-view") {     
        include "paginasComercio/productos.php";  
      }
      else if ($validarRuta == "product-edit") {     
        include "paginasComercio/editProduct.php";  
      }
      else if ($validarRuta == "product-new") {     
        include "paginasComercio/newProduct.php";  
      }
      else if ($validarRuta == "pedidos") {     
        include "paginasComercio/pedidos.php";  
      }
      else if ($validarRuta == "salir") {     
        include "paginas/salir.php";  
      }
      else if (is_numeric($rutas[0]) && $rutas[0] <= $totalPaginas) {        
        include "paginas/landing.php";   
      }
      else if (isset($rutas[1]) && is_numeric($rutas[1])) {
        # code...
        include "paginas/landing.php";   
      }
      else{
        include "paginas/404.php";  
      }
    }else{
      include "paginas/landing.php";   
    }
     
      /*=====  End of Validar Rutas  ======*/
      
    /*=====  End of Navegacion  ======*/
    
    ?>
  </div>   
  <input type="hidden" id="rutaActual" value="<?php echo $tienda["dominio"] ?>"> 
  <!-- pagination -->
  <!-- http://josecebe.github.io/twbs-pagination/ -->
  <script src="<?php echo $tienda["dominio"];?>vistas/js/plugins/pagination.min.js"></script>
  <!-- FontAwesome JS -->
    <script src="https://kit.fontawesome.com/68662d198d.js" crossorigin="anonymous"></script>     
    <script src="<?php echo $tienda["dominio"];?>vistas/js/script.js"> </script>
    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo $tienda["dominio"];?>vistas/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>    
    <?php if (isset($rutas[0])): ?>
      <?php if ($rutas[0] == "dashboard" || $rutas[0] == "products-view" || $rutas[0] = "product-edit" || $rutas[0] == "myprofile" || $rutas[0] == "historyBuy"): ?>
        <!-- ChartJS -->
          <script src="<?php echo $tienda["dominio"];?>vistas/plugins/chart.js/Chart.min.js"></script>
          <!-- Sparkline -->
          <script src="<?php echo $tienda["dominio"];?>vistas/plugins/sparklines/sparkline.js"></script>
          <!-- JQVMap -->
          <script src="<?php echo $tienda["dominio"];?>vistas/plugins/jqvmap/jquery.vmap.min.js"></script>
          <script src="<?php echo $tienda["dominio"];?>vistas/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
          <!-- jQuery Knob Chart -->
          <script src="<?php echo $tienda["dominio"];?>vistas/plugins/jquery-knob/jquery.knob.min.js"></script>
          <!-- daterangepicker -->
          <script src="<?php echo $tienda["dominio"];?>vistas/plugins/moment/moment.min.js"></script>
          <script src="<?php echo $tienda["dominio"];?>vistas/plugins/daterangepicker/daterangepicker.js"></script>
          <!-- Tempusdominus Bootstrap 4 -->
          <script src="<?php echo $tienda["dominio"];?>vistas/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
          <!-- Summernote -->
          <script src="<?php echo $tienda["dominio"];?>vistas/plugins/summernote/summernote-bs4.min.js"></script>
          <!-- overlayScrollbars -->
          <script src="<?php echo $tienda["dominio"];?>vistas/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
          <!-- AdminLTE App -->
          <script src="<?php echo $tienda["dominio"];?>vistas/dist/js/adminlte.js"></script>
          <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
          <script src="<?php echo $tienda["dominio"];?>vistas/dist/js/pages/dashboard.js"></script>
          <!-- AdminLTE for demo purposes -->
          <script src="<?php echo $tienda["dominio"];?>vistas/dist/js/demo.js"></script>
      <?php endif ?>
    <?php endif ?>
</body>
</html>

