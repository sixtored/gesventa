<?php

$img 	= urldecode($_GET['img']) ;
$base	= urldecode($_GET['dst_img']) ;
//$img 	= "space.jpg" ;//$_GET['img'] ;
$marca 	= "marca_2.png" ;

//$ancho = 600 ;
//$alto  = 600 ;
 


$ancho 	= $_GET['ancho'] ;
$alto 	= $_GET['alto'] ;

$imagen = imagecreatefrompng($marca) ;  // Marca de agua
//$fuente 	= @imagecreatefrompng($img) ;


$extencion = strtolower(substr($img, -3)) ;

switch ($extencion) {
	case 'png':
		# code...
		$fuente 	= @imagecreatefrompng($img) ;
		$ancho_o 	= imagesx($fuente) ;
		$alto_o		= imagesy($fuente) ;

		$origen 	= @imagecreatetruecolor($alto,$ancho);
		//$base 		= 'unidad4.png' ;
		$imagen1 	= imagecreate($ancho,$alto) ;
		imagecopyresized($origen, $fuente, 0, 0, 0, 0, $ancho, $alto, $ancho_o, $alto_o) ;
		imagejpeg($origen, $base) ;

		$imagen2 = imagecreatefrompng($base) ;
		$formato = 'image/png' ;
		@imagedestroy($origen) ;
		break;

	case 'jpg':
		# code...
		#$img = 'imagenes/space.jpg' ;
		$fuente 	= @imagecreatefromjpeg($img) ;

		//$ancho = $ancho ;
		//$alto  = $alto ;

		$ancho_o 	= imagesx($fuente) ;
		$alto_o		= imagesy($fuente) ;

		$origen 	= @imagecreatetruecolor($ancho,$alto);
		//$base 		= 'unidad4.jpg' ;
		$imagen1 	= imagecreate($ancho,$alto) ;
		imagecopyresized($origen, $fuente, 0, 0, 0, 0, $ancho, $alto, $ancho_o, $alto_o) ;
		imagejpeg($origen, $base) ;
		
		$imagen2 = imagecreatefromjpeg($base) ;
		$formato = 'image/jpeg' ;
		@imagedestroy($origen) ;
		break;	
		
	case 'gif':
		# code...
		$fuente 	= @imagecreatefromgif($img) ;
		$ancho_o 	= imagesx($fuente) ;
		$alto_o		= imagesy($fuente) ;

		$origen 	= @imagecreatetruecolor($alto,$ancho);
		//$base 		= 'unidad4.gif' ;
		$imagen1 	= imagecreate($ancho,$alto) ;
		imagecopyresized($origen, $fuente, 0, 0, 0, 0, $ancho, $alto, $ancho_o, $alto_o) ;
		imagejpeg($origen, $base) ;

		$imagen2 = imagecreatefromgif($base) ;
		$formato = 'image/gif' ;
		@imagedestroy($origen) ;
		break;			
	
	default:
		# code...
		echo 'Error' ;
		break;
}


$extencion = strtolower(substr($base, -3)) ;

switch ($extencion) {
	case 'png':
		# code...

		$imagen2 = imagecreatefrompng($base) ;
		$formato = 'image/png' ;
		break;

	case 'jpg':
		# code...
		$imagen2 = imagecreatefromjpeg($base) ;
		$formato = 'image/jpeg' ;
		break;	
		
	case 'gif':
		# code...
		$imagen2 = imagecreatefromgif($base) ;
		$formato = 'image/gif' ;
		break;			
	
	default:
		# code...
		echo 'Error' ;
		break;
}


imagecopy($imagen2, $imagen, 70, 80, 0, 0, imagesx($imagen), imagesy($imagen)) ;
header("Content-Type: ".$formato) ;
imagejpeg($imagen2);


?>