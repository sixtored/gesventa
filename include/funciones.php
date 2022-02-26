<?php

## 

function redirect_to($url)
	{
		//echo "<script>location.href='".$url."';</script>";
		//die();
		header("Location:".$url);
		exit();
	}

#conexion a la Base de Datos..

	function conectarbd(){
	$lnRet = 0 ;
	global $conexion ;
	$conexion=mysqli_connect("localhost","root","");

	if (!$conexion){
	
	die ("Error de conexión ".mysqli_error($conexion));
	
	}
	
	mysqli_select_db($conexion,"carta") or die ("Error al conectar con la base de datos ".mysqli_error($conexion));
	$lnRet = 1 ;
	RETURN $lnRet ;
	}

	#Cerrar Base de Datos
	function cerrarconexion(){
	
	mysqli_close($GLOBALS['conexion']);
	
	}

function mostrar_foto($codigo){	

//include('..\Configuracion.php') ;
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'carta';

$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
//$db = pg_connect("host=$dbHost dbname=$dbName user=$dbUsername password=$dbPassword");

if ($db->connect_error) {
    die("No hay Conexion con la base de datos: " . $db->connect_error);
} 

$sql_foto = 'SELECT foto, tipo FROM fotos_productos where codigo='.$codigo ;
$result = $db->query($sql_foto) ;
if ($result->num_rows>0){
$ofoto = $result->fetch_assoc() ;
$imagen = $ofoto['foto'] ;
$tipo   = $ofoto['tipo'] ;
// $image = new Gmagick();
// $image->readimageblob($imagen);
$path = "imagenes"."\\\\";
$archivo = $path.$codigo . '.'.$tipo ;
//print_r($archivo) ;

$f = fopen($archivo,"w+");
fwrite($f, base64_decode($imagen));
fclose($f);

//echo '<img src="data:'.$tipo.';base64,' .  $imagen  . '" width="200" height="200" />';

$sourcefile = $archivo ;
$endfile  = $path."tumb_".$codigo . '.'.$tipo ;
$thumbwidth = 200 ;
$thumbheight = 200 ;
$quality = 75 ;

//function makeThumbnail($sourcefile, $endfile, $thumbwidth, $thumbheight, $quality) {
       // Takes the sourcefile (path/to/image.jpg) and makes a thumbnail from it
       // and places it at endfile (path/to/thumb.jpg).

       // Load image and get image size.
      // header("Content-type: image/jpeg");
       $img = imagecreatefromjpeg($sourcefile);
       $width = imagesx( $img );
       $height = imagesy( $img );

       if ($width > $height) {
           $newwidth = $thumbwidth;
           $divisor = $width / $thumbwidth;
           $newheight = floor( $height / $divisor);
       } else {
           $newheight = $thumbheight;
           $divisor = $height / $thumbheight;
           $newwidth = floor( $width / $divisor );
       }

       // Create a new temporary image.
       $tmpimg = imagecreatetruecolor( $newwidth, $newheight );

       // Copy and resize old image into new image.
       imagecopyresampled( $tmpimg, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );

       // Save thumbnail into a file.
       imagejpeg($tmpimg,$endfile,$quality);  
       // release the memory
       imagedestroy($tmpimg);
       imagedestroy($img);
    
      return $endfile ; 

  } else {
  	return "imagenes\gesventa_05b.jpg" ;
  }     
}



?>

