<?php require("session.php"); 
	header("Content-Type: image/jpeg") ;
	$chars = "0123456789";
	$string = "";
	$num_chars = 5;
	for($i=0;$i<$num_chars;$i++)
	{
		$random = rand(0,strlen($chars)-1);
		$string .= substr($chars,$random,1);
	}
	$_SESSION["captcha"] = $string ;

	$captcha 	= imagecreate(120, 40) ;
	$fondo 		= imagecolorallocate($captcha, 245, 210, 113) ;
	$color		= imagecolorallocate($captcha, 64, 76, 245) ;
	$color_line = imagecolorallocate($captcha, 227, 14, 67) ;
	imagestring($captcha, 6, 10, 10, $string, $color) ;
	imageline($captcha, 5, 5, 120, 20, $color_line) ;
	//imageline($captcha, 5, 10, 120, 40, $color_line) ;

	imagejpeg($captcha) ;
	
	//imagepng($captcha);
	
?>