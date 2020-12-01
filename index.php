<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/tienda.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/productosComercio.controlador.php";
require_once "modelos/tienda.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/productosComercio.modelo.php";
$plantilla = new controladorPlantilla();
$plantilla -> ctrincluirPlantilla();