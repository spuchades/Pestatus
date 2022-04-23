<?php 
//la primera vista del usuario será una interfaz muy agradable en la que via template accedemos al login por mediacion del boton
//implementado en el fichero acceso.php
//templarizar nos permite que mediante require podemos trasladar diseños predefinidos a lo largo de nuestra aplicacion sin duplicar codigo 
$header  = "view/templates/header.php";
require($header);
$content = "view/acceso.php";
require($content);
$footer  = "view/templates/footer.php";
require($footer);

?>

