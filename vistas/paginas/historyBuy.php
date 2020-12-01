<?php
if (isset($_SESSION["loginUser"])) {
  # code...
  if ($_SESSION["loginUser"] == "ok") { 
    include "modulos/navbarProfile.php";
    include "modulos/sidebar.php";
    include "modulos/historyBuy.php";
  }
}