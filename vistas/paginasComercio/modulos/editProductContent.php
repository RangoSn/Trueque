<?php
$rutas = explode("/",  $_GET["pagina"]);
$producto = controladorProductosComercio::ctrconsultarProductos(0,1, "id_producto", $rutas[1]);
if ($rutas[1] == "product-new") {
  # code...
  echo '<script>
          if(window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
          }
          window.location = "'.$tienda["dominio"].'product-new"
        </script>';
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Edita tu producto</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nombre del producto</label>
                        <input type="text" required name="eNameProduct" class="form-control" value="<?php echo $producto[0]["nombre_producto"]; ?>" placeholder="Nombre del producto">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Categoría actual</label>
                         <input type="hidden" name="eCategoriaProdPrevId" value="<?php echo $producto[0]["id_categoria"]; ?>" >
                        <input type="text" disabled name="eCategoriaProdPrev" class="form-control" value="<?php echo $producto[0]["titulo_categoria"]; ?>" placeholder="Nombre del producto">
                        <label class="mt-3">Cambiar Categoría</label>
                        <select class="custom-select" name="eCategoriaProd">
                          <option value="">Selecciona una opción</option>
                          <option value="9"><?php echo $categorias[8]["titulo_categoria"]?></option>
                          <option value="2"><?php echo $categorias[1]["titulo_categoria"]?></option>
                          <option value="3"><?php echo $categorias[2]["titulo_categoria"]?></option>
                          <option value="4"><?php echo $categorias[3]["titulo_categoria"]?></option>
                          <option value="5"><?php echo $categorias[4]["titulo_categoria"]?></option>
                          <option value="6"><?php echo $categorias[5]["titulo_categoria"]?></option>
                          <option value="7"><?php echo $categorias[6]["titulo_categoria"]?></option>
                          <option value="8"><?php echo $categorias[7]["titulo_categoria"]?></option>
                          <option value="1"><?php echo $categorias[0]["titulo_categoria"]?></option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Descripción del producto</label>
                        <textarea required class="form-control" name="eDescProd" rows="3"><?php echo $producto[0]["descripcion_producto"]; ?></textarea>
                      </div>
                    </div>                    
                    <div class="col-sm-12">
                      <div class="input-group mb-3">
                        <div class="custom-file">
                           <input type="hidden" name="eFotoProducto" value="<?php echo $producto[0]["foto_producto"]; ?>" >
                            <input type="file" class="custom-file-input" id="fotoProducto" name="fotoProducto" />
                            <label class="custom-file-label" for="fotoProducto">Foto de tu producto</label>
                        </div>
                      </div>                    
                    </div>
                     <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Cantidad actual</label>
                        <input type="hidden" name="eCantidadProdPrev" value="<?php echo $producto[0]["cantidad_producto"]; ?>" >
                        <input type="text" class="form-control" value="<?php echo $producto[0]["cantidad_producto"]; ?>" disabled placeholder="Nombre del producto">
                        <label class="mt-3">Cambia la cantidad de productos</label>
                        <select class="custom-select" name="eCantidadProd">
                          <option value="">Selecciona una opción</option>
                          <?php
                          for ($i=1; $i < 101; $i++) { 
                            # code...
                            echo '<option value="'.$i.'">'.$i.'</option>';
                          }
                          ?>                          
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Precio actual</label>
                        <input type="hidden" name="ePrecioProdPrev" value="<?php echo $producto[0]["precio_producto"]; ?>" >
                        <input type="text" class="form-control" value="<?php echo $producto[0]["precio_producto"]; ?>" disabled placeholder="Nombre del producto">
                        <label class="mt-3">Precio del producto</label>
                        <select class="custom-select" name="ePrecioProd">
                          <option value="">Selecciona una opción</option>
                          <?php
                          for ($i=1; $i < 1001; $i++) { 
                            # code...
                            echo '<option value="'.$i.'">'.$i.'</option>';
                          }
                          ?>                          
                        </select>
                      </div>
                    </div>

                    <?php
                    $editarProducto = controladorProductosComercio::ctreditarProducto($_SESSION["user"], $rutas[1]);
                    if ($editarProducto == "ok") {
                      # code...                      
                      echo '<script>
                              if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                              }
                              
                            </script>';
                      echo '<script>
                              toastr["success"]("Producto registrado");
                              setTimeout(function(){
                                  window.location = "'.$tienda["dominio"].'products-view"
                                },2000);
                            </script>
                         ';              
                    }
                    ?> 
                    <div id="prevImgEdit" class="col-sm-12 prevImg">
                      <div class="card prevImgCard">
                        <img class="card-img-top img-fluid prevImgProd" src="<?php echo $tienda["dominio"],$producto[0]["foto_producto"]; ?>" alt="Card image cap">
                      </div>
                    </div>
                     <div class="col-sm-12">            
                      <button type="submit" class="productBtn btn btn-danger">Registrar</button>
                    </div>        
                  </div>
                                  
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->            
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->