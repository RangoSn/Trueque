<?php
$productos = controladorProductosComercio::ctrconsultarProductosComercio($_SESSION["user"]);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Simple Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php if (empty($productos)): ?>
      <div class="callout callout-info">
         <h5><i class="fas fa-info"></i> Nota:</h5>
         <h2>
            No hay productos.
         </h2>
      </div>   
    <?php endif ?>
    <?php if (!empty($productos)): ?>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Todos mis productos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th style="width: 10px">#</th>                      
                        <th>Nombre del producto</th>
                        <th>Categoria</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($productos as $key => $value): ?>
                        <tr>
                          <td><?php echo $value["id_producto"];?>.</td>
                          <td><?php echo $value["nombre_producto"];?></td>
                          <td><?php echo $value["titulo_categoria"];?></td>
                          <td>
                            <div class="btn-group">
                              <div class="px-1">
                                <a href="<?php echo $tienda["dominio"]."product-edit/".$value["id_producto"];?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                              </div>
                              <div class="px-1">
                                <form method="POST">
                                  <input type="hidden" name="eProducto" value="<?php echo $value["id_producto"]; ?>" >
                                  <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                  <?php
                                  $eliminarProducto = new controladorProductosComercio();
                                  $eliminarProducto -> ctrEliminarProducto();
                                  ?>
                                </form> 
                              </div>           
                            </div>
                          </td>                        
                        </tr>                      
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    <?php endif ?>
  </div>
  <!-- /.content-wrapper -->