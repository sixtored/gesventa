<?php
//require 'session.php';
require 'basededatos.php' ;
require 'cliente_sitio.php' ;
include '../Configuracion.php';
include '../La-carta.php';
require 'class.phpmailer.php';
require 'class.smtp.php';		


$cart = new Cart;

// redirect to home if cart is empty
if($cart->total_items() <= 0){
    header("Location: index.php");
}


if (isset($_POST)) {
	if (isset($_SESSION['captcha'])) {
		
		$nom 		= strtoupper($_POST['nombre']) ;
		$dire 		= strtoupper($_POST['direccion']) ;
		$celu		= $_POST['celular'] ;
		$email		= strtolower($_POST['email']) ;
		//$contras	= $_POST['contrasenia'] ;
		$captcha 	= $_POST['captcha'] ;

		$control 	= $_SESSION['captcha'] ;

		if ($control == $captcha){
			// guardar los datos en la BBDD
			//echo 'guardar datos en la BBDD' ;
			$base = new BasedeDatos() ;
			$cli = new Cliente_sitio($base) ;

			$cliente = $cli->get_one_cliente($email) ;
			//echo $user->row_cnt ;
			//echo '<br>'.var_dump($usuario) ;
			
			if ($cli->row_cnt>0) {
				// si existe cliente traer ID
					
				$_SESSION['sessCustomerID'] = $cli->id ;
				// GUARDAR PEDIDO
				header("Location:../AccionCarta.php?action=placeOrder") ;

			} else {
				//$password = password_hash($contras, PASSWORD_DEFAULT, array('cost'=> 4));
				//name,$email,$phone,$address
				$cliente = $cli->insertcliente($nom,$email,$dire,$celu) ;
				if ($cli->row_cnt>0) {

					// REGISTRAMOS EL CLIENTE Y TRAER ID
					$_SESSION['sessCustomerID'] = $cli->id ;
					// GUARDAR PEDIDO

				header("Location:../AccionCarta.php?action=placeOrder") ;	

				} else {

				header("Location:../index.php?registroerror") ;
			}
		}

		} else {
			//echo 'No coincide el captcha.' ;
			header("Location:../pedir.php?nocaptcha") ;
		}
	} else {
		//echo 'no existe el captcha' ;
		header("Location:../pedir.php?nocaptcha") ;
	}

} else {
	//echo 'No existe el POST' ;
	header("Location:../index.php") ;
}

?>