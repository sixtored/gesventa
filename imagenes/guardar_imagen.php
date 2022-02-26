<?php
require 'include\funciones.php';
if (isset($_POST['submit'])) {
$codigo 	= $_POST['codigo'] ;
$name		= $_POST['name'] ;
$descrip 	= $_POST['descrip'] ;
$precio 	= $_POST['precio'] ;

$imagen_nombre 	= $_FILES ['imagen']['name'] ;
$imagen_tamanio = $_FILES ['imagen']['size'] ;
$imagen_tipo 	= $_FILES ['imagen']['type'] ;
$imagen_temp	= $_FILES ['imagen']['tmp_name'] ;

$lim_tamanio = 200000 ; // 200kb

if ($imagen_tamanio>=$lim_tamanio) {
	echo 'imagen muy pesada ' ;
}
$archivo 		= fopen($imagen_temp, 'r+') ;
$imagen_base 	= fread($archivo, $imagen_tamanio) ;
$imagen_base	= addcslashes($imagen_base) ;

$con = conectarbd() ;
global $conexion ;

$query 	= 'SELECT 1 FROM mis_productos LIMIT 1' ;
$result = mysqli_query($conexion, $query) ;
if (!$result) {
  			// si no existe la tabla la creamos..
$query = "CREATE TABLE mis_productos (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  description text COLLATE utf8_unicode_ci NOT NULL,
  price float(10,2) NOT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at timestamp NULL DEFAULT NULL,
  status enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  imagen blob, 
  imagentipo varchar(10), 
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5" ;

$resul = mysqli_query($conexion, $query) ;
}	


		$query = "INSERT INTO mis_productos (id, name, description, price, created, modified, status,
		imagen, imagentipo) VALUES (DEFAULT, '$name', '$descrip', '$precio', DEFAULT, DEFAULT, '$imagen_base',$'imagen_tipo')" ;
		$sqlres = mysqli_query($conexion, $query) ;

		if (!$sqlres) {
			cerrarconexion();
			header('Location:..\carga_producto.php?error') ;
		} else {
			cerrarconexion();
		  header('Location:..\carga_producto.php?cargado') ;
		}

} else {

	header('Location:..\carga_producto.php') ;	
}


?>