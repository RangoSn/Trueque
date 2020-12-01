'use strict'
//Total de venta
/*===============================================
=            Calcular total de venta            =
===============================================*/
if ($("#cantidadVenta").val() == 1) {
	var costo = $("#precioVenta").val();
	var cantidad = parseInt($("#cantidadVenta").val());
	var total = costo*cantidad;
	document.getElementById('totalVenta').innerHTML = 'Costo total: $'+total;
	document.getElementById('precioTotalVenta').value = total;

}
$("#cantidadVenta").change(function(){
	var costoTotal = "";
	var costo = $("#precioVenta").val();
	var cantidad = parseInt($("#cantidadVenta").val());
	var total = costo*cantidad;
	document.getElementById('totalVenta').innerHTML = 'Costo total: $'+total;
	document.getElementById('precioTotalVenta').value = total;
});
/*=====  End of Calcular total de venta  ======*/

/*=======================================
=            Cargar imagenes            =
=======================================*/
$("#fotoProducto").change(function(){	
	$("#prevImgEdit").hide();
	var fileName = this.files[0].name;
	$('.custom-file-label').html(fileName);
	var imgProduct = this.files[0];
	if (imgProduct["type"] != "image/jpeg" && imgProduct["type"] != "image/png") {
		var fileName = "Foto de tu producto";
		$('.custom-file-label').html(fileName);
		toastr["error"]("Hubo un error, los formatos deben se jpg o png.", "Error en registro");
		return;
	}else if (imgProduct["size"] > 2000000) {
		var fileName = "Foto de tu producto";
		$('.custom-file-label').html(fileName);
		toastr["error"]("Hubo un error, la imagen es muy pesada.", "Error en registro");
		return;
	}else{
		var datosImg = URL.createObjectURL(imgProduct);
		var img = $('<div class="col-sm-12 prevImg"><div class="card prevImgCard"><img class="card-img-top img-fluid prevImgProd" src="'+ datosImg +'" alt="Card image cap"></div></div>');
		$(img).insertBefore(".productBtn");
	}
});
/*=====  End of Cargar imagenes  ======*/

/*===========================================================
=            Abrir formulario modal de comercios            =
===========================================================*/
$("#formCoOpen").click(function(){
	setTimeout(function(){
	 $('#registerComercioModal').modal('show');
	}, 300);	
});
$("#formCliOpen").click(function(){
	setTimeout(function(){
	 $('#registerModal').modal('show');
	}, 300);	
});

/*=====  End of Abrir formulario modal de comercios  ======*/

/*==================================
=            Paginacion            =
==================================*/
var totalPaginas = Number($('.sync-pagination').attr("totalpagina"));
var paginaActual = Number($('.sync-pagination').attr("paginaActual"));
var rutaActual = $('#rutaActual').val();
var rutaPagina = $('.sync-pagination').attr("rutaPagina");
if ($('.sync-pagination').length != 0) {
	$('.sync-pagination').twbsPagination({
	        totalPages: totalPaginas,
			startPage: paginaActual,
			visiblePages: 4,
			first: "Primero",
			last: "Último",
			prev: '<i class="fas fa-angle-left"></i>',
			next: '<i class="fas fa-angle-right"></i>'
    }).on("page", function(evt, page){
    	if (rutaPagina != "") {
    		window.location = rutaActual+rutaPagina+"/"+page;

    	}else{
    		window.location = rutaActual+page;
    	}
    })	
}
/*=====  End of Paginacion  ======*/

/*================================
=            Buscador            =
================================*/
var rutaBuscador;
$(".buscador").change(function(){
	var busqueda = $(this).val().toLowerCase();
	var expresion = /^[a-z0-9ñÑáéíóú ]*$/;
	if (!expresion.test(busqueda)) {
		$(".buscador").val("");
	}else{
		var evaluarBusqueda = busqueda.replace(/[0-9ñáéíóú ]/g,"_");
		var rutaBuscador = evaluarBusqueda;
			$(".buscar").click(function(e){
			console.log(rutaBuscador);
			if(busqueda.length != 0){
				console.log("hola");
				window.location = rutaActual+rutaBuscador;

			}
			e.stopImmediatePropagation();

		})		
	}

})
/*=====  End of Buscador  ======*/

/*=============================================
BUSCADOR CON ENTER
=============================================*/

$(document).on("keyup", ".buscador", function(evento){

	evento.preventDefault();
	var busqueda = $(this).val().toLowerCase();

	if(evento.keyCode == 13 && busqueda != ""){
		console.log(busqueda);		
		var busqueda = $(this).val().toLowerCase();

		var expresion = /^[a-z0-9ñÑáéíóú ]*$/;

		if(!expresion.test(busqueda)){

			$(".buscador").val("");

		}else{

			var evaluarBusqueda = busqueda.replace(/[0-9ñáéíóú ]/g, "_");

			var rutaBuscador = evaluarBusqueda;

			window.location = rutaActual+rutaBuscador;

		}
		evento.stopImmediatePropagation();


	}

})


