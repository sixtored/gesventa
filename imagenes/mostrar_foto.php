<?php
include('..\Configuracion.php') ;

$codigo = $_GET['codigo'] ;

$sql_foto = 'SELECT foto, tipo FROM fotos_productos where codigo='.$codigo ;
$result = $db->query($sql_foto) ;
if ($result->num_rows>0){
$ofoto = $result->fetch_assoc() ;
$imagen = $ofoto['foto'] ;
$tipo   = $ofoto['tipo'] ;
// $image = new Gmagick();
// $image->readimageblob($imagen);
$archivo = $codigo . '.'.$tipo ;
print_r($archivo) ;

$f = fopen($archivo,"w+");
fwrite($f, base64_decode($imagen));
fclose($f);

//echo '<img src="data:'.$tipo.';base64,' .  $imagen  . '" width="200" height="200" />';

$sourcefile = $archivo ;
$endfile  = "tumb_".$archivo ;
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
       imagejpeg($tmpimg, $endfile, $quality );  
       // release the memory
       //imagedestroy($tmpimg);
       //imagedestroy($img);

  } else {
   

  }     

?>
