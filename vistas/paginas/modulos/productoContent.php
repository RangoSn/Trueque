    <?php
    if (isset($rutas[1])) {
      # code...
      $producto = controladorProductosComercio::ctrconsultarProductos(0,1, "ruta_producto", $rutas[1]);      
    }
    ?>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none"><?php echo $producto[0]["nombre_producto"];?></h3>
              <div class="col-12">
                <img src="<?php echo $tienda["dominio"];?>vistas/dist/img/prod-1.jpg" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="<?php echo $tienda["dominio"];?>vistas/dist/img/prod-1.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="<?php echo $tienda["dominio"];?>vistas/dist/img/prod-2.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="<?php echo $tienda["dominio"];?>vistas/dist/img/prod-3.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="<?php echo $tienda["dominio"];?>vistas/dist/img/prod-4.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="<?php echo $tienda["dominio"];?>vistas/dist/img/prod-5.jpg" alt="Product Image"></div>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <form method="post">
                <h3 class="my-3"><?php echo $producto[0]["nombre_producto"];?></h3>
                <hr>
                <h4>Categoria:</h4>
                <div class="container">
                  <h5><?php echo $producto[0]["titulo_categoria"]; ?></h5>
                </div>
                <hr>
                <h4 class="mt-3">Vendedor:</h4>
                <div class="container">
                  <h5><?php echo $producto[0]["nombre_comercio"]; ?></h5>
                </div>
                <hr>
                <div >
                  <h4>Costo:</h4>
                  <div class="container">
                    <h2 class="mb-0">
                      $<?php echo $producto[0]["precio_producto"]; ?>
                    </h2>                    
                  </div>
                </div>
                <hr>    
                <h5 class="mt-2">Cantidad en existencia:</h5>            
                <div class="container">
                  <h5>
                    <?php echo $producto[0]["cantidad_producto"]; ?>
                  </h5>
                </div>
                <?php if (isset($_SESSION["loginUser"])): ?>
                    <?php if ($_SESSION["loginUser"] == "ok"): ?>
                      <!--ID del producto-->
                      <input type="hidden" name="cIdProducto" value="<?php echo $producto[0]["id_producto"]; ?>" >

                      <!--Nombre del producto-->
                      <input type="hidden" name="cProductoName" value="<?php echo $producto[0]["nombre_producto"]; ?>" >

                      <!--Descripcion del producto-->
                      <input type="hidden" name="cDescProd" value="<?php echo $producto[0]["descripcion_producto"]; ?>">

                      <!--Precio del producto-->
                      <input type="hidden" name="cPrecioProducto" id="precioVenta" value="<?php echo $producto[0]["precio_producto"]; ?>">

                      <!--Cantidad de producto a comprar-->
                      <h4 class="mt-2">Cantidad:</h4>
                      <div class="container">
                        <select id="cantidadVenta" class="custom-select" required name="cCantidadProd">
                                <?php
                                for ($i=1; $i < $producto[0]["cantidad_producto"]+1; $i++) { 
                                  # code...
                                  echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                                ?>                             
                              </select>
                      </div>

                      <!--Precio total de la compra-->
                      <input type="hidden" name="cPrecioTotalProducto" id="precioTotalVenta" value="">

                      <!--ID del comercio-->
                      <input type="hidden" name="cIdComercio" value="<?php echo $producto[0]["id_comercio"]; ?>">

                      <!--Nombre del comercio-->
                      <input type="hidden" name="cComercioName" value="<?php echo $producto[0]["nombre_comercio"]; ?>">
                      <div class="container">
                        <h4 class="mt-2">
                          <small id="totalVenta"></small>
                        </h4>
                      </div>
                      <hr>                
                      <div class="mt-4">
                      <?php
                      $registroPedido = controladorTienda::ctrNuevoPedido($_SESSION["user"]);
                      ?>
                      <button type="submit" name="BtnAdd" class="productBtn btn btn-danger btn-lg btn-flat" value="Agregar"><i class="fas fa-cart-plus fa-lg mr-2"></i>Agregar al carrito</button>
                      <div class="btn btn-default btn-lg btn-flat">
                        <i class="fas fa-heart fa-lg mr-2"></i> 
                        Add to Wishlist
                      </div>
                    <?php endif ?>
                  <?php endif ?>
                  <?php if (!isset($_SESSION["loginUser"])): ?>
                    <h4 class="mt-3">Para realizar una compra es necesario que crees una cuenta.</h4>
                  <?php endif ?>
                </div>
              </form>


              <div class="mt-4 product-share">
                <a href="#" class="text-gray">
                  <i class="fab fa-facebook-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fab fa-twitter-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-envelope-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-rss-square fa-2x"></i>
                </a>
              </div>

            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a>
                <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><?php echo $producto[0]["descripcion_producto"]; ?></div>
              <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"><?php echo $producto[0]["descripcion_producto"]; ?></div>
              <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"><?php echo $producto[0]["descripcion_producto"]; ?></div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->