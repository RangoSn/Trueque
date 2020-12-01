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
                <h3 class="card-title">Nuevo producto</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nombre del producto</label>
                        <input type="text" required id="NameProduct" name="rNameProduct" class="form-control" placeholder="Nombre del producto">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Categoría</label>
                        <select class="custom-select" name="rCategoriaProd" required>
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
                        <textarea required class="form-control" name="rDescProd" rows="3" placeholder="..."></textarea>
                      </div>
                    </div>                    
                    <div class="col-sm-12">
                      <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" required class="custom-file-input" id="fotoProducto" name="fotoProducto" />
                            <label class="custom-file-label" for="fotoProducto">Foto de tu producto</label>
                        </div>
                      </div>                    
                    </div>
                     <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Cantidad de productos</label>
                        <select class="custom-select" required name="rCantidadProd">
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
                        <label>Precio del producto</label>
                        <input type="number" required name="rPrecioProduct" class="form-control" placeholder="Precio">
                      </div>
                    </div>

                    <?php
                    $registroProductos = controladorProductosComercio::ctrnuevoProducto($_SESSION["user"]);
                    if ($registroProductos == "ok") {
                      # code...                      
                      echo '<script>
                              if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                              }
                            </script>';
                      echo '<script>
                              toastr["success"]("Producto registrado");
                            </script>';              
                    }
                    ?> 
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