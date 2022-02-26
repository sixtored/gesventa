<?php
require 'funciones.php'

//echo 'guardar datos en la BBDD' ;
if isset($_GET['codigo']) {
$con = conectarbd() ;
global $conexion ;

$codigo = $_GET['codigo'] ;

$query 	= 'SELECT foto, tipo FROM fotos_productos where codigo='.$codigo ;
$result = mysqli_query($conexion, $query) ;
if ($result){

$imagen = mysqli_fetch_row($result) ;

$image = new Gmagick();
$image->readimageblob($imagen);
echo '<img src="data:image/jpeg;base64,' .  base64_encode($image->getimageblob())  . '" />';
} else {
	echo 'ERROR ' ;
	}

cerrarconexion();
}


?>