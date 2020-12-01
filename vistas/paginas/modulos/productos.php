<?php
if (isset($rutas[0]) && is_numeric($rutas[0])) {
    # code...
    $paginaActual = $rutas[0];
}else{
    $paginaActual = 1;
}
?>
<!-- PRODUCTOS -->                         
    <div class="productos-container">        
        <div class="container pt-5 pb-5"> 
         <div class="text-center">
            <h1>Productos recientes</h1>            
        </div>              
            <div class="row">
                <?php foreach ($productos as $key => $value): ?>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 mt-4">
                    <a href="<?php echo $tienda["dominio"],$value["ruta_categoria"]."/".$value["ruta_producto"];?>">
                        <div class="card">
                            <img loading="lazy" class=" mt-3 card-img-top img-fluid" src="<?php echo $tienda["dominio"]; echo $value["foto_producto"];?>" alt="">
                            <div class="card-body">
                                
                                <h5 class="text-dark"><?php echo $value["id_producto"];?></h5>  
                                <h5 class="text-dark"><?php echo $value["nombre_producto"];?></h5>    
                                <h5 class="text-dark"><?php echo $value["titulo_categoria"];?></h5>                     
                                <p class="text-dark">
                                    <?php echo $value["descripcion_producto"];?> 
                                </p>
                                <h4  class="card-text text-dark">
                                    $<?php echo $value["precio_producto"];?> 
                                </h4>
                                <h5 class="text-dark">Vendedor: <?php echo $value["nombre_comercio"];?></h5>
                                <h5></h5>
                            </div>
                        </div>
                    </a>                
                    </div>  
                <?php endforeach ?>                 
            </div>   
            <div class="container mt-4">
                <ul class="sync-pagination justify-content-center" totalPagina = "<?php  echo $totalPaginas;?>" paginaActual = "<?php echo $paginaActual; ?>" rutaPagina></ul>   
            </div>                 
        </div>           
    </div>
<!--END OF PRODUCTOS -->