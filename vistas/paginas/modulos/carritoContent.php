<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Carrito de compras</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">Carrito</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php if (empty($_SESSION["carrito"])): ?>
            <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Nota:</h5>
            <h2>
               No hay productos en tu carrito.
            </h2>
          </div>          
          <?php endif ?>
          <?php if (!empty($_SESSION["carrito"])): ?>
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> Trueque.
                   
                    <small class="float-right">Date:  <?php echo date("m/d/Y g:i a");                
                    ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From                  
                    <address>
                    <strong>Admin, Inc.</strong><br>
                    Nombre: <?php echo $_SESSION["dataUser"]["nombreCliente"]?><br>
                    Apellido: <?php echo $_SESSION["dataUser"]["ApellidoCliente"]?><br>
                    Dirección: <?php echo $_SESSION["dataUser"]["DireccionCliente"]?><br>
                    Email: <?php echo $_SESSION["dataUser"]["emailCliente"]?>
                  </address>                  
                </div>
 
                <div class="col-sm-4  invoice-col">
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Due:</b> 2/22/2014<br>
                  <b>Account:</b> 968-34567
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Cantidad</th>
                      <th>Nombre</th>
                      <th>Description</th>
                      <th>Total</th>
                      <th>--</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $totalVenta=0;?>
                    <?php foreach ($_SESSION["carrito"] as $key => $value): ?>
                      <tr>
                      <td><?php echo $value["cantidad"];?></td>
                      <td><?php echo $value["nombreProducto"];?></td>
                      <td><?php echo $value["descProducto"];?></td>
                      <td><?php echo $value["totalProducto"];?></td>
                      <td>
                        <form method="POST">
                          <input type="hidden" name="eIdProducto" value="<?php echo $value["idProducto"];?>" >
                          <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                          <?php
                           $totalVenta = $totalVenta+$value["totalProducto"];
                           $EliminarItem = new controladorTienda();
                           $EliminarItem -> ctrEliminarItemPedido();
                           ;
                           ?>
                        </form>                         
                      </td>
                      </tr>
                    <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">                
                <div class="col-12">
                  
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:100%">Total de compra:</th>
                        <td>$<?php echo $totalVenta;?></td>
                      </tr>
                    </table>
                  </div>
                  <!-- this row will not appear when printing -->
                  <div class="row no-print">
                    <div class="col-12">
                      <form method="post">
                        <input type="hidden" name="ntotalVenta" value="<?php echo $totalVenta;?>">
                        <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Comprar
                        </button>   
                        <?php
                        $Compra = controladorTienda::ctrNuevaVenta();
                        ?>                 
                      </form>
                    </div>
                  </div>
                </div>
                <hr>
                <!-- /.col -->
                <!-- accepted payments column -->
                <div class="col-12">
                  <p class="lead">Payment Methods:</p>
                  <img src="vistas/dist/img/credit/visa.png" alt="Visa">
                  <img src="vistas/dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="vistas/dist/img/credit/american-express.png" alt="American Express">
                  <img src="vistas/dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.invoice -->
          <?php endif ?>
          


          
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->